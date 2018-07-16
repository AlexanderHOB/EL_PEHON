<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                
            </div>
            <!-- Graficos de Ingresos y Ventas Mensuales-->
            <div class="car-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ingresos</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ingresos">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Compras de los últimos meses.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ventas</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ventas">                                                
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
            <!-- FIN Graficos de Ingresos y Ventas Mensuales-->
            <!-- Graficos de Ingresos y Ventas Diarias-->
             <div class="car-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ingresos por día</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ingresosDia">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Compras de los últimos dias.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ventas del día</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ventasDia">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Ventas de los últimos dias.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN Graficos de Ingresos y Ventas Diarias-->
            <div class="car-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ingresos</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="polarIngresos">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Compras de los últimos meses.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ventas</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="polarVentas">                                                
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
</template>
<script>
    export default {
        data (){
            return {
                varIngreso:null,
                charIngreso:null,
                ingresos:[],
                varTotalIngreso:[],
                varMesIngreso:[], 
                
                varIngresoDia:null,
                charIngresoDia:null,
                ingresosDia:[],
                varTotalIngresoDia:[],
                varMesIngresoDia:[],
               
               varVenta:null,
                charVenta:null,
                ventas:[],
                varTotalVenta:[],
                varMesVenta:[],

                varVentaDia:null,
                charVentaDia:null,
                ventasDia:[],
                varTotalVentaDia:[],
                varMesVentaDia:[],

                

            }
        },
        methods : {
           
            getIngresos(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ingresos = respuesta.ingresos;
                    //cargamos los datos del chart
                    me.loadIngresos();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getIngresosDia(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ingresosDia = respuesta.ingresosDia;
                    //cargamos los datos del chart
                    me.loadIngresosDia();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getVentas(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ventas = respuesta.ventas;
                    //cargamos los datos del chart
                    me.loadVentas();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getVentasDia(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ventasDia = respuesta.ventasDia;
                    //cargamos los datos del chart
                    me.loadVentasDia();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadIngresos(){
                let me=this;
                me.ingresos.map(function(x){
                    me.varMesIngreso.push(x.mes);
                    me.varTotalIngreso.push(x.total);
                });
                me.varIngreso=document.getElementById('ingresos').getContext('2d');

                me.charIngreso = new Chart(me.varIngreso, {
                    type: 'bar',
                    data: {
                        labels: me.varMesIngreso,
                        datasets: [{
                            label: 'Ingresos',
                            data: me.varTotalIngreso,
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
            loadIngresosDia(){
                let me=this;
                me.ingresosDia.map(function(x){
                    me.varMesIngresoDia.push(x.dia);
                    me.varTotalIngresoDia.push(x.total);
                });
                me.varIngresoDia=document.getElementById('ingresosDia').getContext('2d');

                me.charIngresoDia = new Chart(me.varIngresoDia, {
                    type: 'bar',
                    data: {
                        labels: me.varMesIngresoDia,
                        datasets: [{
                            label: 'Ingresos Diarios',
                            data: me.varTotalIngresoDia,
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
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
                me.varIngresoDia=document.getElementById('polarIngresos').getContext('2d');

                me.charIngresoDia = new Chart(me.varIngresoDia, {
                    type: 'polarArea',
                    data: {
                        labels: me.varMesIngresoDia,
                        datasets: [{
                            label: 'Ingresos Diarios',
                            data: me.varTotalIngresoDia,
                             backgroundColor: [
                            'rgb(5,155,255)',
                            'rgb(255,99,132)',
                            'rgb(75,192,192)',
                            'rgb(255,205,86)',
                            'rgb(201,203,207)',
                            'rgb(75,192,192)'
                            ],
                            borderColor: 'rgba(255, 159, 64, 1)',
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
            loadVentas(){
                let me=this;
                me.ventas.map(function(x){
                    me.varMesVenta.push(x.mes);
                    me.varTotalVenta.push(x.total);
                });
                me.varVenta=document.getElementById('ventas').getContext('2d');

                me.charVenta = new Chart(me.varVenta, {
                    type: 'bar',
                    data: {
                        labels: me.varMesVenta,
                        datasets: [{
                            label: 'Ventas',
                            data: me.varTotalVenta,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 0.2)',
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
            loadVentasDia(){
                let me=this;
                me.ventasDia.map(function(x){
                    me.varMesVentaDia.push(x.dia);
                    me.varTotalVentaDia.push(x.total);
                });
                me.varVentaDia=document.getElementById('ventasDia').getContext('2d');

                me.charVentaDia = new Chart(me.varVentaDia, {
                    type: 'bar',
                    data: {
                        labels: me.varMesVentaDia,
                        datasets: [{
                            label: 'Ventas Diarias',
                            data: me.varTotalVentaDia,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
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
                me.varVentaDia=document.getElementById('polarVentas').getContext('2d');

                me.charVentaDia = new Chart(me.varVentaDia, {
                    type: 'polarArea',
                    data: {
                        labels: me.varMesVentaDia,
                        datasets: [{
                            label: 'Ventas Diarias',
                            data: me.varTotalVentaDia,
                             backgroundColor: [
                            'rgb(5,155,255)',
                            'rgb(255,99,132)',
                            'rgb(75,192,192)',
                            'rgb(255,205,86)',
                            'rgb(201,203,207)',
                            'rgb(75,192,192)'
                            ],
                            borderColor: 'rgba(255, 206, 86, 1)',
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
            
            
        },
        mounted() {
            this.getIngresos();
            this.getVentas();
            this.getIngresosDia();
            this.getVentasDia();
            
        }
    }
</script>
