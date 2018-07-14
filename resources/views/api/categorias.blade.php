<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Peñon">
    <meta name="author" content="NibleTeach.com">
    <meta name="keyword" content="Sistema ventas El Peñon">
    
    <meta name="userId" content="{{Auth::check() ? Auth::user()->id : ''}}">
 
    <link rel="shortcut icon" href="img/ico/penion-1.ico">
    <title>EL PEÑON</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" enabled="true">
          <span class="navbar-toggler-icon" ></span>
        </button>
        
    </header>

    <div class="app-body">
    
        <main class="main">
            <div class="container-fluid">
                <div class="card-body">
                    <div class="form-group row border center">
                        <div class="col-md-12">
                            <br>
                            <button id="obtener" class="btn-success col-md-12">
                                Obtener Categorias De Productos
                            </button>
                            <br>
                            <br>        
                            <button id="obtener1" class="btn-success col-md-12">
                                Obtener Categorias De Platillos
                            </button> 
                            </br>
                            </br>
                            <button id="obtener2" class="btn-success col-md-12">
                                    Obtener Ventas Del Mes
                            </button> 
                                </br>
                                </br>
                            <button id="obtener3" class="btn-success col-md-12">
                                    Obtener Ventas Del Dia
                            </button> 
                                </br>
                                </br>
                            <button id="obtener4" class="btn-success col-md-12">
                                        Obtener Compras Del Mes
                            </button> 
                                </br>
                                </br>
                            <button id="obtener5" class="btn-success col-md-12">
                                        Obtener Compras Del dia
                            </button> 
                                </br>
                                </br>
                            <ol id="contenido" class="list-group">
                
                            </ol>
                            <div class="col-md-12">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4>Ventas</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="myChart">

                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p>Ventas de los últimos meses.</p>
                                        </div>
                                    </div>
                            </div>                                       
                        </div>
                    </div>               
                </div>
                
            </div>
        </main>    
    </div>   
    </div>
    <footer class="app-footer">
        <span><a href="http://www.nibbleframe.com/">NibbleFrame</a> &copy; 2018</span>
        <span class="ml-auto">Desarrollado por <a href="http://www.nibbleframe.com/">NibbleFrame</a></span>
    </footer>
    

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
    <script src="js/majax.js"></script>
    <script>
            Majax.setConfig(2,'cLrHpwlawIu90LujZtKhYKVX4Lsz20XGI9fVMoFl','');
            var boton=document.getElementById('obtener');
            boton.addEventListener('click',function(e){
                e.preventDefault();
                var majax = new Majax(),
                    contenido=document.getElementById('contenido');
                majax.get(
                    'api/reporteCategoria',
                    {
                        valid:function(r){
                            console.info(r);
                            var data=r.data,
                                temp=null;
                                contenido.innerHTML="";
                            for(var i=0,n=data.length;i<n;i++){                           
                                temp=document.createElement('span');
                                temp.innerHTML=data[i].nombre+"("+data[i].descripcion+")";
                                temp2=document.createElement('div');
                                temp2.appendChild(temp);
                                temp=document.createElement('li');
                                temp.classList.add('list-group-item','list-group-item-info');
                                temp.appendChild(temp2);
                                contenido.appendChild(temp);
                            }
                        },
                        error:function(error){
                            console.error(error);
                        }
                    }
    
                )
            },false)
    
    </script>
    <!--SCRIP DE CATEGORIAS DE PLATILLOS  -->
    <script>
            Majax.setConfig(2,'cLrHpwlawIu90LujZtKhYKVX4Lsz20XGI9fVMoFl','');
            var boton=document.getElementById('obtener1');
            boton.addEventListener('click',function(e){
                e.preventDefault();
                var majax = new Majax(),
                    contenido=document.getElementById('contenido');
                majax.get(
                    'api/reporteCategoriaPlatillos',
                    {
                        valid:function(r){
                            console.info(r);
                            var data=r.data,
                                temp=null;
                                contenido.innerHTML="";
                            for(var i=0,n=data.length;i<n;i++){                           
                                temp=document.createElement('span');
                                temp.innerHTML=data[i].nombre+"("+data[i].descripcion+")";
                                temp2=document.createElement('div');
                                temp2.appendChild(temp);
                                temp=document.createElement('li');
                                temp.classList.add('list-group-item','list-group-item-info');
                                temp.appendChild(temp2);
                                contenido.appendChild(temp);
                            }
                        },
                        error:function(error){
                            console.error(error);
                        }
                    }
    
                )
            },false)
    
    </script>
    <!--  OBTENER VENTAS DEL MES -->
    <script>
            Majax.setConfig(2,'cLrHpwlawIu90LujZtKhYKVX4Lsz20XGI9fVMoFl','');
            var boton=document.getElementById('obtener2');
            boton.addEventListener('click',function(e){
                e.preventDefault();
                var majax = new Majax(),
                    contenido=document.getElementById('contenido');
                majax.get(
                    'api/reporteVentas',
                    {
                        valid:function(r){
                            console.info(r);
                            var data=r.data,
                                temp=null;
                                varMesIngreso=[];
                                varTotalIngreso=[];
                                contenido.innerHTML="";
                           /* for(var i=0,n=data.length;i<n;i++){                           
                                temp=document.createElement('span');
                                temp.innerHTML="Mes: "+data[i].mes+" Total:  "+data[i].total;
                                temp2=document.createElement('div');
                                temp2.appendChild(temp);
                                temp=document.createElement('li');
                                temp.classList.add('list-group-item','list-group-item-info');
                                temp.appendChild(temp2);
                                contenido.appendChild(temp);
                            }*/
                                
                                data.map(function(x){
                                varMesIngreso.push(x.mes);
                                varTotalIngreso.push(x.total);
                            });
                            var ctx = document.getElementById("myChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: varMesIngreso,
                                    datasets: [{
                                        label: 'Ingresos',
                                        data: varTotalIngreso,
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: 'rgba(255, 99, 132, 0.2)',
                                        borderWidth: 1
                        }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });
                                            
                                        },
                        error:function(error){
                            console.error(error);
                        }
                    }
    
                )
            },false)
    
    </script>
    <!--  FIN OBTENER VENTAS DEL MES -->
    <!--  OBTENER VENTAS DEL DIA -->
    <script>
            Majax.setConfig(2,'cLrHpwlawIu90LujZtKhYKVX4Lsz20XGI9fVMoFl','');
            var boton=document.getElementById('obtener3');
            boton.addEventListener('click',function(e){
                e.preventDefault();
                var majax = new Majax(),
                    contenido=document.getElementById('contenido');
                majax.get(
                    'api/reporteVentasDia',
                    {
                        valid:function(r){
                            console.info(r);
                            var data=r.data,
                                temp=null;
                                varMesIngreso=[];
                                varTotalIngreso=[];
                                contenido.innerHTML="";
                        /*    for(var i=0,n=data.length;i<n;i++){                           
                                temp=document.createElement('span');
                                temp.innerHTML="Mes: "+data[i].dia+" Total:  "+data[i].total;
                                temp2=document.createElement('div');
                                temp2.appendChild(temp);
                                temp=document.createElement('li');
                                temp.classList.add('list-group-item','list-group-item-info');
                                temp.appendChild(temp2);
                                contenido.appendChild(temp);
                            }*/
                                
                                data.map(function(x){
                                varMesIngreso.push(x.dia);
                                varTotalIngreso.push(x.total);
                            });
                            var ctx = document.getElementById("myChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: varMesIngreso,
                                    datasets: [{
                                        label: 'Ingresos',
                                        data: varTotalIngreso,
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: 'rgba(255, 99, 132, 0.2)',
                                        borderWidth: 1
                        }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });
                                            
                                        },
                        error:function(error){
                            console.error(error);
                        }
                    }
    
                )
            },false)
    
    </script>
    <!--  FIN OBTENER VENTAS DEL DIA -->
    <!--  OBTENER INGRESOS DEL MES -->
    <script>
            Majax.setConfig(2,'cLrHpwlawIu90LujZtKhYKVX4Lsz20XGI9fVMoFl','');
            var boton=document.getElementById('obtener4');
            boton.addEventListener('click',function(e){
                e.preventDefault();
                var majax = new Majax(),
                    contenido=document.getElementById('contenido');
                majax.get(
                    'api/reporteIngresos',
                    {
                        valid:function(r){
                            console.info(r);
                            var data=r.data,
                                temp=null;
                                varMesIngreso=[];
                                varTotalIngreso=[];
                                contenido.innerHTML="";
                        /*    for(var i=0,n=data.length;i<n;i++){                           
                                temp=document.createElement('span');
                                temp.innerHTML="Mes: "+data[i].dia+" Total:  "+data[i].total;
                                temp2=document.createElement('div');
                                temp2.appendChild(temp);
                                temp=document.createElement('li');
                                temp.classList.add('list-group-item','list-group-item-info');
                                temp.appendChild(temp2);
                                contenido.appendChild(temp);
                            }*/
                                
                                data.map(function(x){
                                varMesIngreso.push(x.mes);
                                varTotalIngreso.push(x.total);
                            });
                            var ctx = document.getElementById("myChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: varMesIngreso,
                                    datasets: [{
                                        label: 'Ingresos',
                                        data: varTotalIngreso,
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: 'rgba(255, 99, 132, 0.2)',
                                        borderWidth: 1
                        }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });
                                            
                                        },
                        error:function(error){
                            console.error(error);
                        }
                    }
    
                )
            },false)
    
    </script>
    <!--  FIN OBTENER INGRESOS DEL MES -->
    <!--  OBTENER INGRESOS DEL DIA -->
    <script>
            Majax.setConfig(2,'cLrHpwlawIu90LujZtKhYKVX4Lsz20XGI9fVMoFl','');
            var boton=document.getElementById('obtener5');
            boton.addEventListener('click',function(e){
                e.preventDefault();
                var majax = new Majax(),
                    contenido=document.getElementById('contenido');
                majax.get(
                    'api/reporteIngresosDia',
                    {
                        valid:function(r){
                            console.info(r);
                            var data=r.data,
                                temp=null;
                                varMesIngreso=[];
                                varTotalIngreso=[];
                                contenido.innerHTML="";
                        /*    for(var i=0,n=data.length;i<n;i++){                           
                                temp=document.createElement('span');
                                temp.innerHTML="Mes: "+data[i].dia+" Total:  "+data[i].total;
                                temp2=document.createElement('div');
                                temp2.appendChild(temp);
                                temp=document.createElement('li');
                                temp.classList.add('list-group-item','list-group-item-info');
                                temp.appendChild(temp2);
                                contenido.appendChild(temp);
                            }*/
                                
                                data.map(function(x){
                                varMesIngreso.push(x.dia);
                                varTotalIngreso.push(x.total);
                            });
                            var ctx = document.getElementById("myChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: varMesIngreso,
                                    datasets: [{
                                        label: 'Ingresos',
                                        data: varTotalIngreso,
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: 'rgba(255, 99, 132, 0.2)',
                                        borderWidth: 1
                        }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero:true
                                            }
                                        }]
                                    }
                                }
                            });
                                            
                                        },
                        error:function(error){
                            console.error(error);
                        }
                    }
    
                )
            },false)
    
    </script>
</body>

</html>