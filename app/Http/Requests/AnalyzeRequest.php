<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalyzeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => 'required|url',
            'categories' => 'required|array|min:1', 
            'strategy' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => 'El campo URL es obligatorio.',
            'url.url' => 'Debes ingresar una URL válida.',
            'categories.required' => 'Debes seleccionar al menos una categoría.',
            'categories.min' => 'Debes seleccionar al menos una categoría.',
            'strategy.required' => 'El campo estrategia es obligatorio.',
        ];
    }
}
