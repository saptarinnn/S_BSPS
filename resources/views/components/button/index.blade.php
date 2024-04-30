@props(['type' => 'submit'])

<button type="{{ $type }}"
    class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-semibold text-white transition duration-150 border border-transparent rounded-lg bg-primary gap-x-2 hover:bg-primary/90">
    {{ $slot }}
</button>
