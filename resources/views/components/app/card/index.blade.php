<div class="card">
    @isset($header)
        <div class="card-header d-flex justify-content-end">
            {{ $header }}
        </div>
    @endisset

    <div class="card-body">
        {{ $slot }}
    </div>
</div>
