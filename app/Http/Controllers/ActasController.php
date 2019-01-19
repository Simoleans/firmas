<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Proveedor;
use App\Empresas;
use App\Actas;
use App\Participantes;
use App\Acciones;

class ActasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actas = Actas::where('id_user',Auth::user()->id)->get();
        //dd($actas);

        return view('actas.index',['actas' => $actas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = Empresas::empresa(Auth::user()->id);
        return view('actas.create',['empresa' => $empresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd($request->all());

        $codigo=rand(11111, 99999);

        $acta = new Actas;
        $acta->codigo = 'AC'.$codigo;
        $acta->id_user = Auth::user()->id;
        $acta->id_empresa = $request->id_empresa;
        $acta->observaciones = $request->observaciones;

        if ($acta->save()) {
            //for participantes
            for ($i=0; $i < count($request->nombre); $i++)
             { 
           
                $participante = new Participantes;
                $participante->codigo_acta = 'AC'.$codigo;
                $participante->nombre = $request->nombre[$i];
                $participante->apellido = $request->apellido[$i];
                $participante->cargo = $request->cargo[$i];
                $participante->save();
             }//fin for

             //for acciones
             for ($i=0; $i < count($request->accion); $i++)
             { 
           
                $acciones = new Acciones;
                $acciones->codigo_acta = 'AC'.$codigo;
                $acciones->accion = $request->accion[$i];
                $acciones->save();
             }//fin for


             return response()->json(['msg'=>'Se registro correctamente']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acta = Actas::findOrfail($id);

        return view('actas.view',['acta' => $acta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdf($id)
    {

    }

    public function firma($id)
    {
        $acta = Actas::findOrfail($id);

        $participante = Participantes::where('codigo_acta',$acta->codigo)->first();

        return view('actas.firma',['acta' => $acta,'participante' => $participante]);
    }

    public function firmaSend(Request $request)
    {
        dd($request->all());
    }
}
