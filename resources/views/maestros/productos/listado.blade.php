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
            <h1>Gestionar Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Listado de Productos</li>
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
                <h3 class="card-title">Listado de Productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <a href="{{route($variable.'.create')}}" class="btn btn-xs btn-success"><span class="fas fa-plus"></span> Nueva Entrada</a>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        @include('mensajes.successful')
                    </div>
                </div>
                <br>
                <div class="row">
                                {{--<div class="col-sm-2 col-xs-12">
                                   <button class="btn btn-sm btn-primary" id="btnSincronizar" name="btnSincronizar"><span class="glyphicon glyphicon-refresh"></span> Sincronizar con Sprinter</button>
                                </div>--}}

                                <div class="col-sm-12 col-xs-12">
                                    <form class="form form-horizontal" id="frm_nuevo" name="frm_nuevo" action="#" method="get">
                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                        <div class="col-sm-2 col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control" id="cbo_web" name="cbo_web">
                                                    {{--<option value="">- Se ve en Web -</option>--}}
                                                    <option value="1" @if($cbo_web=='1') selected="" @endif>SI</option>
                                                    <option value="0" @if($cbo_web=='0') selected="" @endif>NO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-xs-12">
                                            <div class="form-group">
                                            <select class="form-control" id="cbo_marca" name="cbo_marca">
                                                <option value="">-Marcas-</option>
                                                @foreach($marcas as $marca)
                                                    <option value="{{$marca->id}}" @if($marca->id==$cbo_marca) selected @endif>{{$marca->mar_nombre}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="txt_codigo" id="txt_codigo" placeholder="Código" value="{{$txt_codigo}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" name="txt_descripcion" id="txt_descripcion" placeholder="Descripción" value="{{$txt_descripcion}}" class="form-control">
                                            </div>
                                        </div>

                                        <input type="hidden" name="txt_tipo_proceso" id="txt_tipo_proceso" value="{{$tipoproceso}}">
                                        <div class="col-sm-3 col-xs-12" style="margin-top: 15px">
                                            <div class="form-group">
                                            <select class="form-control" id="cbo_categoria1" name="cbo_categoria1">
                                                <option value="">-TODOS-</option>
                                                @foreach($categorias as $categoria)
                                                    {{--<option value="{{$departamento->id}}" @if($departamento->id==$departamento_id) selected @endif>{{$departamento->departamento}}</option>--}}
                                                    <option value="{{$categoria->cat_codigo}}" @if($categoria->cat_codigo==$cbo_categoria1) selected @endif>{{$categoria->cat_descripcion}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-12" style="margin-top: 15px">
                                            <div class="form-group"> 
                                                <select class="form-control" id="cbo_categoria2" name="cbo_categoria2">
                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-12" style="margin-top: 15px">
                                            <div class="form-group">
                                                <select class="form-control" id="cbo_categoria3" name="cbo_categoria3">
                                            </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-1 col-xs-12" style="text-align: right;margin-top: 15px">
                                            <button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                                        </div>
                                        <div class="col-sm-2 col-xs-12" style="margin-top: 15px">
                                            <a href="{{route($variable.'.create')}}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Nueva Entrada</a>
                                            <br><br>
                                        </div>

                                    </form>
                                </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                
                    <table id="no-more-tables" class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Marca</th>
                                        <th>Descripción</th>
                                        <th>Categoría</th>
                                        <th>Mostrar en web</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productos as $producto)
                                    <tr class="">
                                        <td data-title="Código">{{$producto->pro_codigo}}</td>
                                        <td data-title="Marca">{{$producto->mar_nombre}}</td>
                                        <td data-title="Descripción">{{$producto->pro_descripcion}}</td>
                                        <td data-title="Categoría">{{$producto->categoria['cat_descripcion']}}</td>
                                        <td>
                                            @if($producto->pro_web==1)
                                            <input type="checkbox" data-render="switchery" data-theme="default" checked onchange="activa_btn({{$producto->id}})" />
                                            @else
                                            <input type="checkbox" data-render="switchery" data-theme="default" onchange="activa_btn({{$producto->id}})" />
                                            @endif
                                        </td>
                                        <td data-title="Editar" align="center"><a href="{{route($variable.'.edit',$producto->id)}}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
                                        <td data-title="Eliminar" align="center"><a href="{{route($variable.'.show',$producto->id)}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                        
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>



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


@endsection