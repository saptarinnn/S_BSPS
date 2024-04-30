<header
    class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 sm:py-4 lg:ps-64">
    <nav class="flex items-center w-full px-4 mx-auto basis-full sm:px-6 md:px-8">
        <div class="me-5 lg:me-0 lg:hidden">
            <a class="flex-none text-xl font-extrabold text-primary" href="#" aria-label="Brand">BSPS<span
                    class="text-lg font-bold text-secondary">Mobil</span></a>
        </div>

        <div class="flex items-center justify-end w-full ms-auto sm:gap-x-3 sm:order-3">
            <div class="flex flex-row items-center justify-end gap-2">
                <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                    <button id="hs-dropdown-with-header" type="button"
                        class="inline-flex items-center justify-center text-sm font-medium text-dark/70">
                        <span>{{ ucwords(auth()->user()->nama) }}</span>
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2"
                        aria-labelledby="hs-dropdown-with-header">
                        <div class="px-5 py-3 -m-2 bg-gray-100 rounded-t-lg">
                            <p class="text-sm text-gray-500">Signed in as</p>
                            <p class="text-sm font-medium text-gray-800">
                                {{ auth()->user()->username }}</p>
                        </div>
                        <div class="py-2 mt-2 first:pt-0 last:pb-0">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-primary"
                                href="#">
                                Profile
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-primary hover:bg-gray-100 focus:ring-2 focus:ring-primary"
                                href="#">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
