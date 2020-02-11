@extends('layouts.app')

@section('script_cabecera')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
{!! Html::style('/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') !!}
{!! Html::style('/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')
<!--<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Configuración</a></li>
		<li><a href="javascript:;">Usuarios</a></li>
		<li class="active">Listado</li>
	</ol>

	<h1 class="page-header">Gestión de Usuarios </h1>

	<div class="row">
		<div class="col-md-12">
			        
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Listado</h4>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                        	   <div class="col-sm-6 col-xs-12">
                            	   <a href="{{route($variable.'.create')}}" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> Nueva Entrada</a>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    @include('mensajes.successful')
                                </div>
                            </div>
                            <br>
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($usuarios as $usuario)
                                    <tr class="">
                                        <td>{{$usuario->name}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>{{$usuario->rol['rol_descripcion']}}</td>
                                        <td align="center"><a href="{{route($variable.'.edit',$usuario->id)}}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>
                                        <td align="center"><a href="{{route($variable.'.show',$usuario->id)}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                        
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
	</div>
</div>-->


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestionar Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Listado</li>
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
                <h3 class="card-title">Listado de Usuarios</h3>
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
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($usuarios as $usuario)
                    <tr class="">
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->rol['rol_descripcion']}}</td>
                        <td align="center"><a href="{{route($variable.'.edit',$usuario->id)}}" class="btn btn-sm btn-primary"><span class="fas fa-edit"></span></a></td>
                        <td align="center"><a href="{{route($variable.'.show',$usuario->id)}}" class="btn btn-sm btn-danger"><span class="fas fa-trash-alt"></span></a></td>
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
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    {!! Html::script('/assets/plugins/DataTables/media/js/jquery.dataTables.js') !!}
    {!! Html::script('/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') !!}
    {!! Html::script('/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') !!}
    {!! Html::script('/assets/js/table-manage-default.demo.min.js') !!}
    {!! Html::script('/assets/js/apps.min.js') !!}
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script type="text/javascript">
		$(document).ready(function() {
			TableManageDefault.init();
		});
	</script>
@endsection