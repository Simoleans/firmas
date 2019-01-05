<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ProductosCompras;
use App\Proveedor;
use App\Empresas;
use App\OrdenC;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = OrdenC::where('id_user',Auth::user()->id)->get();

        //dd($ordenes->user());
        return view('ordenC.index',['ordenes'=>$ordenes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(Auth::user()->empresa->toArray()[0]['r_social']);

        $proveedores = Proveedor::where('id_user', Auth::user()->id)->get();

        $empresa = Empresas::where('id_user',Auth::user()->id)->first();

        return view('ordenC.create',['proveedor' => $proveedores,'empresa' => $empresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codigo=rand(11111, 99999);

        //dd($request->all());

        //dd(base64_decode($request->firma));

            // $file = Input::file('logo');
            // $file->move(public_path().'/img/empresas/', date("YmdHi").$file->getClientOriginalName());
            $name = md5(date("dmYhisA")).'.png';
            $nombre = public_path().'/img/firmas/'.$name;

            //dd($name);

            

            $orden = new OrdenC;
            $orden->cod_seguimiento = $codigo;
            $orden->id_user = Auth::user()->id;
            $orden->id_proveedor = $request->id_proveedor;
            $orden->id_empresa = $request->id_empresa;
            $orden->firma = $name;

            if ($orden->save()) {

                file_put_contents($nombre,base64_decode($request->firma));

                 for ($i=0; $i < count($request->producto); $i++) { 
           
                    $productosCompras = new ProductosCompras;
                    $productosCompras->cod_seguimiento = $codigo;
                    $productosCompras->tipo_modelo = $request->tipo_modelo[$i];
                    $productosCompras->producto = $request->producto[$i];
                    $productosCompras->precio_unt = $request->precio_unt[$i];
                    $productosCompras->cantidad = $request->cantidad[$i];
                    $productosCompras->save();

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
