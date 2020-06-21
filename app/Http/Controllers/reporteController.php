<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comprador;
use App\Pedido;
use App\PlanAfilizacion;
use App\Tienda;
use Carbon\Carbon;

class reporteController extends Controller
{

    public function getUltimoDiaMes($elAnio,$elMes) {
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }

    public function compradorCharts(){
        $compradorMesActual=Comprador::whereYear('created_at',Carbon::now()->year)
        ->whereMonth('created_at',Carbon::now()->month)->count();
       
        $compradorMesPasado=Comprador::whereYear('created_at',Carbon::now()->year)
        ->whereMonth('created_at',Carbon::now()->subMonth(1))->count();
        
        $compradorSegundoMesPasado=Comprador::whereYear('created_at',Carbon::now()->year)
        ->whereMonth('created_at',Carbon::now()->subMonth(2))->count();
       
        return view('plantilla.contenido.admin.reportes.compradorCharts',compact('compradorMesActual','compradorMesPasado','compradorSegundoMesPasado'));
    }

    public function graficaComprador($anio,$mes){
       
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

        $compradores=array();
        $tiendas=array();

        $comprador=Comprador::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();

        $tienda=Tienda::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();


        if(count($comprador)!=0){
            for ($j=0; $j <count($comprador) ; $j++) { 

                array_push($compradores,$comprador[$j]);
            }
        }

        if(count($tienda)!=0){
            for ($j=0; $j <count($tienda) ; $j++) { 

                array_push($tiendas,$tienda[$j]);
            }
        }

        $usuarios=$compradores;
        $usuarios1=$tiendas;

        $ct=count($usuarios);
        $ct1=count($usuarios1);

        for($d=1;$d<=$ultimo_dia;$d++){
            $registros[$d]=0;     
        }

        for($d=1;$d<=$ultimo_dia;$d++){
            $registros1[$d]=0;     
        }

        foreach($usuarios as $usuario){
            $diasel=intval(date("d",strtotime($usuario->created_at) ) );
            $registros[$diasel]++;    
        }

        foreach($usuarios1 as $usuario1){
            $diasel1=intval(date("d",strtotime($usuario1->created_at) ) );
            $registros1[$diasel1]++;    
        }

        $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros,"registrosdia1" =>$registros1);
        return   json_encode($data);

    } 

    public function graficaPedido($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

        $pedidos=array();

       
        $pedidoArray=Pedido::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
            
        if(count($pedidoArray)!=0){
            for ($j=0; $j <count($pedidoArray) ; $j++) { 
                array_push($pedidos, $pedidoArray[$j]);
            }
        }
        
        $nombre=array('Espera por Transferencia','Pago aceptado','PeparandoPedido','Enviado al comprador','Cancelado','Culminado');
        $numero=array(0,0,0,0,0,0);

        $ct =count($pedidos);

        for ($i=0; $i <$ct ; $i++) { 

            if($pedidos[$i]->status == "esperaTransferencia"){ 
                $numero[0] = $numero[0] +1;
            }

            if($pedidos[$i]->status == "pagoAceptado"){ 
                $numero[1] = $numero[1] +1;
            }

            if($pedidos[$i]->status == "preparandoPedido"){ 
                $numero[2] = $numero[2] +1;
            }

            if($pedidos[$i]->status == "enviadoComprador"){ 
                $numero[3] = $numero[3] +1;
            }
            
            if($pedidos[$i]->status == "cancelado"){ 
                $numero[4] = $numero[4] +1;
            }

            if($pedidos[$i]->status == "culminado"){ 
                $numero[5] = $numero[5] +1;
            }

        }

        $data=array(  "nombre"=>$nombre,"numero"=>$numero);

        return json_encode($data);
    }

    public function graficaPlan($anio,$mes){
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d", strtotime($anio."-".$mes."-".$ultimo_dia) );
       
        $planAfiliacion=PlanAfilizacion::All();


        $nombre=array();
        $numero=array();
        for ($i=0; $i < count($planAfiliacion) ; $i++) { 

            $t=Tienda::where('planAfilizacion_id',$planAfiliacion[$i]['id'])->whereBetween('fechaPlanAfiliacion', [$fecha_inicial,  $fecha_final])->count();

            array_push($numero,$t);
            array_push($nombre,$planAfiliacion[$i]['nombre']);
            
        }   

        $data=array("nombre"=>$nombre,"numero"=>$numero);
        
        return   json_encode($data);

    }


}
