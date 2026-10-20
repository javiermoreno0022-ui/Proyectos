{{-- Semana 7 · Blade --}}
{{-- resources/views/comercios/show.blade.php --}}
@extends('layouts.app')

@section('titulo', $comercio->nombre_comercio)

@section('contenido')
    <p>
        <a href="{{ route('comercios.index') }}">
            &larr; Volver a comercios
        </a>
    </p>

    <h1>{{ $comercio->nombre_comercio }}</h1>

    <p>
        <a href="{{ route('transacciones.create', $comercio) }}">
            + Nueva transacción
        </a>
    </p>

    <p class="meta">
        Rubro: {{ $comercio->rubro }}
        &middot;
        Teléfono: {{ $comercio->telefono ?? 'Sin teléfono registrado' }}
    </p>

    {{-- Mensaje de éxito --}}
    @if (session('mensaje'))
        <p class="mensaje">
            {{ session('mensaje') }}
        </p>
    @endif

    <h2>Transacciones</h2>

    @forelse ($comercio->transacciones as $transaccion)
        <div class="card">
            <strong>
                ${{ number_format($transaccion->monto, 2) }}
            </strong>

            — {{ $transaccion->cliente_nombre }}

            <x-badge-estado :estado="$transaccion->estado" />

            <p>
                <a href="{{ route('transacciones.edit', $transaccion) }}">
                    Editar
                </a>
                
            </p>
            
            @if ($transaccion->estado === 'Iniciada')
    <form
        action="{{ route('transacciones.mover', [$transaccion, 'Completada']) }}"
        method="POST"
        style="display: inline"
    >
        @csrf
        @method('PATCH')
        <button type="submit">Marcar Completada</button>
    </form>

    <form
        action="{{ route('transacciones.mover', [$transaccion, 'Fallida']) }}"
        method="POST"
        style="display: inline"
    >
        @csrf
        @method('PATCH')
        <button type="submit">Marcar Fallida</button>
    </form>
        @endif

            <form
                action="{{ route('transacciones.destroy', $transaccion) }}"
                method="POST"
                onsubmit="return confirm('¿Estás seguro de eliminar esta transacción?');"
            >
                @csrf
                @method('DELETE')

                <button type="submit">Eliminar</button>
            </form>
        </div>
    @empty
        <p>Sin transacciones</p>
    @endforelse
@endsection