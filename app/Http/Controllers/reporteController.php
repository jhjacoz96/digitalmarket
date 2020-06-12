<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comprador;
use Carbon\Carbon;

class reporteController extends Controller
{
    public function compradorCharts(){
        $compradorMesActual=Comprador::whereYear('created_at',Carbon::now()->year)
        ->whereMonth('created_at',Carbon::now()->month)->count();
       
        $compradorMesPasado=Comprador::whereYear('created_at',Carbon::now()->year)
        ->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        
        $compradorSegundoMesPasado=Comprador::whereYear('created_at',Carbon::now()->year)
        ->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
       
        return view('plantilla.contenido.admin.reportes.compradorCharts',compact('compradorMesActual','compradorMesPasado','compradorSegundoMesPasado'));
    }
}
