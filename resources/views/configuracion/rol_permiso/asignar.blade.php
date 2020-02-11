@extends('layouts.app')

@section('script_cabecera')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestión de permisos por rol</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Asignar permisos</li>
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
                <h3 class="card-title">Asignar</h3>
              </div>

              <div class="card-body">
                
                      <form id="form_asignar" name="form_asignar" method="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">                    
                          <div class="form-group">
                              <label class="">Seleccionar el Rol: <span>(*)</span></label>
                              <div class="">                    
                                <select class="form-control" id="cbo_rol" name="cbo_rol" onChange="ver_lista_asignados(),ver_lista_no_asignados()">
                                  {{--<option value="0">-SELECCIONE ROL-</option>--}}
                                  @foreach($roles as $rol)
                                  <option value="{{$rol->id}}">{{$rol->rol_descripcion}}</option>
                                  @endforeach
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="cbo_rol">Permisos asignados</label>
                              <div id="div_permisos_asignados">
                                
                              </div>
                          </div>

                          <div class="form-group">
                            <button type="button" onclick="asignar_permiso();" name="cmd_asignar" id="cmd_asignar" class="btn btn-success">
                              <span class="fas fa-arrow-up"></span><br />Asignar permiso
                            </button>
                                    
                              <button type="button" onclick="quitar_permiso();" name="cmd_quitar" id="cmd_quitar" class="btn btn-primary">
                              Quitar permiso<br /><span class="fas fa-arrow-down"></span>
                            </button>
                          </div>

                          <div class="form-group">
                            <label for="cbo_rol">Permisos no asignados</label>
                            <div id="div_permisos_no_asignados">
                            </div>
                          </div>

                        </form>
               
              </div>

            </div>

          </div>

        </div>
        
      </div>
    </section>
  </div>


@endsection

@section('script_pie')
  {!! Html::script('/js/rol_permiso.js') !!}
@endsection