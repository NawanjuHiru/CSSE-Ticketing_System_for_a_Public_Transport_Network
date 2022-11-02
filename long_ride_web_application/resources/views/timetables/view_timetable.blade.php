@extends('layouts.default')

@push('styles')

@endpush

@php
$timetables = $data['timetables'];
$routeId = $data['routeId'];
$routeData =   $data['routeData'];
if($routeId == null){
    $routeId = 0;
}

if($routeData == null){
    $routeData->routeNo= 'null';
    $routeData->startPoint= 'null';
    $routeData->endpoint= 'null';
}


@endphp

@section('title','Route')
@section('sub_title','Time Table / '.$routeData->routeNo.' '.$routeData->startPoint.'-'.$routeData->endpoint.' Route')

@section('content')




<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card custom-card" style="height: 350px">
                        <div class="card-header">Monday</div>
                        <div class="card-body">
                <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                    <thead>

                        <tr>
                            <th scope="col">Departure Time</th>
                            <th scope="col">Arrival Time</th>
                            <th scope="col">Vehicle Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timetables as $res)
                        @if($res->day == 'Monday')
                            <tr>

                                <td scope="col" >{{$res->depaturetime}}</td>
                                <td scope="col">{{$res->arrivaltime}}</td>
                                <td scope="col">{{$res->vehicleId}}</td>
                            </tr>
                       @endif
                        @endforeach

                    </tbody>
                </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card custom-card" style="height: 350px">
                        <div class="card-header">Tuesday</div>
                        <div class="card-body">
                <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">Departure Time</th>
                            <th scope="col">Arrival Time</th>
                            <th scope="col">Vehicle Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timetables as $res)
                        @if($res->day == 'Tuesday')
                            <tr>
                                <td scope="col" >{{$res->depaturetime}}</td>
                                <td scope="col">{{$res->arrivaltime}}</td>
                                <td scope="col">{{$res->vehicleId}}</td>
                            </tr>
                       @endif
                        @endforeach
                    </tbody>
                </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card custom-card" style="height: 350px">
                        <div class="card-header">Wednesday</div>
                        <div class="card-body">
                    <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                        <thead>
                            <tr>
                                <th scope="col">Departure Time</th>
                                <th scope="col">Arrival Time</th>
                                <th scope="col">Vehicle Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timetables as $res)
                            @if($res->day == 'Wednesday')
                                <tr>
                                    <td scope="col" >{{$res->depaturetime}}</td>
                                    <td scope="col">{{$res->arrivaltime}}</td>
                                    <td scope="col">{{$res->vehicleId}}</td>
                                </tr>
                           @endif
                            @endforeach

                        </tbody>
                    </table>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card custom-card" style="height: 350px">
                            <div class="card-header">Thursday</div>
                            <div class="card-body">
                        <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                            <thead>
                                <tr>
                                    <th scope="col">Departure Time</th>
                                    <th scope="col">Arrival Time</th>
                                    <th scope="col">Vehicle Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timetables as $res)
                                @if($res->day == 'Thursday')
                                    <tr>
                                        <td scope="col" >{{$res->depaturetime}}</td>
                                        <td scope="col">{{$res->arrivaltime}}</td>
                                        <td scope="col">{{$res->vehicleId}}</td>
                                    </tr>
                               @endif
                                @endforeach

                            </tbody>
                        </table>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-card" style="height: 350px">
                                <div class="card-header">Friday</div>
                                <div class="card-body">
                            <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                                <thead>
                                    <tr>

                                        <th scope="col">Departure Time</th>
                                        <th scope="col">Arrival Time</th>
                                        <th scope="col">Vehicle Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($timetables as $res)
                                    @if($res->day == 'Friday')
                                        <tr>
                                            <td scope="col" >{{$res->depaturetime}}</td>
                                            <td scope="col">{{$res->arrivaltime}}</td>
                                            <td scope="col">{{$res->vehicleId}}</td>
                                        </tr>
                                   @endif
                                    @endforeach

                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-card" style="height: 350px">
                                <div class="card-header">Saturday</div>
                                <div class="card-body">
                            <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                                <thead>
                                    <tr>
                                        <th scope="col">Departure Time</th>
                                        <th scope="col">Arrival Time</th>
                                        <th scope="col">Vehicle Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($timetables as $res)
                                    @if($res->day == 'Saturday')
                                        <tr>
                                            <td scope="col" >{{$res->depaturetime}}</td>
                                            <td scope="col">{{$res->arrivaltime}}</td>
                                            <td scope="col">{{$res->vehicleId}}</td>
                                        </tr>
                                   @endif
                                    @endforeach
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-card" style="height: 350px">
                                <div class="card-header">Sunday</div>
                                <div class="card-body">
                            <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                                <thead>
                                    <tr>
                                        <th scope="col">Departure Time</th>
                                        <th scope="col">Arrival Time</th>
                                        <th scope="col">Vehicle Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($timetables as $res)
                                    @if($res->day == 'Sunday')
                                        <tr>
                                            <td scope="col" >{{$res->depaturetime}}</td>
                                            <td scope="col">{{$res->arrivaltime}}</td>
                                            <td scope="col">{{$res->vehicleId}}</td>
                                        </tr>
                                   @endif
                                    @endforeach
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>

</script>
@endpush
