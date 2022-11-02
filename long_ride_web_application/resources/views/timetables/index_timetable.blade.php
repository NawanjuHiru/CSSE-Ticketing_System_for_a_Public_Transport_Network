@extends('layouts.default')

@push('styles')

@endpush

@php

$routeId = $data['routeId'];
$routeData =   $data['routeData'];

@endphp

@section('title','Route')
@section('sub_title','Time Table / '.$routeData->routeNo.' '.$routeData->startPoint.'-'.$routeData->endpoint.' Route')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                    <h6 class="card-title mb-1">Search Time Tabels</h6>
                    <form  method="POST" class="login-form" id="form_id">
                        @csrf
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group @error('day') has-danger @enderror">
                                <label class="">Day</label>
                                <select class="form-control select2" name="day" id="day">
                                    <option value="" label="Select Day">
                                       Select Day
                                    </option>
                                    <option value="Monday" label="Monday" @if(!empty(old('day') && old('day') == 'Monday')) selected @endif>
                                        Monday
                                     </option>
                                     <option value="Tuesday" label="Tuesday" @if(!empty(old('day') && old('day') == 'Tuesday')) selected @endif>
                                         Tuesday
                                     </option>
                                     <option value="Wednesday" label="Wednesday" @if(!empty(old('day') && old('day') == 'Wednesday')) selected @endif>
                                         Wednesday
                                     </option>
                                     <option value="Thursday" label="Thursday" @if(!empty(old('day') && old('day') == 'Thursday')) selected @endif>
                                         Thursday
                                     </option>
                                     <option value="Friday" label="Friday" @if(!empty(old('day') && old('day') == 'Friday')) selected @endif>
                                         Friday
                                     </option>
                                     <option value="Saturday" label="Saturday" @if(!empty(old('day') && old('day') == 'Saturday')) selected @endif>
                                         Saturday
                                     </option>
                                     <option value="Sunday" label="Sunday" @if(!empty(old('day') && old('day') == 'Sunday')) selected @endif>
                                         Sunday
                                     </option>
                                </select>
                                @error('day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                                <div>
                                    <label>&nbsp;</label>
                                </div>
                            </div>
                    </div><br/>
                    <div class="row card-footer">
                        <div class="col-md-6 text-left">
                            <div class="form-group col-md-12">
                                <button type="submit" id="search" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="form-group col-md-12">
                                <a href="{{route('timetable_view',['id' => $routeId])}}" type="button" class="btn btn-secondary text-white">View Timetable</a>
                                <a href="{{route('create_timeTable_view',['id' => $routeId])}}" type="button" id="add" class="btn btn-success">Add Time Table</a>
                            </div>
                        </div>
                    </div>
                </form>
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
                            <th scope="col">#</th>
                            <th scope="col">Departure Time</th>
                            <th scope="col">Arrival Time</th>
                            <th scope="col">Vehicle Number</th>
                            <th scope="col">Day</th>
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
            filter: false,
            order:false,
            responsive: true,
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
            columns: [
                {
                    data: 'timetableId',
                    name: 'timetableId'
                },{
                    data: 'depaturetime',
                    name: 'depaturetime'
                },
                {
                    data: 'arrivaltime',
                    name: 'arrivaltime'
                },
                {
                    data: 'vehicleId',
                    name: 'vehicleId'
                },
                {
                    data: 'day',
                    name: 'day'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $('#search').click(function (e) {
            e.preventDefault();
            category_table.ajax.reload();
            $('.select2').css('width','100%');
         })

         $(document).on('click','.delete',function (e) {
            e.preventDefault();
            var timetableid = $(this).closest("a").data('timetableid');
            console.log("Time Table Id : "+ timetableid)
             var res = deleteTimeTable(timetableid);
        });

        function deleteTimeTable(timetableid){

            let url = "{{ route('timeTable_delete', ':id') }}";
            url = url.replace(':id', timetableid);

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
                        data: {'_token':'{{csrf_token()}}','id':timetableid},
                        success: function (response) {
                            if(response.success == 1){
                                $('*[data-timetableid="' + timetableid + '"]').closest("tr").remove();
                                Swal.fire(
                                'Deleted!',
                                'Record has been deleted successfully.',
                                'success'
                                );
                            } else if(response.success == 2){
                            Swal.fire({
                            icon: 'warning',
                            title: 'Delete Fail',
                            text: 'This workout plan is currenty in use',
                            }) }else if(response.success == 0){
                            Swal.fire({
                            icon: 'warning',
                            title: 'Delete Fail',
                            text: 'Something Went Wrong',
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
