@extends('layouts.theme-2.frontend')

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
            left: 45%;
        }

        .other-links a {
            text-decoration: none;
            font: 700 1.2rem 'Roboto Slab', sans-serif;
            text-align: center;
        }

    </style>
@endsection

@section('content')

    <div class="card col-md-8 m-auto my-5">
        <img src="https://lh3.googleusercontent.com/ytP9VP86DItizVX2YNA-xTYzV09IS7rh4WexVp7eilIcfHmm74B7odbcwD5DTXmL0PF42i2wnRKSFPBHlmSjCblWHDCD2oD1oaM1CGFcSd48VBKJfsCi4bS170PKxGwji8CPmehwPw=w200-h247-no" alt="Person" class="card__image">
        <p class="card__name">{{ $data['company'][0]['company']  }}</p>
        <div class="">

            <div class="grid-child-posts text-center">
                {{ $data['info'][0]['address']  }}
            </div>

        </div>
        <ul class="social-icons">
            <li><a href="{{ $data['social_media'][0]['facebook']  }}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="{{ $data['social_media'][0]['instagram']  }}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="{{ $data['social_media'][0]['whatsapp']  }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
            <li><a href="{{ $data['social_media'][0]['twitter']  }}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="{{ $data['social_media'][0]['linkedin']  }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
            <li><a href="{{ $data['social_media'][0]['email']  }}" target="_blank"><i class="fa fa-envelope"></i></a></li>
        </ul>

        <div class="row">
            <div class="col-md-6">
{{--                <button class="btn draw-border">Save</button>--}}
                <a href="{{ route("download-vcf", $data['company'][0]['id'] )  }}" class="p-3 btn draw-border js-message-btn downloadVcf">Save Contact</a>
            </div>
            <div class="col-md-6">
                <button class="btn draw-border">Share</button>

            </div>
        </div>

        <ul class="list-inline" style="width: 61%">
            <li class="row other-links shadow position-relative d-none draw-border mb-4" id="youtube--video">
                <iframe width="100%" height="300" class="p-0" id="video-preview" src="{{ $data['video'][0]['video_link']  }}">
                </iframe>
                <i class="fas fa-times-circle close-video position-absolute"></i>
            </li>
            <li class="row other-links draw-border shadow mb-4" id="show-video">
                <a href="javascript:void(0)" class="draw-border p-3">Welcome to {{ $data['company'][0]['company']  }}</a>
            </li>
            <li class="row other-links draw-border shadow mb-4">
                <a href="{{ $data['social_media'][0]['website']  }}" class="draw-border p-3 " target="_blank">Website</a>
            </li>
            <li class="row other-links shadow">
                <a href="{{ $data['social_media'][0]['portfolio']  }}" class="draw-border p-3" target="_blank">Our Portfolio</a>
            </li>

            <li class="row other-links draw-border shadow mb-4">
                <a href="{{ $data['social_media'][0]['youtube']  }}" class="draw-border p-3" target="_blank">Youtube Channel</a>
            </li>

            <li class="row other-links draw-border shadow mb-4">
                <a href="{{ $data['social_media'][0]['pricing']  }}" class="draw-border p-3" target="_blank">Pricing</a>
            </li>
        </ul>



    </div>



@endsection

@section('js')

    <script>
        $(document).ready(function () {

            $("#show-video").click(function () {
                $("#show-video").addClass('d-none');
                $("#youtube--video").removeClass('d-none');
            })

            $(".close-video").click(function () {
                $("#youtube--video").addClass('d-none');
                $("#show-video").removeClass('d-none');
            })

            // $(".downloadVcf").click(function () {
            //
            //     var company_id = $('#company-id').val();
            //     var url = '/download-vcf/'+ company_id;
            //
            //     $.ajax({
            //         url: url,
            //         type: "get",
            //         success: function (response) {
            //
            //         },
            //         error: function(jqXHR, textStatus, errorThrown) {
            //             console.log(textStatus, errorThrown);
            //         }
            //     });
            // })

        })

    </script>

@endsection
