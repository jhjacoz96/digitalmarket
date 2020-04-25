@extends('layouts.appAdmin')
@section('contenido')

<div id="atributos">
    
        
    
        

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
                                    
                                    <section>
                                        <form v-on:submit.prevent="agregar()">
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <div class="form-group">


                                                    <label for="">grupo</label>
                                                    <input type="text" v-model="grupo.nombre" 
                                                    class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">

                                                    <label for="">Atributo</label>

                                                    <div class="btn-group">
                                                        <input type="text" v-model="atributo"
                                                            class="form-control  mb-2">
                                                        <button class="btn btn-info btn-group mx-2 mb-2"
                                                            v-on:click.prevent="agregarAtributo()">mas</button>

                                                    </div>

                                                    <select name="" class="form-control" multiple id="">
                                                        <option v-for="atr in grupo.selectAtributos" value="atr">@{{atr}}
                                                        </option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <button class="btn btn-info" type="submit" >Agregar
                                            grupo</button>
                                            <button type="button" class="btn btn-secondary" v-on:click="generarLista()">
                                                combinar
                                            </button>
                                        </form>
                                    </section>

                                   

                                    <div class="row mt-3">
                                        <div class="col-md-6">

                                            <ul class="list-group" >
                                                <li clsass="list-group-item"  v-for="(item, index) in grupos"
                                                    :key="index">
                                                    <p>@{{item.id}}</p>
                                                    <p>@{{item.nombre}}</p>
                                                    
                                                    

                                                    <button @click="eliminarGrupo(item,index)"
                                                        class="btn btn-danger btn-sm">eliminar</button>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>



                                    
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Variante</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th>Precio</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="( items, index) in listaCombinacion" :key="index" >

                                                    <td scope="row">@{{index+1}}</td>

                                                    <td>
                                                        <div v-for="(item, index) in items.elemento" :key="index">
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

                                                        <input type="checkbox"  v-model="items.estado">


                                                    </td>

                                                </tr>



                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>

                                <div class="card-footer">
                                    <form v-on:submit.prevent="guardar()">
                                        <button class="btn btn-primary" type="submit">
                                            gruardar
                                        </button>
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

    
</div>

@endsection