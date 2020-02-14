@extends('layouts.app')

@section('script_cabecera')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar Roles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Nuevo Rol</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Nuevo Rol</h3>
              </div>

              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <a href="{{url($variable)}}" class="btn btn-sm btn-danger"><span class="fas fa-chevron-left"></span> Atras</a>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        @include('errors.errores')
                    </div>
                </div>
                
                <div class="row">
                    <form class="col-sm-12 col-xs-12" method="POST" action="{{url($variable)}}" accept-charset="UTF-8" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Descripción (*)</label>
                                        {!! Form::text('txt_descripcion',null,['class' => 'form-control','id'=>'txt_descripcion', 'maxlength'=>'250','placeholder'=>'Ingrese Descripción']) !!}
                                    </div>
                                    <div class="form-group">
                                    <label>(*) Campos Obligatorios</label>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary m-r-5"><span class="glyphicon glyphicon-save"></span> Registrar</button>
                                    <a href="{{url($variable)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
                                </fieldset>
                            </form>
                </div>
               
              </div>

            </div>

          </div>

        </div>
        
      </div>
    </section>
  </div>


@endsection

@section('script_pie')

@endsection