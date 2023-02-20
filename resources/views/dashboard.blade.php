<div>
    <x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="dashboard"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <x-navbars.navs.auth titlePage='Dashboard'></x-navbars.navs.auth>


            <div class="container-fluid px-2 px-md-4 py-4">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white mx-3">
                        <strong>
                            Dashboard
                        </strong>
                    </h6>
                </div>
            </div>
            {{-- <x-footers.auth></x-footers.auth> --}}

        </main>

    </x-layout>
</div>
