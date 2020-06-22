@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->

  <style>
    .table{
      width: 100%;
      margin-bottom: 1rem;
      color:#212529;
      text-align: center;
    }

    .table th, .table td {
      padding: .75rem;
      vertical-align: center;
      border-top: 1px solid #dee2e6;
    }

  </style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

 
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h5>Cantidad de tipos de clientes :{{count($tipo)}}</h5>
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
                  <h3 class="card-title">Consultar tipos de clientes</h3>
  
                  
                </div>
                
                <!-- /.card-header -->
                <div class="card-body">
                  <div class=" table-responsive p-0">

                    <table id="table_id" class="display">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Miembros</th>
                          <th>Descuento</th>
                          <th>Envio gratis</th>
                          <th>Activo</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($tipo as $item)
                             
                         <tr>
                            <td class="mailbox-star">{{$item->id}}</td>
  
                             <td class="mailbox-star">{{$item->nombre}}</td>
  
                             <td class="mailbox-star">
                                  {{count($item->comprador)}}
                             </td>
                          
                             <td class="mailbox-star">{{$item->porcentajeDescuento}}%</td>
  
  
                             <td class="mailbox-star">
                                  @if($item->envioGratis==1)
                                  <span>Si</span>
                                  @else
                                  <span>No</span>
                                  @endif
                              </td>
  
                             <td class="mailbox-star">
                                 @if($item->estatus==1)
                                  <span class="badge badge-success">Activo</span>
                                  @else
                                  <span class="badge badge-danger">Inacivo</span>
                                  @endif
                              </td>
                            
                             <td class="mailbox-star">
                                 <div class="btn-group">
                                 
  
                                 <a href="{{route('tipoComprador.edit',$item->id)}}" class="btn btn-default  btn-sm">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>
  
                                 @if ($item->nombre!='Comprador'||$item->nombre!='comprador')
                                     
                                 <form action="{{route('tipoComprador.destroy',$item)}}" method="POST">
                                     @method('DELETE')
                                     @csrf
                                     <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este tipo de comprador?')"><span class="fas fa-trash-alt" aria-hidden ="true" ></span></button>
                                 </form>
  
                                 @endif
                                     
                                     
                                   
                                 </div>
                             </td>
                         </tr>
                         @endforeach
                              
                          
                      
                       
                      </tbody>
                    </table>
                  </div>
                  

                  <div class="box-footer p-3 float-right">
                  <a href=" {{route('tipoComprador.create')}} "  class="btn  btn-info ">Agregar tipo comprador</a>
            
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