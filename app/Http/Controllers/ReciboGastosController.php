<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\DetalleRecibo;
use App\ReciboGastos;
use App\Mail\ReciboG;
use App\Empresas;
use PDF;

class ReciboGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $recibo = ReciboGastos::where('id_user',Auth::user()->id)->get();
        //dd($actas);

        return view('recibog.index',['recibo' => $recibo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = Empresas::where('id_user',Auth::user()->id)->first();

         //$empresa_despachos = EmpresaDespacho::all();

        return view('reciboG.create',['empresa' => $empresa]);
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
            $name = 'rg'.md5(date("dmYhisA")).'.png';
            $nombre = public_path().'/img/firmas/recibog/'.$name;


            $recibo = new ReciboGastos;
            $recibo->cod_seguimiento = 'RG'.$codigo;
            $recibo->id_user = Auth::user()->id;
            $recibo->id_empresa = $request->id_empresa;
            $recibo->recibe = strtoupper($request->recibe);
            $recibo->observaciones = $request->observaciones;
            $recibo->firma = $name;

            $detalle = new DetalleRecibo;
            $detalle->cod_seguimiento = 'RG'.$codigo;
            $detalle->concepto = $request->concepto;
            $detalle->cantidad = $request->cantidad;
            $detalle->cuenta = $request->cuenta;
            $detalle->transferencia_efectivo = $request->transferencia_efectivo;
            $detalle->adicional = $request->adicional;

        if ($recibo->save() && $detalle->save()) {

            file_put_contents($nombre,base64_decode($request->firma));

            return response()->json(['msg'=>'Se registro correctamente']);
        }else{
            return response()->json(['msg'=>'¡Error!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReciboGastos  $reciboGastos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $recibo = ReciboGastos::findOrfail($id);

         $detalle = DetalleRecibo::where('cod_seguimiento',$recibo->cod_seguimiento)->first();

         return view('reciboG.view',['recibo' => $recibo,'detalle' => $detalle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReciboGastos  $reciboGastos
     * @return \Illuminate\Http\Response
     */
    public function edit(ReciboGastos $reciboGastos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReciboGastos  $reciboGastos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReciboGastos $reciboGastos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReciboGastos  $reciboGastos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReciboGastos $reciboGastos)
    {
        //
    }

    public function pdf($id)
    {
         $recibo = ReciboGastos::findOrfail($id);

         $detalle = DetalleRecibo::where('cod_seguimiento',$recibo->cod_seguimiento)->first();

        //dd($productos);

          $pdf = PDF::loadView('reciboG.pdf',['recibo'=>$recibo,'detalle'=>$detalle]);
            
            return $pdf->download($recibo->cod_seguimiento.'.pdf');
    }

    public function sendEmail(Request $request)
    {
        $url = route('recibogastos.firma',[$request->id]);

        $guia = ReciboGastos::findOrfail($request->id);
         \Mail::to($request->email)
                 ->send(new ReciboG($url,$guia));

         return redirect("recibogastos")->with([
          'flash_message' => 'Correo enviado correctamente.',
          'flash_class' => 'alert-success'
          ]);
    }
    public function firma($id)
    {
        $recibo = ReciboGastos::findOrfail($id);

        $detalle = DetalleRecibo::where('cod_seguimiento',$recibo->cod_seguimiento)->first();

        //dd($detalle);

        return view('reciboG.firma',['recibo' => $recibo,'detalle' => $detalle]);
    }

     public function firmaSend(Request $request)
    {

         $name = 'rg'.md5(date("dmYhisA")).'.png';
         $nombre = public_path().'/img/firmas/recibog/'.$name;

         $recibo = ReciboGastos::findOrfail($request->id_recibo);

         $recibo->firma_receptor = $name;
         $recibo->status = 1;

        if ($recibo->save()) {
             file_put_contents($nombre,base64_decode($request->firma));

             return response()->json(['msg' => 'Se ha registrado correctamente']);
        }
    }
}
