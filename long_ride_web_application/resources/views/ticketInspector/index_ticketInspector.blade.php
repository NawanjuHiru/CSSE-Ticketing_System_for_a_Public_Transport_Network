@extends('layouts.default')

@push('styles')

@endpush

@section('title','Ticket Inspector')
@section('sub_title','View Ticket Inspector')

@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <div class="form-group">
            <a href="{{route('createTicketInspector_view')}}" type="button" id="" class="btn btn-success mt-0 mb-0">+ New Inspector</a>
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
                            <th scope="col">Avatar</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">City</th>
                            <th scope="col">Route</th>
                            <th scope="col">Action</th>
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
    $('.select2').css('width','100%');
    category_table = $('#zero_config').DataTable({
            buttons: [],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bflrtip',
            processing: false,
            serverSide: true,
            filter: true,
            order:false,
            responsive: true,
            ajax: {
                url: "{{url()->current()}}",
                "type": "GET",
                "data": function (d) {
                    var frm = $('#search_equipment').serializeArray();
                    $.each(frm, function (indexInArray, valueOfElement) {
                        var name = valueOfElement.name;
                        d[name] = valueOfElement.value;
                    });
                }
            },
            "fnDrawCallback": function (oSettings) {},
            columns: [{
                    data: 'avatar',
                    name: 'avatar'
                },
                {
                    data: 'firstname',
                    name: 'firstname'
                },
                {
                    data: 'lastname',
                    name: 'lastname'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'route',
                    name: 'route'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
        $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var tinsid = $(this).closest("a").data('tinsid');
            var res = deleteTicketInspector(tinsid);
        });
        function deleteTicketInspector(tinsid){
            console.log("iiiiii"+tinsid);

            let url = "{{ route('timetableInspector_delete', ':id') }}";

            url = url.replace(':id', tinsid);
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
                        url: url,
                        data: {'id':tinsid,'_token':'{{csrf_token()}}'},
                        success: function (response) {
                            if(response.success == 1){
                                $('*[data-tinsid="' + tinsid + '"]').closest("tr").remove();
                                Swal.fire(
                                'Deleted!',
                                'Record has been deleted successfully.',
                                'success'
                                );
                            }else if(response.success == 2){
                                Swal.fire({
                                icon: 'warning',
                                title: 'Delete Fail',
                                text: 'This rout is currenty in use',
                })
                            }
                        }
                    });
                }
            });
        }
});
</script>
@endpush
