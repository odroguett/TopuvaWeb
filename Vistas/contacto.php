<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="icon" type="image/png" href="img/logo.png">
   <title>Frutos Secos</title>
   <!-- Slick Slider -->
   <link rel="stylesheet" type="text/css" href="../vendor/slick/slick.min.css" />
   <link rel="stylesheet" type="text/css" href="../vendor/slick/slick-theme.min.css" />
   <!-- Icofont Icon-->
   <link href="../vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">
   <!-- Bootstrap core CSS -->
   <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Custom styles for this template -->
   <link href="../css/style.css" rel="stylesheet">
   <!-- Sidebar CSS -->
   <link href="../vendor/sidebar/demo.css" rel="stylesheet">
</head>


<body class="fixed-bottom-padding bg-light">
   <div class="row">
      <div class=" col-lg-12 ">
         <div class="form-inline ">

            <div class="col-md-7 bg-ligth">
               <div class="bg-ligth form-inline">
                  <img class="img-fluid logo-img  " src="../img/logo.png">
                  <div class="col-md-3 bg-ligth ">
                     <div class="bg-ligth">
                        <h5 class="text-kumel-titulo text-kumel-titulo-fuente ">Productos naturales</h5>
                     </div>
                  </div>
                  
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-inline ">
               <ul class="list-unstyled form-inline mb-0 border-right border-left">
                     <li class="nav-item active">
                        <a class="nav-link text-kumel-bold pl-0" href="/TopuvaWeb/index.php"> <i class="icofont-circled-left"></i>
                        Home
                     </a>
                     </li>
                  </ul>
                  <div class=" border-right ">
                     <a href="#" class="btn btn-icon btn-light"> <i class="icofont-facebook"></i></a>
                     <a href="#" class="btn btn-icon btn-light "><i class="icofont-instagram"></i></a>
                  </div>
                  <input type="text" class="form-control idPatronBusqueda" id="idPatronBusqueda"
                     placeholder="Buscar Productos">
                  <div class="input-group-prepend border-right  ">
                     <div id="btnBuscarProductos" class="btn btn-light rounded-right"><i class="icofont-search"></i>
                     </div>
                  </div>

                  <a href="#" id="carrito"
                     class="ml-2 text-dark bg-light rounded-pill p-2 icofont-size border shadow-sm">
                     <i class="icofont-shopping-cart"></i>
                  </a>
               </div>

            </div>

         </div>
      </div>
   </div>

   <div class="col-lg-12">
      <hr></span>

   </div>

   <section class="py-4 osahan-main-body">
      <div class="container" style="max-width: 60%; ">
         <div class="row ">
         <img src="../img/Kummel.jpg"  class="img-contacto  bg-Kumel" alt="Responsive image">
         </div>
      </div>
   </section>
   
   <section class="py-4 osahan-main-body">
      <div class="container ">
         <div class="row">

            <div class="col-lg-12 p-4 bg-light rounded shadow-sm">

               <div id="edit_profile">
                  <div class="p-0">
                     <form action="../Negocio/enviarDatosContacto.php" method="post">

                        <div class="form-group row ">
                           <div class="col-lg-6">
                              <label class="text-kumel-titulo" for="exampleInputName1">Tu nombre</label>
                              <input type="text" placeholder="Ingresa tu nombre" class="form-control"
                                 id="exampleInputName1" name="nombre" required>
                           </div>
                           <div class="col-lg-6">
                              <label class="text-kumel-titulo" for="exampleInputEmail1">Correo</label>
                              <input type="email" placeholder="Correo" class="form-control" id="exampleInputEmail1"
                                 name="mail" aria-describedby="emailHelp" required>
                           </div>



                        </div>

                        <div class="form-group row">
                           <div class="col-lg-7">
                              <textarea class="text-kumel-titulo" rows="10" cols="100" id="ContactFormMessage"
                                 name="mensaje" placeholder="Mensaje" required></textarea>
                           </div>

                           <div class="col-lg-4">
                              <input type="submit" class="btn btn-kumel" style="position: absolute;top: 80%;"
                                 value="enviar">
                           </div>


                        </div>

                     </form>
                  </div>
               </div>
            </div>
         </div>

   </section>




</body>
<!-- footer -->
<footer class="section-footer border bg-kumel">
   <br />
   <div class="form-inline">

      <div class="col-md-1 offset-md-1"></div>
      <div class="row  " style="height: 200px">


         <div class=" col-lg-6">
            <h5 style="text-align: left;" class="text-kumel-texto">Contactanos</h5>
            <ul>
               <li class="text-kumel-texto ">topuva@gmail.com</li>
               <li class="text-kumel-texto">+569999999</li>
            </ul>
         </div>
      </div>
   </div>






</footer>

</html>