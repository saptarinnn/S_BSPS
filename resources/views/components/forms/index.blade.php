@props(['file' => false])

<form {{ $attributes }} method="POST" @if ($file) enctype="multipart/form-data" @endif>
    @csrf
    {{ $slot }}
</form>
