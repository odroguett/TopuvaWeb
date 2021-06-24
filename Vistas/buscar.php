


<?php 

require_once("../BD/catalogoBD.php");
$oCatalogo= new catalogoBD();
$sPatron = $_POST['sPatron'];
//Sanitizamos el patron de busqueda//
$sPatron = filter_var($sPatron, FILTER_SANITIZE_STRING);

if(isset($sPatron))
{
    $Listafilas=$oCatalogo->buscador($sPatron);
    if(isset($Listafilas))
    {  echo    
         "
        <div class='modal-header bg-light'>
            <h6 class='modal-title text-secondary' id='exampleModalLabel'>Resultados de busqueda</h6>
            <button type='button' id='botonCerrarDespacho' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
       </div>
       <div class='modal-body bg-light'>
            <table class='responsive-table table table-hover table-bordered' id='tablaBuscar' style='width:100%;' >
            <thead>
              <tr>
                
                 <th class='bg-info text-white'>Producto</th>
                 <th class='bg-info text-white'>Unidad</th>
                 <th class='bg-info text-white'>precio</th>
                 <th class='text-white'>Codigo</th>
                 <th class='text-ligth'>Tamano</th>
                 <th class='text-ligth'>codigo_unidad</th>
              </tr>
            </thead><br>
       <tbody>";
      
        
        foreach($Listafilas as $filas => $value)
        {
        echo "<tr>
        
		<td class='text-ligth'>".$value['descripcion']."</td>	
        <td class='text-ligth'> ".$value['tamano']. " " . $value['codigo_unidad']. "</td>
        <td class='text-ligth'>$ ".$value['precio_venta']."</td>
        <td>".$value['codigo_precio_producto']."</td>	
        <td>".$value['tamano']."</td>	
        <td>".$value['codigo_unidad']."</td>	
		</tr>";
        
        }
        echo "</tbody>
	</table>
    </div>";
    }
    
}

include("../includes/footer.php");





?>

<script>
   $(document).ready(function() {
  $("#tablaBuscar").DataTable({
  
    "language":
    {
        "url": "js/Spanish.json.js" ,
                
    },
    'columns' : [
        null,
        null,
        null,
        //hide the fourth column
        {'visible' : false,"width": "0px" },
        {'visible' : false,"width": "0px" },
        {'visible' : false,"width": "0px" }
    ],
    "responsive": true,
    "lengthChange": true,
    "ordering": false,
    "info": false,
    "lengthChange": true,
   
    
});

var table = $('#tablaBuscar').DataTable();

$('#tablaBuscar tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        oCarrito.LinkProducto(data[0], data[2],data[4],data[5],1,"");
        $("#botonCerrarDespacho").click();
                        
    } );
});
</script>