@extends('layouts.app')
@section('title','Ayuda - '.config('app.name'))
@section('header','Ayuda')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li><a href="{{route('ayudas.index')}}" title="Ayuda"> Ayudas </a></li>
    <li class="active">Agregar</li>
  </ol>
@endsection
@section('content')
   

<div class="box box-success" >
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-question"></i> <a href="#" data-toggle="collapse" data-target="#demo">Registrar Ayuda</a></h3>
            <span class="pull-right"></span>
           </div>
            <div class="box-body">
                <div id="demo" class="collapse">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
           </div>
      </div>

      <div class="box box-success" >
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-question"></i> <a href="#" data-toggle="collapse" data-target="#ss">Registrar sffs</a></h3>
            <span class="pull-right"></span>
           </div>
            <div class="box-body">
                <div id="ss" class="collapse">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
           </div>
      </div>
@endsection
