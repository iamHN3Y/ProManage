<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Departamento;
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Http\Request;

class TareaController extends Controller
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
    public function create($proyectoId)
    {
        $proyecto = Proyecto::findOrFail($proyectoId);
        $estados = Estado::all();
        $usuarios = User::all();
        $departamentos = Departamento::all();
        $tareas = Tarea::all();

        return view('tareas.create', compact('proyecto', 'estados', 'usuarios', 'departamentos', 'tareas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Tarea' => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Fecha_Inicio' => 'required|date|after_or_equal:' . $request->Fecha_Inicio,
            'Fecha_Termino' => 'required|date|after_or_equal:Fecha_Inicio',
            'ID_Estado_FK' => 'required|integer|exists:estados,ID_Estado',
            'ID_Proyecto_FK' => 'required|integer|exists:proyectos,ID_Proyecto',
            'usuarios' => 'required|array',
            'usuarios.*' => 'integer|exists:users,id',
            'nuevo_departamento_nombre' => 'nullable|string|max:255|required_if:crear_nuevo_departamento,1',
            'ID_Departamento_FK' => 'nullable|integer|exists:departamentos,ID_Departamento',
            'ID_TareaPadre_FK' => 'nullable|integer|exists:tareas,ID_Tarea',
        ]);

        // Determinar el departamento
        $departamentoId = $request->crear_nuevo_departamento ? null : $request->ID_Departamento_FK;
        if ($request->crear_nuevo_departamento && $request->nuevo_departamento_nombre) {
            $departamento = Departamento::create([
                'Nombre_Departamento' => $request->nuevo_departamento_nombre
            ]);
            $departamentoId = $departamento->ID_Departamento;
        }

        // Creación de la tarea
        $tarea = Tarea::create([
            'Nombre_Tarea' => $request->Nombre_Tarea,
            'Descripcion' => $request->Descripcion,
            'Fecha_Inicio' => $request->Fecha_Inicio,
            'Fecha_Termino' => $request->Fecha_Termino,
            'ID_Estado_FK' => $request->ID_Estado_FK,
            'ID_Proyecto_FK' => $request->ID_Proyecto_FK,
            'ID_Departamento_FK' => $departamentoId,
            'ID_TareaPadre_FK' => $request->ID_TareaPadre_FK,
            'Nivel' => $request->ID_TareaPadre_FK ? true : false,
        ]);

        // Asignar usuarios a la tarea
        $tarea->usuarios()->attach($request->usuarios);

        return redirect()->route('proyectos.show', $request->ID_Proyecto_FK)
            ->with('success', 'Tarea creada exitosamente y asignada al proyecto.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.edit', compact('tarea'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());

        return redirect()->route('proyectos.show', $tarea->ID_Proyecto_FK)->with('success', 'Tarea actualizada exitosamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()->route('proyectos.show', $tarea->ID_Proyecto_FK)->with('success', 'Tarea eliminada exitosamente.');
    }
}
