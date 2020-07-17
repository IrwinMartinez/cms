@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 247px;">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Noticiario</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>

            <li class="breadcrumb-item active">Noticiario</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-12">

          <!-- Default box -->
          <div class="card">

            <div class="card-header">

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearnoticiario">Crear nueva noticia</button>

            </div>

            <div class="card-body">

              {{--   @foreach ($noticiario as $element)
                {{ $element }}
              @endforeach --}}

              <table class="table table-bordered table-striped dt-responsive" id="tablaNoticiario" width="100%">
              
                <thead>
                  
                  <tr>
                    
                    <th width="10px">#</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th width="200px">Imagen</th>

                  </tr>


                </thead>

                <tbody>
                  

                </tbody>  

              </table>

            </div>

            <!-- /.card-body -->
        
          </div>
          <!-- /.card -->
        </div>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>

<!--=====================================
Crear Noticiario
======================================-->
<div class="modal" id="crearNoticiario">

  <div class="modal-dialog">

    <div class="modal-content">

      <form action="{{url('/')}}/noticiario" method="post" enctype="multipart/form-data">

       @csrf
        
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Noticia</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">
          
           {{-- Título noticiario --}}

           <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <input type="text" class="form-control" name="titulo_noticiario" placeholder="Ingrese el título de la noticia" value="{{old("titulo_noticiario")}}" required> 

          </div> 

          {{-- Descripción de la notica --}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>

            <input type="text" class="form-control" name="descripcion_noticiario" placeholder="Ingrese la descripción de la noticia" value="{{old("descripcion_noticiario")}}" maxlength="30" required> 

          </div> 

          {{-- Imagen de la Noticia --}}

          <hr class="pb-2">

          <div class="form-group my-2 text-center">
            
              <div class="btn btn-default btn-file">
               
                <i class="fas fa-paperclip"></i> Adjuntar Imagen de la Noticia
              
                <input type="file" name="img_noticiario" required>

              </div>

              <img class="previsualizarImg_img_noticiario img-fluid py-2">

              <p class="help-block small">Dimensiones: 1024px * 250px | Peso Max. 2MB | Formato: JPG o PNG</p>
          </div>

        </div>

        <div class="modal-footer d-flex justify-content-between">
          
          <div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

          <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>

        </div>

      </form>

    </div>
    
  </div>

</div>

<!--=====================================
Editar Noticiario
======================================-->

@if (isset($status))

  @if ($status == 200)

    @foreach ($noticiario as $key => $value)
  
      <div class="modal" id="editarNoticiario">

        <div class="modal-dialog">

          <div class="modal-content">

            <form action="{{url('/')}}/noticiario/{{$value->id_categoria}}" method="post" enctype="multipart/form-data">

              @method('PUT')

              @csrf
              
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Noticiario</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>

              <div class="modal-body">
                
                {{-- Título de la noticia --}}

                <div class="input-group mb-3">

                  <div class="input-group-append input-group-text">
                    <i class="fas fa-list-ul"></i>
                  </div>

                  <input type="text" class="form-control" name="titulo_noticiario" placeholder="Ingrese el título de la noticia" value="{{$value->titulo_noticiario}}" required> 

                </div> 

                {{-- Descripción Noticia --}}

                <div class="input-group mb-3">
           
                  <div class="input-group-append input-group-text">
                    <i class="fas fa-pencil-alt"></i>
                  </div>

                  <input type="text" class="form-control" name="descripcion_noticiario" placeholder="Ingrese la descripción de la noticia" value="{{$value->descripcion_noticiario}}" maxlength="30" required> 

                </div> 

                {{-- Imagen de la Noticia --}}

                <hr class="pb-2">

                <div class="form-group my-2 text-center">
                  
                  <div class="btn btn-default btn-file">
                     
                    <i class="fas fa-paperclip"></i> Adjuntar Imagen de la Noticia
                    
                    <input type="file" name="img_noticiario">

                  </div>

                  <img src="{{url('/')}}/{{$value->img_noticiario}}" class="previsualizarImg_img_noticiario img-fluid py-2">

                  <input type="hidden" value="{{$value->img_noticiario}}" name="img_actual">

                  <p class="help-block small">Dimensiones: 1024px * 250px | Peso Max. 2MB | Formato: JPG o PNG</p>
                </div>

              </div>

              <div class="modal-footer d-flex justify-content-between">
                
                <div>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

                <div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

              </div>

            </form>

          </div>
          
        </div>

      </div>

    @endforeach

    <script>$("#editarNoticiario").modal()</script>

  @endif

@endif

@if (Session::has("ok-crear"))

  <script>
      notie.alert({ type: 1, text: '¡La noticia ha sido creada correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-validacion"))

  <script>
      notie.alert({ type: 2, text: '¡Hay campos no válidos en el formulario!', time: 10 })
 </script>

@endif

@if (Session::has("error"))

  <script>
      notie.alert({ type: 3, text: '¡Error en el gestor de noticias!', time: 10 })
 </script>

@endif

@if (Session::has("ok-editar"))

  <script>
      notie.alert({ type: 1, text: '¡La noticia ha sido actualizada correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-borrar"))

  <script>
      notie.alert({ type: 3, text: '¡Error al borrar la noticia!', time: 10 })
 </script>

@endif

@endsection