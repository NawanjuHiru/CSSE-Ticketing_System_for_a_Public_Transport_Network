@extends('layouts.default')

@push('styles')
<!---Internal Fileupload css-->
<link href="../../assets/plugins/fileuploads/css/fileupload.css" rel="stylesheet" type="text/css"/>
@endpush
@php
    (isset($data['id'])) ? $id = $data['id'] : $id = '';
    $routeData =   $data['routes'];
@endphp

@section('title','Ticket Inspector')
@section('sub_title','Edit Ticket Inspector Information')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card h-100">
                    <form action="{{route('ticketInspector_update',['id' => $id])}}" method="POST" class="login-form" enctype="multipart/form-data" id="edit_ticketInspector">
                        @csrf
                        <div class="card-body">
                            <h6 class="card-title mb-3">Update Ticket Inspector Information</h6>
                        <div class="row row-sm">
                            <div class="col-6">
                                <div class="form-group @error('firstname') has-danger @enderror">
                                    <label class="form-label">First Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="firstname" id="firstname" placeholder="Input First Name"  type="text"
                                    @if(!empty(old('firstname'))) value="{{old('firstname')}}" @else value="{{$data['result']->firstname}}" @endif>
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('email') has-danger @enderror">
                                    <label class="form-label">Email: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="email" id="email" placeholder="Input Email" type="text"
                                    @if(!empty(old('email'))) value="{{old('email')}}" @else value="{{$data['result']->email}}" @endif>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('city') has-danger @enderror">
                                    <label class="form-label">City <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="city" id="city" placeholder="Input City"  type="text"
                                    @if(!empty(old('city'))) value="{{old('city')}}" @else value="{{$data['result']->city}}" @endif>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('password') has-danger @enderror">
                                    <label class="form-label">Password: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="password" id="password" placeholder="Input Password"  type="password"
                                    @if(!empty(old('password'))) value="{{old('password')}}" @else value="{{$data['result']->password}}" @endif>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group @error('lastname') has-danger @enderror">
                                    <label class="form-label">Last Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="lastname" id="lastname" placeholder="Input lastt Name"  type="text"
                                    @if(!empty(old('lastname'))) value="{{old('lastname')}}" @else value="{{$data['result']->lastname}}" @endif>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('phone') has-danger @enderror">
                                    <label class="form-label">Phone: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="phone" id="phone" placeholder="Input Phone"  type="text"
                                    @if(!empty(old('phone'))) value="{{old('phone')}}" @else value="{{$data['result']->phone}}" @endif>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" @error('route') has-danger @enderror>
                                    <label class="form-label">Route: </label>
                                    <select class="form-control select2" data-parsley-class-handler="#slWrapper" name="route" id="route" data-parsley-errors-container="#slErrorContainer" data-placeholder="Choose one">
                                        <option value=' ' label="Select route">
                                            Select Route
                                        </option>
                                        @foreach($routeData as $route)
										<div class="col-lg-3">
                                            <option value="{{$route->routeId}}" label="{{$route->routeNo}}" @if(!empty(old('route') && old('route') == $route->routeId)) selected  @elseif (isset($data['result']) && $data['result']->route ==  $route->routeId) selected  @endif>
                                                {{$route->routeNo}}
                                             </option>
                                        </div>
                                        <br>
                                    @endforeach
                                    </select>
                                    @error('route')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group @error('avatar') has-danger @enderror">
                            <label for="avatar" class="mb-3">Avatar<span class="tx-danger">*</span></label><br/>
                            @php
                                $img = Storage::disk('accountsdocs')->get($data['result']->avatar);
                                $type =  pathinfo(Storage::disk('accountsdocs')->path($data['result']->avatar), PATHINFO_EXTENSION);
                                $path = 'data:avatar/' . $type . ';base64,' . base64_encode($img);
                                $avatarName = explode("/",$data['result']->avatar)
                            @endphp
                            <div id="fImage">
                                <img src="{{$path}}"  class="bd mb-2" name="fImage" height="100px">
                                <h6 class="text-primary">{{Str::ucfirst($avatarName[1])}}</h6>
                            </div>
                            <div class="mt-3">
                                <input type="file" name="avatar" id="avatar" data-allowed-file-extensions="jpg png" value="{{$data['result']->avatar}}"  class="dropify form-control" data-height="200" />
                            </div>
                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>&nbsp;</label>
                        </div>
                        </div>

                        <div class="card-footer w-100" style="position: absolute; bottom: 0;">
                            <div class="row">

                                <div class="col-md-6 text-left">
                                    <div class="form-group col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit" class="btn btn-success">Update Inspector</button>
                                        <button type="reset" id="clear" class="btn btn-secondary text-white">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>



@endsection



@push('scripts')
<script>
$(document).ready(function () {
$('#clear').click(function (e) {
    e.preventDefault();
    clear();
});
$('#avatar').change(function (e) {
    e.preventDefault();
    $('#fImage').remove();
});
});
function clear(){
    $('.select2').val('');
    $('.select2').trigger('change');
    $('input[type=text]').val('');
    $('textarea').val('');
    $(".dropify-clear").trigger('click');
}
</script>
@endpush
