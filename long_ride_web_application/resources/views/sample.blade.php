@extends('layouts.default')

@push('styles')

@endpush

@section('title','Sample')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <h6 class="card-title mb-1">Sample Form</h6>
                    <div class="row">
                        <div class="col-md-6">

                            <form  method="POST" class="login-form">
                                @csrf
                                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                <div class="form-group @error('email') has-danger @enderror">
                                    <label>Username</label>
                                    <input class="form-control" placeholder="Enter your username" type="text"
                                        name="username">
                                    @error('username')
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
                                </div>

                                <div class="form-group @error('password') has-danger @enderror">
                                    <label>Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                            </div>
                                        </div>
                                        <input class="form-control fc-datepicker col-md-6" placeholder="MM/DD/YYYY" type="text">
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('password') has-danger @enderror">
                                    <label>Select</label>
                                    <select class="form-control select2">
                                        <option label="Choose one">
                                            Choose one
                                        </option>
                                        <option value="Firefox">
                                            Firefox
                                        </option>
                                        <option value="Chrome">
                                            Chrome
                                        </option>
                                        <option value="Safari">
                                            Safari
                                        </option>
                                        <option value="Opera">
                                            Opera
                                        </option>
                                        <option value="Internet Explorer">
                                            Internet Explorer
                                        </option>
                                    </select>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="ckbox">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('Remember Me') }}</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <button type="button" id="submit" class="btn btn-primary mt-3 mb-0">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
$(document).ready(function () {
$('#submit').click(function (e) {
    e.preventDefault();
    alert(' xxxxxx');
});

$(document).ready(function () {
    category_table = $('#zero_config').DataTable({
            buttons: ['copy', 'excel', 'pdf'],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            ajax: {
                url: "{{ url('/') }}"
            },
            "fnDrawCallback": function (oSettings) {},
            columns: [{
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
});

});
</script>
@endpush
