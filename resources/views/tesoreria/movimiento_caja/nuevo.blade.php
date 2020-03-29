@extends('layouts.app')

@section('script_cabecera')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar Movimientos de Cajas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Movimiento de Caja</li>
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
                <h3 class="card-title">Movimiento de Caja</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <a href="{{url('/home')}}" class="btn btn-sm btn-danger"><span class="fas fa-chevron-left"></span> Atras</a>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        @include('errors.errores')
                    </div>

                    <form id="frm_nuevo" name="frm_nuevo" class="col-sm-12 col-xs-12" method="POST" action="{{url($variable)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                        </br>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Caja (*)</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="cbo_caja" name="cbo_caja" placeholder="Seleccione Caja">
                                        @foreach($cajas as $caja)
                                            <option value="{{$caja->id}}">{{$caja->caj_codigo}} | {{$caja->caj_descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tipo Operación (*)</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="cbo_operacion" name="cbo_operacion" placeholder="Seleccione Operación">
                                        @foreach($tiposOperacion as $tipoOperacion)
                                            <option value="{{$tipoOperacion->id}}">{{$tipoOperacion->tio_codigo}} | {{$tipoOperacion->tio_descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Movimiento (*)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="txt_fecha" name="txt_fecha" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="{{$fecha_hoy}}" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Monto Operación (*)</label>
                                    <input type="number" class="form-control" name="txt_monto" id="txt_monto">
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Forma Pago (*)</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="cbo_formapago" name="cbo_formapago" placeholder="Seleccione Forma Pago">
                                        @foreach($formasPago as $formaPago)
                                            <option value="{{$formaPago->id}}">{{$formaPago->fop_codigo}} | {{$formaPago->fop_descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Observaciones:</label>
                                    <textarea class="form-control" rows="3" name="txt_observaciones" id="txt_observaciones" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>(*) Campos Obligatorios</label>
                        </div>
                        <button type="button" id="btn_grabar" class="btn btn-sm btn-primary m-r-5"><span class="glyphicon glyphicon-save"></span> Registrar</button>
                        <a href="{{url($variable)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
                        </fieldset>
                    </form>

                </div>
               
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
    {!! Html::script('/js/tesoreria/movimientoCaja.js') !!}
@endsection