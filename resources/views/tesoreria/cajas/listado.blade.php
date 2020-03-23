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
            <h1>Gestionar Cajas</h1>
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
                <h3 class="card-title">Listado de Cajas</h3>
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
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Punto Venta</th>
                        <th>Editar</th>
                        <th>Activar / Desactivar</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cajas as $caja)
                    <tr class="">
                        <td>{{$caja->caj_codigo}}</td>
                        <td>{{$caja->caj_descripcion}}</td>
                        <td>{{$caja->caj_descripcion}}</td>
                        <td align="center"><a href="{{route($variable.'.edit',$caja->id)}}" class="btn btn-sm btn-primary"><span class="fas fa-edit"></span></a></td>
                        @if($caja->caj_estado==1)
                        <td align="center"><a href="{{route($variable.'.show',$caja->id)}}" class="btn btn-sm btn-danger"><span class="fas fa-times"></span></a></td>
                        @else
                        <td align="center"><a href="{{route($variable.'.show',$caja->id)}}" class="btn btn-sm btn-success"><span class="fas fa-check"></span></a></td>
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