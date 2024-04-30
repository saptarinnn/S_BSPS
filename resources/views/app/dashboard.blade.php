<x-app-layout>
    <x-slot:title>Dashboard</x-slot>
    <x-slot:main_title>Dashboard</x-slot>

    <div class="mb-4 text-right fw-semibold">
        Tanggal : {{ date('d F Y') }}
    </div>

    @can('dashboard umum index')
        {{-- Booking --}}
        <div class="row">
            <div class="col-lg-3 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Booking New</h6>
                            <p class="text-info fw-bolder h5">{{ count($new) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Booking</small>
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-info">
                            <box-icon name='folder-plus' color="teal"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-3 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Booking Pending</h6>
                            <p class="text-primary fw-bolder h5">{{ count($pending) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Booking</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-primary">
                            <box-icon name='loader' color="blue"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-3 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Booking Success</h6>
                            <p class="text-success fw-bolder h5">{{ count($success) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Booking</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-success">
                            <box-icon name='check' color="green"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-3 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Booking Failed</h6>
                            <p class="text-danger fw-bolder h5">{{ count($failed) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Booking</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-danger">
                            <box-icon name='x' color="red"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
        </div>

        {{-- Report /Year --}}
        <div class="row">
            <div class="col-12 col-lg-8">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Report Order</h6>
                        <select name="report" id="report" class="form-select" style="width: 110px">
                            @for ($i = 2023; $i < 2023 + 2; $i++)
                                <option value="{{ $i }}" {{ date('Y') ? 'selected' : '' }}>{{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div style="min-width: 100%; margin: auto;">
                        <canvas id="barChart"></canvas>
                    </div>
                </x-app.card>
            </div>
            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <x-app.card>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-semibold">Total Sales</h6>
                                    <p class="text-primary fw-bolder h5">Rp
                                        <span>{{ \Illuminate\Support\Number::format($sales, locale: 'id') }}</span>
                                    </p>
                                </div>
                                <div
                                    class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-primary">
                                    <box-icon name='wallet' color="blue"></box-icon>
                                </div>
                            </div>
                        </x-app.card>
                    </div>
                    <div class="col-12">
                        <x-app.card>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-semibold">Total Order</h6>
                                    <p class="text-success fw-bolder h5">{{ $order }}</p>
                                </div>
                                <div
                                    class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-success">
                                    <box-icon name='shopping-bag' color="green"></box-icon>
                                </div>
                            </div>
                        </x-app.card>
                    </div>
                    <div class="col-12">
                        <x-app.card>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-semibold">Total Customer</h6>
                                    <p class="text-warning fw-bolder h5">{{ count($customer) }}</p>
                                </div>
                                <div
                                    class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-warning">
                                    <box-icon name='user' color="orange"></box-icon>
                                </div>
                            </div>
                        </x-app.card>
                    </div>
                    <div class="col-12">
                        <x-app.card>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-semibold">Total Sparepart</h6>
                                    <p class="text-danger fw-bolder h5">{{ count($sparepart) }}</p>
                                </div>
                                <div
                                    class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-danger">
                                    <box-icon name='box' color="red"></box-icon>
                                </div>
                            </div>
                        </x-app.card>
                    </div>
                </div>
            </div>
        </div>

        <x-slot:script>
            <script type="module">
                var ctx = document.getElementById('barChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            label: 'Total Order',
                            data: @json($dataorder),
                            backgroundColor: 'rgba(25,135,84, 0.2)',
                            borderColor: 'rgba(25,135,84, 1)',
                            borderWidth: 2,
                            borderRadius: 8,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </x-slot>
    @endcan

    @can('dashboard customer index')
        {{-- Booking --}}
        <div class="row">
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Booking New</h6>
                            <p class="text-info fw-bolder h5">{{ count($newBooking) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Booking</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-info">
                            <box-icon name='folder-plus' color="teal"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Booking Process</h6>
                            <p class="text-primary fw-bolder h5">{{ count($processBooking) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Booking</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-primary">
                            <box-icon name='loader' color="blue"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Booking Finish</h6>
                            <p class="text-success fw-bolder h5">{{ count($finishBooking) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Booking</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-success">
                            <box-icon name='check' color="green"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
        </div>

        {{-- Servis --}}
        <div class="row">
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Service New</h6>
                            <p class="text-info fw-bolder h5">{{ count($newServis) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Service</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-info">
                            <box-icon name='folder-plus' color="teal"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Service Process</h6>
                            <p class="text-primary fw-bolder h5">{{ count($processServis) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Service</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-primary">
                            <box-icon name='loader' color="blue"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Service Finish</h6>
                            <p class="text-success fw-bolder h5">{{ count($finishServis) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Service</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-success">
                            <box-icon name='check' color="green"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
        </div>
    @endcan

    @can('dashboard mekanik index')
        {{-- Servis --}}
        <div class="row">
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Service New</h6>
                            <p class="text-info fw-bolder h5">{{ count($serviceNew) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Service</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-info">
                            <box-icon name='folder-plus' color="teal"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Service Process</h6>
                            <p class="text-primary fw-bolder h5">{{ count($serviceProcess) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Service</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-primary">
                            <box-icon name='loader' color="blue"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
            <div class="col-lg-4 col-12">
                <x-app.card>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold">Service Finish</h6>
                            <p class="text-success fw-bolder h5">{{ count($serviceFinish) }}
                                <small class="fw-medium" style="font-size: 13px; color: #777">Service</small>
                            </p>
                        </div>
                        <div
                            class="p-3 rounded-full bg-opacity-10 d-flex justify-content-center align-items-center bg-success">
                            <box-icon name='check' color="green"></box-icon>
                        </div>
                    </div>
                </x-app.card>
            </div>
        </div>
    @endcan
</x-app-layout>
