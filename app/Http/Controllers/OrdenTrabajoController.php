<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Proveedor;
use App\Empresas;
use App\OrdenTrabajo;
use App\DetalleOTrabajo;

class OrdenTrabajoController extends Controller
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

        return view('ordenT.create',['empresa' => $empresa]);
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
            $name = 'ot'.md5(date("dmYhisA")).'.png';
            $nombre = public_path().'/img/firmas/ordent'.$name;

            //dd($name);

            

            $ordenT = new OrdenTrabajo;
            $ordenT->cod_seguimiento = 'OT'.$codigo;
            $ordenT->id_user = $request->id_user;
            $ordenT->id_empresa = $request->id_empresa;
            $ordenT->fecha_inicio = $request->fecha_inicio;
            $ordenT->fecha_fin = $request->fecha_fin;
            $ordenT->firma = $name;

            if ($ordenT->save()) {

                file_put_contents($nombre,base64_decode($request->firma));

                 for ($i=0; $i < count($request->nombre); $i++) { 
           
                    $DetalleOTrabajo = new DetalleOTrabajo;
                    $DetalleOTrabajo->cod_seguimiento = 'OC'.$codigo;
                    $DetalleOTrabajo->nombre = $request->nombre[$i];
                    $DetalleOTrabajo->cantidad = $request->cantidad[$i];
                    $DetalleOTrabajo->save();

                 }//fin for
                  return response()->json(['msg'=>'Se registro correctamente']);
            }//fin if de orden save

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
