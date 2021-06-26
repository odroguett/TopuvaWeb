<?php 

require_once("../BD/catalogoBD.php");
$oCatalogo= new catalogoBD();
$idDespacho = $_POST['idDespacho']; 
$sNombre="";
$sApellido="";
$sDireccion="";
$sDepartamento="";
$sComuna="";
$sCiudad="";
$sRegion="";
$sTelefono="";
$sEmail="";


if($idDespacho !="")
{
    $Listafilas=$oCatalogo->obtieneDatosDespacho($idDespacho);
    foreach($Listafilas as $filas => $value)
{
   $sNombre = $value['NOMBRE'];
   $sApellido = $value['APELLIDOS'];
   $sDireccion = $value['DIRECCION'];
   $sDepartamento = $value['DEPARTAMENTO'];
   $sComuna = $value['COMUNA'];
   $sCiudad = $value['CIUDAD'];
   $sRegion = $value['REGION'];
   $sTelefono = $value['TELEFONO'];
   $sEmail = $value['EMAIL'];
}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>Agregar Dirección</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />
    <!-- Icofont Icon-->
    <link href="vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Datos del Pedido</h5>
    <button type="button" id="botonCerrarDespacho" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">



    <body class="fixed-bottom-padding">
        <div class="row">
            <div class="col-md-6">
                <label id="idError" type="text" class="text-danger" hidden ></label>
            </div>
        </div>
        <!-- body -->
        <section class="py-4 osahan-main-body">
            <div class="title d-flex align-items-center py-3">
                <form action="" method="" class="">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <input placeholder="Nombre" id="nombre" type="text" class="form-control" required value="<?php  echo $sNombre ?>" > </inpuit>
                        </div>
                        <div class="col-md-6">
                            <input placeholder="Apellidos" id="apellido" type="text" class="form-control" required value="<?php  echo $sApellido ?>">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input placeholder="Dirección" id="direccion" type="text" class="form-control" required value="<?php  echo $sDireccion ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input placeholder="Departamento" id="departamento" type="text" class="form-control" value="<?php  echo $sDepartamento ?>">
                        </div>
                    </div>
                    <div class="row form-group">

                        <div class="col-md-6">
                            <input placeholder="Ciudad" id="ciudad" type="text" class="form-control" required value="<?php  echo $sCiudad ?>">
                        </div>
                        <div class="col-md-6">
                            <input placeholder="Comuna" id="comuna" type="text" class="form-control" required value="<?php  echo $sComuna ?>">
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-12 ">
                            <input placeholder="Region" id="region" type="text" class="form-control" value="<?php  echo $sRegion ?>">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input placeholder="Teléfono" id="telefono" type="text" class="form-control" required value="<?php  echo $sTelefono ?>">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input placeholder="Email" id="email" type="email" class="form-control" required value="<?php  echo $sEmail ?>">
                        </div>

                    </div>

                </form>

            </div>
            <div class="row form-group">
                <div class="col-md-11">
                    <button type="button" id="btnIngresar" class="btn btn-info btn-block">Ingresar</button>
                </div>
            </div>
        </section>
    </body>
</div>


</html>
<?php include("../includes/footer.php")  ?>
