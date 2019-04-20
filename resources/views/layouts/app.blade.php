<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title',config('app.name'))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Icon 16x16 -->
    <link rel="icon" type="image/png" sizes="240x240" href="{{asset('img/logo.png')}}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
     <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fileinput-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fileinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('js/sign_src/css/jquery.signaturepad.css')}}">


    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/css/inputmask.min.css" rel="stylesheet"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
  	<style type="text/css">
	    .perfil{
			  position: relative;
			  background: #fff;
			  border: 1px solid #f4f4f4;
			  padding: 20px;
			  margin: 10px 25px;
			}


     
      #btnSaveSign {
        color: #fff;
        background: #f99a0b;
        padding: 5px;
        border: none;
        border-radius: 5px;
        font-size: 20px;
        margin-top: 10px;
      }
      #signArea{
        width:304px;
        margin: 50px auto;
      }
      .sign-container {
        width: 60%;
        margin: auto;
      }
      .sign-preview {
        width: 150px;
        height: 50px;
        border: solid 1px #CFCFCF;
        margin: 10px 5px;
      }
      .tag-ingo {
        font-family: cursive;
        font-size: 16px;
        text-align: center;
        font-style: oblique;
      }
    
	  </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini @guest sidebar-collapse @endguest">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="{{route('dashboard')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
          	<b>FR</b>
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>FIRMA</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- User Account: style can be found in dropdown.less -->
            @auth
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">{{ Auth::user()->email }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                      DESCRIPCCION
                      <small>LEYENDA DEL USUARIO ONLINE</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                  	<div class="pull-left">
                  		<a href="{{route('perfil')}}" class="btn btn-flat btn-default"><i class="fa fa-user-circle" aria-hidden="true"></i> Perfil</a>
                  	</div>
                    
                   	<div class="pull-right">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-flat btn-default" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</button>
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
            @endauth
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
    @auth
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ</li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i>Ver usuarios</a></li>
                <li><a href="{{ route('users.create') }}"><i class="fa fa-circle-o"></i>Agregar usuario</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-industry"></i>
                <span>Empresa</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('empresas.create')}}"><i class="fa fa-circle-o"></i> Registrar Empresa</a></li>
                <li><a href="{{route('empresas.index')}}"><i class="fa fa-circle-o"></i> Mis Empresa</a></li>
              </ul>
            </li>
        @if($empresa > 0) {{-- Si tiene empresa registrada --}}
             <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Proveedores</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('proveedor.create')}}"><i class="fa fa-circle-o"></i> Registrar Proveedor</a></li>
                <li><a href="{{route('proveedor.index')}}"><i class="fa fa-circle-o"></i> Mis Proveedores</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-arrows-alt"></i> Guias
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Guia De Despacho
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{route('guiadespacho.create')}}"><i class="fa fa-circle-o"></i> Registrar Guia De Despacho</a></li>
                    <li><a href="{{route('guiadespacho.index')}}"><i class="fa fa-circle-o"></i> Ver Guias De Despacho</a></li>
                  </ul>
                </li>
                 <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Guia De Entrega
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{route('guiaentrega.create')}}"><i class="fa fa-circle-o"></i> Registrar Guia De Entrega</a></li>
                    <li><a href="{{route('guiaentrega.index')}}"><i class="fa fa-circle-o"></i> Ver Guias De Entrega</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          
           <li class="treeview">
              <a href="#"><i class="fa fa-print"></i> Ordenes
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Orden De Compra
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{route('ordencompra.create')}}"><i class="fa fa-circle-o"></i> Registrar Orden De Compra</a></li>
                    <li><a href="{{route('ordencompra.index')}}"><i class="fa fa-circle-o"></i> Ver Ordenes De Compra</a></li>
                  </ul>
                </li>
                 <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Orden De Trabajo
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{route('ordentrabajo.create')}}"><i class="fa fa-circle-o"></i> Registrar Orden De Trabajo</a></li>
                    <li><a href="{{route('ordentrabajo.index')}}"><i class="fa fa-circle-o"></i> Ver Ordenes De Trabajo</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-o"></i>
                <span>Recibo De Gastos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('recibogastos.create')}}"><i class="fa fa-circle-o"></i>Crear Recibo</a></li>
                <li><a href="{{route('recibogastos.index')}}"><i class="fa fa-circle-o"></i>Ver Recibos</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-file-o"></i>
                <span>Acta De Asistencia</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{route('actas.create')}}"><i class="fa fa-circle-o"></i>Crear Acta</a></li>
                <li><a href="{{route('actas.index')}}"><i class="fa fa-circle-o"></i>Ver Actas</a></li>
              </ul>
            </li>
        @endif {{-- Fin de validacion si tiene empresa registrada --}}
                  
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
    @endauth

      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
          <h1>
            @yield('header')
          </h1>
          @yield('breadcrumb')
        </section>
        <!-- Main content -->
        <section class="content">
        	@yield('content')
        </section>
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <strong>Desarrollador por VeanX Technology - 2019</strong> | todos los derechos reservados| consultas a: contacto@veanx.cl
      </footer>
    </div><!-- .wrapper -->
    <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{asset('js/app.min.js')}}"></script>
    <!-- Data table -->
    <script type="text/javascript" src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/fileinput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/sign_src/js/bezier.js')}}"></script>
     <script type="text/javascript" src="{{asset('js/sign_src/js/jquery.signaturepad.js')}}"></script>
     <script type="text/javascript" src="{{asset('js/sign_src/js/json2.min.js')}}"></script>
     <script type="text/javascript" src="{{asset('js/sign_src/js/numeric-1.2.6.min.js')}}"></script>
     <script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>

     
    <script type="text/javascript">  

      $(document).ready(function(){

        $(".rut").inputmask({
            mask: "9[9.999.999]-[9|K|k]",
          });

        $(".tlf").inputmask({
            mask: "[9-9999-9999]",
          });
      	//Eliminar alertas que no contengan la clase alert-important luego de 7seg
      	$('div.alert').not('.alert-important').delay(7000).slideUp(300);

        

      	//activar Datatable
        $('.data-table').DataTable({
          responsive: true,
          language: {
          	url:'{{asset("plugins/datatables/spanish.json")}}'
          }
        });
      })
    </script>

    @yield('script')
  </body>
</html>