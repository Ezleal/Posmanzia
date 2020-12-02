<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FACTURA N° {{ $venta->codigo }}</title>
    <link rel="stylesheet" href="css/stylePDF.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="images/logo.png">
      </div>
      <div id="company">
        <h2 class="name">Nielsen CCA</h2>
        <div>Av. Siempreviva 742, CP 90004, AR</div>
        <div>(5411) 112259-0450</div>
        <div><a href="mailto:nielsencca@gmail.com">Nielsencca@gmail.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">Facturado a:</div>
          <h2 class="name">{{ $venta->cliente->name }}</h2>
          <div class="address">{{ $venta->cliente->direccion }}</div>
          <div class="email"><a href="mailto:{{ $venta->cliente->email }}">{{ $venta->cliente->email }}</a></div>
        </div>
        <div id="invoice">
          <h1>FACTURA N° {{ $venta->codigo }}</h1>
          <div class="date">Fecha: {{ $venta->fecha }}</div>
          <div class="date">Vendedor: {{ $venta->vendedor->name }}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPCIÓN</th>
            <th class="unit">PRECIO UNITARIO</th>
            <th class="qty">CANTIDAD</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
       @foreach ($productos as $item)
       <tr>
           <td class="no">{{ $contador++ }}</td>
           <td class="desc"><h3></h3>{{ $item['descripcion'] }}</td>
           <td class="unit">${{ $item['precio'] }}</td>
           <td class="qty">{{ $item['cantidad'] }}</td>
           <td class="total">${{ $item['total'] }}</td>
        </tr>
           
        @endforeach
           
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>${{ $venta->neto }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">IVA 21%</td>
            <td>${{$venta->impuesto }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">PRECIO TOTAL</td>
            <td>${{$venta->total }}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Gracias por su Compra!</div>
      <div id="notices">
        <div>IMPORTANTE!</div>
        <div class="notice">No se aceptan devoluciones pasada la semana de compra (solo por defectos de fabrica).</div>
      </div>
    </main>
    <footer>
      Documento no valido como factura.
    </footer>
  </body>
</html>