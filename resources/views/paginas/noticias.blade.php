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

          <div class="card">
         
            <div class="card-header">

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearNoticias">Crear nueva noticia</button>

            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive" width="100%" id="tablaNoticias">
                
                <thead>

                  <tr>
                    
                    <th>#</th>
                    <th>Titulo</th>
                    <th width="50px">Foto</th>
                    <th>Descripcion</th>

                  </tr>              

                </thead>

                <tbody>

                 {{--  @foreach ($noticias as $key => $value ?? '')
                  
                    <tr>
                     
                      <td>{{($key+1)}}</td> 
                      <td>{{($value ?? 'titulo')}}</td>  

                      {{-- @php

                        if($value ?? 'foto' == ""){

                          echo '<td><img src="'.url('/').'/img/noticias/foto.png" class="img-fluid rounded-circle"></td>';

                        }else{


                          echo '<td><img src="'.url('/').'/'.$value ?? 'foto'.'" class="img-fluid rounded-circle"></td>';

                        }
                       
                      @endphp

                      <td>
                        <div class="btn-group">
                          
                          <a href="{{url('/')}}/noticias/{{$value ?? 'id'}}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt text-white"></i>
                          </a>

                          <button class="btn btn-danger btn-sm eliminarNoticias" action="{{url('/')}}/noticias/{{$value ?? 'id'}}" method="DELETE" pagina="noticias">
                            @csrf 
                            <i class="fas fa-trash-alt"></i>

                          </button>

                          <form method="post" action="{{url('/')}}/noticias/{{$value ?? 'id'}}"> 

                            <input type="hidden" name="_method" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          
                          </form>

                        </div> 

                      </td> 

                    </tr>

                  --}}
                  
                </tbody>

              </table>

            </div>

            <div class="card-footer">


            </div>

             <!-- /.card-footer-->

          </div>
          <!-- /.card -->

        </div>

      </div>

    </div>

  </section>

  <!-- /.content -->

</div>

<div class="modal" id="crearNoticias">

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

              <p class="help-block small">Dimensiones: 1024px * 576px | Peso Max. 2MB | Formato: JPG o PNG</p>
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

@if (isset($status))

  @if ($status == 200)
   
    @foreach ($noticias as $key => $value)
      
      <div class="modal" id="editarNoticias">
       
        <div class="modal-dialog">
         
          <div class="modal-content">

            <form method="POST" action="{{url('/')}}/noticias/{{$value["id"]}}" enctype="multipart/form-data">

              @method('PUT')
              @csrf
            
              <div class="modal-header bg-info">
                
                <h4 class="modal-title">Editar Noticias</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>

              <div class="modal-body">

                  {{-- Titulo --}}

                  <div class="input-group mb-3">
                    
                    <div class="input-group-append input-group-text">               
                       <i class="fas fa-user"></i>
                    </div>

                    <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ $value["titulo"] }}" required autocomplete="titulo" autofocus placeholder="Titulo">

                    @error('titulo')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>
                  
                  {{-- Foto --}}
                  <hr class="pb-2">

                  <div class="form-group my-2 text-center">
                  
                    <div class="btn btn-default btn-file">
                      
                      <i class="fas fa-paperclip"></i> Adjuntar Foto

                      <input type="file" name="foto">

                    </div> 

                    <br>

                    @if ($value["foto"] == "")

                     <img src="{{url('/')}}/img/noticias/foto.png" class="previsualizarImg_foto img-fluid py-2 w-25 rounded-circle">
                      
                    @else 

                     <img src="{{url('/')}}/{{$value["foto"]}}" class="previsualizarImg_foto img-fluid py-2 w-25 rounded-circle">

                    @endif

                    <input type="hidden" value="{{$value["foto"]}}" name="foto_actual">

                    <p class="help-block small">Dimensiones: 200px * 200px | Peso Max. 2MB | Formato: JPG o PNG</p>

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

    <script>
  
     $("#editarNoticias").modal();

    </script>

    @else

    {{$status}}

  @endif
 
@endif

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
    text: '¡Error en el gestor de la noticia!',
    time: 7

  })

</script>

@endif

@if (Session::has("ok-editar"))

<script>
  
  notie.alert({

    type: 1,
    text: '¡La noticia ha sido actualizada correctamente!',
    time: 7

  })

</script>

@endif

@if (Session::has("ok-eliminar"))

  <script>
    notie.alert({ type: 1, text: '¡La noticia ha sido eliminado correctamente!', time: 10 })
 </script>

@endif

@if (Session::has("no-borrar"))

  <script>
    notie.alert({ type: 2, text: '¡Esta noticia no se puede borrar!', time: 10 })
 </script>

@endif

@endsection

@else

<script>window.location="{{url('/noticias')}}"</script>