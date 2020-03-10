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
              <li class="breadcrumb-item active">Editar Producto</li>
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
                <h3 class="card-title">Editar Producto</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    
                    <div class="col-sm-6 col-xs-12">
                        @include('mensajes.successful')
                    </div>
                </div>
                

                

                  
                            <a href="{{url($variable)}}" class="btn btn-sm btn-danger"><span class="fas fa-chevron-left"></span> Atrás</a>
                            <br>
                            
                            
                                
                            <center>
                                <h4>Está a punto de eliminar el siguiente registro</b></h4>
                                <h4>¿Realmente desea eliminar este registro?</h4>
                                <h3>{{$producto->pro_descripcion}}</h3>
                                {!!Form::open(['route'=> [$variable.'.destroy', $producto], 'method'=>'DELETE'])!!}
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <center><div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href="{{url($variable)}}" class="btn btn-sm btn-danger"> Cancelar</a>
                                            <button type="submit" class="btn btn-sm btn-primary"> Eliminar </button>
                                        </div>
                                    </div></center>
                                {!!Form::close()!!}
                                
                            </center>


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

{!! Html::script('/js/maestros/productos.js') !!}

@endsection