<div class="form-check">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="@error($name) is-invalid @enderror form-check-input form-check-primary"
            name="{{ $name }}" id="{{ $label }}" value="{{ $value }}" />
        <label class="form-check-label" for="{{ $label }}">{{ $label }}</label>
    </div>
</div>
