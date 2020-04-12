<?php


//Mostrar imagenes guardadas
$imagen=App\Imagen::orderBy('id','Desc')->get();
return $imagen; 


//saber si un producto tiene o no una imagen
$producto=App\Producto::find(1);
$imagen=$producto->imagen;

if($imagen){
    echo 'tiene una imagen';
}else{
    echo 'no tiene una imagen';
}

return $imagen;

//crear una imagen usando el metodo save
$imagen=new App\Imagen(['url' => 'imagenes/avatar.png']);

$producto=App\Producto::find(1);
$producto->imagen()->save($imagen);


return $producto;



//obtener las informaciones de las imagenes
$producto=App\Producto::find(1);
return $producto->imagen->url;


 //crear VARIAS imagenes para un producto usando el metodo savemany

 $producto=App\Producto::find(1);
 $producto->imagen()->saveMany([
     new App\Imagen(['url'=>'imagenes/avatar.png']),
     new App\Imagen(['url'=>'imagenes/avatar2.png']),
     new App\Imagen(['url'=>'imagenes/avatar3.png']),
     
 ]);
 return $producto->imagen;
 
 // r una imagen con el metodo create
 $producto=App\Producto::find(1);
 $producto->imagen()->create([
     'url'=>'imagenes/avatar2.png'
 ]);
 
 
 return $producto;



//otra forma
$imagen=[];

$imagen['url']= 'imagenes/avatar3.png';

$producto=App\Producto::find(1);

$producto->imagen()->create($imagen);
    
return $producto;


//crear varias imagenes para un producto utlilizando el metodo createMany

$imagen=[];

$imagen[]['url']= 'imagenes/avatar1.png';
$imagen[]['url']= 'imagenes/avatar2.png';
$imagen[]['url']= 'imagenes/avatar3.png';
$imagen[]['url']= 'imagenes/a.png';
$imagen[]['url']='imagenes/a.png';
$imagen[]['url']= 'imagenes/a.png';

$producto=App\Producto::find(1);

$producto->imagen()->createMany($imagen);

return $producto->imagen;

 //actualizar una imagen 
 $marca=App\Marca::find(1);

 $marca->imagen->url='imageenes/avatar2.png';

 $marca->push();
 return $marca->imagen;


 //actualizar  imagen de los productos
 $producto=App\Producto::find(1);


 $producto->imagen[0]->url='imagenes/a.png';
 $producto->push();

 return $producto->imagen;

 //buscar el registro relaionado con la imagen 
 $imagen=App\Imagen::find(7);
 return $imagen->imageable; 

 //delimitar los registros
 $produto=App\Producto::find(1);
 return $produto->imagen()->where('url','imagenes/a.png')->get(); 

  //ontar los registros relacionado a la marca
  $marca=App\Marca::withCount('imagen')->get();
  $marca= $marca->find(1);
  return $marca->imagen_count;

   //ontar los registros relacionado a las productos
   $produto=App\Producto::withCount('imagen')->get();
   $producto= $producto->find(1);
   return $marca->imagen_count;

   //contar los registros relacionado a las productos de otra forma
   
   $producto= $producto->find(1);
   return $producto->loadCount('imagen');

    //ontar los registros relacionado a las productos
    $produto=App\Producto::withCount('imagen')->get();
    $producto= $producto->find(1);
    return $marca->imagen_count;

     //carga previa
     $marca=App\Marca::with('imagen')->find(1);
     return $marca->imagen->url;

       //carga previa de multiples relaciones
    $producto=App\Produto::with('imagen','categoria')->get(1);
    return $producto;

     //carga previa de multiples relaciones on restricciones
     $producto=App\Producto::with('imagen:id,imageable_id,url','subCategoria')->find(1);
     return $producto;

     
   //delimitar los campos
   $producto=App\Producto::with('imagen:id,imageable_id,url','subCategoria:id,nombre')->find(1);
   return $producto;

    //eliminar una imagen
    $producto=App\Producto::find(1);
    return $producto->imagen[0]->delete();

    //eliminar todas las imagenes imagen
   $producto=App\Producto::find(1);
   $producto->imagen()->delete();
   return $producto;
 
   