<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
  </head>
	<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
     <center><img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Logo" style="height:75px"></center>
	      <a href="#"><b>{{ config('app.name') }}</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registro de usuario</p>
    <form action="{{route('users.regist')}}" method="post">
    	{{csrf_field()}}
		<div class="form-group {{ $errors->has('apellido')?'has-error':'' }}">
			<label class="control-label" for="apellido">Nombre y Apellido: *</label>
			<input id="apellido" class="form-control" type="text" name="nombre" value="{{ old('apellido')?old('apellido'):'' }}" placeholder="Nombre Completo" required>
		</div>
		<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
			<label class="control-label" for="email">Correo De Verificación: *</label>
			<input id="email" class="form-control" type="mail" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email" required>
		</div>
		<div class="form-group {{ $errors->has('rut_user')?'has-error':'' }}">
			<label class="control-label" for="rut">RUT* en formato 00.000.000-0: *</label>
			<input id="rut_user" class="form-control " type="text" name="rut_user" oninput="checkRut(this)" value="{{ old('rut_user')?old('rut_user'):'' }}" placeholder="01.999.999-K" required>
		</div>
		<div class="form-group {{ $errors->has('ciudad_user')?'has-error':'' }}">
			<label class="control-label" for="ciudad_user">Ciudad: *</label>
			<input id="ciudad_user" class="form-control" type="text" name="ciudad_user" value="{{ old('ciudad_user')?old('ciudad_user'):'' }}" placeholder="Ciudad" required>
		</div>
		<div class="form-group {{ $errors->has('telefono_user')?'has-error':'' }}">
			<label class="control-label" for="telefono_user">Teléfono móvil: *</label>
			<input id="telefono_user" class="form-control tlf" type="text" name="telefono_user" value="{{ old('telefono_user')?old('telefono_user'):'' }}" placeholder="Telefono" required>
		</div>
		<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
			<label class="control-label" for="direccion_user">Dirección: *</label>
			<input id="direccion_user" class="form-control" type="text" name="direccion_user" value="{{ old('direccion_user')?old('direccion_user'):'' }}" placeholder="Direccion" required>
		</div>
		<div class="form-group {{ $errors->has('password')?'has-error':'' }}">
			<label class="control-label" for="password">Contraseña: *</label>
			<input id="password" class="form-control" type="password" name="password" required>
		</div>
		<div class="form-group {{ $errors->has('password_confirmation')?'has-error':'' }}">
			<label class="control-label" for="password_confirmation">Verificar contraseña: *</label>
			<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
		</div>
	      <div class="row">
	      	@if (count($errors) > 0)
	          <div class="alert alert-danger alert-important">
		          <ul>
		            @foreach($errors->all() as $error)
		              <li>{{$error}}</li>
		            @endforeach
		          </ul>  
	          </div>
	        @endif
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
	        </div>
	         <div class="col-xs-4 col-xs-offset-4">
	          <small><a href="{{route('login')}}">Iniciar Sesión</a></small>
	        </div>
	        <!-- /.col -->
	      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<script type="text/javascript" src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
	 function checkRut(rut) {
          // Despejar Puntos
          var valor = rut.value.replace('.','');
          // Despejar Guión
          valor = valor.replace('-','');
          
          // Aislar Cuerpo y Dígito Verificador
          cuerpo = valor.slice(0,-1);
          dv = valor.slice(-1).toUpperCase();
          
          // Formatear RUN
          rut.value = cuerpo + '-'+ dv
          
          // Si no cumple con el mínimo ej. (n.nnn.nnn)
          if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
          
          // Calcular Dígito Verificador
          suma = 0;
          multiplo = 2;
          
          // Para cada dígito del Cuerpo
          for(i=1;i<=cuerpo.length;i++) {
          
              // Obtener su Producto con el Múltiplo Correspondiente
              index = multiplo * valor.charAt(cuerpo.length - i);
              
              // Sumar al Contador General
              suma = suma + index;
              
              // Consolidar Múltiplo dentro del rango [2,7]
              if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
        
          }
          
          // Calcular Dígito Verificador en base al Módulo 11
          dvEsperado = 11 - (suma % 11);
          
          // Casos Especiales (0 y K)
          dv = (dv == 'K')?10:dv;
          dv = (dv == 0)?11:dv;
          
          // Validar que el Cuerpo coincide con su Dígito Verificador
          if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
          
          // Si todo sale bien, eliminar errores (decretar que es válido)
          rut.setCustomValidity('');
      }


	$(".rut").inputmask({
            mask: "9[9.999.999]-[9|K|k]",
          });

        $(".tlf").inputmask({
            mask: "[9-9999-9999]",
          });
</script>
</body>
</html>
