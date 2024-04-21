@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Rol</h1>
@stop

@section('content')
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'roles.store']) !!}

                @include('role.partials.form')

                {!! Form::submit('Guardar', ['class' => 'btn btn-success border border-secondary btn-sm']) !!}
                {!! Form::close() !!}
            </div>      
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop