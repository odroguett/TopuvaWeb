<?php 
include("includes/BD/catalogoBD.php");
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
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <body class="fixed-bottom-padding">
        <!-- body -->
        <section class="py-4 osahan-main-body">
            <div class="title d-flex align-items-center py-3">
                <form class="">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <input placeholder="Nombre" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input placeholder="Apellidos" type="text" class="form-control">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input placeholder="Dirección" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input placeholder="Departamento" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">

                        <div class="col-md-6">
                            <input placeholder="Ciudad" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input placeholder="Comuna" type="text" class="form-control">
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-12 ">
                            <input placeholder="Region" type="text" class="form-control">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input placeholder="Teléfono" type="text" class="form-control">
                        </div>

                    </div>
                </form>
            </div>
        </section>
    </body>
</div>
<div class="modal-footer p-0 border-0">
            <form class="">
                
                    <div class="col-md-12 form-group">
                        <button type="button" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                


            </form>

    
    
</div>


</html>