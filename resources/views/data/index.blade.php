@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Contacts</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Contacts</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Contacts List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show auto-colse-3" role="alert">
                    <i class="ri-check-double-line me-3 align-middle fs-16"></i><strong>Success! </strong>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Upload Contacts</h4>
                            <form action="{{ route('data.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input id="file" name="file" type="file" class="form-control @error('file') is-invalid @enderror" placeholder="file" value="{{ old('file') }}">
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-success">  <i class="bx bx-import me-1"></i> Import Contacts</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Filters</h4>
                            <form action="{{ route('data.index') }}" method="GET">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100"> <i class="bx bx-filter-alt me-1"></i>Apply</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('data.index') }}" class="waves-effect waves-light btn btn-secondary w-100"> <i class="bx bx-crosshair me-1"></i>Remove</a>
                                    </div>
                                </div>

                                <label for="code" class="mt-0 mb-0">Code</label>
                                <input type="code" name="code" class="form-control" value="{{ request()->input('code') }}"><br>

                                <label for="identifier" class="mt-0 mb-0">Identifier</label>
                                <input type="text" name="identifier" class="form-control" value="{{ request()->input('identifier') }}"><br>

                                <label for="channel" class="mt-2 mb-0">Channel</label>
                                <select id="channel" name="channel[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Channel</option>
                                    @foreach (getPlatforms('social') as $key => $platform)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('channel', []))) selected @endif>{{ $platform }}</option>
                                    @endforeach
                                </select>

                                <label for="call_type" class="mt-3 mb-0">Call Type</label>
                                <select id="call_type" name="call_type[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Call Type</option>
                                    @foreach (getGenStatus('general') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('call_type', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="age_band" class="mt-3 mb-0">Age Band</label>
                                <select id="age_band" name="age_band[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Call Type</option>
                                    @foreach (getAgeBand('age') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('age_band', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="gender" class="mt-3 mb-0">Gender</label>
                                    <select id="gender" name="gender[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Gender</option>
                                    @foreach (getGenderStatus('gender') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('gender', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="sexuality" class="mt-3 mb-0">Sexuality</label>
                                <select id="sexuality" name="sexuality[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Sexuality</option>
                                    @foreach (getGenderStatus('sexuality') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('sexuality', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="diagnoses" class="mt-3 mb-0">Diagnoses / Self Identifying Labels</label>
                                <select id="diagnoses" name="diagnoses[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Diagnoses / Self Identifying Labels</option>
                                    @foreach (getIssues('diagnose') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('diagnoses', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="triggers" class="mt-3 mb-0">Triggers</label>
                                <select id="triggers" name="triggers[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Triggers</option>
                                    @foreach (getIssues('trigger') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('triggers', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="self_harm_method" class="mt-3 mb-0">Self Harm Method</label>
                                <select id="self_harm_method" name="self_harm_method[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Self Harm Method</option>
                                    @foreach (getIssues('self_harm') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('self_harm_method', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="contact_type" class="mt-3 mb-0">Contact Type</label>
                                <select id="contact_type" name="contact_type[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Contact Type</option>
                                    @foreach (getIssues('contact_type') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('contact_type', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="location" class="mt-3 mb-0">Location</label>
                                <select id="location" name="location[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Location</option>
                                    @foreach (getLocation('country') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('location', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>
                                <label for="service_awareness" class="mt-3 mb-0">Service Awareness</label>
                                <select id="service_awareness" name="service_awareness[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Service Awareness</option>
                                    @foreach (getPlatforms('service_awareness') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('service_awareness', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>
                                <label for="other_involved_services" class="mt-3 mb-0">Other Involved Service</label>
                                <select id="other_involved_services" name="other_involved_services[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Othe Involved Service</option>
                                    @foreach (getGenStatus('bool') as $key => $cat)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('other_involved_services', []))) selected @endif>{{ $cat }}</option>
                                    @endforeach
                                </select>
                                <label for="personal_situation" class="mt-3 mb-0">Personal Situtaion</label>
                                <select id="personal_situation" name="personal_situation[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Personal Situtaion</option>
                                    @foreach (getSituation('personal') as $key => $value)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('personal_situation', []))) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>

                                <label for="specific_issues" class="mt-3 mb-0">Specific Issues</label>
                                <select id="specific_issues" name="specific_issues[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    @foreach (getIssues('specific') as $key => $value)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('specific_issues', []))) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>

                                <label for="use_for" class="mt-3 mb-0">Use For</label>
                                <select id="use_for" name="use_for[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Use For </option>
                                    @foreach (getPlatforms('usage') as $key => $value)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('use_for', []))) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <label for="outcomes" class="mt-3 mb-0">Outcome</label>
                                <select id="outcomes" name="outcomes[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Outcome </option>
                                    @foreach (getPlatforms('outcomes') as $key => $value)
                                        <option value="{{ ++$key }}" @if(in_array($key, request()->input('outcomes', []))) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data List</h4>
                            <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                <a class="btn btn-secondary waves-effect waves-light" href="{{ route('data.export') }}"> <i class="bx bx-export me-1"></i> Export Contacts</a>
                                <a href="{{ route('data.create') }}" class="btn btn-primary waves-effect waves-light w-10"> <i class="bx bx-plus me-1"></i> Add New</a>
                            </div>
                            @if (count($data) > 0)
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="company" role="tabpanel">
                                        <p class="mb-0">
                                            <div class="table-responsive" bis_skin_checked="1">
                                                <table class="table mb-0 table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Code</th>
                                                            <th>Identifier</th>
                                                            <th>Age Band</th>
                                                            <th>Gender</th>
                                                            <th>Sexuality</th>
                                                            <th>User For</th>
                                                            <th>Location</th>
                                                            <th class="text-center">Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $key => $contact)
                                                            <tr>
                                                                <td  class="text-center">{{ ++$key }}</td>
                                                                <td>{{ $contact->code }}</td>
                                                                <td>{{ $contact->identifier }}</td>
                                                                <td>{{ getAgeBand('age', $contact->age_band) }}</td>
                                                                <td>{{ getGenderStatus('gender', $contact->gender) }}</td>
                                                                <td>{{ getGenderStatus('sexuality', $contact->sexuality) }}</td>
                                                                <td>{{ getPlatforms('usage', $contact->use_for) }}</td>
                                                                <td>{{ getLocation('country', $contact->location) }}</td>
                                                                <td class="text-center">
                                                                    {{-- <a href="{{ route('data.edit', $contact->id) }}"><i class="bx bx-pencil"></i></a> --}}
                                                                    <a href="#" class="detail-modal-btn" data-toggle="modal" data-target="#detailModal{{ $contact->id }}"><i class="bx bx-info-circle"></i></a>
                                                                </td>
                                                            </tr>

                                                            {{-- Detail Modal --}}
                                                            <div class="modal fade" id="detailModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 50%;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="detailModalLabel">Data Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="code">Code</label>
                                                                                    <input type="text" id="code" name="code" class="form-control" value="{{ $contact->code }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="identifier">Identifier</label>
                                                                                    <input type="text" id="identifier" name="identifier" class="form-control" value="{{ $contact->identifier }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{ $data->links() }}
                                            </div>
                                        </p>
                                    </div>
                                    {{-- <div class="tab-pane" id="person" role="tabpanel">
                                        <p class="mb-0">
                                            <div class="table-responsive" bis_skin_checked="1">
                                                <table class="table mb-0 table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Name</th>
                                                            <th>Title</th>
                                                            <th>Company</th>
                                                            <th>Email</th>
                                                            <th>Mobile</th>
                                                            <th>Employees</th>
                                                            <th>Revenue</th>
                                                            <th>Address</th>
                                                            <th class="text-center">Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $key => $contact)
                                                            <tr>
                                                                <td  class="text-center">{{ ++$key }}</td>
                                                                <td>{{ $contact->first_name .' '. $contact->last_name }}</td>
                                                                <td>{{ $contact->title }}</td>
                                                                <td>{{ $contact->company }}</td>
                                                                <td>{{ $contact->email }}</td>
                                                                <td>{{ $contact->mobile_phone }}</td>
                                                                <td>{{ $contact->employees }}</td>
                                                                <td>{{ $contact->annual_revenue }}</td>
                                                                <td>{{ $contact->state .', '. $contact->country }}</td>
                                                                <td class="text-center">
                                                                    <a href="#" class="detail-modal-btn" data-toggle="modal" data-target="#detailModal{{ $contact->id }}"><i class="bx bx-info-circle"></i></a>
                                                                </td>
                                                            </tr>

                                                            <div class="modal fade" id="detailModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 50%;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="detailModalLabel">Contact Details</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="first_name">First Name:</label>
                                                                                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $contact->first_name }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="last_name">Last Name:</label>
                                                                                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $contact->last_name }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="title">Title:</label>
                                                                                    <input type="text" id="title" name="title" class="form-control" value="{{ $contact->title }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company">Company:</label>
                                                                                    <input type="text" id="company" name="company" class="form-control" value="{{ $contact->company }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company_name_for_emails">Company Name for Emails:</label>
                                                                                    <input type="text" id="company_name_for_emails" name="company_name_for_emails" class="form-control" value="{{ $contact->company_name_for_emails }}" disabled>
                                                                                </div><div class="col-md-6">
                                                                                    <label for="email">Email:</label>
                                                                                    <input type="text" id="email" name="email" class="form-control" value="{{ $contact->email }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="email_status">Email Status:</label>
                                                                                    <input type="text" id="email_status" name="email_status" class="form-control" value="{{ $contact->email_status }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="email_confidence">Email Confidence:</label>
                                                                                    <input type="text" id="email_confidence" name="email_confidence" class="form-control" value="{{ $contact->email_confidence }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="seniority">Seniority:</label>
                                                                                    <input type="text" id="seniority" name="seniority" class="form-control" value="{{ $contact->seniority }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="departments">Departments:</label>
                                                                                    <input type="text" id="departments" name="departments" class="form-control" value="{{ $contact->departments }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="contact_owner">Contact Owner:</label>
                                                                                    <input type="text" id="contact_owner" name="contact_owner" class="form-control" value="{{ $contact->contact_owner }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="first_phone">First Phone:</label>
                                                                                    <input type="text" id="first_phone" name="first_phone" class="form-control" value="{{ $contact->first_phone }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="work_direct_phone">Work Direct Phone:</label>
                                                                                    <input type="text" id="work_direct_phone" name="work_direct_phone" class="form-control" value="{{ $contact->work_direct_phone }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="home_phone">Home Phone:</label>
                                                                                    <input type="text" id="home_phone" name="home_phone" class="form-control" value="{{ $contact->home_phone }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="mobile_phone">Mobile Phone:</label>
                                                                                    <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" value="{{ $contact->mobile_phone }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="corporate_phone">Corporate Phone:</label>
                                                                                    <input type="text" id="corporate_phone" name="corporate_phone" class="form-control" value="{{ $contact->corporate_phone }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="other_phone">Other Phone:</label>
                                                                                    <input type="text" id="other_phone" name="other_phone" class="form-control" value="{{ $contact->other_phone }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="stage">Stage:</label>
                                                                                    <input type="text" id="stage" name="stage" class="form-control" value="{{ $contact->stage }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="lists">Lists:</label>
                                                                                    <input type="text" id="lists" name="lists" class="form-control" value="{{ $contact->lists }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="last_contacted">Last Contacted:</label>
                                                                                    <input type="text" id="last_contacted" name="last_contacted" class="form-control" value="{{ $contact->last_contacted }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="account_owner">Account Owner:</label>
                                                                                    <input type="text" id="account_owner" name="account_owner" class="form-control" value="{{ $contact->account_owner }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="employees">Employees:</label>
                                                                                    <input type="text" id="employees" name="employees" class="form-control" value="{{ $contact->employees }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="industry">Industry:</label>
                                                                                    <input type="text" id="industry" name="industry" class="form-control" value="{{ $contact->industry }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="keywords">Keywords:</label>
                                                                                    <input type="text" id="keywords" name="keywords" class="form-control" value="{{ $contact->keywords }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="person_linkedin">Person LinkedIn:</label>
                                                                                    <input type="text" id="person_linkedin" name="person_linkedin" class="form-control" value="{{ $contact->person_linkedin }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="url">URL:</label>
                                                                                    <input type="text" id="url" name="url" class="form-control" value="{{ $contact->url }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="website">Website:</label>
                                                                                    <input type="text" id="website" name="website" class="form-control" value="{{ $contact->website }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company_linkedin_url">Company LinkedIn URL:</label>
                                                                                    <input type="text" id="company_linkedin_url" name="company_linkedin_url" class="form-control" value="{{ $contact->company_linkedin_url }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="facebook_url">Facebook URL:</label>
                                                                                    <input type="text" id="facebook_url" name="facebook_url" class="form-control" value="{{ $contact->facebook_url }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="twitter_url">Twitter URL:</label>
                                                                                    <input type="text" id="twitter_url" name="twitter_url" class="form-control" value="{{ $contact->twitter_url }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="city">City:</label>
                                                                                    <input type="text" id="city" name="city" class="form-control" value="{{ $contact->city }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="state">State:</label>
                                                                                    <input type="text" id="state" name="state" class="form-control" value="{{ $contact->state }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="country">Country:</label>
                                                                                    <input type="text" id="country" name="country" class="form-control" value="{{ $contact->country }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company_address">Company Address:</label>
                                                                                    <input type="text" id="company_address" name="company_address" class="form-control" value="{{ $contact->company_address }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company_city">Company City:</label>
                                                                                    <input type="text" id="company_city" name="company_city" class="form-control" value="{{ $contact->company_city }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company_state">Company State:</label>
                                                                                    <input type="text" id="company_state" name="company_state" class="form-control" value="{{ $contact->company_state }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company_country">Company Country:</label>
                                                                                    <input type="text" id="company_country" name="company_country" class="form-control" value="{{ $contact->company_country }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="company_phone">Company Phone:</label>
                                                                                    <input type="text" id="company_phone" name="company_phone" class="form-control" value="{{ $contact->company_phone }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="seo_description">SEO Description:</label>
                                                                                    <input type="text" id="seo_description" name="seo_description" class="form-control" value="{{ $contact->seo_description }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="technologies">Technologies:</label>
                                                                                    <input type="text" id="technologies" name="technologies" class="form-control" value="{{ $contact->technologies }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="annual_revenue">Annual Revenue:</label>
                                                                                    <input type="text" id="annual_revenue" name="annual_revenue" class="form-control" value="{{ $contact->annual_revenue }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="total_funding">Total Funding:</label>
                                                                                    <input type="text" id="total_funding" name="total_funding" class="form-control" value="{{ $contact->total_funding }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="latest_funding">Latest Funding:</label>
                                                                                    <input type="text" id="latest_funding" name="latest_funding" class="form-control" value="{{ $contact->latest_funding }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="latest_funding_amount">Latest Funding Amount:</label>
                                                                                    <input type="text" id="latest_funding_amount" name="latest_funding_amount" class="form-control" value="{{ $contact->latest_funding_amount }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="last_raised_at">Last Raised At:</label>
                                                                                    <input type="text" id="last_raised_at" name="last_raised_at" class="form-control" value="{{ $contact->last_raised_at }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="email_sent">Email Sent:</label>
                                                                                    <input type="text" id="email_sent" name="email_sent" class="form-control" value="{{ $contact->email_sent }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="email_open">Email Open:</label>
                                                                                    <input type="text" id="email_open" name="email_open" class="form-control" value="{{ $contact->email_open }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="email_bounced">Email Bounced:</label>
                                                                                    <input type="text" id="email_bounced" name="email_bounced" class="form-control" value="{{ $contact->email_bounced }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="replied">Replied:</label>
                                                                                    <input type="text" id="replied" name="replied" class="form-control" value="{{ $contact->replied }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="demoed">Demoed:</label>
                                                                                    <input type="text" id="demoed" name="demoed" class="form-control" value="{{ $contact->demoed }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="number_of_retail_locations">Number of Retail Locations:</label>
                                                                                    <input type="text" id="number_of_retail_locations" name="number_of_retail_locations" class="form-control" value="{{ $contact->number_of_retail_locations }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="apollo_contact_id">Apollo Contact ID:</label>
                                                                                    <input type="text" id="apollo_contact_id" name="apollo_contact_id" class="form-control" value="{{ $contact->apollo_contact_id }}" disabled>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                    <label for="apollo_account_id">Apollo Account ID:</label>
                                                                                    <input type="text" id="apollo_account_id" name="apollo_account_id" class="form-control" value="{{ $contact->apollo_account_id }}" disabled>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{ $data->links() }}
                                            </div>
                                        </p>
                                    </div> --}}
                                </div>
                            @else
                                <div class="noresult">
                                    <div class="text-center mt-5 mb-3">
                                        <h4 class="mt-2 text-danger">Oops! No Record Found</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .w-5 {
        width: 10px !important;
    }
    .h-5 {
        height: 10px !important;
    }
    .flex.justify-between.flex-1
    {
        display: none !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

