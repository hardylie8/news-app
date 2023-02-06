<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;

class CommentSaveRequest extends FormRequest
{
    /**
     * Determine if the current user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
        //        return (auth()->guard('api')->check() || auth()->guard('cms-api')->check());
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $user_id = 1;
        $object = $this->route('comment');
        if ($object instanceof Comment)
            $this->merge([
                'news_id'   => (int) $object->news_id,
            ]);
        $this->merge([
            'users_id'   => (int) $user_id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'news_id' => 'required|integer|exists:news,id',
            'users_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|min:2|max:255',
        ];
    }
}
