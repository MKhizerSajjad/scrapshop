<?php

namespace App\Exports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Data::all();

        // Transform data to replace IDs with actual values
        $transformedData = $data->map(function ($item) {

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


// $outcomeArray = array_map('trim', explode(',', $item->outcomes));
// $outcomeResults = [];
// foreach ($outcomeArray as $outcomes) {
//     $platforms = getPlatforms('outcomes', $outcomes);
//     // If getPlatforms returns an array, merge it into $outcomeResults
//     if (is_array($platforms)) {
//         $outcomeResults = array_merge($outcomeResults, $platforms);
//     } else {
//         $outcomeResults[] = $platforms;
//     }
// }

            return [
                'date' => $item->date,
                'code' => $item->code,
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
        });

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
            'date',
            'code',
            'identifier',
            'channel',
            'call_type',
            'age_band',
            'gender',
            'sexuality',
            'diagnoses',
            'triggers',
            'self_harm_method',
            'contact_type',
            'location',
            'service_awareness',
            'other_involved_services',
            'personal_situation',
            'specific_issues',
            'use_for',
            'outcomes',
        ];

    }
}
