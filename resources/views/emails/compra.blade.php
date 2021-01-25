<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo De Prueba</title>
</head>
<body>
    <h1>
        Gracias por su Compra {{ $cliente->name }}
    </h1>
    <p>Adjuntamos su recibo con numero <strong>{{ $venta->codigo }}</strong>  </p>
</body>
</html>