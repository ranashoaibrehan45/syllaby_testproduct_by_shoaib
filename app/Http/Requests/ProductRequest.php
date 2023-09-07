<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch (request()->method()) {
            case 'POST':
                return [
                    'name' => ['required', 'string', 'max:255', 'unique:products,name'],
                    'photo' => ['required', 'image'],
                    'description' => ['required', 'max:500']
                ];
                break;
            case 'PUT':
            case 'PATCH':
                    return [
                        // ignote the current product name while update
                        'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($this->product->id)],
                        // photo is nullable while update
                        'photo' => ['nullable', 'image'],
                        'description' => ['required', 'max:500'],
                    ];
                    break;
        }
    }
}
