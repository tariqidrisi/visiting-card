@extends('layouts.backend')

@section('style')

@endsection

@section('content')
    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">{{ isset($update) ? 'Edit a Company' : 'Add new Company' }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ isset($update) ? '/company/update/' . $update->id : '/create-company' }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Company</label>
                                        <input type="text" name="company" class="form-control" placeholder="Company"
                                               value="{{ isset($update) ? $update->company : "" }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control textarea" name="desc">
                                            {{ isset($update) ? $update->desc : "" }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">{{ isset($update) ? "Update" : "Submit"  }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
