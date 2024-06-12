<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Excel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
        h3 {
            text-align: center;
            font-weight: normal;
            margin: 5px 0;
            font-size: 14px;
        }
        .fecha-hora {
            text-align: right;
            font-size: 12px;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="fecha-hora">{{ (new DateTime('now', new DateTimeZone('America/Bogota')))->format('Y-m-d H:i:s') }}</div>
    <h1>Reporte Económico</h1>
    <h3>INVERSIONES PIJAO</h3>
    <h3>Desde {{ $fechaInicio }} hasta {{ $fechaFin }}</h3>

    <h2 style="text-align: left;">Resumen de Gastos</h2>
    <table>
        <thead>
            <tr>
                <th>Categoría</th>
                <th>Suma de Montos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reporte as $item)
            <tr>
                <td>{{ $item->nom_cat }}</td>
                <td>{{ number_format($item->suma_montos, 0, '', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td>Total</td>
                <td>{{ number_format($reporte->sum('suma_montos'), 0, '', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h2 style="text-align: left;">Análisis de Préstamo</h2>
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Capital Prestado</td>
                <td>{{ number_format($capitalPrestado, 0, '', '.') }}</td>
            </tr>
            <tr>
                <td>Total Recolectado</td>
                <td>{{ number_format($totalRecolectado, 0, '', '.') }}</td>
            </tr>
            <tr>
                <td>Total Dinero prestado con intereses</td>
                <td>{{ number_format($totalDineroPrestadoConIntereses, 0, '', '.') }}</td>
            </tr>
            <tr>
                <td>Total Utilidad</td>
                <td>{{ number_format($totalUtilidad, 0, '', '.') }}</td>
            </tr>
            <tr>
                <td>Utilidad Neta con gastos</td>
                <td>{{ number_format($utilidadNetaConGastos, 0, '', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <div class="footer">
        Página 1
    </div>
</body>
</html>