<?php

namespace App\Exports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $filters = $this->filters;
        $data = Data::query();
        // Apply filters
        if (isset($filters['code'])) {
            $data->where('code', 'LIKE', '%'.$filters['code'].'%');
        }

        if (isset($filters['from']) && isset($filters['to'])) {
            $data->whereBetween('date', [$filters['from'], $filters['to']]);
        } elseif (isset($filters['from'])) {
            $data->where('date', '>=', $filters['from']);
        } elseif (isset($filters['to'])) {
            $data->where('date', '<=', $filters['to']);
        }

        if (isset($filters['identifier'])) {
            $data->where('identifier', 'like', '%' . $filters['identifier'] . '%');
        }

        if (isset($filters['employee'])) {
            $data->whereIn('employee_id', $filters['employee']);
        }

        if (isset($filters['channel'])) {
            $data->whereIn('channel', $filters['channel']);
        }

        if (isset($filters['call_type'])) {
            $data->whereIn('call_type', $filters['call_type']);
        }

        if (isset($filters['age_band'])) {
            $data->whereIn('age_band', $filters['age_band']);
        }

        if (isset($filters['gender'])) {
            $data->whereIn('gender', $filters['gender']);
        }

        if (isset($filters['sexuality'])) {
            $data->whereIn('sexuality', $filters['sexuality']);
        }

        if (isset($filters['diagnoses'])) {
            $data->whereIn('diagnoses', $filters['diagnoses']);
        }

        if (isset($filters['triggers'])) {
            $data->whereIn('triggers', $filters['triggers']);
        }

        if (isset($filters['self_harm_method'])) {
            $data->whereIn('self_harm_method', $filters['self_harm_method']);
        }

        if (isset($filters['contact_type'])) {
            $data->whereIn('contact_type', $filters['contact_type']);
        }

        if (isset($filters['location'])) {
            $data->whereIn('location', $filters['location']);
        }

        if (isset($filters['service_awareness'])) {
            $data->whereIn('service_awareness', $filters['service_awareness']);
        }

        if (isset($filters['other_involved_services'])) {
            $data->whereIn('other_involved_services', $filters['other_involved_services']);
        }

        if (isset($filters['personal_situation'])) {
            $data->whereIn('personal_situation', $filters['personal_situation']);
        }

        if (isset($filters['specific_issues'])) {
            $data->whereIn('specific_issues', $filters['specific_issues']);
        }

        if (isset($filters['use_for'])) {
            $data->whereIn('use_for', $filters['use_for']);
        }

        if (isset($filters['outcomes'])) {
            $data->whereIn('outcomes', $filters['outcomes']);
        }

        $data = $data->orderBy('date')->get();

        $transformedData = collect([$this->headings()]);
        // Transform data to replace IDs with actual values
        $transformedData = $transformedData->merge($data->map(function ($item) {

            $diagnosesResults = [];
            $triggerResults = [];
            $selfharmResults = [];
            $situationResults = [];
            $issuesResults = [];
            $usageResults = [];
            $outcomeResults = [];

            $diagnosesArray = array_map('trim', explode(',', $item->diagnoses));
            $diagnosesResults = array_map(function($diagnoses) {
                return getIssues('diagnose', $diagnoses);
            }, $diagnosesArray);
            // $diagnosesResults = implode(',', $diagnosesResults);

            $triggerArray = array_map('trim', explode(',', $item->triggers));
            $triggerResults = array_map(function($triggers) {
                return getIssues('trigger', $triggers);
            }, $triggerArray);
            // $triggerResults = implode(',', $triggerResults);

            $selfharmArray = array_map('trim', explode(',', $item->self_harm_method));
            $selfharmResults = array_map(function($self_harm_method) {
                return getIssues('self_harm', $self_harm_method);
            }, $selfharmArray);
            // $selfharmResults = implode(',', $selfharmResults);

            $situationArray = array_map('trim', explode(',', $item->personal_situation));
            $situationResults = array_map(function($personal_situation) {
                return getSituation('personal', $personal_situation);
            }, $situationArray);
            // $situationResults = implode(',', $situationResults);

            $issuesArray = array_map('trim', explode(',', $item->specific_issues));
            $issuesResults = array_map(function($specific_issues) {
                return getIssues('specific', $specific_issues);
            }, $issuesArray);
            // $issuesResults = implode(',', $issuesResults);

            $usageArray = array_map('trim', explode(',', $item->use_for));
            $usageResults = array_map(function($use_for) {
                return getPlatforms('usage', $use_for);
            }, $usageArray);
            // $usageResults = implode(',', $usageResults);

            $outcomeArray = array_map('trim', explode(',', $item->outcomes));
            $outcomeResults = array_map(function($outcomes) {
                return getPlatforms('outcomes', $outcomes);
            }, $outcomeArray);
            // $outcomeResults = implode(',', $outcomeResults);

            return [
                'date' => $item->date,
                'code' => "#".$item->code,
                'identifier' => $item->identifier,
                'channel' => getPlatforms('social', $item->channel),
                'call_type' => getGenStatus('general', $item->call_type),
                'age_band' => getAgeBand('age', $item->age_band),
                'gender' => getGenderStatus('gender', $item->gender),
                'sexuality' => getGenderStatus('sexuality', $item->sexuality),
                'diagnoses' => $diagnosesResults,
                'triggers' => $triggerResults,
                'self_harm_method' => $selfharmResults,
                'contact_type' => getIssues('contact_type', $item->contact_type),
                'location' => getLocation('country', $item->location),
                'service_awareness' => getPlatforms('service_awareness', $item->service_awareness),
                'other_involved_services' => getGenStatus('bool', $item->other_involved_services),
                'personal_situation' => $situationResults,
                'specific_issues' => $issuesResults,
                'use_for' => $usageResults,
                'outcomes' => $outcomeResults,
            ];
        }));

        logger($transformedData);
        return $transformedData;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'Date',
            'Code',
            'Identifier',
            'Channel',
            'Call Type',
            'Age Band',
            'Gender',
            'Sexuality',
            'Diagnoses',
            'Triggers',
            'Self Harm Method',
            'Contact Type',
            'Location',
            'Service Awareness',
            'Other Involved Services',
            'Personal Situation',
            'Specific Issues',
            'Use For',
            'Outcomes',
        ];

    }
}
