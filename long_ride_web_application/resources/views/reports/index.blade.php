@extends('layouts.default')

@push('styles')
@endpush

@section('title', 'Reports')
@section('sub_title', 'All Reports')

@section('content')
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-sm-3">
            <div class="card h-100 border-primary hover scard">
                <div class="card-body text-center">
                    <img src="{{ asset('/images/inspector.png') }}" class="ht-90 mb-4" alt="gym.png" />
                    <h5 class="card-title text-primary">Inspector Report</h5>
                    <hr class="bg-primary" />
                    <a class="modal-effect btn btn-primary" id="inspectorGen" data-effect="effect-fall"
                        href="#inspectorModal" data-toggle="modal">Generate</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card h-100 border-success hover scard">
                <div class="card-body text-center">
                    <img src="{{ asset('/images/route.png') }}" class="ht-90 mb-4" alt="route.png" />
                    <h5 class="card-title text-success">Routes Report</h5>
                    <hr class="bg-success" />
                    <a class="modal-effect btn btn-success" id="routeGen" data-effect="effect-fall" href="#routeModal"
                        data-toggle="modal">Generate</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card h-100 border-danger hover scard">
                <div class="card-body text-center ">
                    <div class=""><img src="{{ asset('/images/timetable.png') }}" class="ht-90 mb-4"
                            alt="dumbbell.png" /></div>
                    <h5 class="card-title text-danger">Timetable</h5>
                    <hr class="bg-danger" />
                    <a class="modal-effect btn btn-danger" id="timetableGen" data-effect="effect-fall"
                        href="#timetableModal" data-toggle="modal">Generate</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card h-100 border-warning hover scard">
                <div class="card-body text-center">
                    <img src="{{ asset('/images/passenger.png') }}" class="ht-90 mb-4" alt="nutrition.png" />
                    <h5 class="card-title text-warning">Passenger Report</h5>
                    <hr class="bg-warning" />
                    <a class="modal-effect btn btn-warning" id="passengerGen" data-effect="effect-fall"
                        href="#passengerModal" data-toggle="modal">Generate</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-left mt-4">
        <div class="col-sm-3">
            <div class="card h-100 border-info hover scard">
                <div class="card-body text-center">
                    <img src="{{ asset('/images/bus.png') }}" class="ht-90 mb-4" alt="gym.png" />
                    <h5 class="card-title text-info">Vehicle Report</h5>
                    <hr class="bg-info" />
                    <a class="modal-effect btn btn-info" id="vehicleGen" data-effect="effect-fall" href="#vehicleModal"
                        data-toggle="modal">Generate</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-fall" id="inspectorModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Generate Ticket Inspector Report</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="inspectorBody">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" id="inspectorClear" data-dismiss="modal"
                        type="button">Close</button>
                    <button class="btn ripple btn-primary" id="inspectorSave" type="button">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-fall" id="timetableModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Generate Time Table</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="timetableBody">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" id="timetableClear" data-dismiss="modal"
                        type="button">Close</button>
                    <button class="btn ripple btn-primary" id="timetableSave" type="button">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-fall" id="passengerModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Generate Passenger Report</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="passengerBody">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" id="passengerClear" data-dismiss="modal"
                        type="button">Close</button>
                    <button class="btn ripple btn-primary" id="passengerSave" type="button">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-fall" id="routeModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Generate Route Report</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="routeBody">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" id="routeClear" data-dismiss="modal"
                        type="button">Close</button>
                    <button class="btn ripple btn-primary" id="routeSave" type="button">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-fall" id="vehicleModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Generate Vehicle Report</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="vehicleBody">

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" id="vehicleClear" data-dismiss="modal"
                        type="button">Close</button>
                    <button class="btn ripple btn-primary" id="vehicleSave" type="button">Proceed</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#inspectorGen').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('inspector_load') }}",
                    success: function(response) {
                        $('#inspectorBody').html(response);
                    }
                });
            });

            $('#timetableGen').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('timetable_load') }}",
                    success: function(response) {
                        $('#timetableBody').html(response);
                    }
                });
            });

            $('#inspectorSave').click(function(e) {
                e.preventDefault();
                $('#inspector_print_id').trigger('click');
                $('#inspectorClear').trigger('click');
            });

            $('#timetableSave').click(function(e) {
                e.preventDefault();
                $('#timetable_print_id').trigger('click');
                $('#timetableClear').trigger('click');
            });

            $('#passengerGen').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('passenger_load') }}",
                    success: function(response) {
                        $('#passengerBody').html(response);
                    }
                });
            });

            $('#passengerSave').click(function(e) {
                e.preventDefault();
                $('#passenger_print_id').trigger('click');
                $('#passengerClear').trigger('click');
            });

            $('#routeGen').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('route_load') }}",
                    success: function(response) {
                        $('#routeBody').html(response);
                    }
                });
            });

            $('#vehicleGen').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('vehicle_load') }}",
                    success: function(response) {
                        $('#vehicleBody').html(response);
                    }
                });
            });

            $('#routeSave').click(function(e) {
                e.preventDefault();
                $('#route_print_id').trigger('click');
                $('#routeClear').trigger('click');
            });

            $('#vehicleSave').click(function(e) {
                e.preventDefault();
                $('#vehicle_print_id').trigger('click');
                $('#vehicleClear').trigger('click');
            });
        });
    </script>
@endpush
