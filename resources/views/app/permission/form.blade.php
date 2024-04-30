<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}" back="{{ $page_meta['back'] }}">
            <x-app.form.content required label="Nama Permission" name="name" value="{{ old('name', $data->name) }}" />

            <div class="mt-2 row">
                <div class="col-md-3">
                    <label>Pilih Route</label>
                </div>
                <div class="gap-4 mt-1 mt-md-0 col-md-9 form-group d-flex">
                    <x-app.form.checkbox name="listPermission[]" label="Index" value="index" />
                    <x-app.form.checkbox name="listPermission[]" label="Create" value="create" />
                    <x-app.form.checkbox name="listPermission[]" label="Update" value="update" />
                    <x-app.form.checkbox name="listPermission[]" label="Destroy" value="destroy" />
                </div>
            </div>
        </x-app.form>
    </x-app.card>


    <x-slot:script>
        @if (session('message'))
            <x-app.alert.success />
        @endif
        @if (session('error'))
            <x-app.alert.error />
        @endif
    </x-slot>
</x-app-layout>
