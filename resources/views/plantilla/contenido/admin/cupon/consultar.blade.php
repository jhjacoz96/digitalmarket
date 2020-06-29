@extends('layouts.appAdmin')
@section('contenido')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cantidad de cupones: {{count($cupon)}}</h1>
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
                  <h5 class="card-title">Consultar Cupones</h5>
  
                  
                </div>
                
                <!-- /.card-header -->
                <div class="card-body ">
                  <div class="table-responsive p-0">
                    <table id="table_id" class="display">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Código</th>
                          <th>Tipo de cupón</th>
                          <th>fecha de creación</th>
                          <th>Fecha de expiración</th>
                          <th>Cantidad</th>
                          <th>Tipo comprador</th>
                          <th>Estado</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($cupon as $item)
                      <tr >
                              <td class="mailbox-star">{{$item->id}}</td>
                              <td class="mailbox-star">{{$item->codigoCupon}}</td>
                              <td class="mailbox-star">{{$item->tipoCupon}}</td>
                              <td class="mailbox-star">{{$item->created_at->format('d-m-Y')}}</td>
                              <td class="mailbox-star">{{$item->fechaExpiracion}}</td> 
                              <td class="mailbox-star">
                                @if($item->tipoCupon=='Porcentaje')
                                {{$item->cantidad}}%
                                @else
                                Bs{{$item->cantidad}}
                                @endif
                              </td> 
                              <td class="mailbox-star">
                                <select name="" id="" class="form-control">
                                    @foreach ($item->tipoComprador as $tipo)
                                <option value="">{{$tipo->nombre}}</option>
                                    @endforeach
                                </select>
                              </td>
                              <td class="mailbox-star">
                                @if($item->estatus=='A')
                                <span class="badge badge-success">Activo</span>
                                @else
                                <span class="badge badge-danger">Inactivo</span>
                                @endif  
                              </td> 
                    
                              <td class="mailbox-star">
                                  <div class="btn-group">
                                  
                                  <a href="{{route('cupon.edit',$item)}}" class="btn btn-default btn-sm mx-1">  <span class="fas fa-edit" aria-hidden ="true" ></span></a>
  
                                      
                                      
                                      <form action="{{route('cupon.destroy',$item)}}" method="POST"  >
                                          @method('DELETE')
                                          @csrf
                                          <button class="btn btn-default btn-sm d-inline float-left" onclick="return confirm('¿Esta seguro que desea eliminar este cupón?')"><span class="fas fa-trash-alt " aria-hidden ="true" ></span></button>
                                        </form>
                                      
                                      
                                    
                                  </div>
                              </td>
                          </tr>
                              
                          @endforeach
                      
                       
                      </tbody>
                    </table>
                  </div>
              
                  <div class="box-footer p-3 float-right">
                  <a href="{{route('cupon.create')}}"  class="btn  btn-info ">Registrar cupón</a>
            
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