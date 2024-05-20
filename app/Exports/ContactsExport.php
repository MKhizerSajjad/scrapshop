<?php

namespace App\Exports;

use App\Models\Contacts;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contacts::all();

        // return Contacts::select("id", "name", "email")->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            'date_time',
            'exclude_date_time',
            'code',
            'exclude_code',
            'identifier',
            'exclude_identifier',
            'channel',
            'exclude_channel',
            'call_type',
            'exclude_call_type',
            'age_band',
            'exclude_age_band',
            'gender',
            'exclude_gender',
            'sexuality',
            'exclude_sexuality',
            'diagnoses',
            'exclude_diagnoses',
            'triggers',
            'exclude_triggers',
            'self_harm_method',
            'exclude_self_harm_method',
            'contact_type',
            'exclude_contact_type',
            'location',
            'exclude_location',
            'service_awareness',
            'exclude_service_awareness',
            'other_involved_services',
            'exclude_other_involved_services',
            'personal_situation',
            'exclude_personal_situation',
            'specific_issues',
            'exclude_specific_issues',
            'use_for',
            'exclude_use_for',
            'outcomes',
            'exclude_outcomes'
        ];

    }
}
