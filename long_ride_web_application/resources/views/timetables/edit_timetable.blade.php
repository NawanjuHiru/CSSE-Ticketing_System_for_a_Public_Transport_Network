@extends('layouts.default')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
@endpush

@section('title','Time Table')
@section('sub_title','Edit Time Table')

@section('content')

@php
$vehicles = $data['vehicles'];
$routeId = $data['result']->routeId;
$id = $data['result']->timetableId;
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card h-100">
                    <form action="{{route('timetable_update',['id' => $id])}}" method="POST" class="login-form" id="create_timeTable_form">
                        @csrf
                    <div class="card-body">
                        <h6 class="card-title mb-3">Edit Time Table</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @error('day') has-danger @enderror">
                                    <input class="form-control" placeholder="Arrival Time" type="routeId" name="routeId" value="{{$routeId}}" hidden>
                                    <label>Day</label>
                                    <select class="form-control select2" name="day" id="day">
                                        <option value="Select a Day" label="Select a Day">
                                           Select a Day
                                        </option>
                                        <option value="Monday" label="Monday"  @if(!empty(old('day') && old('day') == 'Monday')) selected  @elseif (isset($data['result']) && $data['result']->day ==  "Monday") selected  @endif>
                                           Monday
                                        </option>
                                        <option value="Tuesday" label="Tuesday" @if(!empty(old('day') && old('day') == 'Tuesday')) selected  @elseif (isset($data['result']) && $data['result']->day ==  "Tuesday") selected  @endif>
                                            Tuesday
                                        </option>
                                        <option value="Wednesday" label="Wednesday" @if(!empty(old('day') && old('day') == 'Wednesday')) selected  @elseif (isset($data['result']) && $data['result']->day ==  "Wednesday") selected  @endif>
                                            Wednesday
                                        </option>
                                        <option value="Thursday" label="Thursday" @if(!empty(old('day') && old('day') == 'Thursday')) selected  @elseif (isset($data['result']) && $data['result']->day ==  "Thursday") selected  @endif>
                                            Thursday
                                        </option>
                                        <option value="Friday" label="Friday" @if(!empty(old('day') && old('day') == 'Friday')) selected  @elseif (isset($data['result']) && $data['result']->day ==  "Friday") selected  @endif>
                                            Friday
                                        </option>
                                        <option value="Saturday" label="Saturday" @if(!empty(old('day') && old('day') == 'Saturday')) selected  @elseif (isset($data['result']) && $data['result']->day ==  "Saturday") selected  @endif>
                                            Saturday
                                        </option>
                                        <option value="Sunday" label="Sunday" @if(!empty(old('day') && old('day') == 'Sunday')) selected  @elseif (isset($data['result']) && $data['result']->day ==  "Sunday") selected  @endif>
                                            Sunday
                                        </option>
                                    </select>
                                    @error('day')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('arrivaltime') has-danger @enderror">
                                    <label>Arrival Time</label>
                                    <input class="timepicker form-control" placeholder="00.00" type="text" name="arrivaltime"  @if(!empty(old('arrivaltime'))) value="{{old('arrivaltime')}}" @else value="{{$data['result']->arrivaltime}}" @endif>
                                    @error('arrivaltime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @error('vehicleId') has-danger @enderror">
                                    <label>Vehicle Number</label>
                                    <select class="form-control select2" name="vehicleId" id="vehicleId">
                                        <option value="   Select the Vehicle" label="Select the Vehicle">
                                           Select the Vehicle
                                        </option>
                                        @foreach($vehicles as $vehicle)
										<div class="col-lg-3">

                                            <option value="{{$vehicle[0]->vehicleId}}" label="{{$vehicle[0]->vehicleNumber}}" @if(!empty(old('vehicleId') && old('vehicleId') == $vehicle[0]->vehicleId)) selected  @elseif (isset($data['result']) && $data['result']->vehicleId ==  $vehicle[0]->vehicleId) selected  @endif>
                                                {{$vehicle[0]->vehicleNumber}}
                                             </option>
                                        </div>
                                        <br>
                                    @endforeach
                                    </select>
                                    @error('vehicleId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group @error('depaturetime') has-danger @enderror">
                                    <label>Departure Time</label>
                                    <input class="timepicker form-control" placeholder="00.00" type="text" name="depaturetime"  @if(!empty(old('depaturetime'))) value="{{old('depaturetime')}}" @else value="{{$data['result']->depaturetime}}" @endif>

                                    @error('depaturetime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group @error('workout_plan_day') has-danger @enderror">
                                    <label></label>
                                    <div class="row">

									</div>
                                    @error('workout_plan_day')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>&nbsp;</label>
                                </div>
                            </div>
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
                                    <button  type="submit" id="save" class="btn btn-success">Update</button>
                                    <button type="button" id="clear" class="btn btn-secondary text-white" >Clear</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script>
$(document).ready(function () {

    $('#clear').click(function (e) {
    e.preventDefault();
    clear();
});

$('.timepicker').datetimepicker({
    format: 'HH:mm',
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
  })

});

function clear(){
    $('.select2').val('');
    $('.select2').trigger('change');
    $('input[type=text]').val('');
    $('input[type=checkbox]').prop('checked',false);
    $('textarea').val('');
}

</script>
@endpush
