@php
    use Carbon\Carbon;
    $img = public_path('images/bg_img_green.png');

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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Time Table {{$routeData->routeNo.' '.$routeData->startPoint.'-'.$routeData->endpoint.' Route' }}</title>
    <style>
        * {
            font-size: 21px;
            font-family: Arial, Helvetica, sans-serif !important;
        }
        html{
            margin:10px 40px 10px 40px;
        }
        .page-break {
            page-break-after: always;
        }
        * {
            font-size: 12px;
        }
        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }
        .pagenum:before {
            content: counter(page);
        }
        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 150px;
            background-color: transparent;
        }
        header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            background-color: transparent;
        }
        .content {
            position: fixed;
            top: 13%;
            height: 68%;
            left: 0px;
            right: 0px;
            background-color: transparent;
        }
        #summary_table{
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        .cl3 tr {
            line-height: 180%;
        }
        #zero_config th, #zero_config tr td  {
            border: 1px groove black;
            padding-top: 4px;
            padding-bottom: 4px;
            text-align: center;
        }
        #zero_config tr:nth-child(even){background-color: #63a1b94d;}

        .container-name div {
            display: inline-block;
             width: 300px;
            max-height: 10000px;
        }

        table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
    </style>
</head>
    <body>
        <header style=" border: 1px solid white">
            <table style="width:100%; margin-top: 0%;">
                <tr style="width:100%" >
                    <td style="width:100%; padding-left:20px"><img src="{{ $img }}" style="width:200px"/></td>
                    <td style="width:100%"  align="right"  valign="bottom"><h1><span style="font-style:italic; color:#b6b4b4; font-size:16px">{{$routeData->routeNo.' '.$routeData->startPoint.'-'.$routeData->endpoint.' Route Time Table' }} {{date('Y-m-d')}}</span></h1></td>
                </tr>
            </table>
            <hr />

            <table style="width:100%"><!-- 3 -->
                <tr style="width:600px">
                </tr>
            </table>
        </header>

        <div  class="center content" style="margin-top:3%;  border: 1px solid white">
            <div class="container-name">
                <div class="div1">
                    <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                        <thead>
                            <tr>
                                <th scope="col">Day</th>
                                <td  style="text-align: center; color: yellowgreen">Monday</td>
                            </tr>
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
                <div class="div2"> <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                    <thead>
                        <tr>
                            <th scope="col">Day</th>
                            <td  style="text-align: center; color: yellowgreen">Tuesday</td>
                        </tr>
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
                </table></div>
                </div>

                <div class="container-name">
                    <div class="div1">
                        <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                            <thead>
                                <tr>
                                    <th scope="col">Day</th>
                                    <td  style="text-align: center; color: yellowgreen">Wednesday</td>
                                </tr>
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
                    <div class="div2"> <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                        <thead>
                            <tr>
                                <th scope="col">Day</th>
                                <td  style="text-align: center; color: yellowgreen">Thursday</td>
                            </tr>
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
                    </table></div>
                    </div>
                    <div class="container-name">
                        <div class="div1">
                            <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                                <thead>
                                    <tr>
                                        <th scope="col">Day</th>
                                        <td  style="text-align: center; color: yellowgreen">Friday</td>
                                    </tr>
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
                        <div class="div2"> <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                            <thead>
                                <tr>
                                    <th scope="col">Day</th>
                                    <td  style="text-align: center; color: yellowgreen">Saturday</td>
                                </tr>
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
                        </table></div>
                        </div>
                        <div class="container-name">
                            <div class="div1">
                                <table class="table table-striped mg-b-0 text-md-nowrap" id="zero_config">
                                    <thead>
                                        <tr>
                                            <th scope="col">Day</th>
                                            <td  style="text-align: center; color: yellowgreen">Sunday</td>
                                        </tr>
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
        </div><br/>

        <footer id="footer2" style=" border: 1px solid white">
            <hr />
                <table style="width:100%; vertical-align: bottom; alignment-adjust:central " ><!-- 2 -->
                    <tr style="width:100%;" >
                        <td style="width:100%; text-align:left">
                            <span style="color: #939393">
                                <p>Smart Traveller Ltd<br>Unit C1 and C2 Ward Place,<br>Mirihana Road,<br>Nugegoda<br>Gloucester, GL2 2GB</p>
                            </span>
                        </td>
                        <td style="width:100%; text-align:right">
                            <span style="color: #939393">
                                <p>Fax : 03300167689<br>Support Line : 03300167680</p>
                                <p>Web : http://www.smarttraveller.com</p>
                            </span>
                        </td>
                    </tr>
                </table>
                <div  align="center"><span style="color: #939393" class="pagenum"></span></div>
        </footer>
    </body>
</html>
