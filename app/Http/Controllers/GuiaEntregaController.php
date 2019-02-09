<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ProductosCompras;
use App\GuiaEntrega;
use App\Mail\GuiaE;
use App\Empresas;
use PDF;

class GuiaEntregaController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function show(GuiaEntrega $guiaEntrega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function edit(GuiaEntrega $guiaEntrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuiaEntrega $guiaEntrega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuiaEntrega $guiaEntrega)
    {
        //
    }
}
