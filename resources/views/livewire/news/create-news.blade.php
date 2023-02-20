<div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="news"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
            <x-navbars.navs.auth titlePage='News/Show News'></x-navbars.navs.auth>
            <div class="container-fluid px-2 px-md-4 py-4">
                <div class="card  my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                            <h6 class="text-white mx-3">
                                <strong>
                                    News
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
                    <form wire:submit.prevent="submit">
                        <div class="card-body px-3 pb-2">
                            <div class="row my-3">
                                <div class="col-3">
                                    <label class="text-md">Title</label>
                                </div>
                                <div class="col-9">
                                    <div class="input-group   input-group-outline ">
                                        <input type="text" class="form-control " wire:model="news.title">
                                    </div>
                                    @error('news.title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-3">
                                    <label class="text-md">News</label>
                                </div>
                                <div class="col-9">
                                    <livewire:concerns.trix :value="''">
                                        @error('news.news')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-3">
                                    <label class="text-md">Tags</label>
                                </div>
                                <div class="col-9">
                                    <div wire:ignore>
                                        <select class="form-control" id="select2-dropdown" multiple>
                                            <option value="">Select Option</option>

                                            @foreach ($this->tags as $key => $item)
                                                <option value="{{ $key }}">
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @error('tagsValues')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-3">
                                    <label class="text-md">Publish Status</label>
                                </div>
                                <div class="col-9">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" wire:model="published">
                                        @error('published')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <button type="button" class="btn btn-primary" wire:click="save()">
                                        save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <x-footers.auth></x-footers.auth>

        </main>

    </x-layout>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#select2-dropdown').select2();

                $('#select2-dropdown').on('change', function(e) {
                    var data = $('#select2-dropdown').select2("val");
                    @this.set('tagsValues', data);
                });
            });


            window.addEventListener('swal', function(e) {
                Swal.fire(e.detail);
            });

            document.addEventListener('livewire:load', function() {
                $('.dt-delete').click(function(event) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Delete',
                        text: 'are you sure you want to delete this item ??',
                        showDenyButton: true,
                        confirmButtonColor: '#d9534f',
                        denyButtonColor: '#5bc0de',
                        confirmButtonText: 'Yes, delete it!',
                        denyButtonText: ` <span class="text-light">No, Cancel.</span>`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let key = $(this).attr('data-key');
                            @this.delete(key);

                        }
                    })
                });
            })
        </script>
    @endpush
</div>
