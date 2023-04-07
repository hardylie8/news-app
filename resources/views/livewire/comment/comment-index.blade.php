<div>
    <br>
    <div class="card  my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                <h6 class="text-white mx-3">
                    <strong>
                        Comment
                    </strong>
                </h6>
            </div>
        </div>

        <div class="card-body px-3 pb-2">
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-sm text-center font-weight-bolder opacity-7">
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
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ">
                                        {{ $column->key }}
                                    </th>
                                @endif

                            @endforeach
                            <th class="text-uppercase text-secondary text-sm text-center font-weight-bolder opacity-7">
                                Action
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
                                        href="/news/{{ $row->id }}" data-original-title="" title="">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    <a rel="tooltip" class="btn btn-icon p-2 btn-success btn-link"
                                        href="/news/{{ $row->id }}/edit" data-original-title="" title="">
                                        <i class="material-icons">edit</i>
                                    </a>

                                    <button type="button" class="btn p-2 btn-icon btn-danger dt-delete btn-link"
                                        data-original-title="" data-key="{{ $row->getKey() }}" title="">
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
