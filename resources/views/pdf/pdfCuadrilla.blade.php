@extends('layouts.appPdf')

@section('content')

    <div class="row">
      <div class="col-sm-12">
        <h3 style="border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;padding: 0.5em">Cuadrilla {{$planilla->codigo}}</h3>
        <br>
        <section class="perfil">
          <div class="row">
            <!-- <div class="col-md-12">
              <h2 class="page-header" style="margin-top:0!important">
                <i class="fa fa-user" aria-hidden="true"></i>
                {{ $planilla->codigo }}
                <small class="pull-right">Registrado: {{ $planilla->created_at->format('Y-m-d') }}</small>
                <span class="clearfix"></span>
              </h2>
            </div> -->
            <div class="col-md-4">
              <h4>Detalles de la Cuadrilla</h4>
              <p><b>Comuna: </b> {{strtoupper($planilla->comuna->nombre)}} </p>
              <p><b>Consejo Comunal: </b> {{strtoupper($planilla->consejo->nombre)}} </p>
              <p><b>Sector: </b>{{strtoupper($planilla->sectores->nombre)}}</p>
            </div>

          </div>
        </section>
        <h3 class="text-center">Participantes</h3>
         <hr>
        <table class="table data-table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Apellido</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Correo</th>
              </tr>
            </thead>
            <tbody class="text-center">
              @foreach($participantes as $g)
                <tr>
                  <td>{{$loop->index+1}}</td>
                  <td>{{$g->nombre}}</td>
                  <td>{{$g->apellido}}</td>
                  <td>{{$g->telefono}}</td>
                  <td>{{$g->correo}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

@endsection
