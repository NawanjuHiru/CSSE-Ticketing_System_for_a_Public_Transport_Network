@php
    $from = date("m/d/Y", strtotime(date("d-m-Y", strtotime(date("d-m-Y"))) . "-1 month"));
@endphp


<form action="{{route('passenger_print')}}"  method="POST" class="login-form" id="passenger_form_id">
@csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group @error('from') has-danger @enderror">
                <label>From</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input class="form-control fc-datepicker" onkeydown="false" name="from" value="{{$from}}" id="dateFrom" type="text">
                </div>
                @error('from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group @error('to') has-danger @enderror">
                <label>To</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                        </div>
                    </div>
                    <input class="form-control fc-datepicker" onkeydown="false" name="to" value="{{date('m/d/Y')}}" id="dateTo" type="text">
                </div>
                @error('to')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button class="" id="passenger_print_id" type="submit" hidden>Proceed</button>
    </div>
</form>

