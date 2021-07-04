


<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/TopuvaWeb/rutas.php');
require_once(BD . "catalogoBD.php");
require_once(COMPARTIDA . "parametros.php");
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
            <h6 class='modal-title text-kumel-titulo' id='exampleModalLabel'>Resultados de busqueda</h6>
            <button type='button' id='botonCerrarDespacho' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
       </div>
       <div class='modal-body bg-light'>
            <table class='responsive-table table table-hover table-bordered' id='tablaBuscar' style='width:100%;' >
            <thead>
              <tr>
                
                 <th class='bg-kumel text-kumel-texto'>Imagen</th>
                 <th class='bg-kumel text-kumel-texto'>Producto</th>
                 <th class='bg-kumel text-kumel-texto'>Unidad</th>
                 <th class='bg-kumel text-kumel-texto'>precio</th>
                 <th class='text-white'>Codigo</th>
                 <th class='text-ligth'>Tamano</th>
                 <th class='text-ligth'>codigo_unidad</th>
                 <th class='text-ligth'>stock</th>
              </tr>
            </thead><br>
       <tbody>";
      
        
        foreach($Listafilas as $filas => $value)
        {
        echo "<tr>
        <td class='text-kumel-titulo'> <img id='imagen-producto' src=" .$value['IMAGEN'] . "  height='70' width='70'> </td>
		<td class='text-kumel-titulo'>".$value['descripcion']."</td>	
        <td class='text-kumel-titulo'> ".$value['tamano']. " " . $value['codigo_unidad']. "</td>
        <td class='text-kumel-tituloh'> " . $value['precio_venta'] . "</td>
        <td>".$value['codigo_precio_producto']."</td>	
        <td>".$value['tamano']."</td>	
        <td>".$value['codigo_unidad']."</td>	
        <td>".$value['stock']."</td>	
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
        null,
        //hide the fourth column
        {'visible' : false,"width": "0px" },
        {'visible' : false,"width": "0px" },
        {'visible' : false,"width": "0px" },
        {'visible' : false,"width": "0px" },
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
        var imagen = $(data[0]).attr("src");
        oCarrito.LinkProducto(imagen, data[1],data[3],data[5],data[6] , data[7],data[4]);
        $("#botonCerrarDespacho").click();
                        
    } );
});
</script>