@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1>Reporte Económico</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('reportes.index') }}" method="GET">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $fechaInicio }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="fecha_fin">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $fechaFin }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <h3>Resumen de Gastos</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Suma de Montos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reporte as $item)
                                <tr>
                                    <td>{{ $item->nom_cat }}</td>
                                    <td>{{ number_format($item->suma_montos, 0, '', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total</strong></td>
                                <td>{{ number_format($reporte->sum('suma_montos'), 0, '', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h3>Análisis de Préstamo</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Capital Prestado</td>
                                <td>{{ number_format($capitalPrestado, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Total Recolectado</td>
                                <td>{{ number_format($totalRecolectado, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Total Dinero prestado con intereses</td>
                                <td>{{ number_format($totalDineroPrestadoConIntereses, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Deuda</td>
                                <td>{{ number_format($deuda, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Total Utilidad</td>
                                <td>{{ number_format($totalUtilidad, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Utilidad Neta con gastos</td>
                                <td>{{ number_format($utilidadNetaConGastos, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h3>Bonos a Cobradores</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cobrador</th>
                                <th>Bonos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bonosCobradores as $bono)
                                <tr>
                                    <td>{{ $bono->nom_cob }}</td>
                                    <td>{{ number_format($bono->total_bono, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <form action="{{ route('reportes.pdf') }}" method="GET" target="_blank" style="float: right; margin-right: 10px;">
                        <input type="hidden" name="fecha_inicio" value="{{ $fechaInicio }}">
                        <input type="hidden" name="fecha_fin" value="{{ $fechaFin }}">
                        <button type="submit" class="btn btn-danger">PDF</button>
                    </form>
                    <form action="{{ route('reportes.excel') }}" method="GET" target="_blank" style="float: right; margin-right: 10px;">
                        <input type="hidden" name="fecha_inicio" value="{{ $fechaInicio }}">
                        <input type="hidden" name="fecha_fin" value="{{ $fechaFin }}">
                        <button type="submit" class="btn btn-success">Excel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

    <style>
    #example_wrapper .paginate_button.page-item.active > a.page-link {
    background-color: lightgray !important;
    color: black !important;
    border-color: gray !important;
    }
    </style>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json" // Carga el archivo de idioma en español
                }
            });
        });
    </script>
@stop