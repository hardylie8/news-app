<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;
use App\Http\Livewire\Concerns\DeleteRecord;
use App\Http\Livewire\Concerns\SwalTrigger;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

abstract class TagForm extends Component
{

    use SwalTrigger, DeleteRecord;

    public Tag $tag;

    public $published = false;

    protected $rules = [
        'tag.title' => 'required|string|min:6',
    ];

    public function render()
    {
        return view('livewire.tag.show-tag');
    }

    public function backToIndex()
    {
        return  redirect()->to(route('web.tag.index'));
    }

    public function save()
    {
        $this->validate();

        $this->tag->save();


        $this->DispactchSwal(
            'swal',
            [
                'title' => 'success',
                'text' => 'Items has been succesfully updated',
                'icon' => 'success'
            ]
        );

        $this->backToIndex();
    }

    /**
     * Get a new query builder instance for the current datatable component.
     * You may include the model's relationships if it's necessary.
     *
     * @return Builder
     */
    protected function newQuery(): builder
    {
        return (new Tag())->newQuery();
    }

    /**
     * Redirect to the edit faq page.
     *
     * @return mixed
     */
    public function edit()
    {
        return redirect()->to(
            route('web.tag.edit', ['tag' => $this->tag])
        );
    }
}
