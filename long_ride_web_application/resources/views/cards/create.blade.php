@extends('layouts.default')

@push('styles')


@endpush

@section('title','Cards')
@section('sub_title','Add cards')

@section('content')

@php
    $validityPeriods = [
        '1 Year',
        '2 Year',
        '3 Year',
        '1 Month',
        '2 Month',
        '3 Month',
    ];


    if($action != 'add'){
        $id = $data['cards']->cardId;
    }else{
        $id = '';
    }

@endphp

<form action="{{route('card_create',['action' => $action,'id' => $id])}}" method="POST" class="login-form" id="form_id">
    @csrf
<div class="row">
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-body">
                <h6 class="card-title mb-4">Card Type Information</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @error('cardName') has-danger @enderror">
                            <label>Card Name</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                            <input class="form-control" placeholder="Enter card name" type="text"
                                name="cardName" @if(!empty(old('cardName'))) value="{{old('cardName')}}" @elseif($action != 'add') value="{{$data['cards']->cardName}}" @endif>
                            @error('cardName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group @error('validity') has-danger @enderror">
                            <label>Validity Period</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                            <select class="form-control select2" name="validity">
                                <option value=" ">
                                    Select validity period
                                </option>
                                @foreach ($validityPeriods as $validityPeriod)
                                    <option value="{{$validityPeriod}}" @if(!empty(old('validity')) && old('validity') ==  $validityPeriod) selected @elseif($action != 'add' && $validityPeriod == $data['cards']->validity) selected @endif>
                                        {{$validityPeriod}}
                                    </option>
                                @endforeach
                            </select>
                            @error('validity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group @error('charge') has-danger @enderror">
                                <label>Charge Per KM</label><span class="text-danger" data-placement="top" data-toggle="tooltip-primary" title="Required">&nbsp; *</span>
                                <input class="form-control" placeholder="Enter charge per km" type="number"
                                    name="charge" @if(!empty(old('charge'))) value="{{old('charge')}}" @elseif($action != 'add') value="{{$data['cards']->charge}}" @endif>
                                @error('charge')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="row card-footer mt-4">
                    <div class="col-md-12 text-right">
                        <div class="form-group col-md-12">
                            <button type="submit" id="save" data-toggle="tooltip-primary" data-placement="top" title="Save route"  class="btn btn-success text-white">{{($action == 'edit') ? 'Update' : 'Save'}}</button>
                            <button type="button" id="clear" data-toggle="tooltip-primary" data-placement="top" title="Clear the form" class="btn btn-secondary">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card custom-card" style="height: 13rem;">
            <div class="card-body">
                <h6 class="card-title mb-5">Available For</h6>
                <div class="row">
                    <div class="col-md-6 ml-2">
                        <div class="form-group mb-4">
                            <label class="ckbox">
                                <input type="checkbox" name="localp" id="localp"
                                    @if(!empty(old('localp'))) checked @elseif($action != 'add' && $data['cards']->localp == '1') checked @endif>
                                <span>{{ __('Local Passengers') }}</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="ckbox">
                                <input type="checkbox" name="foreignp" id="foreignp"
                                @if(!empty(old('localp'))) checked @elseif($action != 'add' && $data['cards']->foreignp == '1') checked @endif>
                                <span>{{ __('Foreign Passengers') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

@endsection



@push('scripts')
<script>
$(document).ready(function () {
    $('.select2').css('width', '100%');
    $(document).on('click','#clear',function (e) {
        e.preventDefault();
        $('input[type=text]').val("");
        $('input[type=number]').val("");
        $('.select2').val(' ');
        $('.select2').trigger('change');
        $('.select2').css('width','100%');
    });
});

</script>
@endpush
