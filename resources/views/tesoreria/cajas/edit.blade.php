@extends('layouts.app')

@section('script_cabecera')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar Cajas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Editar Caja</li>
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
                <h3 class="card-title">Editar Caja</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <a href="{{url($variable)}}" class="btn btn-sm btn-danger"><span class="fas fa-chevron-left"></span> Atras</a>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        @include('errors.errores')
                    </div>

                    <form id="frm_nuevo" name="frm_nuevo" class="col-sm-12 col-xs-12" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                        <input type="hidden" id="txt_id_registro" name="txt_id_registro" autocomplete="off" value="{{$caja->id}}">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Código (*)</label>
                                    {!! Form::text('txt_codigo',$caja->caj_codigo,['class' => 'form-control','id'=>'txt_codigo', 'disabled'=>'disabled', 'maxlength'=>'250','placeholder'=>'Ingrese código']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción (*)</label>
                                    {!! Form::text('txt_descripcion',$caja->caj_descripcion,['class' => 'form-control','id'=>'txt_descripcion', 'maxlength'=>'250','placeholder'=>'Ingrese descripción']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Punto Venta</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="cbo_punto" name="cbo_punto">
                                        @foreach($puntoVentas as $punto)
                                            <option value="{{$punto->id}}">{{$punto->pto_descripcion}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="txt_punto_id" id="txt_punto_id" value="{{$caja->pto_id}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>(*) Campos Obligatorios</label>
                        </div>
                        <button type="button" id="btn_guardar2" class="btn btn-sm btn-primary m-r-5"><span class="glyphicon glyphicon-save"></span> Registrar</button>
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
    {!! Html::script('/js/tesoreria/caja.js') !!}
@endsection