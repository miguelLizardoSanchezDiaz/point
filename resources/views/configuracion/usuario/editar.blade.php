@extends('layouts.app')

@section('script_cabecera')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Editar Usuario</li>
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
                <h3 class="card-title">Editar Usuarios</h3>
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
                            <div class="col-sm-12 col-xs-12">
                                
                                {!!Form::model($usuario, ['route'=> ['usuario.update', $usuario ], 'method'=>'PUT', 'class'=>'','files' => true])!!}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <fieldset>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Usuario</label>
                                        {!! Form::text('email',$usuario->email,['class' => 'form-control','id'=>'email', 'maxlength'=>'250','placeholder'=>'Ingrese usuario','readonly'=>'readonly']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombres(*)</label>
                                        {!! Form::text('txt_nombre',$usuario->name,['class' => 'form-control','id'=>'txt_nombre', 'maxlength'=>'250','placeholder'=>'Ingrese nombre']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Rol</label>
                                        <select class="form-control" id="cbo_rol" name="cbo_rol">
                                            @foreach($roles as $rol)
                                                <option value="{{$rol->id}}" @if($usuario->rol_id==$rol->id) selected @endif>{{$rol->rol_descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Contraseña</label>
                                        <input type="password" class="form-control" name="txt_contraseña1" id="txt_contraseña1" maxlength="25" placeholder="****************" value="123456">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Repita Contraseña</label>
                                        <input type="password" class="form-control" name="txt_contraseña2" id="txt_contraseña2" maxlength="25" placeholder="****************" value="123456">
                                    </div>
                                    <div class="form-group">
                                    <label>(*) Campos Obligatorios</label>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary m-r-5"><span class="glyphicon glyphicon-save"></span> Registrar</button>
                                    <a href="{{url($variable)}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
                                </fieldset>
                                {!!Form::close()!!}
                            </div>

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