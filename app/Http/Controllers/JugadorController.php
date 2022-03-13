<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['jugadores']=Jugador::paginate(5);
        return view('Jugador.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Jugador.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion de campos vacios
        $campos = [//array para validacion de campos de formulario
            'nombre'=>'required|string|max:25',
            'apellido'=>'required|string|max:50',
            'email'=>'required|email',
            'alias'=>'required|string|max:25',
            'foto'=>'required|mimes:jpeg,jpg,png'];

        $mensajes=[//array para mensajes de error en campos de formulario
            'required'=>'El :attribute es obligatorio',
            'foto.required'=> 'Debes de poner una foto de perfil'];

        $this->validate($request, $campos, $mensajes);

        $datosjugador = request()->except('_token');
        if ($request->hasFile('foto')){
            $datosjugador['foto']=$request->file('foto')->store('upload','public');}
        Jugador::insert($datosjugador);
        return redirect('Jugador')->with('mensaje', 'Empleado agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function show(Jugador $jugador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jugador=Jugador::findOrFail($id);
        return view('Jugador.editar', compact('jugador'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validacion de campos vacios
        $campos = [//array para validacion de campos de formulario
            'nombre'=>'required|string|max:25',
            'apellido'=>'required|string|max:50',
            'email'=>'required|email',
            'alias'=>'required|string|max:25'];

        $mensajes=[//array para mensajes de error en campos de formulario
            'required'=>'El :attribute es obligatorio'];

        //validacion para que el usuario al editar no este obligado a poner de nuevo otra foto
        if ($request->hasFile('foto')){
            $campos = ['foto'=>'required|mimes:jpeg,jpg,png'];
            $mensajes = ['foto.required'=> 'Debes de poner una foto de perfil'];
        }

            $this->validate($request, $campos, $mensajes);

        $datosjugador = request()->except(['_token', '_method']);

        if ($request->hasFile('foto')){
            $jugador=Jugador::findOrFail($id);
            Storage::delete('public/'.$jugador->foto);
            $datosjugador['foto']=$request->file('foto')->store('upload','public');
        }

        Jugador::where('id','=',$id)->update($datosjugador);
        $jugador=Jugador::findOrFail($id);
        return redirect('Jugador')->with('mensaje', 'Empleado modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jugador=Jugador::findOrFail($id);

        if (Storage::delete('public/'.$jugador->foto)) {
            Jugador::destroy($id);
        }
        return redirect('Jugador')->with('mensaje', 'Empleado borrado correctamente');


    }
}
