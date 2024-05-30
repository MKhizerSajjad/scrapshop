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

                                <div class="mb-3">
                                    <label for="name" class="mb-0">Date Range</label>

                                    <p class="card-title-desc font-size-10 mb-0">
                                        <code><b>From Date</b></code>
                                    </p>
                                    <input type="date" name="from" class="form-control" value="{{ request()->input('from') }}">
                                    <p class="card-title-desc font-size-10 mb-0">
                                        <code><b>To Date</b></code>
                                    </p>
                                    <input type="date" name="to" class="form-control" value="{{ request()->input('to') }}">
                                </div>

                                <label for="code" class="mt-0 mb-0">Code</label>
                                <input type="code" name="code" class="form-control" value="{{ request()->input('code') }}"><br>

                                <label for="identifier" class="mt-0 mb-0">Identifier</label>
                                <input type="text" name="identifier" class="form-control" value="{{ request()->input('identifier') }}"><br>

                                <label for="employee" class="mt-2 mb-0">Employee</label>
                                <select id="employee" name="employee[]" class="select2 form-control select2-multiple" data-placeholder="Select" multiple="multiple">
                                    <option>Select Employee</option>
                                    @foreach (getEmployee() as $key => $employee)
                                        <option value="{{ $employee->id }}" @if(in_array($key, request()->input('employee', []))) selected @endif>{{ $employee->first_name .' '. $employee->last_name }}</option>
                                    @endforeach
                                </select>

                                <label for="channel" class="mt-3 mb-0">Channel</label>
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
                                                            <th>Employee</th>
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
                                                                <td>{{ $contact->employee->first_name }}</td>
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
                                                                                    <label for="date">Date</label>
                                                                                    <input type="date" id="date" name="date" class="form-control" value="{{ $contact->date }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="code">Code</label>
                                                                                    <input type="number" id="code" name="code" class="form-control" value="{{ $contact->code }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="identifier">Identifier</label>
                                                                                    <input type="text" id="identifier" name="identifier" class="form-control" value="{{ $contact->identifier }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="channel">Channel</label>
                                                                                    <input type="text" id="channel" name="channel" class="form-control" value="{{ getPlatforms('social', $contact->channel) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="call_type">Call Type</label>
                                                                                    <input type="text" id="call_type" name="call_type" class="form-control" value="{{ getGenStatus('general', $contact->call_type) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="age_band">Age Band</label>
                                                                                    <input type="text" id="age_band" name="age_band" class="form-control" value="{{ getAgeBand('age', $contact->age_band) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="gender">Gender</label>
                                                                                    <input type="text" id="gender" name="gender" class="form-control" value="{{ getGenderStatus('gender', $contact->gender) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="sexuality">Sexuality</label>
                                                                                    <input type="text" id="sexuality" name="sexuality" class="form-control" value="{{ getGenderStatus('sexuality', $contact->sexuality) }}" disabled>
                                                                                </div>
                                                                                {{-- <div class="col-md-6">
                                                                                    <label for="diagnoses">Diagnoses </label>
                                                                                    <input type="text" id="diagnoses" name="diagnoses" class="form-control" value="{{ getIssues('diagnoses', $contact->diagnoses) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="triggers">Triggers</label>
                                                                                    <input type="text" id="triggers" name="triggers" class="form-control" value="{{ getIssues('triggers', $contact->triggers) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="self_harm_method">Self Harm Method</label>
                                                                                    <input type="text" id="self_harm_method" name="self_harm_method" class="form-control" value="{{ getIssues('self_harm_method', $contact->self_harm_method) }}" disabled>
                                                                                </div> --}}
                                                                                <div class="col-md-6">
                                                                                    <label for="contact_type">Contact Type</label>
                                                                                    <input type="text" id="contact_type" name="contact_type" class="form-control" value="{{ getIssues('contact_type', $contact->contact_type) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="location">Location</label>
                                                                                    <input type="text" id="location" name="location" class="form-control" value="{{ getLocation('country', $contact->location) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="service_awareness">Service Awareness</label>
                                                                                    <input type="text" id="service_awareness" name="service_awareness" class="form-control" value="{{ getPlatforms('service_awareness', $contact->service_awareness) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="other_involved_services">Other Involved Services</label>
                                                                                    <input type="text" id="other_involved_services" name="other_involved_services" class="form-control" value="{{ getGenStatus('bool', $contact->other_involved_services)}}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="personal_situation">Personal Situation</label>
                                                                                    <input type="text" id="personal_situation" name="personal_situation" class="form-control" value="{{ getSituation('personal', $contact->personal_situation) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="specific_issues">Specific Issues</label>
                                                                                    <input type="text" id="specific_issues" name="specific_issues" class="form-control" value="{{ getIssues('specific', $contact->specific_issues) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="use_for">Use For</label>
                                                                                    <input type="text" id="use_for" name="use_for" class="form-control" value="{{ getPlatforms('usage', $contact->use_for) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="outcomes">Outcomes</label>
                                                                                    <input type="text" id="outcomes" name="outcomes" class="form-control" value="{{ getPlatforms('outcomes', $contact->outcomes) }}" disabled>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label for="note">Note</label>
                                                                                    <textarea id="note" name="note" class="form-control" disabled>{{ $contact->note }}</textarea>
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

