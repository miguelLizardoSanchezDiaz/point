@extends('layouts.app')

@section('script_cabecera')

@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar aperturas y cierres de caja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Listado Aperturas y Cierres</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Listado de Aperturas y Cierres</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <!--<div class="col-sm-6 col-xs-12">
                        <a href="{{route($variable.'.create')}}" class="btn btn-xs btn-success"><span class="fas fa-plus"></span> Nueva Entrada</a>
                    </div>-->
                    <div class="col-sm-6 col-xs-12">
                        @include('mensajes.successful')
                    </div>
                </div>
                <br>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                        <th>Fecha de Apertura</th>
                        <th>Monto de Apertura</th>
                        <th>Fecha de Cierre</th>
                        <th>Monto de Cierre</th>
                        <th>Movimientos</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($CajaOperaciones as $CajaOperacion)
                    <tr class="">
                        <td>{{fecha_a_espanol($CajaOperacion->cao_fecha_apertura)}}</td>
                        <td>{{$CajaOperacion->cao_monto_apertura}}</td>
                        <td>{{fecha_a_espanol($CajaOperacion->cao_fecha_cierre)}}</td>
                        <td>{{$CajaOperacion->cao_monto_cierre}}</td>
                        <td align="center"><a href="{{url($variable.'/'.$CajaOperacion->id.'/movimientos')}}" class="btn btn-sm btn-info"><span class="fas fa-list-ul"></span></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>

        </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection

@section('script_pie')
	
@endsection