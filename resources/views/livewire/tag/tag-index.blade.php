<div>
    <x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="tag"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <x-navbars.navs.auth titlePage='Tags'></x-navbars.navs.auth>


            <div class="container-fluid px-2 px-md-4 py-4">
                <div class="card  my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white mx-3">
                                <strong>
                                    {{__('common.Tags')}}
                                </strong>
                            </h6>
                        </div>
                    </div>
                    <div class=" me-3 my-3 text-end">
                        <a class="btn bg-gradient-dark mb-0" wire:click="create()"><i
                                class="material-icons text-sm">add</i>&nbsp;&nbsp;
                                {{__("common.addNew" , ["name" => __('common.Tags')])}} </a>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="d-flex justify-content-end mb-3 ">
                            <div class="col-lg-3 col-md-6">
                                <div class="row ">
                                    <div class="input-group  col  align-self-center me-2 input-group-outline">
                                        <label class="my-auto me-2" for="basic-url"> {{__('common.search')}} :</label>
                                        <input type="text " class="form-control " type="text"
                                            wire:model.debounce.700ms="search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-sm text-center font-weight-bolder opacity-7">
                                            #
                                        </th>
                                        @foreach ($this->columns() as $column)
                                            @if ($column->sortable)
                                                <th wire:click="sortBy('{{ $column->key }}')">
                                                    <div
                                                        class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7  cursor-pointer">
                                                        {{ $column->label }}
                                                        @if ($sortBy === $column->key)
                                                            @if ($sortDirection === 'asc')
                                                                <span class="material-icons  font-weight-bolder"
                                                                    style="color:#FCE700">
                                                                    keyboard_double_arrow_up
                                                                </span>
                                                            @else
                                                                <span class="material-icons  font-weight-bolder"
                                                                    style="color:#FCE700">
                                                                    keyboard_double_arrow_down
                                                                </span>
                                                            @endif
                                                        @else
                                                            <span class="material-icons font-weight-bolder">
                                                                unfold_more
                                                            </span>
                                                        @endif
                                                    </div>
                                                </th>
                                            @else
                                                <th
                                                    class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ">
                                                    {{ $column->key }}
                                                </th>
                                            @endif

                                        @endforeach
                                        <th
                                            class="text-uppercase text-secondary text-sm text-center font-weight-bolder opacity-7">
                                            {{__("common.action")}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->data() as $key => $row)
                                        <tr>
                                            <td>
                                                <label class="text-xs text-secondary ps-2 mb-0">
                                                    {{ $this->data()->firstItem() + $key }}

                                                </label>
                                            </td>
                                            @foreach ($this->columns() as $column)
                                                <td class="align-left text-left text-sm">
                                                    <p class="text-xs text-secondary ps-2 mb-0">
                                                        <x-dynamic-component :component="$column->component" :value="$row[$column->key]">
                                                        </x-dynamic-component>
                                                    </p>
                                                </td>
                                            @endforeach
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-icon p-2 btn-info btn-link"
                                                    href="/tag/{{ $row->id }}">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a rel="tooltip" class="btn btn-icon p-2 btn-success btn-link"
                                                    href="/tag/{{ $row->id }}/edit">
                                                    <i class="material-icons">edit</i>
                                                </a>

                                                <button type="button"
                                                    class="btn p-2 btn-icon btn-danger dt-delete btn-link"
                                                    data-key="{{ $row->getKey() }}">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <div class="p-2"> {{ $this->data()->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
            <script>
                document.addEventListener('livewire:load', function() {
                    $('.dt-delete').click(function(event) {
                        Swal.fire({
                            icon: 'warning',
                            title: `{{__("common.delete" ,  ['name' => __("common.News")])}}`,
                            text: `{{__("common.areYouSure")}}`,
                            showDenyButton: true,
                            confirmButtonColor: '#d9534f',
                            denyButtonColor: '#5bc0de',
                            confirmButtonText: `{{__("common.yesDelete")}}`,
                            denyButtonText: ` <span class="text-light">{{__("common.noCancel")}}</span>`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let key = $(this).attr('data-key');
                                @this.deleteItem(key);

                            }
                        })
                    });

                })
                window.addEventListener('swal', function(e) {
                    Swal.fire(e.detail);
                });
            </script>
        </main>

    </x-layout>
</div>
