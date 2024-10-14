<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyectos.create'); // Asegúrate de tener una vista llamada 'proyectos.create'
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Proyecto' => 'required|string|max:255',
            'Fecha_Inicio' => 'nullable|date',
            'Fecha_Termino' => 'required|date|after_or_equal:Fecha_Inicio',
        ]);

        // Determinar la fecha de inicio
        $fechaInicio = $request->input('fecha_hoy') ? now()->toDateString() : $request->Fecha_Inicio;

        // Crear el proyecto y capturar la instancia en una variable
        $proyecto = Proyecto::create([
            'Nombre_Proyecto' => $request->Nombre_Proyecto,
            'Descripcion' => $request->Descripcion,
            'Fecha_Inicio' => $fechaInicio,
            'Fecha_Termino' => $request->Fecha_Termino,
        ]);

        // Asignar el usuario actual como administrador del proyecto
        $user = Auth::user();
        $proyecto->usuarios()->attach($user->id, ['ID_Rol_FK' => 1]);

        return redirect()->route('home')->with('success', 'Proyecto creado y asignado como administrador exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proyecto = Proyecto::with(['tareas', 'tareas.estado'])->findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
