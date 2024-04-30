<x-app-layout>
    <x-slot:title>{{ $page_meta['title'] }}</x-slot>
    <x-slot:main_title>{{ $page_meta['title'] }}</x-slot>

    <x-app.card>

        <h6 class="card-title fw-semibold mb-4">{{ ucwords($data->name) }} | List Permission</h6>
        <div class="row">
            @forelse ($data->getAllPermissions() as $data)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <ul>
                        <li><strong class="text-primary">*</strong> {{ ucwords($data->name) }}</li>
                    </ul>
                </div>
            @empty
                <div class="col-12">
                    <span class="text-center">Tidak terdapat <i>Permission</i> pada Role {{ $data->name }}</span>
                </div>
            @endforelse
        </div>

    </x-app.card>

</x-app-layout>
