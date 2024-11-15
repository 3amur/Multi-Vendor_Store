@if(session()->has($type))
<div class="text-center alert alert-{{ $message }}">
    <strong>{{ session($type) }}</strong>
</div>
@endif