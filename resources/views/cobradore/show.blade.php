@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ver Cobrador</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-outline-danger btn-sm custom-btn" href="{{ route('cobradores.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Código:</strong>
                            {{ $cobradore->id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $cobradore->nom_cob }}
                        </div>
                        <div class="form-group">
                            <strong>No. de cédula:</strong>
                            {{ $cobradore->num_ced_cob }}
                        </div>
                        <div class="form-group">
                            <strong>No. de celular:</strong>
                            {{ $cobradore->num_cel_cob }}
                        </div>
                        <div class="form-group">
                            <strong>Correo electrónico:</strong>
                            {{ $cobradore->cor_ele_cob }}
                        </div>
                        <div class="form-group">
                            <strong>Dirección:</strong>
                            {{ $cobradore->dir_cob }}
                        </div>
                        <div class="form-group">
                            <strong>Barrio:</strong>
                            {{ $cobradore->barrio->nom_bar }}
                        </div>
                        <div class="form-group">
                            <strong>Zona:</strong>
                            {{ $cobradore->zona->nom_zon }}
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