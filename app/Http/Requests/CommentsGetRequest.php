<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'integer|min:1',
            'news_id' => 'integer|min:1',
            'users_id' => 'integer|min:1',
            // 'news_id' => 'integer|exists:news,id',
            // 'users_id' => 'integer|exists:users,id',
            'filter.title' => 'string|min:2|max:255',
            'name' => 'string|min:2|max:255',
            'title' => 'string|min:2|max:255',
            'page.number' => 'integer|min:1',
            'page.size' => 'integer|between:1,100',
            'search' => 'nullable|string|min:3|max:60',
        ];
    }
}
