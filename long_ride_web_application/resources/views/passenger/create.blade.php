@extends('layouts.default')

@push('styles')
<!---Internal Fileupload css-->
<link href="{{asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@php
    $action = $data['action'];
    (isset($data['id'])) ? $id = $data['id'] : $id = '';
@endphp

@section('title','Passenger')
@section('sub_title', $action.' Passenger')

@section('content')

<div class="row">
    <div class="col-md-9">
        <form action="{{route('passenger_create', ['action' => $action, 'id' => $id])}}" class="login-form" method="POST" enctype="multipart/form-data">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-1">Passenger Information</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group @error('first_name') has-danger @enderror">
                                            <label>First Name</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <input class="form-control" placeholder="Enter First Name" type="text" id="first_name"
                                                name="first_name" @if(!empty(old('first_name'))) value="{{old('first_name')}}" @elseif(isset($data['result'])) value="{{$data['result']->first_name}}" @else value="" @endif>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('last_name') has-danger @enderror">
                                            <label>Last Name</label> @if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <input class="form-control" placeholder="Enter Last Name" type="text" id="last_name"
                                                name="last_name" @if(!empty(old('last_name'))) value="{{old('last_name')}}" @elseif(isset($data['result'])) value="{{$data['result']->last_name}}" @else value="" @endif>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('email') has-danger @enderror">
                                            <label>Email</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <input class="form-control" placeholder="Enter Email" type="text" id="email"
                                                name="email" @if(!empty(old('email'))) value="{{old('email')}}" @elseif(isset($data['result'])) value="{{$data['result']->email}}" @else value="" @endif>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('phone') has-danger @enderror">
                                            <label>Phone</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <input class="form-control" placeholder="Enter Phone Number" type="text" id="email"
                                                name="phone" @if(!empty(old('phone'))) value="{{old('phone')}}" @elseif(isset($data['result'])) value="{{$data['result']->phone}}" @else value="" @endif>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @error('password') has-danger @enderror">
                                            <label>Password</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <input class="form-control" placeholder="Enter Password" type="password" id="password"
                                                name="password" @if(!empty(old('password'))) value="{{old('password')}}" @elseif(isset($data['result'])) value="{{$data['result']->password}}" @else value="" @endif>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @php
                                        $type = [
                                            'Type1' => 'Local',
                                            'Type2' => 'Foreign',
                                        ]
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="form-group @error('type') has-danger @enderror">
                                            <label>Type</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <select class="form-control select2" name="type">
                                                <option label="Choose one" value="">
                                                    Choose Passenger Type
                                                </option>
                                                @foreach ($type as $key => $value )
                                                    <option value="{{$value}}" @if(!empty(old('type') && old('type') == $value)) selected @elseif(isset($data['result']) && $data['result']->type == $value) selected @endif>
                                                        {{$value}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if ($action == 'Edit')
                                    @php
                                        $status = [
                                            '1' => 'Active',
                                            '0' => 'Deactive',
                                        ]
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="form-group @error('status') has-danger @enderror">
                                            <label>Status</label>@if($action == 'Add')<span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>@endif
                                            <select class="form-control select2" name="status">
                                                <option label="Choose one" value="">
                                                    Choose Passenger Status
                                                </option>
                                                @foreach ($status as $key => $value )
                                                    <option value="{{$key}}" @if(!empty(old('status') && old('status') == $value)) selected @elseif(isset($data['result']) && $data['result']->status == $key) selected @endif>
                                                        {{$value}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group @error('image') has-danger @enderror">
                                            <label for="image" class="mb-3">Passenger Avatar</label><br/>
                                            @php
                                                $img = Storage::disk('accountsdocs')->get($data['result']->avatar_path);
                                                $type =  pathinfo(Storage::disk('accountsdocs')->path($data['result']->avatar_path), PATHINFO_EXTENSION);
                                                $path = 'data:image/' . $type . ';base64,' . base64_encode($img);
                                                $imageName = explode("/",$data['result']->avatar_path)
                                            @endphp
                                            <div id="fImage">
                                                <img src="{{$path}}"  class="bd mb-2" name="fImage" height="150px">
                                                <h6 class="text-primary">{{Str::ucfirst($imageName[1])}}</h6>
                                            </div>
                                            <div class="">
                                                <input type="file" name="image" id="image" data-allowed-file-extensions="jpg png" value="{{$data['result']->avatar_path}}"  class="dropify form-control" data-height="200" />
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-12">
                                        <div class="form-group @error('image') has-danger @enderror">
                                            <label for="image">Avatar<span class="tx-danger">*</span></label>
                                            <div class="">
                                                <input type="file" name="image" data-allowed-file-extensions="jpg png" id="image" class="dropify form-control" data-height="200" />
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-12 text-right">
                                        <div class="form-group col-md-12">
                                            <button type="submit" id="submit" class="btn btn-success mt-3 mb-0" data-placement="top"
                                            data-toggle="tooltip-primary" title="Save Details">{{(isset($data['result'])) ? 'Update' : 'Save'}}</button>
                                            <button type="button" id="clear" class="btn btn-secondary mt-3 mb-0" data-placement="top"
                                            data-toggle="tooltip-secondary" title="Reset the form">Clear</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-1">Card Type</h6>
                <hr>
                <div class="col-md-6">
                    <div class="form-group @error('cid') has-danger @enderror">
                        <div class="">
                            @foreach ($data['cards'] as $item)
                                <label class="rdiobox"><input name="cid" type="radio" value="{{$item->cardId}}"
                                    @if(!empty(old('cid')) && (old('cid') == $item->cardId)) checked @elseif(isset($data['result']) && $data['result']->card_id == $item->cardId) checked @else value="" @endif>
                                    <span>{{$item->cardName}}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('cid')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </form>
                <div class="text-left">
                    <div class="form-group">
                        <a href="{{route('passenger_view',['action' => 'Add', 'id' => ''])}}" type="button" id="submit" class="btn btn-success mt-0 mb-0">+ Create Card</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.select2').css('width','100%');
    });

    $('#clear').click(function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will clear all the details you inserted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, clear it!'
            }).then((result) => {
            if (result.isConfirmed) {
                e.preventDefault();
                $('#first_name, #last_name, #email, #phone, #password').val("");
                $('.select2').val('');
                $('.select2').trigger('change');
                $('.select2').css('width','100%');
                $(".dropify-clear").trigger('click');
            }
        });
    });
</script>
@endpush
