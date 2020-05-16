<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Categoria;
use App\SubCategoria;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function mainCategorias(){
        
        $mainCategorias=Categoria::where('estatus','A')->with('subCategoria')->get();
        return $mainCategorias;
    }
}
