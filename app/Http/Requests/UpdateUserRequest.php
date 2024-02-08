<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        //access current logged in user, call "can" with User Model binding method
        // return $this->user()->can('update', $this->user);  === $this->authorize('update', $user);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:40',
            'bio' => 'nullable|min:1|max:255',
            'image' => 'image',
        ];
    }
}
