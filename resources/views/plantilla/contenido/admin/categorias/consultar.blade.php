@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de categorias:{{count($categoria)}}</h1>
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
                  <h3 class="card-title">Consultar categorias</h3>
  
                  
                </div>
                
                <!-- /.card-header -->
                <div class="card-body ">
                  <div class="table-responsive p-0">
                    <table  id="table_id" class="display">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Slug</th>
                          <th>Sub categorias</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($categoria as $item)
                             
                         <tr>
                         <td class="mailbox-star">{{$item->id}}</td>
                             <td class="mailbox-star">{{$item->nombre}}</td>
                             <td class="mailbox-star">{{$item->slug}}</td>
                             <td class="mailbox-star">
                               <select class="form-control " name="" id="">
                                 @foreach ($item->subCategoria as $sub)
                               <option value="">{{$sub->nombre}}</option>
                                 @endforeach
                               </select>
                              </td>
                             
                             <td class="mailbox-star">
                                 <div class="btn-group">
                                 
  
                                 <a href="{{route('categoria.edit',$item->slug)}}" class="btn btn-default btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>
  
                                     
                                     
                                     <form action="{{route('categoria.destroy',$item)}}" method="POST">
                                         @method('DELETE')
                                         @csrf
                                         <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar esta categoría?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                       </form>
                                     
                                     
                                   
                                 </div>
                             </td>
                         </tr>
                         @endforeach
                              
                          
                      
                       
                      </tbody>
                    </table>
                  </div>
                  

                  <div class="box-footer p-3 float-right">
                  <a href=" {{route('categoria.create')}} "  class="btn  btn-info ">Agregar categoría</a>
            
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