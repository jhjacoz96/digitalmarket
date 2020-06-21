function cambiar_fecha_grafica(){

    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();
  
    cargar_grafica_barras(anio_sel,mes_sel);
    cargar_grafica_torta(anio_sel,mes_sel);
    cargar_grafica_barra_plan(anio_sel,mes_sel);
  } 
  
  function cargar_grafica_barras(anio,mes){
  
        var options={
      chart: {
        renderTo: 'div_grafica_barras',
          type: 'column',
          scrollablePlotArea: {
              minWidth: 700,
              scrollPositionX: 1
          }
      },
      title: {
          text: 'Cantidad de compradores en el mes'
      },
      xAxis: {
          categories: [],
          title: {
              text: 'Dias del mes'
          },
          crosshair: true
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Registros al dia'
          }
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: [{
          name: 'Compradores',
          data: []
      },{
        name: 'Tiendas',
        data: []
    }
    ]
  }
  
  $("#div_grafica_barras").html( $("#cargador_empresa").html() );
    var url = "/reporte-comprador/"+anio+"/"+mes;
  
    $.get(url,function(result){
      
      var datos=jQuery.parseJSON(result);
      var totaldias=datos.totaldias;
      var registrosdia=datos.registrosdia;
      var registrosdia1=datos.registrosdia1;
      var i=0;
      var i1=0;
      var acum= 0;
      var acum1= 0;
  
      for(i=1;i<=totaldias;i++){
  
        options.series[0].data.push( registrosdia[i] );
        acum = acum +  registrosdia[i];
        options.xAxis.categories.push(i);
      }

      for(i1=1;i1<=totaldias;i1++){
  
        options.series[1].data.push( registrosdia1[i1] );
        acum1 = acum1 +  registrosdia1[i1];
      }
  
      options.title.text="Compradores: "+ acum + "| tiendas:"+ acum1;
      chart = new Highcharts.Chart(options);
  
    })
  
  
  
  }

  function cargar_grafica_torta(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_torta_pedido',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Porcentaje de pedidos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Porcentaje',
            colorByPoint: true,
            data: []
        }]
    };


    var url = "/reporte-pedido/"+anio+"/"+mes;

    $.get(url,function(result){
        var datos= jQuery.parseJSON(result);
       
        var totattipos=6;
        var nombre = datos.nombre;
        var numero= datos.numero;

        for(i=0;i<=totattipos-1;i++){  
            var objeto= {name: nombre[i], y:numero[i] };     
            options.series[0].data.push( objeto );  
        }
     
        chart = new Highcharts.Chart(options);
    
    })

}


  function cargar_grafica_barra_plan(anio,mes){

   var options= {
        chart: {
            renderTo:'div_grafica_colum_plan',
            type: 'column',
            scrollablePlotArea: {
                minWidth: 700,
                scrollPositionX: 1
            }
        },
        title: {
            text: 'Cantidad de compradores por plan'
        },
        xAxis: {
            categories: [],
            crosshair: true
        },
        yAxis: {
            min: 0,
            crosshair: true,
            title: {
                text: 'Cantidad de compradores'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name:'plan de afiliación',
            data:[]
        }]
    };

    var url = "/reporte-plan/"+anio+"/"+mes;
  
    $.get(url,function(result){
      
        var datos=jQuery.parseJSON(result);
       
        totalTipos=datos.numero.length;
        var nombre= datos.nombre;
        var numero= datos.numero;
      
        
        for(i=0;i<totalTipos;i++){
          options.series[0].data.push(numero[i]);
          options.xAxis.categories.push(nombre[i]);
        }

        chart = new Highcharts.Chart(options);
    
      }).catch(e=>{
          console.log(e)
      })
    
    
    
    }