@extends('layouts.app')

@section('content')

<div class="col-md-12 col-lg-12 col-xl-12 bg-white">
    <div class="login d-flex py-2">

        <div class="container p-0">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 mx-auto">
                    <div class="card-sigin">
                        <div class="mb-5 d-flex"> <a href="index.html"><img src="{{ asset('favicon.png') }}"
                                    class="sign-favicon" alt="logo"></a>
                            <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">System<span> Force</span> I.T</h1>
                        </div>
                        <div class="card card-sigin box-shadow-0">
                            <div class="main-signup-header">
                                <div class="card-header">
                                    <h4 class="card-title mb-1">Create Your Credentials</h4>
                                </div>
                                <div class="card-body pt-0">
                                {{-- <form action="{{-- route('login')  }}" method="POST" class="credentialscreate-form"> --}}
                            <form action="{{ route('create_account')  }}" method="POST" class="credentialscreate-form">
                            @csrf
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group  @error('username') has-danger @enderror">
                                                    <label>Username</label>
                                                    <input class="form-control" placeholder="Enter your username" value="{{ $row->company_id }}" type="text" name="username" readonly>
                                                    @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group @error('password') has-danger @enderror">
                                                    <label>Password</label>
                                                    <input class="form-control password" placeholder="Enter your password" type="password" name="password" id="password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group @error('password_confirmation') has-danger @enderror">
                                                    <label>Confirm Password</label>
                                                    <input class="form-control password_confirmation" placeholder="Confirm your password" type="password" name="password_confirmation" id="password_confirmation">
                                                    @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>

                                                    <a class="btn btn-main-primary btn-block login-btn  modal-trigger" data-target="#modaldemo1" data-toggle="modal" href="">Auto Generate</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-3 col-md-3 col-sm-12"></div>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Your password must be more than 6 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
                                    </small>
                                    </div>
                                </div>
                                <div class="tx-right pd-y-20">
                                    <button class="btn btn-main-primary col-lg-2 col-md-2 col-sm-6" type="submit">Submit</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End -->
    </div>
</div><!-- End -->

<!-- Basic modal -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Generate Password</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="system_password" class="system_password_lbl">Generated Password</label>
                            <input class="form-control"  type="text" id="system_password" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="tx-right pd-y-20">
                            <button type="button" id="btngene_password" class="btn btn-primary tx-right">Generate Password</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <input class="text_copied"  type="checkbox" value="" id="text_copied">
                            <label for="text_copied"> <span style="text-transform: none"> I </span> have save this password to safe place</label>
                        </div>
                    </div>
                </div>
                </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary use_password" type="button">Use Password</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->

@endsection
@push('scripts')

<script>
    $(document).ready(function () {

        $('.use_password').prop("disabled", true);

        $('#text_copied').change(function () {
            if(!$('#text_copied').is(":checked")){
                $('.use_password').prop("disabled", true);
            }else{
                $('.use_password').prop("disabled", false);
            }
        });

        $('#btngene_password').click(function () {
            $(".system_password_lbl").addClass("active");
            $('#system_password').val(password.generate());
        });

        $('.use_password').click(function () {

            var generatede_password = $('#system_password').val();

            $('#password').val(generatede_password);
            $(".password").addClass("active");

            $('#password_confirmation').val(generatede_password);
            $(".password_confirmation").addClass("active");

            $('#modaldemo1').modal('toggle');

        });

    });
</script>

@endpush
