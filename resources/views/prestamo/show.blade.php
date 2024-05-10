@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ver Prestamo</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-right">
                            <a class="btn btn-outline-danger btn-sm custom-btn" href="{{ route('prestamos.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Código:</strong>
                                    {{ $prestamo->id }}
                                </div>
                                <div class="form-group">
                                    <strong>Nombre:</strong>
                                    {{ $prestamo->nom_cli_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>No. de cédula:</strong>
                                    {{ $prestamo->num_ced_cli_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>No. de celular:</strong>
                                    {{ $prestamo->num_cel_cli_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Dirección:</strong>
                                    {{ $prestamo->dir_cli_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Barrio:</strong>
                                    {{ $prestamo->barrio->nom_bar }}
                                </div>
                                <div class="form-group">
                                    <strong>Fecha:</strong>
                                    {{ $prestamo->fec_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Cobros y/o pagos:</strong>
                                    {{ $prestamo->pag_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Cuotas:</strong>
                                    {{ $prestamo->cuo_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Capital:</strong>
                                    {{ $prestamo->cap_pre }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Interes %:</strong>
                                    {{ $prestamo->int_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Total:</strong>
                                    {{ $prestamo->tot_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Valor cuota:</strong>
                                    {{ $prestamo->val_cuo_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Cuota pagada:</strong>
                                    {{ $prestamo->cuo_pag_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Valor pagado:</strong>
                                    {{ $prestamo->val_pag_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Siguiente cuota:</strong>
                                    {{ $prestamo->sig_cuo_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>cuotas pendientes:</strong>
                                    {{ $prestamo->cuo_pen_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Valor cuotas pendientes:</strong>
                                    {{ $prestamo->val_cuo_pen_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Estado:</strong>
                                    {{ $prestamo->est_pag_pre }}
                                </div>
                                <div class="form-group">
                                    <strong>Dias en mora:</strong>
                                    {{ $prestamo->dia_mor_pre }}
                                </div>
                            </div>
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