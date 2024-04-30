@props(['name', 'label', 'content' => 'input', 'type' => 'text', 'value' => '', 'desc' => ''])

<div class="mt-2 row">
    <div class="col-md-3">
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
    <div class="mt-1 mt-md-0 col-md-9 form-group">
        @if ($content == 'input')
            <input type="{{ $type }}" id="{{ $name }}"
                class="@error($name) is-invalid @enderror form-control text-sm" name="{{ $name }}"
                placeholder="Masukkan {{ $label }}" value="{{ $value }}" {{ $attributes }}>
        @endif

        @if ($content == 'textarea')
            <textarea name="{{ $name }}" id="{{ $name }}"
                class="@error($name) is-invalid @enderror form-control text-sm" rows="5" {{ $attributes }}>{{ $value }}</textarea>
            <span style="color: #b3b3b3; font-size: 12px; font-weight: 500;">{{ $desc }}</span>
        @endif

        @if ($content == 'select')
            <select name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
                class="@error($name) is-invalid @enderror form-select text-sm">
                {{ $slot }}
            </select>
        @endif

        @error($name)
            <span class="mt-1 text-sm ms-1 text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
