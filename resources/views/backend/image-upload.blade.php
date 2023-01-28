@extends('layouts.backend')

@section('style')
    <style>
        #youtube--video {
            border-radius: 50px;
        }
        #youtube--video iframe {
            border-radius: 50px;
            border: 5px solid #fff;

        }

        .slow-motion {
            transition: all .5s ease-in-out;
        }

        #youtube--video .close-video {
            bottom: -20px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
<div class="content">

    <div class="panel panel-primary">
        <div class="panel-body">

{{--            @if ($message = Session::get('success'))--}}
{{--                <div class="alert alert-success alert-block">--}}
{{--                    <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </div>--}}
{{--                <img src="{{ Session::get('image') }}">--}}
{{--            @endif--}}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-5">
                    <div class="col-md-2">
                        <label>Company</label>
                    </div>
                    <div class="col-md-10">
                        <select name="company_id" class="form-control w-50 companies">
                            <option></option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id  }}" @if(isset($id) && $company->id == $id) selected @endif>{{ $company->company }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <label>Company Logo</label>
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-2">
                        <label>QR Code Image</label>
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="qr_code" class="form-control">
                    </div>



                </div>

                <div class="row">
                    <img src="{{ Session::get('image') }}">
                </div>

                <div class="row mt-4">

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
