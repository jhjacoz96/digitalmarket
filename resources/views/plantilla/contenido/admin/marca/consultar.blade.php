@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de marca:{{count($marca)}}</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Consultar</li>
            </ol>
        </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
      <!-- Main content -->
      <section class="content">


        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="p-2">
                  @include('flash::message')
               </div>

                <div class="card-header">
                  <h3 class="card-title">Consultar marca</h3>
  
                  <div class="card-tools">

                    <form >
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar"
                      value="{{request()->get('nombre')}}"
                        >
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </form>

                    </div>
                  </div>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body ">
                  <div  class="table-responsive p-0">
                    <table id="table_id" class="display">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Logo</th>
                          <th>Nombre</th>
                          <th>Descripción</th>
                    
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($marca as $item)
                             
                         <tr>
                         <td class="mailbox-star">{{$item->id}}</td>
                         <td class="mailbox-star">
                          @if($item->imagen==null)
                            <img style="height:100px; width:100px; border-radius:10px;" src="/imagenes/avatar.png">
                           @else
                           <img style="height:100px; width:150px; border-radius:10px;" src="{{$item->imagen->url}}">
                          @endif        
                       </td>
                        <td class="mailbox-star">{{$item->nombre}}</td>
                        <td class="mailbox-star">{{$item->descripcion}}</td>
                      
                           
  
                             <td class="mailbox-star">
                                 <div class="btn-group">
                                 
  
                                 <a href="{{route('marca.edit',$item)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>
  
                                     
                                     
                                     <form action="{{route('marca.destroy',$item)}}" method="POST">
                                         @method('DELETE')
                                         @csrf
                                         <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este marca?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                       </form>
                                     
                                     
                                   
                                 </div>
                             </td>
                         </tr>
                         @endforeach
                              
                          
                      
                       
                      </tbody>
                    </table>
                  </div>
                  
                  <div class="box-footer p-3 float-right">
                  <a href=" {{route('marca.create')}}"  class="btn  btn-info ">Agregar marca</a>
            
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->


      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection