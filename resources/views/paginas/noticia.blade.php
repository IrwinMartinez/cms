@extends('plantilla')

@section('content')

<div class="content-wrapper" style="min-height: 547px;">

  <section class="content-header">

    <div class="container-fluid">
       
      <div class="row mb-2">
         
        <div class="col-sm-6">
          
          <h1>Noticias</h1>
          
        </div>
          
        <div class="col-sm-6">
          
          <ol class="breadcrumb float-sm-right">
          
            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
          
            <li class="breadcrumb-item active">Noticias</li>
          
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

          @foreach ($noticias as $element)

          @endforeach

          <form action="{{url('/')}}/noticias/{{$element->id}}" method="post" enctype="multipart/form-data">

          @method('PUT')

          @csrf

          <div class="card">
         
            <div class="card-header">

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearNoticias">Crear nueva noticia</button>


             </div>

              <div class="card-body">

                {{-- Título  --}}

                <div class="input-group mb-3">
                            
                  <div class="input-group-append">
                              
                    <span class="input-group-text">Título</span>

                  </div>

                  <input type="text" class="form-control" name="titulo" value="{{ $element->titulo}}" required>

                </div>


                {{-- Cambiar Foto de la notica --}}

                <div class="form-group my-2 text-center">
                              
                 <div class="btn btn-default btn-file mb-3">
                                
                    <i class="fas fa-paperclip"></i> Adjuntar Foto 

                    <input type="file" name="foto">

                    <input type="hidden" name="foto_actual" value="{{$element->foto}}" required>

                  </div>

                  <br>

                  <img src="{{url('/')}}/{{$element->foto}}" class="img-fluid py-2 bg-secondary previsualizarImg_foto">

                  <p class="help-block small mt-3">Dimensiones: 1024px * 576px | Peso Max. 2MB | Formato: JPG o PNG</p>

                </div>

                <hr class="pb-2">
                {{-- Cambiada Foto de la noticia --}}


                {{-- Descripción  --}}

                <div class="input-group mb-3">
                            
                  <div class="input-group-append">
                              
                    <span class="input-group-text">Descripción</span>

                  </div>

                  <textarea class="form-control" rows="5" name="descripcion" required>{{$element->descripcion}}</textarea>

                </div>

                <hr class="pb-2">

             </div>

             <div class="card-footer">


             </div>

             <!-- /.card-footer-->

           </div>

           <!-- /.card -->
          
          </form>

        </div>

       </div>

    </div>

  </section>

  <!-- /.content -->

</div>

<div class="modal" id="crearNoticas">

  <div class="modal-dialog">

    <div class="modal-content">

      <form action="{{url('/')}}/noticias" method="post" enctype="multipart/form-data">

       @csrf
        
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Noticia</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">
          
           {{-- Título noticia --}}

           <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              <i class="fas fa-list-ul"></i>
            </div>

            <input type="text" class="form-control" name="titulo" placeholder="Ingrese el título de la noticia" value="{{old("titulo")}}" required> 

          </div> 

          {{-- Descripción noticia --}}

          <div class="input-group mb-3">
     
            <div class="input-group-append input-group-text">
              <i class="fas fa-pencil-alt"></i>
            </div>

            <input type="text" class="form-control" name="descripcion" placeholder="Ingrese la descripción de la noticia" value="{{old("descripcion")}}" maxlength="30" required> 

          </div> 

          {{-- Imagen de portada --}}

          <hr class="pb-2">

          <div class="form-group my-2 text-center">
            
              <div class="btn btn-default btn-file">
               
                <i class="fas fa-paperclip"></i> Adjuntar Imagen de la noticia
              
                <input type="file" name="foto" required>

              </div>

              <img class="previsualizarImg_foto img-fluid py-2">

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

<div class="modal" id="crearNoticias">

  <div class="modal-dialog">

    <div class="modal-content">
        
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Crear Noticia</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

        </div>

        <div class="modal-footer">

        </div>

    </div>
    
  </div>

</div>

@if (Session::has("no-validacion"))

<script>
  
  notie.alert({

    type: 2,
    text: '¡Hay campos no válidos en el formulario!',
    time: 7

  })

</script>

@endif

@if (Session::has("error"))

<script>
  
  notie.alert({

    type: 3,
    text: '¡Error en el gestor de blog!',
    time: 7

  })

</script>

@endif

@if (Session::has("ok-editar"))

<script>
  
  notie.alert({

    type: 1,
    text: '¡El blog ha sido actualizado correctamente!',
    time: 7

  })

</script>

@endif

@endsection