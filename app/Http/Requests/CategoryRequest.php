<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($this->route('category'))],
            'description' => 'required|string|max:2000',
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

            'image.required' => 'El ARCHIVO de imagen es obligatorio',
            'image.image' => 'El ARCHIVO a subir debe ser una imagen',
            'image.mimes' => 'La IMAGEN debe ser de entre uno de estos tipos: jpeg, jpg o png',
            'image.max' => 'La IMAGEN no puede exceder de los :max kilobytes',
        ];
    }
}
