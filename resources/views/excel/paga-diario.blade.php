<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paga diario Excel</title>
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
    <h1>Reporte Paga Diario</h1>
    <h3>INVERSIONES PIJAO</h3>

    <h2 style="text-align: left;">Total recogido / prestado</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total recogido</td>
                <td>{{ $sumaValCuo }}</td>
            </tr>
            <tr>
                <td>Total prestado</td>
                <td>{{ $sumaCapPre }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h2>Bonos a cobradores</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nuevosPrestamosCobrador as $nuevoPrestamo)
                <tr>
                    <td>{{ $nuevoPrestamo->nom_cob }}</td>
                    <td>{{ $nuevoPrestamo->val_cuo_pre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Página 1
    </div>
</body>
</html>