<x-app-layout>
    <x-slot:title>Profil</x-slot>
    <x-slot:main_title>Profil</x-slot>

    <div class="container mx-auto">
        <div class="card">
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- @include('profile.partials.delete-user-form') --}}
    </div>
</x-app-layout>
