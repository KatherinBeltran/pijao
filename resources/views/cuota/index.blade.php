@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Manejo de cuotas</h1>

    <div class="float-right">
        <a href="{{ route('cuotas.create') }}" class="btn btn-block btn-outline-success btn-sm float-right" data-placement="left">
            {{ __('Nuevo') }}
        </a>
    </div>
    <br>
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
                <th>Código prestamo</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Total abonado</th>
                <th>Saldo</th>
                <th>Número</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuotas as $cuota)
                @php
                    $prestamo = $prestamos->where('cuo_pre', $cuota->num_cuo)->first();
                @endphp
                <tr class="@if ($cuota->sal_cuo !== null && $cuota->sal_cuo == 0)
                    row-green 
                @elseif ($cuota->fec_cuo < \Carbon\Carbon::now('America/Bogota')->format('Y-m-d'))
                    row-red 
                @endif" id="row_{{ $cuota->id }}">
                    <td>{{ $cuota->pre_cuo }}</td>
                    <td>{{ $cuota->prestamo->nom_cli_pre }}</td>
                    <td>{{ $cuota->fec_cuo }}</td>
                    <td>{{ $cuota->val_cuo }}</td>
                    <td>{{ $cuota->tot_abo_cuo }}</td>
                    <td>{{ $cuota->sal_cuo }}</td>
                    <td>{{ $cuota->num_cuo }}</td>
                    <td>{{ $cuota->obs_cuo }}</td>
                    <td>
                        <form action="{{ route('cuotas.destroy',$cuota->id) }}" method="POST">
                            <a class="btn btn-sm btn-info" href="{{ route('cuotas.show',$cuota->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('cuotas.edit',$cuota->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
        .row-red {
            background-color: #dc3545 !important;
            color: white !important;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
    $(document).ready(function() {
        $('#example tbody').sortable({
            items: 'tr',
            cursor: 'move',
            opacity: 0.6,
            revert: 300,
            update: function(event, ui) {
                var order = $(this).sortable('toArray');
                
                $.ajax({
                    url: '{{ route("cuotas.updateOrder") }}', // Aseg迆rate de que esta URL sea correcta
                    method: 'POST',
                    data: { 
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Orden actualizado exitosamente.');
                            alert('Orden actualizado exitosamente.');
                        } else {
                            console.error('Error al actualizar el orden:', response);
                            alert('Error al actualizar el orden.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', status, error);
                        console.log('Respuesta del servidor:', xhr.responseText);
                        alert('Error al actualizar el orden. Por favor, revisa la consola para m芍s detalles.');
                    }
                });
            }
        }).disableSelection();
    });
    </script>
@stop