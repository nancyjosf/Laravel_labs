<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        return [
            'title' => 'required|unique:posts,title,' . $this->route('id') . '|min:3',
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
