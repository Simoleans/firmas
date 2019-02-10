@extends('layouts.app')
@section('title','Guia De Despacho - '.config('app.name'))
@section('header','Guia De Despacho')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Guia De Despacho </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Guia De Despacho</span>
          <span class="info-box-number">{{ count($guia) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div><!--row-->

	<div class="row">
	  	<div class="col-md-12">
	    	<div class="box box-danger">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-users"></i> Guias De Despachos</h3>
		        <span class="pull-right">
					<a href="{{ route('guiadespacho.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Guia</a>
				</span>
		      </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed nowrap" style="width:100%">
						<thead>
							<tr>
								<th class="text-center">Codigo</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Empresa</th>
								<th class="text-center">Empresa Receptora</th>
								<th class="text-center">Fecha inicio</th>
								<th class="text-center">Autorizado</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($guia as $d)
								<tr>
									<td>{{$d->cod_seguimiento}}</td>
									<td>{{$d->user->nombre}}</td>
									<td>{{strtoupper($d->empresa->r_social)}}</td>
									<td>{{strtoupper($d->empresa_receptora->r_social)}}</td>
									<td>{{$d->created_at->format('Y-m-d')}}</td>
									<td>{{$d->firma_receptor?'Autorizado':'No Autorizado'}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('guiadespacho.show',[$d->id])}}"><i class="fa fa-search"></i></a>
										 <a class="btn btn-danger btn-flat btn-sm" href="{{ route('guiadespacho.pdf',[$d->id])}}"><i class="fa fa-print"></i></a> 
										{{-- <a href="{{route('ordencompra.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>  --}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection