<div>
    <br>
    <div class="card  my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                <h6 class="text-white mx-3">
                    <strong>
                        {{__('common.Comment')}}
                    </strong>
                </h6>
            </div>
        </div>

        <div class="card-body px-3 pb-2">
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
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
                                        {{ $column->label }}
                                    </th>
                                @endif

                            @endforeach

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($this->data() as $key => $row)
                            <tr>
                                <td>
                                    <label class="text-xs text-secondary ps-2">
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
