@props(['type'])

@if ($type == 'create')
    <a {{ $attributes }} class="btn btn-sm btn-primary">Tambah Data</a>
@endif

@if ($type == 'show')
    <a {{ $attributes }} class="py-0 pt-1 mx-1 btn btn-info btn-sm">
        <box-icon type='solid' style="width: 16px" color='white' name='info-circle'></box-icon>
    </a>
@endif

@if ($type == 'edit')
    <a {{ $attributes }} class="py-0 pt-1 mx-1 btn btn-warning btn-sm">
        <box-icon type='solid' style="width: 16px" color='white' name='edit'></box-icon>
    </a>
@endif

@if ($type == 'delete')
    <form method="POST" {{ $attributes }} class="d-inline">
        @method('DELETE')
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="py-0 pt-1 mx-1 btn btn-danger btn-sm btn-delete">
            <box-icon type='solid' style="width: 16px" color='white' name='trash'></box-icon>
        </button>
    </form>
@endif

@if ($type == 'accepted')
    <a {{ $attributes }} class="py-0 pt-1 mx-1 btn btn-success btn-sm">
        <box-icon style="width: 16px" color='white' name='check'></box-icon>
    </a>
@endif

@if ($type == 'rejected')
    <form method="POST" {{ $attributes }} class="d-inline">
        @method('DELETE')
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="py-0 pt-1 mx-1 btn btn-danger btn-sm btn-rejected">
            <box-icon style="width: 16px" color='white' name='x'></box-icon>
        </button>
    </form>
@endif

@if ($type == 'acc')
    <form method="POST" {{ $attributes }} class="d-inline">
        @method('PUT')
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <button type="submit" class="py-0 pt-1 mx-1 btn btn-success btn-sm btn-acc">
            <box-icon style="width: 16px" color='white' name='check'></box-icon>
        </button>
    </form>
@endif

@if ($type == 'finish')
    <form method="POST" {{ $attributes }} class="d-inline">
        @method('PUT')
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <button type="submit" class="py-0 pt-1 mx-1 btn btn-success btn-sm btn-finish">
            <box-icon style="width: 16px" color='white' name='check'></box-icon>
        </button>
    </form>
@endif
