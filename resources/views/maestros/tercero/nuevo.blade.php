@extends('layouts.app')

@section('script_cabecera')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar Terceros</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Nuevo Tercero</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Nuevo Tercero</h3>
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

                    <form id="frm_tercero" class="col-sm-12 col-xs-12" method="POST" action="{{url($variable)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Documnto Identidad</label>
                                        <select class="form-control" id="cbo_documento" name="cbo_documento" onchange="validar_persona_empresa()">
                                            @foreach($documentosidentidad as $documento)
                                                <option value="{{$documento->id}}">{{$documento->doi_descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Código (*)</label>
                                        {!! Form::text('txt_codigo',null,['class' => 'form-control','id'=>'txt_codigo', 'maxlength'=>'250','placeholder'=>'Ingrese codigo']) !!}
                                    </div>
                            </div>
                        </div>
                        <div id="empresa">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Razon Social (*)</label>
                                            {!! Form::text('txt_razonsocial',null,['class' => 'form-control','id'=>'txt_razonsocial', 'maxlength'=>'250','placeholder'=>'Ingrese razón social']) !!}
                                        </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre Comercial (*)</label>
                                            {!! Form::text('txt_nombreComercial',null,['class' => 'form-control','id'=>'txt_nombreComercial', 'maxlength'=>'250','placeholder'=>'Ingrese nombre comercial']) !!}
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pagina Web</label>
                                            {!! Form::text('txt_web',null,['class' => 'form-control','id'=>'txt_web', 'maxlength'=>'250','placeholder'=>'Ingrese pagina web']) !!}
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div id="persona">
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombres (*)</label>
                                            {!! Form::text('txt_nombre',null,['class' => 'form-control','id'=>'txt_nombre', 'maxlength'=>'250','placeholder'=>'Ingrese nombre']) !!}
                                        </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellido Paterno (*)</label>
                                            {!! Form::text('txt_apellidopaterno',null,['class' => 'form-control','id'=>'txt_apellidopaterno', 'maxlength'=>'250','placeholder'=>'Ingrese apellido paterno']) !!}
                                        </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellido Materno (*)</label>
                                            {!! Form::text('txt_apellidomaterno',null,['class' => 'form-control','id'=>'txt_apellidomaterno', 'maxlength'=>'250','placeholder'=>'Ingrese apellido materno']) !!}
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha Nacimiento (*)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="txt_nacimiento" name="txt_nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tipo tercero (*)</label>
                                        <select class="form-control" id="cbo_tipo" name="cbo_tipo">
                                            @foreach($tipostercero as $tipo)
                                                <option value="{{$tipo->id}}">{{$tipo->tit_descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Telefono</label>
                                            {!! Form::text('txt_telefono',null,['class' => 'form-control','id'=>'txt_telefono', 'maxlength'=>'250','placeholder'=>'Ingrese telefono']) !!}
                                    </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ubigeo</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="cbo_ubigeo" name="cbo_ubigeo">
                                            @foreach($ubigeos as $ubigeo)
                                                <option value="{{$ubigeo->id}}">{{$ubigeo->ubi_descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">            
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Dirección (*)</label>
                                            {!! Form::text('txt_direccion',null,['class' => 'form-control','id'=>'txt_direccion', 'maxlength'=>'250','placeholder'=>'Ingrese dirección']) !!}
                                    </div>
                            </div>
                        </div>
                                    <div class="form-group">
                                    <label>(*) Campos Obligatorios</label>
                                    </div>
                                    <button type="submit" id="btn_guardar" class="btn btn-sm btn-primary m-r-5"><span class="glyphicon glyphicon-save"></span> Registrar</button>
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
    {!! Html::script('/js/maestros/tercero.js') !!}
@endsection