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
        }
    </style>
@endsection

@section('content')

    <div class="card col-md-8 m-auto my-5">
        <img src="https://lh3.googleusercontent.com/ytP9VP86DItizVX2YNA-xTYzV09IS7rh4WexVp7eilIcfHmm74B7odbcwD5DTXmL0PF42i2wnRKSFPBHlmSjCblWHDCD2oD1oaM1CGFcSd48VBKJfsCi4bS170PKxGwji8CPmehwPw=w200-h247-no" alt="Person" class="card__image">
        <p class="card__name">Lily-Grace Colley</p>
        <div class="grid-container">

            <div class="grid-child-posts">
                156 Post
            </div>

        </div>
        <ul class="social-icons">
            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-codepen"></i></a></li>
        </ul>
        <button class="btn draw-border">Follow</button>
        <button class="btn draw-border">Message</button>

    </div>



@endsection

@section('js')
@endsection
