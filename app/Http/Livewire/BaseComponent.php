<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

abstract class BaseComponent extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $page = 1;

    public $sortBy = '';

    public $sortDirection = 'asc';

    public $search = '';

    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function columns(): array;

    public abstract function searchColumn(): string;

    public function data()
    {
        $query = $this
            ->query()
            ->when($this->sortBy !== '', function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            });
        if ($this->search !== '') {
            $query =   $query->where($this->searchColumn(), 'like', '%' . $this->search . '%');
        }
        $query =  $query->paginate($this->perPage);
        return $query;
    }


    public function deleteItem($key)
    {
        $item = $this->query()->find($key);
        $item->delete();
    }


    /**
     * Update the datatable sorting behavior.
     *
     * @param string $column
     */
    public function sortBy(string $column): void
    {
        if ($this->sortBy !== $column) {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';

            $this->resetPage();

            return;
        }

        $this->sortDirection = ($this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->resetPage();
    }
}
