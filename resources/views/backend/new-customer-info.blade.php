@extends('layouts.backend')

@section('style')

@endsection

@section('content')
    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Add New Information</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ isset($update) ? '/customer-information/update/' . $update->id : '/create-customer-information' }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Company</label>
                                        <select name="company_id" class="form-control">
                                            @foreach($companies as $company)
                                            <option value="{{ $company->id  }}" @if(isset($update) && $company->id === $update->company_id) selected @endif>{{ $company->company }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Owner Name</label>
                                        <input type="text" name="owner" class="form-control" placeholder="Owner Name"
                                               value="{{ isset($update) ? $update->owner : ""  }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                               value="{{ isset($update) ? $update->email : "" }}">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Contact</label>
                                        <input type="number" name="contact" maxlength="10" class="form-control" placeholder="Contact Number"
                                               value="{{ isset($update) ? $update->contact : "" }}">
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control textarea" name="address">
                                            {{ isset($update) ? $update->address : "" }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>From Day</label>
                                        <select name="from_day" class="form-control">
                                            <option value="Monday" @if(isset($update) && $update->from_day == 'Monday') selected @endif>Monday</option>
                                            <option value="Tuesday" @if(isset($update) && $update->from_day == 'Tuesday') selected @endif>Tuesday</option>
                                            <option value="Wednesday" @if(isset($update) && $update->from_day == 'Wednesday') selected @endif>Wednesday</option>
                                            <option value="Thursday" @if(isset($update) && $update->from_day == 'Thursday') selected @endif>Thursday</option>
                                            <option value="Friday" @if(isset($update) && $update->from_day == 'Friday') selected @endif>Friday</option>
                                            <option value="Saturday" @if(isset($update) && $update->from_day == 'Saturday') selected @endif>Saturday</option>
                                            <option value="Sunday" @if(isset($update) && $update->from_day == 'Sunday') selected @endif>Sunday</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>To Day</label>
                                        <select name="to_day" class="form-control">
                                            <option value="Monday" @if(isset($update) && $update->to_day == 'Monday') selected @endif>Monday</option>
                                            <option value="Tuesday" @if(isset($update) && $update->to_day == 'Tuesday') selected @endif>Tuesday</option>
                                            <option value="Wednesday" @if(isset($update) && $update->to_day == 'Wednesday') selected @endif>Wednesday</option>
                                            <option value="Thursday" @if(isset($update) && $update->to_day == 'Thursday') selected @endif>Thursday</option>
                                            <option value="Friday" @if(isset($update) && $update->to_day == 'Friday') selected @endif>Friday</option>
                                            <option value="Saturday" @if(isset($update) && $update->to_day == 'Saturday') selected @endif>Saturday</option>
                                            <option value="Sunday" @if(isset($update) && $update->to_day == 'Sunday') selected @endif>Sunday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>From Time</label>
                                        <input type="time" name="from_time" class="form-control" placeholder="Select Time"
                                               value="{{ isset($update) ? $update->from_time : "" }}">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>To Time</label>
                                        <input type="time" name="to_time" class="form-control" placeholder="Select Time"
                                               value="{{ isset($update) ? $update->to_time : "" }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Closed</label>
{{--                                        {{ dd($update->closed)  }}--}}
                                        <select name="closed[]" class="form-control" multiple>

                                            <option value="Monday"  @if(isset($old_Vals)) {{ in_array('Monday', $old_Vals) ? 'selected' : '' }} @endif>Monday</option>
                                            <option value="Tuesday" @if(isset($old_Vals)) {{ in_array('Tuesday', $old_Vals) ? 'selected' : '' }} @endif>Tuesday</option>
                                            <option value="Wednesday"  @if(isset($old_Vals)) {{ in_array('Wednesday', $old_Vals) ? 'selected' : '' }} @endif>Wednesday</option>
                                            <option value="Thursday" @if(isset($old_Vals)) {{ in_array('Thursday', $old_Vals) ? 'selected' : '' }} @endif>Thursday</option>
                                            <option value="Friday" @if(isset($old_Vals)) {{ in_array('Friday', $old_Vals) ? 'selected' : '' }} @endif>Friday</option>
                                            <option value="Saturday" @if(isset($old_Vals)) {{ in_array('Saturday', $old_Vals) ? 'selected' : '' }} @endif>Saturday</option>
                                            <option value="Sunday" @if(isset($old_Vals)) {{ in_array('Sunday', $old_Vals) ? 'selected' : '' }} @endif>Sunday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">{{ isset($update) ? "Update" : "Submit" }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
