@props(['labels' => true, 'label', 'name', 'type' => 'text', 'value' => ''])

<div>
    @if ($labels)
        <label for="{{ $name }}" class="block mb-2 text-sm font-semibold text-dark/70">{{ $label }}</label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
        class="py-3 px-4 block w-full border-gray-300 font-medium rounded-lg text-sm focus:border-primary focus:ring-primary placeholder:font-medium placeholder:text-dark/60 @error($name) border-primary @enderror"
        value="{{ old($name, $value) }}" {{ $attributes }} />

    @error($name)
        <span class="mt-1 text-xs font-medium text-red-500">{{ $message }}</span>
    @enderror
</div>
