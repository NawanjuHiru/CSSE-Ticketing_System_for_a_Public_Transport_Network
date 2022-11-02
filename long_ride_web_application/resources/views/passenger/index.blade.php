@extends('layouts.default')

@push('styles')

@endpush

@section('title','Passenger')

@section('content')
@php
    $type = [
        'Local' => 'Local',
        'Foreign' => 'Foreign',
    ]
@endphp
<div class="row">
    <div class="col-md-12">
        @include('passenger.header', ['active' => $action])
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group col-md-12">
                    @if ($action == 'Foreign')
                        <h2>Foreign Passengers</h2>
                    @elseif($action == 'Local')
                        <h2>Local Passengers</h2>
                    @else
                        <h2>All Passengers</h2>
                    @endif
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="form-group col-md-12">
                    <a href="{{route('passenger_view',['action' => 'Add', 'id' => ''])}}" type="button" id="" class="btn btn-success mt-0 mb-0">+ New Passenger</a>
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
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type</th>
                            <th scope="col">Card Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
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
    category_table = $('#zero_config').DataTable({
            buttons: [],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            order: false,
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
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'card_Type',
                    name: 'card_Type'
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

        // $('#submit').click(function (e) {
        //     e.preventDefault();
        //     category_table.ajax.reload();
        //     $('.select2').css('width','100%');
        //  })

        $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var appid = $(this).closest("a").data('appid');
            // console.log(appid);
            var res = deletePassenger(appid);
        });

        $(document).on('click','.tog',function (e) {
        e.preventDefault();
        var status = $(this).data('status');
        var passenger_id = $(this).data('passenger_id');
        console.log(passenger_id);
            $.ajax({
                type: "POST",
                url: "{{route('changePassengerStatus')}}",
                data: {'id':passenger_id,'status':status,'_token':'{{csrf_token()}}'},
                success: function (response) {
                    if(response.success){
                        if(status == '1'){
                            $('*[data-passenger_id="' + passenger_id + '"]').closest("tr td div").toggleClass('on');
                        }else{
                            $('*[data-passenger_id="' + passenger_id + '"]').closest("tr td div").toggleClass('on');
                        }
                    }
                }
            });
        });

        function deletePassenger(appid){
            // console.log(appid);
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
                    console.log(appid + " at Swal");
                    $.ajax({
                        type: "POST",
                        url: "{{route('passenger_create',['action' => 'Delete','id' =>"appid"])}}",
                        data: {'id':appid,'_token':'{{csrf_token()}}'},
                        success: function (response) {
                            console.log(response.success);
                            if(response.success){
                                $('*[data-appid="' + appid + '"]').closest("tr").remove();
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
});

</script>
@endpush



