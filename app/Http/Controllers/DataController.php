<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Data::query();

        // Apply filters
        if ($request->filled('code')) {
            $data->where('code', $request->input('code'));
        }

        if ($request->filled('identifier')) {
            $data->where('identifier', 'like', '%' . $request->input('identifier') . '%');
        }

        if ($request->filled('channel')) {
            $data->whereIn('channel', $request->input('channel'));
        }

        if ($request->filled('call_type')) {
            $data->whereIn('call_type', $request->input('call_type'));
        }

        if ($request->filled('age_band')) {
            $data->whereIn('age_band', $request->input('age_band'));
        }

        if ($request->filled('gender')) {
            $data->whereIn('gender', $request->input('gender'));
        }

        if ($request->filled('sexuality')) {
            $data->whereIn('sexuality', $request->input('sexuality'));
        }

        if ($request->filled('diagnoses')) {
            $data->whereIn('diagnoses', $request->input('diagnoses'));
        }

        if ($request->filled('triggers')) {
            $data->whereIn('triggers', $request->input('triggers'));
        }

        if ($request->filled('self_harm_method')) {
            $data->whereIn('self_harm_method', $request->input('self_harm_method'));
        }

        if ($request->filled('contact_type')) {
            $data->whereIn('contact_type', $request->input('contact_type'));
        }

        if ($request->filled('location')) {
            $data->whereIn('location', $request->input('location'));
        }

        if ($request->filled('service_awareness')) {
            $data->whereIn('service_awareness', $request->input('service_awareness'));
        }

        if ($request->filled('other_involved_services')) {
            $data->whereIn('other_involved_services', $request->input('other_involved_services'));
        }

        if ($request->filled('personal_situation')) {
            $data->whereIn('personal_situation', $request->input('personal_situation'));
        }

        if ($request->filled('specific_issues')) {
            $data->whereIn('specific_issues', $request->input('specific_issues'));
        }

        if ($request->filled('use_for')) {
            $data->whereIn('use_for', $request->input('use_for'));
        }

        if ($request->filled('outcomes')) {
            $data->whereIn('outcomes', $request->input('outcomes'));
        }

        // // Apply filters dynamically
        // $filters = $request->except('_token');
        // foreach ($filters as $field => $value) {
        //     // echo json_encode($value);
        //     // if ($value !== null && $value !== '') {
        //     // if ($request->filled($value)) {
        //         // $value = $request->value($value);
        //         // echo ($field .'----'. json_encode($value)) . '<br><br>';
        //         echo '***<--'. $field .'-->';
        //         if (is_array($value)) {
        //             echo '<--'. $field .'-->' . json_encode($value);
        //             $data->whereIn($field, $value);
        //         } else {
        //             // echo $value;
        //             // Assuming 'identifier' field should use 'like' condition
        //             if ($field == 'identifier') {
        //                 $data->where($field, 'like', '%' . $value . '%');
        //             } else {
        //                 $data->where($field, $value);
        //             }
        //         }
        //     // }
        // }

        $data = $data->paginate(50);

        return view('data.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'first_name' => 'required',
        //     'title' => 'nullable',
        //     'email' => 'nullable|email',
        //     'mobile_phone' => 'nullable',
        // ]);


        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'date_time' => $request->date_time,
            'code' => $request->code,
            'identifier' => $request->identifier,
            'channel' => $request->channel,
            'call_type' => $request->call_type,
            'age_band' => $request->age_band,
            'gender' => $request->gender,
            'sexuality' => $request->sexuality,
            'diagnoses' => implode(', ', $request->diagnoses),
            'triggers' => implode(', ', $request->triggers),
            'self_harm_method' => implode(', ', $request->self_harm_method),
            'contact_type' => $request->contact_type,
            'location' => $request->location,
            'service_awareness' => $request->service_awareness,
            'other_involved_services' => $request->other_involved_services,
            'personal_situation' => $request->personal_situation,
            'specific_issues' => $request->specific_issues,
            'use_for' => $request->use_for,
            'outcomes' => $request->outcomes,
            'note' => $request->note
        ];

        Data::create($data);

        return redirect()->route('data.create')->with('success','Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Data $data)
    {
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Data $data)
    {
        return view('data.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Data $data)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'title' => 'nullable',
            'email' => 'nullable|email',
            'mobile_phone' => 'nullable',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'title' => $request->title,
            'company' => $request->company,
            'company_name_for_emails' => $request->company_name_for_emails,
            'email' => $request->email,
            'email_status' => $request->email_status,
            'email_confidence' => $request->email_confidence,
            'seniority' => $request->seniority,
            'departments' => $request->departments,
            'contact_owner' => $request->contact_owner,
            'first_phone' => $request->first_phone,
            'work_direct_phone' => $request->work_direct_phone,
            'home_phone' => $request->home_phone,
            'mobile_phone' => $request->mobile_phone,
            'corporate_phone' => $request->corporate_phone,
            'other_phone' => $request->other_phone,
            'stage' => $request->stage,
            'lists' => $request->lists,
            'last_contacted' => $request->last_contacted,
            'account_owner' => $request->account_owner,
            'employees' => $request->employees,
            'industry' => $request->industry,
            'keywords' => $request->keywords,
            'person_linkedin' => $request->person_linkedin,
            'url' => $request->url,
            'website' => $request->website,
            'company_linkedin_url' => $request->company_linkedin_url,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'company_address' => $request->company_address,
            'company_city' => $request->company_city,
            'company_state' => $request->company_state,
            'company_country' => $request->company_country,
            'company_phone' => $request->company_phone,
            'seo_description' => $request->seo_description,
            'technologies' => $request->technologies,
            'annual_revenue' => $request->annual_revenue,
            'total_funding' => $request->total_funding,
            'latest_funding' => $request->latest_funding,
            'latest_funding_amount' => $request->latest_funding_amount,
            'last_raised_at' => $request->last_raised_at,
            'email_sent' => $request->email_sent,
            'email_open' => $request->email_open,
            'email_bounced' => $request->email_bounced,
            'replied' => $request->replied,
            'demoed' => $request->demoed,
            'number_of_retail_locations' => $request->number_of_retail_locations,
            'apollo_contact_id' => $request->apollo_contact_id,
            'apollo_account_id' => $request->apollo_account_id,
        ];

        $updated = Contacts::find($contacts->id)->update($data);

        return redirect()->route('data.index')->with('success','Record created successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Data $data)
    {
        //
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new ContactsExport, 'data.csv');
        // return back()->with('success','Contacts exported successfully');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file', // |mimetypes:csv
        ]);

        $file = request()->file('file');

        if ($file->getClientOriginalExtension() !== 'csv') {
            return back()->withErrors(['file' => 'The uploaded file must be a CSV.']);
        }

        Excel::import(new ContactsImport, $file);

        return back()->with('success','Contacts imported successfully');
    }
}
