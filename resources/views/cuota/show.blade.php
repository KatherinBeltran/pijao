@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ver Cuota</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-outline-danger btn-sm custom-btn" href="{{ route('cuotas.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <strong>Código cliente:</strong>
                                {{ $cuota->cli_cuo }}
                            </div>
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                {{ $cuota->cliente->nom_cli }}
                            </div>
                            <div class="form-group">
                                <strong>No. de celular:</strong>
                                {{ $cuota->cliente->num_cel_cli }}
                            </div>
                            <div class="form-group">
                                <strong>Dirección:</strong>
                                {{ $cuota->cliente->dir_cli }}
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <strong>Código prestamo:</strong>
                                {{ $cuota->pre_cuo }}
                            </div>
                            <div class="form-group">
                                <strong>Cobros y/o pagos:</strong>
                                {{ $cuota->prestamo->pag_pre }}
                            </div>
                            <div class="form-group">
                                <strong>Fecha:</strong>
                                {{ $cuota->prestamo->fec_pre }}
                            </div>
                            <div class="form-group">
                                <strong>Total:</strong>
                                {{ $cuota->prestamo->tot_pre }}
                            </div>
                            </div>
                            <table>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Valor</th>
                                    <th>Total abonado</th>
                                    <th>Saldo</th>
                                    <th>Número</th>
                                </tr>
                                @foreach($registrosIguales as $cuota)
                                    <tr>
                                        <td>{{ $cuota->fec_cuo }}</td>
                                        <td>{{ $cuota->val_cuo }}</td>
                                        <td>{{ $cuota->tot_abo_cuo }}</td>
                                        <td>{{ $cuota->sal_cuo }}</td>
                                        <td>{{ $cuota->num_cuo }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop