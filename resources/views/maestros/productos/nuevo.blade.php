@extends('layouts.app')

@section('script_cabecera')
{!! Html::style('dropzone/dropzone.css') !!}

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
              <li class="breadcrumb-item active">Nuevo Producto</li>
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
                <h3 class="card-title">Nuevo Productos</h3>
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

                <div class="col-sm-12 col-xs-12">
                
                  
                

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

{!! Html::script('/dropzone/dropzone.js') !!}
{!! Html::script('/twitter-bootstrap-wizard-master/jquery.bootstrap.wizard.js') !!}
{!! Html::script('/js/productos.js') !!}

<script type="text/javascript">
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 10,
            addRemoveLinks: true, 
            
            init: function() {

                var submitBtn = document.querySelector("#submit");
                myDropzone = this;
                
                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                var aux=0;
                this.on("addedfile", function(file) {
                    aux++;
                });
                
                var aux2=0;
                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                    aux2++;
                    if(aux2==aux){
                      alert("La operación se realizó con éxito");
                      var url = ip+"/productos"; 
                      $(location).attr('href',url);
                    }
                    //console.log(file)
                });
 
                this.on("success", 
                    myDropzone.processQueue.bind(myDropzone)
                );
            }
        };
</script>

@endsection