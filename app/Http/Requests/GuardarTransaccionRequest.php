<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarTransaccionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comercio_id' => [
            'required',
            Rule::exists('comercios', 'id')
            ->where('user_id', $this->user()->id),
            ],

            'cliente_nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'monto' => [
            'required',
            'numeric',
            'decimal:0,2',
            'min:0.01',
            'max:99999999.99'
            ],
            
            'estado' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'comercio_id.required' => 'Debes seleccionar un comercio.',
            'comercio_id.exists' => 'El comercio seleccionado no es válido.',

            'cliente_nombre.required' => 'Debes indicar el nombre del cliente.',
            'cliente_nombre.string' => 'El nombre del cliente debe ser texto.',
            'cliente_nombre.max' => 'El nombre del cliente no debe superar los 255 caracteres.',

            'monto.required' => 'Debes indicar un monto.',
            'monto.numeric' => 'El monto debe ser un número.',
            'monto.min' => 'El monto debe ser mayor a cero.',

            'monto.max' => 'El monto no puede superar 99,999,999.99.',
            'monto.decimal' => 'El monto admite como máximo dos decimales.',
            'estado.prohibited' => 'El estado no se envía al crear: toda transacción nace Iniciada.',
        ];
    }

    public function attributes(): array
    {
        return [
            'cliente_nombre' => 'nombre del cliente',
            'monto' => 'monto de la transacción',
            'comercio_id' => 'comercio',
        ];
    }
}

