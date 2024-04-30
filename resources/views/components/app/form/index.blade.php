@props(['url', 'method', 'back'])
<form class="form form-horizontal" method="POST" action="{{ $url }}" {{ $attributes }}>
    @method($method)
    @csrf
    <div class="form-body">

        {{ $slot }}

        <div class="gap-2 mt-2 col-sm-12 d-flex justify-content-end">
            <button type="submit" class="mb-1 btn btn-sm btn-primary">Simpan
                Data</button>
            <a href="{{ $back }}" class="mb-1 btn btn-sm btn-light-secondary">Kembali</a>
        </div>
    </div>
</form>
