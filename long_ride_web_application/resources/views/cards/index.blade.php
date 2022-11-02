@extends('layouts.default')

@push('styles')

@endpush

@section('title','Cards')
@section('sub_title','All Cards')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-3">All Cards</h6>
                    <form  method="POST" class="login-form" id="form_id">
                        <div class="row">
                            <div class="col-md-12 text-right  mb-3">
                            <a href="{{route('card_view',['action' => 'add','id' => ''])}}" type="button" data-toggle="tooltip-primary" data-placement="top" title="Add a new card" class="btn btn-success text-right text-white"> + New Card Type</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            @csrf
                            <table class="table" id="zero_config">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Charge Per KM</th>
                                        <th scope="col">Validity Period</th>
                                        <th scope="col">status</th>
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
                    data: 'cardId',
                    name: 'cardId'
                },
                {
                    data: 'cardName',
                    name: 'cardName'
                },
                {
                    data: 'charge',
                    name: 'charge'
                },
                {
                    data: 'validity',
                    name: 'validity'
                },
                {
                    data: 'availability',
                    name: 'availability'
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
    var cardId = $(this).closest("a").data('routeid');
    var res = deleteCard(cardId);
});

$(document).on('click','.tog',function (e) {
    e.preventDefault();
    var status = $(this).data('status');
    var routeId = $(this).data('routeid');
    $.ajax({
        type: "POST",
        url: "{{route('changeAvailabilityStatus')}}",
        data: {'id':routeId,'status':status,'_token':'{{csrf_token()}}'},
        success: function (response) {
            if(response.success){
                if(status == 'Yes'){
                    $('*[data-routeid="' + routeId + '"]').closest("tr td div").toggleClass('on');
                }else{
                    $('*[data-routeid="' + routeId + '"]').closest("tr td div").toggleClass('on');
                }

            }
        }
    });
});

function deleteCard(cardId){
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
                        url: "{{route('card_create',['action' => 'delete','id' =>"cardId"])}}",
                        data: {'id':cardId,'_token':'{{csrf_token()}}'},
                        success: function (response) {
                            if(response.success){
                                $('*[data-routeid="' + cardId + '"]').closest("tr").remove();
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
