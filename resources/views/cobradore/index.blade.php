@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de cobradores</h1>

    <div class="float-right">
        <a href="{{ route('cobradores.create') }}" class="btn btn-block btn-outline-success btn-sm float-right"  data-placement="left">
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
                <th>Zona</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cobradores as $cobradore)
                <td>{{ $cobradore->id }}</td>
                                            
                <td>{{ $cobradore->nom_cob }}</td>
                <td>{{ $cobradore->num_ced_cob }}</td>
                <td>{{ $cobradore->num_cel_cob }}</td>
                <td>{{ $cobradore->dir_cob }}</td>
                <td>{{ $cobradore->barrio->nom_bar }}</td>
				<td>{{ $cobradore->zona->nom_zon }}</td>

                <td>
                    <form action="{{ route('cobradores.destroy',$cobradore->id) }}" method="POST">
                        <a class="btn btn-sm btn-info" href="{{ route('cobradores.show',$cobradore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                        <a class="btn btn-sm btn-warning" href="{{ route('cobradores.edit',$cobradore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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