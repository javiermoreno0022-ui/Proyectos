<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\EstadoTransaccion;

class UpdateTransaccionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
    return [
        'estado' => [
            'required',
            Rule::enum(EstadoTransaccion::class),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'estado.required' => 'Debes indicar el nuevo estado.',
            'estado.enum' => 'El estado seleccionado no es valido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'estado' => 'estado',
        ];
    }
}
