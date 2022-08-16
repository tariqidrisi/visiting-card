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
    </style>
@endsection

@section('content')

    <div class="profile-card js-profile-card">
        <div class="profile-card__img">
            <img src="{{ $presignedUrl }}" alt="profile card">
        </div>
{{--        {{ dd($data['company'][0])  }}--}}
        <div class="profile-card__cnt js-profile-cnt">
            <div class="profile-card__name">{{ @$data['company'][0]['company']  }}</div>
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
                <a href="{{ $data['social_media'][0]['facebook']  }}" class="profile-card-social__item facebook" target="_blank">
                    <span class="icon-font">
                        <i class="fa-brands fa-facebook-f"></i>
                    </span>
                </a>
                @endif
                @if($data['social_media'][0]['instagram'])
                <a href="{{ $data['social_media'][0]['instagram']  }}" class="profile-card-social__item instagram" target="_blank">
                    <span class="icon-font">
                        <i class="fa-brands fa-instagram"></i>
                    </span>
                </a>
                @endif

                @if($data['social_media'][0]['whatsapp'])
                <a href="{{ $data['social_media'][0]['whatsapp']  }}" class="profile-card-social__item whatsapp" target="_blank">
                    <span class="icon-font">
                        <i class="fa-brands fa-whatsapp"></i>
                    </span>
                </a>
                @endif
                @if($data['social_media'][0]['twitter'])
                <a href="{{ $data['social_media'][0]['twitter']  }}" class="profile-card-social__item twitter" target="_blank">
                    <span class="icon-font">
                        <i class="fa-brands fa-twitter"></i>
                    </span>
                </a>
                @endif
                @if($data['social_media'][0]['linkedin'])
                <a href="{{ $data['social_media'][0]['linkedin']  }}" class="profile-card-social__item behance" target="_blank">
                    <span class="icon-font">
                          <i class="fa-brands fa-linkedin"></i>
                    </span>
                </a>
                @endif
                @if($data['social_media'][0]['email'])
                <a href="mailto:{{ $data['social_media'][0]['email']  }}" class="profile-card-social__item github" target="_blank">
                    <span class="icon-font">
                        <i class="fa fa-envelope"></i>
                    </span>
                </a>
                @endif
            </div>



            <ul class="list-inline">
                @if($data['video'][0]['video_link'])
                <li class="row mx-4 my-5 other-links shadow position-relative d-none" id="youtube--video">
                    <iframe width="100%" height="300" class="p-0" id="video-preview" src="{{ $data['video'][0]['video_link']  }}">
                    </iframe>
                    <i class="fas fa-times-circle close-video position-absolute"></i>
                </li>
                @endif
                @if($data['company'][0]['company'])
                <li class="row p-4 mx-4 my-5 other-links shadow" id="show-video">
                    <a href="javascript:void(0)">Welcome to {{ $data['company'][0]['company']  }}</a>
                </li>
                @endif
                <li class="row mx-4 pt-4 pb-2 my-5 other-links shadow position-relative d-none" id="customer--info">
                    <div class="container">
                        <h5 class="text-center">Our Contact Information</h5>
                        <h6 class="text-center">{{$data['info'][0]['owner']}}</h6>
                        <p>{{$data['company'][0]['company']}}</p>
                        <p class="text-left email-content"><span class="at-sign">@</span>
                            <a href="mailto:{{ $data['info'][0]['email']  }}" class="email" style="text-decoration: underline;" target="_blank">
                                {{ $data['info'][0]['email']  }}
                            </a>
                        </p>
                        <p class="text-left">
                            <span class="at-sign"><i class="fas fa-phone"></i></span>
                            <a href="javascript:void(0)" class="email">{{$data['info'][0]['contact']}}</a>
                        </p>
                        <p class="text-left">
                            <span class="at-sign"><i class="fas fa-clock"></i></span>
                            <a href="javascript:void(0)" class="email">{{$data['info'][0]['opening_hours']}}</a>
                        </p>
                        <p class="text-left">
                            <span class="at-sign"><i class="fas fa-location"></i></span>
                            <a href="javascript:void(0)" class="email">{{$data['info'][0]['address']}}</a>
                        </p>
                        <p style="margin: 40px 0">
                            <a href="{{ route("download-vcf", $data['company'][0]['id'] )  }}" class="downloadVcf">Save Contact</a>
                        </p>
                    </div>
                    <i class="fas fa-times-circle close-info position-absolute"></i>
                </li>
                <li class="row p-4 mx-4 p-3 my-5 other-links shadow" id="contact-info">
                    <a href="javascript:void(0)">Our Contact Information</a>
                </li>
                @if($data['social_media'][0]['website'])
                    <li class="row p-4 mx-4 my-5 other-links shadow">
                        <a href="{{ $data['social_media'][0]['website']  }}" target="_blank">Website</a>
                    </li>
                @endif
                @if($data['social_media'][0]['portfolio'])
                <li class="row p-4 mx-4 my-5 other-links shadow">
                    <a href="{{ $data['social_media'][0]['portfolio']  }}" target="_blank">Our Portfolio</a>
                </li>
                @endif

                @if($data['social_media'][0]['youtube'])
                <li class="row p-4 mx-4 my-5 other-links shadow">
                    <a href="{{ $data['social_media'][0]['youtube']  }}" target="_blank">Youtube Channel</a>
                </li>
                @endif

                @if($data['social_media'][0]['pricing'])
                <li class="row p-4 mx-4 my-5 other-links shadow">
                    <a href="{{ $data['social_media'][0]['pricing']  }}" target="_blank">Pricing</a>
                </li>
                @endif
            </ul>

            <input type="hidden" id="company-id" value="{{ $data['company'][0]['id']  }}">
        </div>
    </div>

@endsection

@section('js')

    <script>
        $(document).ready(function () {

            $("#show-video").click(function () {
                $("#show-video").addClass('d-none');
                $("#youtube--video").removeClass('d-none');
            })

            $("#contact-info").click(function () {
                $("#contact-info").addClass('d-none');
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
