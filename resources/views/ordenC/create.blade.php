@extends('layouts.app')
@section('title','Proveedores - '.config('app.name'))
@section('header','Proveedores')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Proveedores"> Proveedores </a></li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
			</div>
		</div>

		<div class="row">
	  	<div class="col-md-7 col-md-offset-2">
	    	<div class="box box-success">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Proveedor</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form class="" action="{{ route('proveedor.store') }}" method="POST" enctype="multipart/form-data">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="id_empresa" value="{{$empresa->id}}">
					<h4>Agregar Proveedor</h4>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
								<label class="control-label" for="razon_social">Empresa: *</label>
									<input id="razon_social" class="form-control" type="text" name="razon_social" value="{{strtoupper($empresa->r_social)}}" placeholder="Razon Social" required readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
								<label class="control-label" for="contacto">Proveedores: *</label>
								<select name="id_proveedor" id="id_proveedor" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($proveedor as $p)
										<option value="{{$p->id}}">{{$p->razon_social}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="field_wrapper">
							<div class="col-md-4">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Tipo: *</label>
										<input id="razon_social" class="form-control" type="text" name="razon_social" value="{{strtoupper($empresa->r_social)}}" placeholder="Razon Social" required readonly>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Tipo: *</label>
										<input id="razon_social" class="form-control" type="text" name="razon_social" value="{{strtoupper($empresa->r_social)}}" placeholder="Razon Social" required readonly>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Tipo: *</label>
										<input id="razon_social" class="form-control" type="text" name="razon_social" value="{{strtoupper($empresa->r_social)}}" placeholder="Razon Social" required readonly>
								</div>
							</div>
							

						    <div class="col-md-3 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>
						</div>
						
					</div>

					@if (count($errors) > 0)
			          <div class="alert alert-danger alert-important">
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        @endif
					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')

<script type="text/javascript">
	$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div class="col-md-3"><div class="form-group"><label class="control-label" for="razon_social">Tipo: *</label><input id="razon_social" class="form-control" type="text" name="razon_social"  placeholder="Razon Social" required readonly></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="razon_social">Tipo: *</label><input id="razon_social" class="form-control" type="text" name="razon_social"  placeholder="Razon Social" required readonly></div></div><div class="col-md-3"><div class="form-group "><label class="control-label" for="razon_social">Tipo: *</label><input id="razon_social" class="form-control" type="text" name="razon_social" placeholder="Razon Social" required readonly></div></div><div class="col-md-3"><a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button" title="Remove field">X</a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

@endsection
