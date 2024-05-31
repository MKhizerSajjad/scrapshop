<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Data;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Data::with('employee');

        // Apply filters
        if ($request->filled('code')) {
            $data->orWhere('code', 'LIKE', '%'.$request->input('code').'%');
        }

        if ($request->filled('from') && $request->filled('to')) {
            $data->orWhereBetween('date', [$request->input('from'), $request->input('to')]);
        } elseif ($request->filled('from')) {
            $data->orWhere('date', '>=', $request->input('from'));
        } elseif ($request->filled('to')) {
            $data->orWhere('date', '<=', $request->input('to'));
        }

        if ($request->filled('identifier')) {
            $data->orWhere('identifier', 'like', '%' . $request->input('identifier') . '%');
        }

        if ($request->filled('employee')) {
            $data->orWhereIn('employee_id', $request->input('employee'));
        }

        if ($request->filled('channel')) {
            $data->orWhereIn('channel', $request->input('channel'));
        }

        if ($request->filled('call_type')) {
            $data->orWhereIn('call_type', $request->input('call_type'));
        }

        if ($request->filled('age_band')) {
            $data->orWhereIn('age_band', $request->input('age_band'));
        }

        if ($request->filled('gender')) {
            $data->orWhereIn('gender', $request->input('gender'));
        }

        if ($request->filled('sexuality')) {
            $data->orWhereIn('sexuality', $request->input('sexuality'));
        }

        if ($request->filled('diagnoses')) {
            $data->orWhereIn('diagnoses', $request->input('diagnoses'));
        }

        if ($request->filled('triggers')) {
            $data->orWhereIn('triggers', $request->input('triggers'));
        }

        if ($request->filled('self_harm_method')) {
            $data->orWhereIn('self_harm_method', $request->input('self_harm_method'));
        }

        if ($request->filled('contact_type')) {
            $data->orWhereIn('contact_type', $request->input('contact_type'));
        }

        if ($request->filled('location')) {
            $data->orWhereIn('location', $request->input('location'));
        }

        if ($request->filled('service_awareness')) {
            $data->orWhereIn('service_awareness', $request->input('service_awareness'));
        }

        if ($request->filled('other_involved_services')) {
            $data->orWhereIn('other_involved_services', $request->input('other_involved_services'));
        }

        if ($request->filled('personal_situation')) {
            $data->orWhereIn('personal_situation', $request->input('personal_situation'));
        }

        if ($request->filled('specific_issues')) {
            $data->orWhereIn('specific_issues', $request->input('specific_issues'));
        }

        if ($request->filled('use_for')) {
            $data->orWhereIn('use_for', $request->input('use_for'));
        }

        if ($request->filled('outcomes')) {
            $data->orWhereIn('outcomes', $request->input('outcomes'));
        }

        $data = $data->paginate(50);

        return view('data.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code = $this->generateInvoiceCode();
        $currentDate = Carbon::now()->format('Y-m-d');
        return view('data.create', compact('currentDate','code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'identifier' => 'required',
            'channel' => 'required',
            'call_type' => 'required',
            'age_band' => 'required',
            'gender' => 'required',
            'sexuality' => 'required',
            'diagnoses' => 'required',
            'triggers' => 'required',
            'self_harm_method' => 'required',
            'contact_type' => 'required',
            'location' => 'required',
            'service_awareness' => 'required',
            'other_involved_services' => 'required',
            'personal_situation' => 'required',
            'specific_issues' => 'required',
            'use_for' => 'required',
            'outcomes' => 'required',
        ]);

        $code = $this->generateInvoiceCode();

        $data = [
            'employee_id' => Auth::user()->id,
            'status' => isset($request->status) ? $request->status : 1,
            'date' => $request->date,
            'code' => $code,
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

        return redirect()->route('data.index')->with('success','Record created successfully');
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

    public function generateInvoiceCode() {
        // Get current date in 'YYYYMMDD' format
        $date = Carbon::now();
        $todayDate = Carbon::now()->format('Y-m-d');
        $code = Carbon::now()->format('Ymd');

        // // Fetch the maximum existing code for today
        // $maxCode = DB::table('data')
        //     ->whereDate('date', $todayDate)
        //     ->where('code', 'LIKE', $code.'%')
        //     ->max(DB::raw("CAST(SUBSTRING(code, 9, 5) AS UNSIGNED)"));
        // // dd($date);

        $todaysCount = Data::where('date', $todayDate)->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);

    }
}
