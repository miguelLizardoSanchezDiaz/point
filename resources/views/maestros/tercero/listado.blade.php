@extends('layouts.app')

@section('script_cabecera')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
{!! Html::style('/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') !!}
{!! Html::style('/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

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
                <h3 class="card-title">Listado de Terceros</h3>
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
                    @foreach($terceros as $tercero)
                    <tr class="">
                        <td>{{$tercero->ter_descripcion}}</td>
                        <td>{{$tercero->ter_nombre_comercial}}</td>
                        <td>{{$tercero->ter_codigo}}</td>
                        <td align="center"><a href="{{route($variable.'.edit',$tercero->id)}}" class="btn btn-sm btn-primary"><span class="fas fa-edit"></span></a></td>
                        <td align="center"><a href="{{route($variable.'.show',$tercero->id)}}" class="btn btn-sm btn-danger"><span class="fas fa-trash-alt"></span></a></td>
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