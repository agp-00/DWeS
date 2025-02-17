<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpaceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comment' => 'required|string',
            'status' => 'required|string',
            'score' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'space_id' => 'required|exists:spaces,id',
            'images' => 'nullable|array',
            'images.*.url' => 'required_with:images|url'
        ];
    }
}
