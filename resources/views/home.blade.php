<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage</title>
    @vite('resources/js/app.js')
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h1>Dashboard</h1>

        <h2>Proyectos Administrados</h2>
        <ul>
            @forelse($proyectosAdministrados as $proyecto)
            <!-- Cada nombre de proyecto es un enlace que lleva a la vista del proyecto -->
            <li>
                <a href="{{ route('proyectos.show', $proyecto->ID_Proyecto) }}">{{ $proyecto->Nombre_Proyecto }}</a>
            </li>
            @empty
            <p>No eres administrador de ningún proyecto.</p>
            @endforelse
        </ul>

        <h2>Proyectos como Miembro</h2>
        <ul>
            @forelse($proyectosMiembro as $proyecto)
            <li>{{ $proyecto->Nombre_Proyecto }}</li>
            @empty
            <p>No eres miembro de ningún proyecto.</p>
            @endforelse
        </ul>
    </div>
    @endsection
</body>

</html>