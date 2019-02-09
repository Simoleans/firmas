<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ProductosCompras;
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
        //dd($request->all());

            $codigo=rand(11111, 99999);
            // $file = Input::file('logo');
            // $file->move(public_path().'/img/empresas/', date("YmdHi").$file->getClientOriginalName());
            $name = 'gd'.md5(date("dmYhisA")).'.png';
            $nombre = public_path().'/img/firmas/guiad/'.$name;

            $guia = new GuiaDespacho;
            $guia->cod_seguimiento = 'GD'.$codigo;
            $guia->id_user = Auth::user()->id;
            $guia->id_empresa = $request->id_empresa;
            $guia->id_empresa_despacho = $request->id_empresa_despacho;
            $guia->observaciones = $request->observaciones;
            $guia->firma = $name;

            if ($guia->save()) {

                file_put_contents($nombre,base64_decode($request->firma));

                 for ($i=0; $i < count($request->producto); $i++) { 
           
                    $productos = new ProductosCompras;;
                    $productos->cod_seguimiento = 'GD'.$codigo;
                    $productos->tipo_modelo = $request->tipo_modelo[$i];
                    $productos->producto = $request->producto[$i];
                    $productos->precio_unt = $request->precio_unt[$i];
                    $productos->cantidad = $request->cantidad[$i];
                    $productos->precio_total  = $request->cantidad[$i] * $request->precio_unt[$i];
                    $productos->save();

                 }//fin for
                  return response()->json(['msg'=>'Se registro correctamente']);
            }


            
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