<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\EmpresaDespacho;
use App\GuiaDespacho;
use App\Empresas;
use PDF;

class GuiaDespachoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $empresa = Empresas::where('id_user',Auth::user()->id)->first();

       $empresa_despachos = EmpresaDespacho::all();

        return view('guiaD.create',['empresa' => $empresa,'empresa_despachos' => $empresa_despachos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());

            $codigo=rand(11111, 99999);
            // $file = Input::file('logo');
            // $file->move(public_path().'/img/empresas/', date("YmdHi").$file->getClientOriginalName());
            $name = 'ot'.md5(date("dmYhisA")).'.png';
            $nombre = public_path().'/img/firmas/ordent/'.$name;

            $guia = new GuiaDespacho;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function show(GuiaDespacho $guiaDespacho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function edit(GuiaDespacho $guiaDespacho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuiaDespacho $guiaDespacho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GuiaDespacho  $guiaDespacho
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuiaDespacho $guiaDespacho)
    {
        //
    }

    public function empresa(Request $request)
    {
        $empresa_despacho = new EmpresaDespacho;
        $empresa_despacho->fill($request->all());

        $empresa_existe = EmpresaDespacho::where('rut',$request->rut)->exists();

        if ($empresa_existe) {
             $empresas = EmpresaDespacho::all();

            return response()->json(['msg' => 'Esta empresa ya existe.','status' => false,'empresas' => $empresas]);
        }

        if ($empresa_despacho->save()) {

            $empresas = EmpresaDespacho::all();

            return response()->json(['msg' => 'Se Ha Registrado Correctamente','status' => true,'empresas' => $empresas]);

        }else{


            return response()->json(['msg' => 'Ha ocurrido un error','status' => false,'empresas' => $empresas]);

        }
    }
}
