@extends('layouts.app')

@section('titulo', 'Editar transacción')

@section('contenido')
    <p>
        <a href="{{ route('comercios.show', $transaccion->comercio_id) }}">
            &larr; Volver al comercio
        </a>
    </p>

    <h1>Editar transacción</h1>

    @if ($errors->any())
        <div class="mensaje">
            <p>Por favor, corrige los siguientes errores:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('transacciones.update', $transaccion) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div>
            <label for="comercio_id">Comercio</label>

            <select id="comercio_id" name="comercio_id" required>
                @foreach ($comercios as $comercio)
                    <option
                        value="{{ $comercio->id }}"
                        @selected(old('comercio_id', $transaccion->comercio_id) == $comercio->id)
                    >
                        {{ $comercio->nombre_comercio }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="cliente_nombre">Nombre del cliente</label>

            <input
                type="text"
                id="cliente_nombre"
                name="cliente_nombre"
                value="{{ old('cliente_nombre', $transaccion->cliente_nombre) }}"
                maxlength="255"
                required
            >
        </div>

        <div>
            <label for="monto">Monto</label>

            <input
                type="number"
                id="monto"
                name="monto"
                value="{{ old('monto', $transaccion->monto) }}"
                min="0.01"
                step="0.01"
                required
            >
        </div>

        <button type="submit">Guardar cambios</button>

        <a href="{{ route('comercios.show', $transaccion->comercio_id) }}">
            Cancelar
        </a>
    </form>
@endsection