<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route('id');

        return [
            'title' => 'required|min:3|unique:posts,title' . ($postId ? ",$postId" : ''),//required to ensure the title is provided, min:3 to ensure it's at least 3 characters, unique:posts,title to ensure it's unique in the posts table, and if $postId is present (for update), it will ignore the current post's title for uniqueness check
            'content' => 'required|min:10',
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.unique' => 'The title must be unique.',
            'title.min' => 'The title must be at least 3 characters.',
            'content.required' => 'The content field is required.',
            'content.min' => 'The content must be at least 10 characters.',
            'user_id.required' => 'The user field is required.',
            'user_id.exists' => 'The selected user is invalid.',
        ];
    }
}
