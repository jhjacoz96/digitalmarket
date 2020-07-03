<?php

namespace App\Imports;

use App\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Imports\ProductosImport;
class ProductosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row[1])) {
            return null;
        }
        
        return new Producto([
            'notificarStock'=>$row[0],
            'nombre'=>$row[1],
            'subCategoria_id'=>Producto::generarSub($row[2]),
            'marca_id'=>Producto::generarMarca($row[3]),
            'cantidad'=>$row[4],
            'precioActual'=>Producto::generarDescuento($row[5],$row[6]),
            'porcentajeDescuento'=>$row[6],
            'precioAnterior'=>$row[5],
            
            /*'precioAnterior'=>$row[6],
            'porcentajeDescuento'=>$row[7],*/
            'descripcionCorta'=>$row[7],
            'especificaciones'=>$row[8],
            'peso'=>$row[9],
            'tipoCliente'=>'comun',
            'sliderPrincipal'=>'no',
            'status'=>'no',
            'tienda_id'=>\Auth::user()->tienda->id,
            'slug'=>\Str::slug($row[1]), 
            'sku'=>Producto::generarSku($row[2])
        ]);
    }
}
