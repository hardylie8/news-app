<div>
    <x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="tag"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
            <x-navbars.navs.auth pageType="add" titlePage='Tags'></x-navbars.navs.auth>
            <div class="container-fluid px-2 px-md-4 py-4">
                <div class="card  my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                            <h6 class="text-white mx-3">
                                <strong>
                                 {{__("common.Tags")}}
                                </strong>
                            </h6>
                        </div>
                    </div>
                    <div class=" mx-3 my-3 row">
                        <div class="col text-start">
                            <a class="btn bg-gradient-info mb-0" wire:click="backToIndex()"><i
                                    class="material-icons text-sm">keyboard_backspace</i>
                            </a>
                        </div>

                    </div>
                    <div class="card-body px-3 pb-2">
                        {{-- <div class="row my-3">
                            <div class="col-3">
                                <label class="text-md">id</label>
                            </div>
                            <div class="col-9">
                                <div class="input-group   input-group-outline ">
                                    <input type="number" class="form-control " placeholder="{{ $tag->id }}"
                                        disabled>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row my-3">
                            <div class="col-3">
                                <label class="text-md">                                 
                                    {{__("common.Title")}}
                                </label>
                            </div>
                            <div class="col-9">
                                <div class="input-group   input-group-outline ">
                                    <input type="text" class="form-control " wire:model="tag.title">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-9">
                                <button type="button" class="btn btn-primary" wire:click="save()">
                                    {{__("common.save")}}

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>

        </main>

    </x-layout>

    @push('scripts')
        <script>
            window.addEventListener('swal', function(e) {
                Swal.fire(e.detail);
            });
        </script>
    @endpush
</div>
