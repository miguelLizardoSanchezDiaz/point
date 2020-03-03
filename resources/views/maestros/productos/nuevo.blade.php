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
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Nuevo Producto</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    
                    <div class="col-sm-6 col-xs-12">
                        @include('mensajes.successful')
                    </div>
                </div>
                

                <div class="col-sm-12 col-xs-12">
                
                <form role="form">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Código</label>
                        <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" placeholder="Código">
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" placeholder="Descripción" id="txt_descripcion" name="txt_descripcion">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Categoría</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-filter"></i></span>
                          </div>
                          <input type="text" class="form-control" id="txt_categoria" name="txt_categoria" placeholder="Buscar por código o descripción...">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Tipo de producto</label>
                        <select class="custom-select">
                          <option value="M">Mercadería</option>
                          <option value="S">Servicio</option>
                        </select>
                      </div>
                      </div>
                    
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Peso</label>
                        <input type="number" class="form-control" placeholder="Peso">
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Volumen</label>
                        <input type="number" class="form-control" placeholder="Volumen">
                      </div>
                    </div>
                    
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Unidad de Medida</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-filter"></i></span>
                          </div>
                          <input type="text" class="form-control" id="txt_marca" name="txt_marca" placeholder="Buscar por código o descripción...">
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Marca</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-filter"></i></span>
                          </div>
                          <input type="text" class="form-control" id="txt_marca" name="txt_marca" placeholder="Buscar por código o descripción...">
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Modelo</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-filter"></i></span>
                          </div>
                          <input type="text" class="form-control" id="txt_modelo" name="txt_modelo" placeholder="Buscar por código o descripción...">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Otras características</label>
                        <textarea class="form-control" rows="3" placeholder="Ingresar"></textarea>
                      </div>
                    </div>
                  </div>

                  
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