@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Maestro de prestamos</h1>

    <div class="float-right">
        <a href="{{ route('prestamos.create') }}" class="btn btn-block btn-outline-success btn-sm float-right" data-placement="left">
            {{ __('Nuevo') }}
        </a>
    </div>
    <div class="row">
        <div class="col-md-7,1">
            @if (session('success'))
                {!! session('success') !!}
            @endif

            @if (session('error'))
                {!! session('error') !!}
            @endif
        </div>
    </div>
@stop

@section('content')
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="thead">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>No. de cédula</th>
            <th>No. de celular</th>
            <th>Dirección</th>
            <th>Barrio</th>
            <th>Estado</th>
            <th>Dias en mora</th>
            <th>Fecha</th>
            <th>Cobros y/o pagos</th>
            <th>Cuotas</th>
            <th>Capital</th>
            <th>Interes %</th>
            <th>Total a pagar</th>
            <th>Valor cuota</th>
            <th>Cuotas pagadas</th>
            <th>Valor pagado</th>
            <th>Siguiente cuota</th>
            <th>Cuotas pendientes</th>
            <th>Valor cuotas pendientes</th>
            <th>Registrado por</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo)
            <tr class="@if ($prestamo->val_pag_pre == $prestamo->tot_pre) row-green @endif">
                <td>{{ $prestamo->id }}</td>
                
                <td>{{ $prestamo->nom_cli_pre }}</td>
                <td>{{ $prestamo->num_ced_cli_pre }}</td>
                <td>{{ $prestamo->num_cel_cli_pre }}</td>
                <td>{{ $prestamo->dir_cli_pre }}</td>
                <td>{{ $prestamo->barrio->nom_bar }}</td>
                <td>
                    @if ($prestamo->est_pag_pre == 'Al día')
                        <span class="badge badge-success">{{ $prestamo->est_pag_pre }}</span>
                    @elseif ($prestamo->est_pag_pre == 'En mora')
                        <span class="badge badge-danger">{{ $prestamo->est_pag_pre }}</span>
                    @elseif ($prestamo->est_pag_pre == 'Pendiente')
                        <span class="badge badge-info">{{ $prestamo->est_pag_pre }}</span>
                    @else
                        {{ $prestamo->est_pag_pre }}
                    @endif
                </td>
                <td>{{ $prestamo->dia_mor_pre }}</td>
                <td>{{ $prestamo->fec_pre }}</td>
                <td>{{ $prestamo->pag_pre }}</td>
                <td>{{ $prestamo->cuo_pre }}</td>
                <td>{{ $prestamo->cap_pre }}</td>
                <td>{{ $prestamo->int_pre }}</td>
                <td>{{ $prestamo->tot_pre }}</td>
                <td>{{ $prestamo->val_cuo_pre }}</td>
                <td>{{ $prestamo->cuo_pag_pre }}</td>
                <td>{{ $prestamo->val_pag_pre }}</td>
                <td>{{ $prestamo->sig_cuo_pre }}</td>
                <td>{{ $prestamo->cuo_pen_pre }}</td>
                <td>{{ $prestamo->val_cuo_pen_pre }}</td>
                <td>{{ $prestamo->reg_pre }}</td>

                <td>
                <form action="{{ route('prestamos.destroy',$prestamo->id) }}" method="POST">
                    <a class="btn btn-sm btn-info" href="{{ route('prestamos.show',$prestamo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                    <a class="btn btn-sm btn-warning" href="{{ route('prestamos.edit',$prestamo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('') }}</button>
                </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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

        .row-green {
            background-color: green !important;
            color: white !important;
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