<?php

namespace App\Http\Livewire\Concerns;

use Illuminate\Database\Eloquent\Model;

trait DeleteRecord
{
    /**
     * Delete a specific record identified by the given key.
     *
     * @throws \Exception
     * @return mixed
     */
    public function delete(string $key)
    {
        $row = $this->newQuery()->find($key);

        if ($row instanceof Model) {
            $row->delete();
        }
        $this->DispactchSwal(
            'swal',
            [
                'title' => 'success',
                'text' => 'Items has been succesfully Deleted',
                'icon' => 'success'
            ]
        );
        return $this->backToIndex();
    }
}
