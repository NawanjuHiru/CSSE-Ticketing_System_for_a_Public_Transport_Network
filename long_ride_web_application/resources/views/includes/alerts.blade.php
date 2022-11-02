@if (session('success_message'))
<div class="alert alert-solid-success" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
    <span aria-hidden="true">&times;</span></button>
    {{session('success_message')}}
</div>
@endif
@if (session('error_message'))
<div class="alert alert-solid-danger mg-b-0" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
    <span aria-hidden="true">&times;</span></button>
    {{session('error_message')}}
</div>
@endif
