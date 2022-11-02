@extends('layouts.default')

@push('styles')

@endpush

@section('title','Routes')
@section('sub_title','All routes')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-3">All routes</h6>
                    @include('routes.header', ['active' => $action])
                    <form  method="POST" class="login-form" id="form_id">
                        <div class="row">
                            <div class="col-md-12 text-right  mb-3">
                            <a href="{{route('route_view',['action' => 'add','id' => ''])}}" type="button" data-toggle="tooltip-primary" data-placement="top" title="Add a new route" class="btn btn-success text-right text-white"> + New Route</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            @csrf
                            <table class="table" id="zero_config">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Route No</th>
                                        <th scope="col">Start Point</th>
                                        <th scope="col">End Point</th>
                                        <th scope="col">Mode</th>
                                        <th scope="col">No of Vehicles</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection



@push('scripts')
<script>

$(document).ready(function () {
    category_table = $('#zero_config').DataTable({
            buttons: [],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            order: [ 0, "desc" ],
            ajax: {
                url: "{{url()->current()}}",
                "type": "GET",
                "data": function (d) {
                    var frm = $('#form_id').serializeArray();
                    $.each(frm, function (indexInArray, valueOfElement) {
                        var name = valueOfElement.name;
                        d[name] = valueOfElement.value;
                    });
                }
            },
            "fnDrawCallback": function (oSettings) {},
            columns: [{
                    data: 'routeId',
                    name: 'routeId'
                },
                {
                    data: 'routeNo',
                    name: 'routeNo'
                },
                {
                    data: 'startPoint',
                    name: 'startPoint'
                },
                {
                    data: 'endPoint',
                    name: 'endPoint'
                },
                {
                    data: 'mode',
                    name: 'mode'
                },
                {
                    data: 'noVehicles',
                    name: 'noVehicles'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
});

$(document).on('click','.delete',function (e) {
    e.preventDefault();
    var routeId = $(this).closest("a").data('routeid');
    var res = deleteRoute(routeId);
});

$(document).on('click','.tog',function (e) {
    e.preventDefault();
    var status = $(this).data('status');
    var routeId = $(this).data('routeid');
    $.ajax({
        type: "POST",
        url: "{{route('changeRouteStatus')}}",
        data: {'id':routeId,'status':status,'_token':'{{csrf_token()}}'},
        success: function (response) {
            if(response.success){
                if(status == '1'){
                    $('*[data-routeid="' + routeId + '"]').closest("tr td div").toggleClass('on');
                }else{
                    $('*[data-routeid="' + routeId + '"]').closest("tr td div").toggleClass('on');
                }

            }
        }
    });
});

function deleteRoute(routeId){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('route_create',['action' => 'delete','id' =>"routeId"])}}",
                        data: {'id':routeId,'_token':'{{csrf_token()}}'},
                        success: function (response) {
                            if(response.success){
                                $('*[data-routeid="' + routeId + '"]').closest("tr").remove();
                                Swal.fire(
                                'Deleted!',
                                'Record has been deleted successfully.',
                                'success'
                                );
                            }
                        }
                    });
                }
            });

        }
</script>
@endpush
