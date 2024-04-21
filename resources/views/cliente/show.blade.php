@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ver Cliente</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-outline-danger btn-sm custom-btn" href="{{ route('clientes.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $cliente->nom_cli }}
                        </div>
                        <div class="form-group">
                            <strong>No. de cédula:</strong>
                            {{ $cliente->num_ced_cli }}
                        </div>
                        <div class="form-group">
                            <strong>No. de celular:</strong>
                            {{ $cliente->num_cel_cli }}
                        </div>
                        <div class="form-group">
                            <strong>Dirección:</strong>
                            {{ $cliente->dir_cli }}
                        </div>
                        <div class="form-group">
                            <strong>Barrio:</strong>
                            {{ $cliente->bar_cli }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop