<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>
        <x-app.form url="{{ $page_meta['url'] }}" method="{{ $page_meta['method'] }}" back="{{ $page_meta['back'] }}">
            <x-app.form.content label="Nama Role" name="name" value="{{ old('name', $data->name) }}" />

            <div class="row">
                <div class="mb-4">
                    <label class="form-label mb-1">Permission</label>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="check-all" id="check-all" />
                                <label class="form-check-label" for="check-all">
                                    all-permission
                                </label>
                            </div>
                        </div>

                        @if ($page_meta['method'] == 'post')
                            @foreach ($permissions as $permission)
                                <div class="col-3">
                                    <div class="form-check mt-2">
                                        <input class="@error('permission') is-invalid @enderror form-check-input"
                                            name="permission[]" type="checkbox" value="{{ $permission->id }}"
                                            id="{{ $permission->id }}" />
                                        <label class="form-check-label" for="{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        @elseif ($page_meta['method'] == 'put')
                            @foreach ($permissions as $i => $permission)
                                <div class="col-3">
                                    <div class="form-check mt-2">
                                        <input class="@error('permission') is-invalid @enderror form-check-input"
                                            name="permission[]" type="checkbox" value="{{ $permission['id'] }}"
                                            id="{{ $permission['id'] }}"
                                            {{ in_array($permission['name'], $role_name) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="{{ $permission['id'] }}">
                                            {{ $permission['name'] }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @error('permission')
                            <div class="small mt-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </x-app.form>
    </x-app.card>


    <x-slot:script>
        <script type="module">
            $(document).ready(function() {

                let permissions = document.getElementsByName('permission[]');
                $('#check-all[type="checkbox"]').click(function() {
                    if (!$(this).prop("checked")) {
                        for (var i = 0; i < permissions.length; i++) {
                            if (permissions[i].type == 'checkbox')
                                permissions[i].checked = false;
                        }
                    } else if ($(this).prop("checked")) {
                        for (var i = 0; i < permissions.length; i++) {
                            if (permissions[i].type == 'checkbox')
                                permissions[i].checked = true;
                        }
                    }
                });
            });
        </script>
    </x-slot>

</x-app-layout>
