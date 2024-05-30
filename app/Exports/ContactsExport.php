<?php

namespace App\Exports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;

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
            return [
                'date' => $item->date,
                'code' => $item->code,
                'identifier' => $item->identifier,
                'channel' => getPlatforms('social', $item->channel),
                'call_type' => getGenStatus('general', $item->call_type),
                'age_band' => getAgeBand('age', $item->age_band),
                'gender' => getGenderStatus('gender', $item->gender),
                'sexuality' => getGenderStatus('sexuality', $item->sexuality),
                'diagnoses' => getIssues('diagnose', $item->diagnoses),
                'triggers' => getIssues('trigger', $item->triggers),
                'self_harm_method' => getIssues('self_harm', $item->self_harm_method),
                'contact_type' => getIssues('contact_type', $item->contact_type),
                'location' => getLocation('country', $item->location),
                'service_awareness' => getPlatforms('service_awareness', $item->service_awareness),
                'other_involved_services' => getGenStatus('bool', $item->other_involved_services),
                'personal_situation' => getSituation('personal', $item->personal_situation),
                'specific_issues' => getIssues('specific', $item->specific_issues),
                'use_for' => getPlatforms('usage', $item->use_for),
                'outcomes' => getPlatforms('outcomes', $item->outcomes),
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
