@extends('layouts.backend')

@section('style')

@endsection

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('save-embed-video')  }}">
            @csrf

            <div class="row">
                <div class="col-md-2">
                    <label>Which Company ?</label>
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

            <div class="row mt-5">
                <div class="col-md-2">
                    <label>Insert Video Link here</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="video_link" class="form-control w-100" id="video-link" value="{{ $data ? $data[0]['video_link'] : ''  }}">
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-2">
                    <label>Preview</label>
                </div>
                <div class="col-md-10">
                    <iframe width="50%" height="300" id="video-preview" src="">
                    </iframe>
                </div>
            </div>

            <button type="submit" class="btn bg-success text-white btn-round mt-5">Submit</button>
        </form>

    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function () {

            $("#video-preview").attr("src", $("#video-link").val())

            $("#video-link").keyup(function () {
                $("#video-preview").attr("src", $(this).val())
            })

            $(".companies").change(function () {
                var company_id = $(this).val();
                var url = '/embed-video/'+ company_id;

                $.ajax({
                    url: url,
                    type: "get",
                    success: function (response) {

                        $("body").html(response);
                        $("#embed-video").addClass("active")
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            })

        })
    </script>

@endsection
