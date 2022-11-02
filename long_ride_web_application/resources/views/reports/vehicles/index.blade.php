@php
    $modes = [
        'all',
        'bus',
        'train'
    ];
@endphp
<form action="{{route('vehicle_print')}}"  method="POST" class="login-form" id="vehicle_form_id">
    @csrf
<div class="form-group @error('mode') has-danger @enderror">
    <label>Select Mode</label>
    <select class="form-control select2" name="mode">
        @foreach ($modes as $mode)
            <option value="{{$mode}}">
                {{$mode}}
            </option>
        @endforeach
    </select>
    @error('mode')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <button class="btn btn-primary mt-3" id="vehicle_print_id" type="submit" hidden >Proceed</button>
</div>
</form>
