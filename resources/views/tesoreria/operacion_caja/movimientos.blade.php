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
                    <div class="col-sm-12 col-xs-12">
                        <a href="{{url($variable)}}" class="btn btn-sm btn-danger"><span class="fas fa-chevron-left"></span> Atras</a>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        @include('mensajes.successful')
                    </div>
                </div>
                <br>
                <div class="card card-secondary">
                  <div class="card-header">
                      <h3 class="card-title">Totales</h3>
                  </div>
                  <div class="card-body">
                    @foreach($montosSaldo as $montoSaldo)
                      <div class="row">
                          <div class="col-sm-4 col-xs-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">INGRESOS EN {{$montoSaldo->fop_descripcion}}:</label>
                                  <div class="color-palette-set">
                                      <div class="bg-primary color-palette"><label>{{$montoSaldo->monto_entrada}}</label></div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">EGRESOS EN {{$montoSaldo->fop_descripcion}}:</label>
                                  <div class="color-palette-set">
                                      <div class="bg-warning color-palette"><label>{{$montoSaldo->monto_salida}}</label></div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">SALDOS EN {{$montoSaldo->fop_descripcion}}:</label>
                                  <div class="color-palette-set">
                                      <div class="bg-success color-palette"><label>{{$montoSaldo->monto_saldo}}</label></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                  </div>
                </div>
                <br>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha Movimiento</th>
                        <th>Forma Pago</th>
                        <th>Tipo Operación</th>
                        <th>Monto Ingreso</th>
                        <th>Monto Egreso</th>
                        <th>Referencia</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($CajaMovimientos as $CajaMovimiento)
                    <tr class="">
                        @if($CajaMovimiento->tipooperacion['tio_tipo']=='I')
                          <td>INGRESO</td>
                        @else
                          <td>EGRESO</td>
                        @endif
                        <td>{{fecha_a_espanol($CajaMovimiento->cam_fecha)}}</td>
                        <td>{{$CajaMovimiento->formapago['fop_descripcion']}}</td>
                        <td>{{$CajaMovimiento->tipooperacion['tio_descripcion']}}</td>
                        <td>{{$CajaMovimiento->cam_monto_entrada}}</td>
                        <td>{{$CajaMovimiento->cam_monto_salida}}</td>
                        @if($CajaMovimiento->cam_monto_salida==1)
                          <td>{{$CajaMovimiento->cam_referencia_id}}</td>
                        @else
                          <td></td>
                        @endif
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