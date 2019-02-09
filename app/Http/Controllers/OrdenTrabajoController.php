<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Proveedor;
use App\Empresas;
use App\OrdenTrabajo;
use App\DetalleOTrabajo;
use App\Mail\OrdenT;
use PDF;

class OrdenTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = OrdenTrabajo::where('id_user',Auth::user()->id)->get();

        //dd($ordenes);
        return view('ordenT.index',['ordenest'=>$ordenes]);
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
            $nombre = public_path().'/img/firmas/ordent/'.$name;

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
                    $DetalleOTrabajo->cod_seguimiento = 'OT'.$codigo;
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
         $orden = OrdenTrabajo::findOrfail($id);

        $detalles = DetalleOTrabajo::where('cod_seguimiento',$orden->cod_seguimiento)->get();

        //dd($detalles);

        return view('ordenT.view',['orden' => $orden,'detalles' => $detalles]);
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
        $orden = OrdenTrabajo::findOrfail($id);

        $detalles = DetalleOTrabajo::where('cod_seguimiento',$orden->cod_seguimiento)->get();

        //dd($orden->cod_seguimiento);

        $pdf = PDF::loadView('ordenT.pdf',['orden'=>$orden,'detalles'=>$detalles]);
            
            return $pdf->download($orden->cod_seguimiento.'.pdf');
    }

    public function sendEmail(Request $request)
    {
        //dd(env('MAIL_HOST'));
        $url = route('ordentrabajo.firma',[$request->id]);

        $orden = OrdenTrabajo::findOrfail($request->id);
         \Mail::to($request->email)
                 ->send(new OrdenT($url,$orden));

         return redirect("ordentrabajo")->with([
          'flash_message' => 'Invitacion enviada correctamente.',
          'flash_class' => 'alert-success'
          ]);
    }

    public function firma($id)
    {
        $orden = OrdenTrabajo::findOrfail($id);

        $detalles = DetalleOTrabajo::where('cod_seguimiento',$orden->cod_seguimiento)->get();

        //dd($detalles);

        return view('ordenT.firma',['orden' => $orden,'detalles' => $detalles]);
    }

     public function firmaSend(Request $request)
    {

         $name = 'ot'.md5(date("dmYhisA")).'.png';
         $nombre = public_path().'/img/firmas/ordent/'.$name;

         $orden = OrdenTrabajo::findOrfail($request->id_orden);

         $orden->firma_receptor = $name;
         $orden->status = 1;

        if ($orden->save()) {
             file_put_contents($nombre,base64_decode($request->firma));

             return response()->json(['msg' => 'Se ha registrado correctamente']);
        }
    }
}