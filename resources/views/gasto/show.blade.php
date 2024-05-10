@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ver Gasto</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-outline-danger btn-sm custom-btn" href="{{ route('gastos.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Código:</strong>
                            {{ $gasto->id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $gasto->fec_gas }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $gasto->mon_gas }}
                        </div>
                        <div class="form-group">
                            <strong>Categoría:</strong>
                            {{ $gasto->categoria->nom_cat }}
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