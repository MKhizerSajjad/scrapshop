@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class=""><a href="javascript: void(0);">Data</a></li>
                                <li class="mx-1"><a href="javascript: void(0);"> > </a></li>
                                <li class="breadcrumb-item active">Add New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i><strong>Success! </strong>
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add New Data</h4>
                            {{-- <p class="card-title-desc">Fill all information below</p> --}}
                            <form method="POST" action="{{ route('data.store') }}">
                                @csrf
                                <div class="row">

                                    {{-- <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="status">Email Sent</label>
                                            <select id="email_sent" name="email_sent" class="form-control @error('email_sent') is-invalid @enderror" >
                                                <option value="">Select Cat</option>
                                                @foreach (getGenStatus('general') as $key => $cat)
                                                    <option value="{{ ++$key }}">{{ $cat }}</option>
                                                @endforeach
                                            </select>
                                            @error('email_sent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div> --}}

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="date">Date and Time</label>
                                            <input id="date" name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $currentDate) }}">
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="code">Code</label>
                                            <input id="code" name="code" type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Code" value="{{ old('code', $code) }}" readonly>
                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="identifier">Identifier</label>
                                            <input id="identifier" name="identifier" type="text" class="form-control @error('identifier') is-invalid @enderror" placeholder="Identifier" value="{{ old('identifier') }}">
                                            @error('identifier')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="channel">Channel</label>
                                            <select id="channel" name="channel" class="form-control @error('channel') is-invalid @enderror"  data-placeholder="Select" >
                                                <option value="">Select Channel</option>
                                                @foreach (getPlatforms('social') as $key => $platform)
                                                    <option value="{{ ++$key }}">{{ $platform }}</option>
                                                @endforeach
                                            </select>
                                            @error('channel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="call_type">Call Type</label>
                                            <select id="call_type" name="call_type" class="form-control @error('call_type') is-invalid @enderror"  data-placeholder="Select" >
                                                <option value="">Select Call Type</option>
                                                @foreach (getGenStatus('general') as $key => $cat)
                                                    <option value="{{ ++$key }}">{{ $cat }}</option>
                                                @endforeach
                                            </select>
                                            @error('call_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="age_band">Age Band</label>
                                            <select id="age_band" name="age_band" class="form-control @error('age_band') is-invalid @enderror"  data-placeholder="Select" >
                                                <option value="">Select Call Type</option>
                                                @foreach (getAgeBand('age') as $key => $cat)
                                                    <option value="{{ ++$key }}">{{ $cat }}</option>
                                                @endforeach
                                            </select>
                                            @error('age_band')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="gender">Gender</label>
                                             <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror"  data-placeholder="Select" >
                                                <option value="">Select Gender</option>
                                                @foreach (getGenderStatus('gender') as $key => $cat)
                                                    <option value="{{ ++$key }}">{{ $cat }}</option>
                                                @endforeach
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="sexuality">Sexuality</label>
                                            <select id="sexuality" name="sexuality" class="form-control @error('sexuality') is-invalid @enderror"  data-placeholder="Select" >
                                               <option value="">Select Sexuality</option>
                                               @foreach (getGenderStatus('sexuality') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('sexuality')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="diagnoses">Diagnoses / Self Identifying Labels</label>
                                            <select id="diagnoses" name="diagnoses[]" class="select2 form-control select2-multiple @error('diagnoses') is-invalid @enderror"  data-placeholder="Select  Diagnoses / Self Identifying Labels" multiple="multiple">
                                               @foreach (getIssues('diagnose') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('diagnoses')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="triggers">Triggers</label>
                                            <select id="triggers" name="triggers[]" class="select2 form-control select2-multiple @error('triggers') is-invalid @enderror"  data-placeholder="Select Trigger" multiple="multiple">
                                               @foreach (getIssues('trigger') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('triggers')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="self_harm_method">Self Harm Method</label>
                                            <select id="self_harm_method" name="self_harm_method[]" class="select2 form-control select2-multiple @error('self_harm_method') is-invalid @enderror"  data-placeholder="Select Harm Method" multiple="multiple">
                                               @foreach (getIssues('self_harm') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('self_harm_method')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="contact_type">Contact Type</label>
                                            <select id="contact_type" name="contact_type" class="form-control @error('contact_type') is-invalid @enderror">
                                               <option value="">Select Contact Type</option>
                                               @foreach (getIssues('contact_type') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('contact_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="location">Location</label>
                                            <select id="location" name="location" class="form-control @error('location') is-invalid @enderror">
                                               <option value="">Select Location</option>
                                               @foreach (getLocation('country') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="service_awareness">Service Awareness</label>
                                            <select id="service_awareness" name="service_awareness" class="form-control @error('service_awareness') is-invalid @enderror">
                                               <option value="">Select Service Awareness</option>
                                               @foreach (getPlatforms('service_awareness') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('service_awareness')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="other_involved_services">Other Involved Service</label>
                                            <select id="other_involved_services" name="other_involved_services" class="form-control @error('other_involved_services') is-invalid @enderror">
                                               <option value="">Select Othe Involved Service</option>
                                               @foreach (getGenStatus('bool') as $key => $cat)
                                                   <option value="{{ ++$key }}">{{ $cat }}</option>
                                               @endforeach
                                           </select>
                                            @error('other_involved_services')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for=">personal_situation">Personal Situtaion</label>
                                            <select id=">personal_situation" name="personal_situation" class="form-control @error('personal_situation') is-invalid @enderror">
                                               <option value="">Select Personal Situtaion</option>
                                               @foreach (getSituation('personal') as $key => $value)
                                                   <option value="{{ ++$key }}">{{ $value }}</option>
                                               @endforeach
                                           </select>
                                            @error('personal_situation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for=">specific_issues">Specific Issues</label>
                                            <select id=">specific_issues" name="specific_issues" class="form-control @error('specific_issues') is-invalid @enderror">
                                                <option value="">Select Specific Issue </option>
                                               @foreach (getIssues('specific') as $key => $value)
                                                   <option value="{{ ++$key }}">{{ $value }}</option>
                                               @endforeach
                                           </select>
                                            @error('specific_issues')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for=">use_for">Use For</label>
                                            <select id=">use_for" name="use_for" class="form-control @error('use_for') is-invalid @enderror">
                                                <option value="">Select Use For </option>
                                                @foreach (getPlatforms('usage') as $key => $value)
                                                   <option value="{{ ++$key }}">{{ $value }}</option>
                                               @endforeach
                                           </select>
                                            @error('use_for')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for=">outcomes">Outcome</label>
                                            <select id=">outcomes" name="outcomes" class="form-control @error('outcomes') is-invalid @enderror">
                                                <option value="">Select Outcome </option>
                                                @foreach (getPlatforms('outcomes') as $key => $value)
                                                    <option value="{{ ++$key }}">{{ $value }}</option>
                                                @endforeach
                                           </select>
                                            @error('>outcomes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="note">Note </label>
                                            <textarea id="note" name="note" rows="4" class="form-control @error('note') is-invalid @enderror" placeholder="note">{{ old('note') }}</textarea>
                                            @error('note')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2" bis_skin_checked="1">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-10">Submit</button>
                                        <a href="{{ route('data.index') }}" class="waves-effect waves-light btn btn-secondary"> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection
