@push('styles')
<style>
    .nav-tabs .nav-link.active {
        border-color: #279346;
        background-color: #279346;
        color: #fff;
    }
    .nav-tabs{
        border-bottom: 2px solid #279346;
    }
</style>
@endpush
@php
    $head['os_group'] = '';
    $head['os_name'] = '';
    $head['description'] = '';
@endphp


<ul class="nav nav-tabs pt-4 mb-4" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{$active == '' ? 'active' : ''}}" id="all-tab"
            href="{{route('passenger_index',['type' => ''])}}" role="tab" aria-controls="all"
            aria-selected="true">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$active == 'Local' ? 'active' : ''}}" id="local-tab"
        href="{{route('passenger_index',['type' => 'Local'])}}" role="tab" aria-controls="Local"
            aria-selected="false">Local</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{$active == 'Foreign' ? 'active' : ''}}" id="foreign-tab"
        href="{{route('passenger_index',['type' => 'Foreign'])}}" role="tab" aria-controls="Foreign"
            aria-selected="false">Foreign</a>
    </li>
</ul>

@push('scripts')
<script>
</script>

@endpush
