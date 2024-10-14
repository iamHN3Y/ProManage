@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Proyecto</h1>
    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf
        <!-- Campo para Nombre del Proyecto -->
        <div class="form-group">
            <label for="nombre">Nombre del Proyecto</label>
            <input type="text" name="Nombre_Proyecto" id="nombre" class="form-control" required>
        </div>

        <!-- Campo para Descripción del Proyecto -->
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="Descripcion" id="descripcion" class="form-control"></textarea>
        </div>

        <!-- Checkbox para usar la fecha de hoy como inicio -->
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="fecha_hoy" name="fecha_hoy" checked>
            <label class="form-check-label" for="fecha_hoy">Usar fecha de hoy como inicio</label>
        </div>

        <!-- Campo para Fecha de Inicio -->
        <div class="form-group" id="fecha_inicio_container" style="display: none;">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="Fecha_Inicio" id="fecha_inicio" class="form-control">
        </div>

        <!-- Campo para Fecha de Término -->
        <div class="form-group">
            <label for="fecha_termino">Fecha de Término</label>
            <input type="date" name="Fecha_Termino" id="fecha_termino" class="form-control" required>
        </div>

        <!-- Botón para Crear Proyecto -->
        <button type="submit" class="btn btn-primary">Crear Proyecto</button>
    </form>
</div>

<script>
    // Función para obtener la fecha de hoy en formato YYYY-MM-DD
    function obtenerFechaDeHoy() {
        var hoy = new Date();
        var dia = String(hoy.getDate()).padStart(2, '0');
        var mes = String(hoy.getMonth() + 1).padStart(2, '0'); // Enero es 0
        var ano = hoy.getFullYear();
        return ano + '-' + mes + '-' + dia;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Establecer fecha de hoy por defecto en el campo de fecha de término
        var fechaTerminoInput = document.getElementById('fecha_termino');
        var fechaHoy = obtenerFechaDeHoy();
        fechaTerminoInput.value = fechaHoy;
        fechaTerminoInput.min = fechaHoy; // Establecer el mínimo para que no se puedan seleccionar fechas anteriores

        var fechaInicioInput = document.getElementById('fecha_inicio');

        // Mostrar/ocultar campo de fecha de inicio basado en el checkbox
        document.getElementById('fecha_hoy').addEventListener('change', function() {
            var fechaInicioContainer = document.getElementById('fecha_inicio_container');

            if (this.checked) {
                fechaInicioContainer.style.display = 'none';
                fechaInicioInput.value = ''; // Limpiar cualquier fecha seleccionada
                fechaTerminoInput.min = fechaHoy; // Restablecer el mínimo a la fecha de hoy
            } else {
                fechaInicioContainer.style.display = 'block';
                fechaInicioInput.value = fechaHoy; // Establecer fecha de hoy como fecha de inicio por defecto
                fechaTerminoInput.min = fechaInicioInput.value; // Ajustar mínimo a la fecha de inicio
            }
        });

        // Ajustar la fecha mínima de término cuando se selecciona una nueva fecha de inicio
        fechaInicioInput.addEventListener('change', function() {
            if (fechaInicioInput.value) {
                fechaTerminoInput.min = fechaInicioInput.value;
            } else {
                fechaTerminoInput.min = fechaHoy;
            }
        });

        // Inicializar la visibilidad del contenedor de fecha de inicio
        if (document.getElementById('fecha_hoy').checked) {
            document.getElementById('fecha_inicio_container').style.display = 'none';
        }
    });
</script>
@endsection
