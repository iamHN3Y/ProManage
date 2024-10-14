@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Tarea para el Proyecto: {{ $proyecto->Nombre_Proyecto }}</h1>
    <form action="{{ route('tareas.store') }}" method="POST">
        @csrf

        <!-- Campo para Nombre de la Tarea -->
        <div class="form-group">
            <label for="Nombre_Tarea">Nombre de la Tarea</label>
            <input type="text" name="Nombre_Tarea" id="Nombre_Tarea" class="form-control" required>
        </div>

        <!-- Campo para Descripción de la Tarea -->
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="Descripcion" id="descripcion" class="form-control"></textarea>
        </div>

        <!-- Campo para Fecha de Inicio -->
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="Fecha_Inicio" id="fecha_inicio" class="form-control" required min="{{ $proyecto->Fecha_Inicio }}">
        </div>

        <!-- Campo para Fecha de Término -->
        <div class="form-group">
            <label for="fecha_termino">Fecha de Término</label>
            <input type="date" name="Fecha_Termino" id="fecha_termino" class="form-control" required>
        </div>

        <!-- Campo para Estado de la Tarea -->
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="ID_Estado_FK" id="estado" class="form-control" required>
                @foreach($estados as $estado)
                <option value="{{ $estado->ID_Estado }}">{{ $estado->Descripcion }}</option>
                @endforeach
            </select>
        </div>
        <!-- Campo para Seleccionar Usuarios -->
        <div class="form-group">
            <label for="usuarios">Asignar a Usuarios</label>
            <select name="usuarios[]" id="usuarios" class="form-control" multiple required>
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Checkbox para Crear Nuevo Departamento -->
        <div class="form-group">
            <label>
                <input type="checkbox" id="crear_nuevo_departamento" name="crear_nuevo_departamento" value="1">
                Crear Nuevo Departamento
            </label>
        </div>

        <!-- Campo para Crear Nuevo Departamento -->
        <div id="nuevoDepartamento" class="form-group" style="display: none;">
            <label for="nuevo_departamento_nombre">Nombre del Nuevo Departamento</label>
            <input type="text" name="nuevo_departamento_nombre" id="nuevo_departamento_nombre" class="form-control">
        </div>

        <!-- Campo para Seleccionar Departamento Existente -->
        <div id="departamentoExistente" class="form-group">
            <label for="departamento">Asignar a Departamento</label>
            <select name="ID_Departamento_FK" id="departamento" class="form-control">
                <option value="">Seleccione un Departamento</option>
                @foreach($departamentos as $departamento)
                <option value="{{ $departamento->ID_Departamento }}">{{ $departamento->Nombre_Departamento }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo para Seleccionar Tarea Padre (Subtarea) -->
        <div class="form-group">
            <label for="tarea_padre">Tarea Padre (opcional)</label>
            <select name="ID_TareaPadre_FK" id="tarea_padre" class="form-control">
                <option value="">No es Subtarea</option>
                @foreach($tareas as $tarea)
                <option value="{{ $tarea->ID_Tarea }}">{{ $tarea->Nombre_Tarea }}</option>
                @endforeach
            </select>
        </div>
        <!-- Campo Oculto para ID del Proyecto -->
        <input type="hidden" name="ID_Proyecto_FK" value="{{ $proyecto->ID_Proyecto }}">

        <!-- Botón para Crear Tarea -->
        <button type="submit" class="btn btn-primary">Crear Tarea</button>
    </form>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaInicioInput = document.getElementById('fecha_inicio');
        const fechaTerminoInput = document.getElementById('fecha_termino');

        fechaInicioInput.addEventListener('change', function() {
            fechaTerminoInput.min = fechaInicioInput.value;
        });
    });
    // Mostrar/Ocultar campo de nuevo departamento basado en el checkbox
    document.getElementById('crear_nuevo_departamento').addEventListener('change', function() {
        var nuevoDepartamento = document.getElementById('nuevoDepartamento');
        var departamentoExistente = document.getElementById('departamentoExistente');
        if (this.checked) {
            nuevoDepartamento.style.display = 'block';
            departamentoExistente.style.display = 'none';
        } else {
            nuevoDepartamento.style.display = 'none';
            departamentoExistente.style.display = 'block';
        }
    });
</script>
@endsection