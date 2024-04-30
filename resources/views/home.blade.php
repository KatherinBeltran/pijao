@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@if($esAdmin)
<h1>Dashboard</h1>
@endif
@stop

@section('content')
    @if($esAdmin && $prestamosPendientes)
        <div class="alert alert-info alert-dismissible">
            <h5><i class="icon fas fa-info"></i> Alerta!</h5>
            Hay prestamos pendientes por aprobación en la tabla de prestamos.
        </div>
        @elseif(!$esAdmin)
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
@stop