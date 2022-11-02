@php
    $routeData =   $data['routes'];
@endphp
<form action="{{route('inspector_print')}}"  method="POST" class="login-form" id="timetable_form_id">
    @csrf
<div class="form-group @error('route') has-danger @enderror">
    <label>Select Route</label>
    <select class="form-control select2" name="route">
        @foreach ($routeData as $route)
            <option value="{{$route->routeId}}">
                {{$route->routeNo.' '.$route->startPoint.'-'.$route->endpoint.' Route'}}
            </option>
        @endforeach
    </select>
    @error('route')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <button class="btn btn-primary mt-3" id="inspector_print_id" type="submit" hidden >Proceed</button>
</div>
</form>
