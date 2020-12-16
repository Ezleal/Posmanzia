<?php

?>

<table>
    <thead>
    <tr>
                    <td style='font-weight:bold; border:1px solid #f00;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #f00;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #f00;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #f00;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #f00;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #f00;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #f00;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #f00;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #f00;'>METODO DE PAGO</td>
					<td style='font-weight:bold; border:1px solid #f00;'>FECHA</td>	
    </tr>
    </thead>
    <tbody>
    @foreach($ventas as $rowVenta => $venta)
        
        <tr>
            <td style='border:1px solid #f00;'>{{ $venta->codigo }}</td>
            <td style='border:1px solid #f00;'>{{ $venta->cliente->name }}</td>
            <td style='border:1px solid #f00;'>{{ $venta->vendedor->name }}</td>
            <td style='border:1px solid #f00;'>
                <?php
                $productos =  json_decode($venta["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode("<br>".$valueProductos["cantidad"]);
                     }
                echo utf8_decode("</td><td style='border:1px solid #f00;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode("<br>".$valueProductos["descripcion"]);
		 		
                 }
                 echo utf8_decode("</td>
					<td style='border:1px solid #f00;'>$ ".number_format($venta->impuesto,2)."</td>
					<td style='border:1px solid #f00;'>$ ".number_format($venta->neto,2)."</td>	
					<td style='border:1px solid #f00;'>$ ".number_format($venta->total,2)."</td>
					<td style='border:1px solid #f00;'>".$venta->metodo_pago."</td>
					<td style='border:1px solid #f00;'>".substr($venta->fecha,0,10)."</td>		
		 			</tr>");
                ?>
  
    @endforeach
    
    </tbody>
</table>
