<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte PDF</title>
    <style>
        /* Estilos CSS para el PDF */
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
            margin: 5px 0; /* Reducir espacio superior e inferior */
            font-size: 14px; /* Reducir tamaño de fuente */
        }
        .fecha-hora {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 12px;
        }
        /* Estilos para el pie de página */
        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
        }
        .pageNumber::after {
            content: counter(page);
        }
        /* Restablecer contador de página en el encabezado */
        @page {
            counter-reset: page 1;
        }
    </style>
</head>
<body>
    <div class="fecha-hora">{{ (new DateTime('now', new DateTimeZone('America/Bogota')))->format('Y-m-d H:i:s') }}</div>
    <h1>Reporte Paga Diario</h1>
    <h3>INVERSIONES PIJAO</h3>

    <h2 style="text-align: left;">Total recogido / prestado</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total recogido</td>
                <td>{{ number_format($sumaValCuo, 0, '', '.') }}</td>
            </tr>
            <tr>
                <td>Total prestado</td>
                <td>{{ number_format($sumaCapPre, 0, '', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h2>Bonos a cobradores</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nuevosPrestamosCobrador as $nuevoPrestamo)
                <tr>
                    <td>{{ $nuevoPrestamo->nom_cob }}</td>
                    <td>{{ number_format($nuevoPrestamo->val_cuo_pre * 2, 0, '', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Página <span class="pageNumber"></span>
    </div>
</body>
</html>