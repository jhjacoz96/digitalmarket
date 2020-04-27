@extends('layouts.appAdmin')

@section('estilos')
<link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
@endsection

@section('scripts')
<script src="https://unpkg.com/vue-multiselect@2.1.0"></script>

<script>
window.data={
    editar:'si'
}
</script>

@endsection

@section('contenido')

<div id="atributos">
    <form action="{{route('guardarCombinacion')}}" method="post">
        @csrf
 
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Combinaciones</h1>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('Plan.index')}}">Consultar</a></li>
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



                            <div class="card card-success">
                                
                                <div class="card-header">
                                    <h3 class="card-title">Combinaciones</h3>
                                </div>
                                <div class="card-body">
                                              

                                    <div class="row">
                                        <div class="col-md-6">
                                  <!--  <div class="form-group" v-for="(item,index) in grupos">
                                        <label for="">@{{item.nombre}}</label>
                                        <select v-model="select" class="form-control"  multiple   >
                                        <option :value="items" v-for="(items,index) in item.atributo">@{{items.nombre}}</option>
                                        </select>
                                    </div>-->
                                       
                                    <div class="form-group" v-for="(item,index) in grupos">
                                    <label for="">@{{item.nombre}}</label>
                                    <vue-multiselect v-model="select" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="nombre" track-by="id"
                                    
                                    :options="item.atributo"
                                    :multiple="true" :taggable="true" @tag="addTag"></vue-multiselect>
                                    </div>
                                    <pre class="language-json"><code>@{{ select  }}</code></pre>
                                    

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        
                                        <button type="button" class="btn btn-secondary" v-on:click="generarLista()">
                                            combinar
                                        </button>

                                        <button type="button" class="btn btn-outline-secondary float-right " v-if="aparecer" v-on:click.prevent="reset">
                                            resetear
                                        </button>
                                       
                                    </div>
                                    
                                    <input type="hidden" v-model="value" name="value">
                                    
                                  
                                    <div class="card-body table-responsive p-0" >
                                        <table class="table table-hover" v-if="aparecer" >
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Variante</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th>Precio</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="( items, index) in listaCombinacion"  :key="index"  >

                                                    <td scope="row">@{{index+1}}</td>

                                                    <td>
                                                        <div v-for="(item, index) in items.atributo" :key="index">
                                                            @{{item.nombre}}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <input v-model="items.cantidad" class="col-md-4" type="text">
                                                    </td>

                                                    <td>
                                                        <input class="col-md-4" type="text">
                                                    </td>

                                                    <td>

                                                        <a href="" @click.prevent="eliminarCombinacion(items,index)">
                                                            <i class="fas fa-trash-alt" style="color:red;"></i>
                                                        </a>


                                                    </td>

                                                </tr>

                                                

                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>
                                
                                <div class="card-footer">
                                        
                                        <button class="btn btn-primary" type="submit" >
                                            gruardar
                                        </button>
                                        <button v-on:click.prevent="convertir()" class="btn btn-primary" type="button" >
                                            convertir
                                        </button>
                                    
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

    </form>
</div>

@endsection