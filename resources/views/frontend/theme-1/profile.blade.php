@extends('layouts.theme-1.frontend')

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

        #youtube--video .close-video, .close-info {
            bottom: -33px;
            cursor: pointer;
            font-size: 25px;
        }
        .text-left {
            text-align: left;
        }
        .at-sign {
            font-style: italic;
            font-size: 20px;
            font-weight: 700;
        }
        a.email {
            color: #000;
            padding-left: 10px;
        }
        .float-left {
            float: left;
        }
        .txt--user {
            position: absolute;
            left: 38%;
            top: 25%;
        }
    </style>
@endsection

@section('content')

    <div class="profile-card js-profile-card">
        <div class="profile-card__img">
            <img src="{{ $presignedUrl }}" alt="profile card">
        </div>
{{--        {{ dd($data['company'][0])  }}--}}
        <div class="profile-card__cnt js-profile-cnt">
            <div class="profile-card__name">{{ '@'  }}{{ $data['company'][0]['username']  }}</div>
            <div class="profile-card__txt">{{ $data['company'][0]['desc']  }}</div>
{{--            <div class="profile-card-loc">--}}
{{--                 <span class="profile-card-loc__icon">--}}
{{--                    <svg class="icon">--}}
{{--                       <use xlink:href="#icon-location"></use>--}}
{{--                    </svg>--}}
{{--                 </span>--}}
{{--                <span class="profile-card-loc__txt">--}}
{{--                    Istanbul, Turkey--}}
{{--                </span>--}}
{{--            </div>--}}

{{--            <div class="profile-card-ctr">--}}
{{--                <a href="{{ route("download-vcf", $data['company'][0]['id'] )  }}" class="profile-card__button button--blue js-message-btn downloadVcf">Save Contact</a>--}}
{{--                <button type="button" class="profile-card__button button--orange">Share</button>--}}
{{--            </div>--}}

{{--            <div class="profile-card-inf">--}}
{{--                <div class="profile-card-inf__item">--}}
{{--                    <div class="profile-card-inf__title">1598</div>--}}
{{--                    <div class="profile-card-inf__txt">Followers</div>--}}
{{--                </div>--}}
{{--                <div class="profile-card-inf__item">--}}
{{--                    <div class="profile-card-inf__title">65</div>--}}
{{--                    <div class="profile-card-inf__txt">Following</div>--}}
{{--                </div>--}}
{{--                <div class="profile-card-inf__item">--}}
{{--                    <div class="profile-card-inf__title">123</div>--}}
{{--                    <div class="profile-card-inf__txt">Articles</div>--}}
{{--                </div>--}}
{{--                <div class="profile-card-inf__item">--}}
{{--                    <div class="profile-card-inf__title">85</div>--}}
{{--                    <div class="profile-card-inf__txt">Works</div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="profile-card-social">
                @if($data['social_media'][0]['facebook'])
{{--                <a href="{{ $data['social_media'][0]['facebook']  }}" class="profile-card-social__item facebook" target="_blank">--}}
                <a href="{{ $data['social_media'][0]['facebook']  }}" class="" target="_blank">
{{--                    <i class="fa-brands fa-facebook-f"></i>--}}
                    @include('frontend.svg.facebook')
                </a>
                @endif
                @if($data['social_media'][0]['instagram'])
{{--                <a href="{{ $data['social_media'][0]['instagram']  }}" class="profile-card-social__item instagram" target="_blank">--}}
                <a href="{{ $data['social_media'][0]['instagram']  }}" class="" target="_blank">
                    @include('frontend.svg.instagram')
                </a>
                @endif

                @if($data['social_media'][0]['whatsapp'])
{{--                <a href="{{ $data['social_media'][0]['whatsapp']  }}" class="profile-card-social__item whatsapp" target="_blank">--}}
                <a href="{{ $data['social_media'][0]['whatsapp']  }}" class="" target="_blank">
                    @include('frontend.svg.whatsapp')
                </a>
                @endif
                @if($data['social_media'][0]['twitter'])
{{--                <a href="{{ $data['social_media'][0]['twitter']  }}" class="profile-card-social__item twitter" target="_blank">--}}
                <a href="{{ $data['social_media'][0]['twitter']  }}" class="" target="_blank">
                    @include('frontend.svg.twitter')
                </a>
                @endif
                @if($data['social_media'][0]['linkedin'])
{{--                <a href="{{ $data['social_media'][0]['linkedin']  }}" class="profile-card-social__item behance" target="_blank">--}}
                <a href="{{ $data['social_media'][0]['linkedin']  }}" class="" target="_blank">
                    @include('frontend.svg.linkedin')
                </a>
                @endif
                @if($data['social_media'][0]['cash'])
{{--                    <a href="{{ $data['social_media'][0]['cash']  }}" class="profile-card-social__item behance" target="_blank">--}}
                    <a href="{{ $data['social_media'][0]['cash']  }}" class="" target="_blank">
                        @include('frontend.svg.cash')
                    </a>
                @endif

                @if($data['social_media'][0]['email'])
{{--                <a href="mailto:{{ $data['social_media'][0]['email']  }}" class="profile-card-social__item github" target="_blank">--}}
                <a href="mailto:{{ $data['social_media'][0]['email']  }}" class="" target="_blank">
                    @include('frontend.svg.email')
                </a>
                @endif

                @if($qrUrl)
                <a href="javascript:void(0)" class="" data-toggle="modal" data-target="#qrCodeModal">
                    @include('frontend.svg.zelle')
                </a>
                @endif
            </div>



            <ul class="list-inline mx-5 remove-mobile-margin">
                @if($data['video'][0]['video_link'])
                <li class="row mx-4 my-5 other-links shadow position-relative hidden d-none" id="youtube--video">
                    <iframe width="100%" height="300" class="p-0" id="video-preview" src="{{ $data['video'][0]['video_link']  }}">
                    </iframe>
                    <i class="fas fa-times-circle close-video position-absolute"></i>
                </li>
                @endif
                @if($data['company'][0]['company'])
                <li class="row p-1 mx-4 my-5 other-links shadow has-content" id="show-video">
                    <a href="javascript:void(0)" class="">
                        <span class="float-left"><img src="{{ $presignedUrl }}" alt="profile card"></span> <span class="txt--user">Welcome to {{ $data['company'][0]['username']  }}</span>
                    </a>
                </li>
                @endif
                <li class="row mx-4 pt-4 pb-2 my-5 other-links shadow position-relative hidden d-none" id="customer--info">
                    <div class="container">
                        <h5 class="text-center pb-3 border-bottom">Our Contact Information</h5>
                        <h6 class="text-center pt-3"><b>{{$data['info'][0]['owner']}}</b></h6>
                        <p>{{$data['company'][0]['company']}}</p>
                        <p class="text-left email-content mobile--boxx"><span class="at-sign">@</span>
                            <a href="mailto:{{ $data['info'][0]['email']  }}" class="email" style="text-decoration: underline;" target="_blank">
                                {{ $data['info'][0]['email']  }}
                            </a>
                        </p>
                        <p class="text-left mobile--boxx">
                            <span class="at-sign"><i class="fas fa-phone"></i></span>
                            <a href="javascript:void(0)" class="email">{{$data['info'][0]['contact']}}</a>
                        </p>
                        <p class="text-left mobile--boxx">
                            <span class="at-sign"><i class="fas fa-clock"></i></span>
                            <a href="javascript:void(0)" class="email">{{$data['info'][0]['opening_hours']}}</a>
                        </p>
                        <p class="text-left mobile--boxx">
                            <span class="at-sign"><i class="fas fa-location"></i></span>
                            <a href="javascript:void(0)" class="email">{{$data['info'][0]['address']}}</a>
                        </p>
                        <p style="margin: 40px 0" class="">
                            <a href="{{ route("download-vcf", $data['company'][0]['id'] )  }}" class="downloadVcf">Save Contact</a>
                        </p>
                    </div>
                    <i class="fas fa-times-circle close-info position-absolute"></i>
                </li>
                <li class="row p-3 mx-4 my-5 other-links shadow has-content" id="contact-info">
                    <a href="javascript:void(0)">Our Contact Information</a>
                </li>
                @if($data['social_media'][0]['website'])
                    <li class="row p-3 mx-4 my-5 other-links shadow">
                        <a href="{{ $data['social_media'][0]['website']  }}" target="_blank">Website</a>
                    </li>
                @endif
                @if($data['social_media'][0]['our_product'])
                    <li class="row p-3 mx-4 my-5 other-links shadow">
                        <a href="{{ $data['social_media'][0]['our_product']  }}" target="_blank">Our Product</a>
                    </li>
                @endif

                @if($data['social_media'][0]['portfolio'])
                <li class="row p-3 mx-4 my-5 other-links shadow">
                    <a href="{{ $data['social_media'][0]['portfolio']  }}" target="_blank">Our Portfolio</a>
                </li>
                @endif

                @if($data['social_media'][0]['youtube'])
                <li class="row p-3 mx-4 my-5 other-links shadow">
                    <a href="{{ $data['social_media'][0]['youtube']  }}" target="_blank">Youtube Channel</a>
                </li>
                @endif

                @if($data['social_media'][0]['pricing'])
                <li class="row p-3 mx-4 my-5 other-links shadow">
                    <a href="{{ $data['social_media'][0]['pricing']  }}" target="_blank">Pricing</a>
                </li>
                @endif
            </ul>

            <input type="hidden" id="company-id" value="{{ $data['company'][0]['id']  }}">
        </div>
    </div>

    @if($qrUrl)
{{--    <span class="qr--code" data-toggle="modal" data-target="#qrCodeModal">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">--}}
{{--          <path d="M2 2h2v2H2V2Z"/>--}}
{{--          <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z"/>--}}
{{--          <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z"/>--}}
{{--          <path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z"/>--}}
{{--          <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z"/>--}}
{{--        </svg>--}}
{{--    </span>--}}
    @endif

    <div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container mt-5">

                        <div class="profile-card__img">
                            <img src="{{ $presignedUrl }}" alt="profile card">
                        </div>
                        <div class="profile-card__name-black text-center">{{ '@'  }}{{ $data['company'][0]['username']  }}</div>
                        <div class="profile-card__txt-black text-center">{{ $data['company'][0]['desc']  }}</div>

                        <div class="row my-5">
                            <div class="qr-card__img-black text-center">
                                <img src="{{ $qrUrl }}" alt="qr" >
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $(document).ready(function () {

            $("#show-video").click(function () {
                $(this).addClass('d-none');
                $("#youtube--video").removeClass('d-none');
                $("#youtube--video").addClass('fade-in');
            })

            $("#contact-info").click(function () {
                $(this).addClass('d-none');
                $("#customer--info").removeClass('d-none');
            })

            $(".close-video").click(function () {
                $("#youtube--video").addClass('d-none');
                $("#show-video").removeClass('d-none');
            })

            $(".close-info").click(function () {
                $("#customer--info").addClass('d-none');
                $("#contact-info").removeClass('d-none');
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
