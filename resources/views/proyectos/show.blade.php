@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Proyecto: {{ $proyecto->Nombre_Proyecto }}</h1>
    
    <p><strong>Descripción:</strong> {{ $proyecto->Descripcion }}</p>
    <p><strong>Fecha de Inicio:</strong> {{ $proyecto->Fecha_Inicio }}</p>
    <p><strong>Fecha de Término:</strong> {{ $proyecto->Fecha_Termino }}</p>

    <h2>Tareas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Término</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyecto->tareas as $tarea)
                <tr>
                    <td>{{ $tarea->Nombre_Tarea }}</td>
                    <td>{{ $tarea->Descripcion }}</td>
                    <td>{{ $tarea->Fecha_Inicio }}</td>
                    <td>{{ $tarea->Fecha_Termino }}</td>
                    <td>{{ $tarea->estado->Descripcion }}</td>
                    <td>
                        <a href="{{ route('tareas.edit', $tarea->ID_Tarea) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('tareas.destroy', $tarea->ID_Tarea) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay tareas en este proyecto.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Botón para Crear Nueva Tarea -->
    <a href="{{ route('tareas.create', $proyecto->ID_Proyecto) }}" class="btn btn-primary">Crear Nueva Tarea</a>
</div>
@endsection
