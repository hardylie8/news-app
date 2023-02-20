<x-app-layout>
    <x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
        </x-slot>
        <x-navbars.sidebar activePage=""></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md   bg-gray-200">
            <x-navbars.navs.auth titlePage='Tag/Create Tag'></x-navbars.navs.auth>
            <div class="">
                <div class="container-fluid px-2 px-md-4 py-4">
                    <div class="row">
                        <div class="col-12">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>


                    <div class="row my-3">
                        <div class="col-12">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </x-layout>
</x-app-layout>
