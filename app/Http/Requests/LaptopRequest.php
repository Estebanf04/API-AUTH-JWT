<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaptopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:200|unique:laptops,name',
            'description' => 'string|min:10',
            'price' => 'integer',
            'stock' => 'integer'
        ];
    }
}
