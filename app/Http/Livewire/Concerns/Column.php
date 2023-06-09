<?php

namespace App\Http\Livewire\Concerns;

class Column
{
    public bool $sortable = true;

    public string $component = 'cms.column';

    public string $key;

    public string $label;

    public function __construct($key, $label)
    {
        $this->sortable = true;
        $this->key = $key;
        $this->label = $label;
    }

    public static function make($key, $label)
    {
        return new static($key, $label);
    }

    public function component($component)
    {
        $this->component = $component;
        return $this;
    }

    public function notSortable()
    {
        $this->sortable = false;
        return $this;
    }
}
