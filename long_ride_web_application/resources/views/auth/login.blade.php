@extends('layouts.app')

@section('content')


<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-success" style="background-image: url(./images/skyline.png); background-size: cover;">
    <div class="row wd-100p mx-auto text-center">
        {{-- <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
            <img src="{{ asset('images/bg_img.png') }}" class="my-auto ht-xl-70p wd-md-100p wd-xl-70p mx-auto"
                alt="logo">
        </div> --}}
    </div>
</div>
<!-- The content half -->
<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
    <div class="login d-flex align-items-center py-2">
        <!-- Demo content-->
        <div class="container p-0">
            <div class="row">
                <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                    <div class="card-sigin">
                        <div class="d-flex" style="  display: flex;justify-content: center;"> <a href="index.html"><img src="{{ asset('images/bg_img_green.png') }}"
                                    class="sign-favicon ht-100" alt="logo"></a>
                        </div>
                        <div class="card-sigin">
                            <div class="main-signup-header">
                                {{-- <h2>Welcome back!</h2> --}}
                                <h4 class="font-weight-bold mb-4 text-center">Log Into Your Station</h4>
                                <form action="{{url('/login')}}" method="POST" class="login-form">
                                    @csrf
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <div class="form-group @error('email') has-danger @enderror">
                                        <label>Email</label>
                                        <input class="form-control" placeholder="Enter your email" type="text"
                                            name="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('password') has-danger @enderror">
                                        <label>Password</label>
                                        <input class="form-control" placeholder="Enter your password" type="password"
                                            value="" name="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <p><a href="#" class="text-success"><h6>Forgot password?</h6></a></p>
                                    </div>
                                    <button class="btn btn-success btn-block login-btn" type="submit">Log In</button>
                                    <div class="main-signin-footer mt-5 text-center">
                                        <p><a href="#" class="text-success">New To Smart Traveller? Get Started</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End -->
    </div>
</div><!-- End -->


@endsection
@push('scripts')
{{-- @if(GetCaptchaStatus()!="false")
<script src="https://www.google.com/recaptcha/api.js?render={{ GetCaptchaKeys()['captcha_sitekey'] }}"></script>

@endif
<script>
    $(document).ready(function () {

    $('.login-btn').click(function (e) {
        e.preventDefault();
        var captcha_status = "{{ GetCaptchaStatus() }}";
        console.log(captcha_status);

        if (captcha_status != "false" || captcha_status != false) {
            grecaptcha.ready(function () {
                grecaptcha.execute('{{GetCaptchaKeys()['captcha_sitekey']}}', {
                        action: 'submit'
                    }).then(function (token) {
                    // Add your logic to submit to your backend server here.
                    document.getElementById('g-recaptcha-response').value = token;
                    $('.login-form').submit();
                });
            });
        } else {
            $('.login-form').submit();
        }

    });
    });


</script> --}}

@endpush
