<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Alert;
use App\Http\Livewire\Concerns\DeleteRecord;
use App\Http\Livewire\Concerns\SwalTrigger;
use Illuminate\Database\Eloquent\Builder;

abstract class NewsForm extends Component
{
    public News $news;
    use SwalTrigger, DeleteRecord;
    public $published = false;
    protected $rules = [
        'news.title' => 'required|string|min:6',
        'news.news' => 'required|string|max:500',
        'published' => 'required|bool',
        'tagsValues.*' => 'exists:tags,id'
    ];


    public function render()
    {
        return view('livewire.news.show-news');
    }
    public function backToIndex()
    {
        return  redirect()->to(route('web.news.index'));
    }

    public function save()
    {
        $this->validate();
        $this->news->published_at = $this->published ? now() : null;
        $this->news->save();

        $this->news->tags()->sync($this->tagsValues);

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
        return (new News())->newQuery();
    }

    /**
     * Redirect to the edit faq page.
     *
     * @return mixed
     */
    public function edit()
    {
        return redirect()->to(
            route('web.news.edit', ['news' => $this->news])
        );
    }
}
