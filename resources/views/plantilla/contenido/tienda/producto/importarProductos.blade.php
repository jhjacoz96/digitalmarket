@extends('layouts.appAdmin')

@section('contenido')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
       <h1>Productos</h1>
        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('Comprador.index')}}">Consultar</a></li>
            <li class="breadcrumb-item active">Agregar</li>
          </ol>

      </div>
    </div><!-- /.container-fluid -->
  </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Exportar productos masivamente</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <div class="card-body">

               <form role="form" action="{{route('tiendas.productos.masa')}}" method="POST"  enctype="multipart/form-data" id="quickForm">
                   @csrf
                  
                  
                     <div class="row">
                      <div class="alert alert-info alert-dismissible">
                      
                        <h5><i class="icon fas fa-info"></i>Importante</h5>
                      Para agregar productos masivamentes a DitalMarket debe exportar un archivo de tipo cvs o xlsx. El formato admitido es el siguiente: <a href="{{url('/descargar-ejemplo')}}">Descarguelo aqui</a>.
                       </div>
                     </div>
   
   
                       <div class="form-group col-md-6">
                         
                           <label for="file">Importar archivo exel</label> 
                           
                             <input type="file" class="form-control-file" id="file" name="file"  
                             accept="file" >
                           
                        
                            {!!$errors->first('file','<small>:message</small><br>')!!}
                        </div>
   
                   </div>
                   <!-- /.card-body -->
                   <div class="card-footer">
                
                     <button type="submit" class="btn btn-primary float-right">Importar productos</button>
                   </div>
   
                 </form>
             </div>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection