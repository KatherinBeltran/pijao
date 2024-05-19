@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @if($esAdmin)
        <h1>Dashboard</h1>
    @endif
@stop

@section('content')
    @if($esAdmin)
        @if($prestamosPendientes)
            <div class="alert alert-info alert-dismissible">
                <h5><i class="icon fas fa-info"></i> Alerta!</h5>
                Hay prestamos pendientes por aprobación en la tabla de prestamos.
            </div>
        @endif
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $cobradorCount }}</h3>
                        <p>Cobradores</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-motorcycle"></i>
                    </div>
                    <a href="cobradores" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><br>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $prestamoCount }}</h3>
                        <p>Prestamos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-handshake"></i>
                    </div>
                    <a href="prestamos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><br>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $cuotasActivas }}</h3>
                        <p>Cuotas activas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes"></i>
                    </div>
                    <a href="cuotas" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><br>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $gastoCount }}</h3>
                        <p>Gastos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <a href="gastos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div><br>
        </div>
        <section class="col-lg-6 connectedSortable ui-sortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Montos prestados</h3>
                </div>
                <div class="card-body">
                    <canvas id="graficoBarras" style="max-height: 400px;"></canvas>
                </div>
            </div>
        </section>
    @else
        <h1>Dashboard</h1>
    @endif
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/es.min.js"></script>
    <script>
        var datos = @json($datos);
        var ctx = document.getElementById('graficoBarras').getContext('2d');
        // Configurar el formato de fecha en español
        moment.locale('es');
        // Colores vivos para las barras
        var coloresBarras = [
            'rgba(54, 162, 235, 1)', // Azul vivo
            'rgba(255, 206, 86, 1)', // Amarillo vivo
            'rgba(75, 192, 192, 1)', // Verde turquesa vivo
            'rgba(153, 102, 255, 1)', // Púrpura vivo
            'rgba(255, 159, 64, 1)' // Naranja vivo
        ];
        var graficoBarras = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: datos.map(function (dato) {
                    return moment(dato.mes, 'MMMM YYYY').format('MMMM YYYY');
                }),
                datasets: [{
                    label: 'Suma de capital',
                    data: datos.map(function (dato) {
                        return dato.total;
                    }),
                    backgroundColor: function(context) {
                        var index = context.dataIndex;
                        return coloresBarras[index % coloresBarras.length];
                    },
                    borderColor: function(context) {
                        var index = context.dataIndex;
                        return coloresBarras[index % coloresBarras.length];
                    },
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop