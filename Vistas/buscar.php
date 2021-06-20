<?php 

include("../BD/catalogoBD.php");
$oCatalogo= new catalogoBD();
$sPatron = $_POST['sPatron'];
if(isset($sPatron))
{
    $Listafilas=$oCatalogo->buscador($sPatron);
    if(isset($Listafilas))
    {  echo    
         "
        <div class='modal-header'>
            <h6 class='modal-title text-secondary' id='exampleModalLabel'>Resultados de busqueda</h6>
            <button type='button' id='botonCerrarDespacho' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
       </div>
       <div class='modal-body'>
            <table class='responsive-table table table-hover table-bordered'>
            <thead>
              <tr>
                 <th class='bg-info'>Producto</th>
                 <th class='bg-info'>Unidad</th>
                 <th class='bg-info'>precio</th>
              </tr>
            </thead><br>
       <tbody>";
      
        
        foreach($Listafilas as $filas => $value)
        {
            echo "<tr>
		<td class='text-info'>".$value['descripcion']."</td>	
        <td class='text-info'> ".$value['tamano']. " " . $value['codigo_unidad']. "</td>
        <td class='text-info'>$ ".$value['precio_venta']."</td>
		</tr>";
        
        }
        echo "</tbody>
	</table>
    </div>";
    }
    
}







?>