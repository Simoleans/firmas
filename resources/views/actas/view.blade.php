@extends('layouts.app')
@section('title','Acta - '.config('app.name'))
@section('header','Acta')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> Acta {{$acta->codigo}} </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
	<section>
    <a class="btn btn-flat btn-default" href="{{ route('actas.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    {{-- <a class="btn btn-flat btn-success" href="{{ route('actas.edit',[$acta->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a> --}}
    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
	</section>

	<section class="perfil">
		<div class="row">
    	<div class="col-md-12">
    		<h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Acta '.$acta->codigo }}
          <small class="pull-right">Registrado: {{ $acta->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
    	</div>
			<div class="col-md-5">
				<h4>Detalles de la empresa</h4>
				<p><b>Usuario: </b> {{$acta->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($acta->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($acta->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($acta->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($acta->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($acta->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($acta->empresa->direccion)}}</p>
        
			</div>

      <div class="col-md-4"> 
        <p>&nbsp;</p>
        <p><b>Observaciones: </b> {{$acta->observaciones?$acta->observaciones:'N/T'}} </p>
      </div>

      <div class="col-md-2"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$acta->empresa->logo)}}" class="img-responsive">
      </div>
		</div>

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-users" aria-hidden="true"></i>
          Participantes
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table table-condensed table-hover table-bordered">
         <thead>
           <tr>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellido</th>
            <th class="text-center">Cargo</th>
            <th class="text-center">Acción</th>
          </tr>
         </thead>
         <tbody>
          @foreach($acta->participantes($acta->codigo) as $p)
           <tr>
             <td class="text-center">{{$p->nombre}}</td>
             <td class="text-center">{{$p->apellido}}</td>
             <td class="text-center">{{$p->cargo}}</td>
             <td class="text-center">
              @if($p->firma == NULL)
               <a class="btn btn-primary btn-flat btn-sm" href="{{ route('actas.firma',[$acta->id])}}"><i class="fa fa-user-plus"></i></a>
              @else
               <img src="{{asset('img/actas').'/'.$p->firma}}" class="img-responsive">
              @endif
             </td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-list" aria-hidden="true"></i>
          Acciones
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table table-condensed table-hover table-bordered">
         <thead>
           <tr>
            <th class="text-center">#</th>
            <th class="text-center">Accion</th>
          </tr>
         </thead>
         <tbody>
          @foreach($acta->acciones($acta->codigo) as $a)
           <tr>
             <td>{{$loop->index+1}}</td>
             <td class="text-center">{{$a->accion}}</td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>
	</section>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class="col-md-8 col-md-offset-2" action="{{ route('actas.destroy',[$acta->id])}}" method="POST">
              {{ method_field( 'DELETE' ) }}
              {{ csrf_field() }}
              <h4 class="text-center">¿Esta seguro de eliminar esta acta?</h4><br>

              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection