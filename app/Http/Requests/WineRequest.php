<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WineRequest extends FormRequest
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
        $imageRules = 'sometimes|image|mimes:jpeg,jpg,png|max:2048';
        if ($this->isMethod('post')) {
            $imageRules = 'required|image|mimes:jpeg,jpg,png|max:2048';
        }

        return [
            // 'name' => 'required|string|max:255',
            'name' => ['required', 'string', 'max:255', Rule::unique('wines')->ignore($this->route('wine'))],
            'description' => 'required|string|max:2000',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:' . now()->subYears(500)->year . '|max:' . now()->year,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => $imageRules,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El NOMBRE es requerido',
            'name.string' => 'El NOMBRE debe ser una cadena de texto',
            'name.max' => 'El NOMBRE no puede exceder de los :max caracteres',
            'name.unique' => 'El NOMBRE debe ser único',

            'description.required' => 'La DESCRIPCIÓN es requerida',
            'description.string' => 'La DESCRIPCIÓN debe ser una cadena de texto',
            'description.max' => 'La DESCRIPCIÓN no puede exceder de los :max caracteres',

            'category_id.required' => 'La CATEGORÍA es requerida',
            'category_id.exists' => 'La CATEGORÍA elegida no existe',

            'year.required' => 'El AÑO es requerido',
            'year.integer' => 'El AÑO debe ser un número entero',
            'year.min' => 'El AÑO indicado no puede ser menor a :min',
            'year.max' => 'El AÑO indicado no puede ser mayor de :max',

            'price.required' => 'El PRECIO es requerido',
            'price.numeric' => 'El PRECIO debe ser un número',
            'price.min' => 'El PRECIO no puede tener un valor negativo',

            'stock.required' => 'El STOCK es requerido',
            'stock.integer' => 'El STOCK debe ser un número entero',
            'stock.min' => 'El STOCK no puede tener un valor negativo',

            'image.required' => 'El ARCHIVO de imagen es obligatorio',
            'image.image' => 'El ARCHIVO a subir debe ser una imagen',
            'image.mimes' => 'La IMAGEN debe ser de entre uno de estos tipos: jpeg, jpg o png',
            'image.max' => 'La IMAGEN no puede exceder de los :max kilobytes',
        ];
    }
}
