<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ayudas;

class AyudasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayudas = Ayudas::all();

        return view('ayudas.index',['ayudas' => $ayudas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ayudas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ayuda = new Ayudas;
        $ayuda->fill($request->all());

        if($ayuda->save()){
            return redirect("ayudas")->with([
              'flash_message' => 'Ayuda agregada correctamente.',
              'flash_class' => 'alert-success'
              ]);
          }else{
            return redirect("ayudas")->with([
              'flash_message' => 'Ha ocurrido un error.',
              'flash_class' => 'alert-danger',
              'flash_important' => true
              ]);
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
        $ayuda = Ayudas::findOrfail($id);

        return view('ayudas.view',['ayuda' => $ayuda]);
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

    public function viwers()
    {

        $ayudas = Ayudas::all();

        return view('ayudas.viwers',['faq' => $ayudas]);
    }
}
