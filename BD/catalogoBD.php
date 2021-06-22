<?php 
include("conexion.php");
include("respuesta.php");
class catalogoBD
{

 private $oRespuesta;

 public function __construct() {
  $this->oRespuesta = new RespuestaOtd();
  
}

    function ejecutarConsulta($sSql)
    {

      $oConexion = new Conexion();
      $oConexion->conectar();
      $lista= $oConexion->traerDatos($sSql);
      $oConexion->cerrar();
      return $lista;
    }

    function ejecutarConsultaIndividual($sSql)
    {

      $oConexion = new Conexion();
      $oConexion->conectar();
      $lista= $oConexion->traerDatosIndividuales($sSql);
      $oConexion->cerrar();
      return $lista;
    }
function obtieneCategorias()
{
  $sSql="select * from categorias";
  $lista= $this->ejecutarConsulta($sSql);
  return $lista;

}

function obtieneProductosDestacados()
{
  try{

    $sSql='select 
    u.codigo_unidad,
    u.descripcion_unidad,
    u.tamano as tamano_unidad,
    p.descripcion,
    vp.precio_venta,
    vp.imagen,
    vp.codigo_precio_producto
from 
    unidades u, 
    productos p,
    venta_productos vp,
    categorias c
where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    p.id_categoria =  c.id_categoria and vp.destacado = 1
    order by VP.ID_PRODUCTO';
$lista= $this->ejecutarConsulta($sSql);
return $lista;
  }
  catch(Exception $e)
  {
    return NULL;
  }

}

function obtienePrecioProductos($sCategoria)
{

  try
  {
    $sSql ='select  u.codigo_unidad,
    u.descripcion_unidad,
    u.tamano as tamano_unidad,
    p.descripcion,
    vp.precio_venta,
    vp.codigo_precio_producto
from 
    unidades u, 
    productos p,
    venta_productos vp,
    categorias c
where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    p.id_categoria =  c.id_categoria and c.id_categoria = "'.  $sCategoria  .'"
    order by VP.ID_PRODUCTO';


$lista= $this->ejecutarConsulta($sSql);
return $lista;

  }

  catch(Exception $e)
  {
    return NULL;
  }

}

function obtieneDisponibleProductos($sProducto)
{
  try
  {
    $sSql ='select 
    codigo_unidad , tamano
from 
    unidades u, 
    venta_productos vp,
    productos p
where 
    u.id_unidad = vp.id_unidad and
    p.id_producto = vp.id_producto and
    p.descripcion= "'.  $sProducto  .'" and  vp.stock > 0';
$lista= $this->ejecutarConsulta($sSql);
return $lista;


  }

  catch(Exception $e)
  {
    return NULL;
  }

}


function obtieneDatosDespacho($idDespacho)
{
  try
  {
$sSql ='select * from despacho where id_despacho= '. $idDespacho;
$lista= $this->ejecutarConsulta($sSql);
return $lista;


  }

  catch(Exception $e)
  {
    return NULL;
  }

}


function obtieneProductosRelacionados($sProducto)
{

  try{
    $sSql ='select  u.codigo_unidad,
    u.descripcion_unidad,
    u.tamano as tamano_unidad,
    p.descripcion,
    vp.precio_venta
    from unidades u, 
    productos p,
    venta_productos vp,
    categorias c
    where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    p.id_categoria =  c.id_categoria and p.descripcion="'.  $sProducto  .'"
    order by vp.ID_PRODUCTO';
    $lista= $this->ejecutarConsulta($sSql);
    return $lista;
  }
  catch(Exception $e)
  {


    return NULL;
  }

}

function obtieneParametros()
{
  try
  {
 $sSql ='select * from parametros';
 $lista= $this->ejecutarConsulta($sSql);
 return $lista;
  }

  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
   return null;
    


  }

}

function InsertaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail)
{

  try{

    $oConexion = new Conexion();
    $dmIdDespacho=0;
    $sSql = 'select count(id_despacho) as id from despacho';
    $ArraydmIdDespacho =$this->ejecutarConsultaIndividual($sSql);
    $dmIdDespacho= $ArraydmIdDespacho["id"];
    if($dmIdDespacho ==0)
    {

      $dmIdDespacho = 1;
    }
    else
    {
      $dmIdDespacho = $dmIdDespacho  + 1;
    }
    $sSql='';
    $sSql ='Insert into despacho (ID_DESPACHO,NOMBRE,APELLIDOS,DIRECCION,DEPARTAMENTO,COMUNA,CIUDAD,REGION,TELEFONO,EMAIL,ID_CLIENTE,ID_TIPO_DESPACHO)
    VALUES(' . $dmIdDespacho . ',"'.$sNombre.'","'.$sApellidos .'","'.$sDireccion.'","'.$sDepartamento.'","'.$sComuna.'","'.$sCiudad.'","'.$sRegion.'","'.$sTelefono.'","'.$sEmail.'",1,1) ';
    
    $oConexion->conectar();
    $oConexion->execBool($sSql);
    $oConexion->cerrar();
   $this->oRespuesta ->bEsValido =true;
   $this->oRespuesta ->idDespacho =$dmIdDespacho;
   $this->oRespuesta ->sDireccion =$sDireccion;
   $this->oRespuesta ->sDepartamento =$sDepartamento;
   $this->oRespuesta ->sComuna =$sComuna;
   $this->oRespuesta ->sCiudad =$sCiudad;
   $this->oRespuesta ->sRegion =$sRegion;
   $this->oRespuesta ->sTelefono =$sTelefono;
   $this->oRespuesta ->sMensaje ="Datos para el despacho ingresados correctamente.";
    return $this->oRespuesta;
  }
  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    $this->oRespuesta ->bEsValido =false;
    


  }

}

function ActualizaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail,$idDespacho)
{

  try{

    $oConexion = new Conexion();
    $sSql='';
    $sSql ='update despacho set NOMBRE =  "'.$sNombre. '", APELLIDOS = "'.$sApellidos .'",DIRECCION = "' .  $sDireccion.'",
           COMUNA ="' .  $sComuna.'", CIUDAD ="'.$sCiudad.'",REGION ="'.$sRegion.'",DEPARTAMENTO = "'.$sDepartamento.'",
           TELEFONO="'.$sTelefono.'",EMAIL="'.$sEmail.'"
           WHERE ID_DESPACHO = ' . $idDespacho . '';
    
    
    $oConexion->conectar();
    $oConexion->execBool($sSql);
    $oConexion->cerrar();
  $this->oRespuesta ->bEsValido =true;
   $this->oRespuesta ->idDespacho =$idDespacho;
   $this->oRespuesta ->sDireccion =$sDireccion;
   $this->oRespuesta ->sDepartamento =$sDepartamento;
   $this->oRespuesta ->sComuna =$sComuna;
   $this->oRespuesta ->sCiudad =$sCiudad;
   $this->oRespuesta ->sRegion =$sRegion;
   $this->oRespuesta ->sTelefono =$sTelefono;
   $this->oRespuesta ->bEsValido =true;
   $this->oRespuesta ->sMensaje ="Actualización de datos para despacho correcta.";
    return $this->oRespuesta;
  }
  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    $this->oRespuesta ->bEsValido =false;
    


  }

  function RebajaStock($codigoProducto)
  {
    try{
    
   $oConexion = new Conexion();
   $sSql = 'update venta_productos set STOCK = STOCK - '. $codigoProducto . ' 
           WHERE CODIGO_PRECIO_PRODUCTO = "'. $codigoProducto  . '"' ;
           $oConexion->conectar();
           $oConexion->execBool($sSql);
           $oConexion->cerrar();
    return true;
    }
    catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    return false;
    


  }
  
  }
  
}
function RevisaStock($codigoProducto)
  {
    try{
    
   
   $sSql = 'select STOCK from  venta_productos 
            WHERE CODIGO_PRECIO_PRODUCTO = "'. $codigoProducto  . '"' ;
  $Array =$this->ejecutarConsultaIndividual($sSql);
  $dmStock= $Array["STOCK"];
   return $dmStock;
  return true;
    }
    catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    return false;
    


  }
  
  }

function eliminaDespacho($idDespacho)
{
  try{
    $oConexion = new Conexion();
    $sSql='';
    $sSql = 'delete from despacho where id_despacho =' . $idDespacho;
    $oConexion->conectar();
    $oConexion->execBool($sSql);
    $oConexion->cerrar();
    $this->oRespuesta ->bEsValido =true;
    $this->oRespuesta ->sMensaje ="Información de despacho eliminada correctamente.";
    return $this->oRespuesta;

  }
  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    $this->oRespuesta ->bEsValido =false;
   


  }


}

function InsertarCabeceraPago($idDespacho,$totalProductosPago,$idTipoPago,$totalPago)
{

  $oConexion = new Conexion();
  $dmIdDetalle=0;
  $sSql = 'select count(id_detalle) as id from carrito';
  $ArraydmIdDespacho =$this->ejecutarConsultaIndividual($sSql);
  $dmIdDetalle= $ArraydmIdDespacho["id"];
  if($dmIdDetalle ==0)
  {

    $dmIdDetalle = 1;
  }
  else
  {
    $dmIdDetalle = $dmIdDetalle  + 1;
  }
  $sSql='';
  $sSql ='Insert into carrito (ID_DETALLE,TOTAL_PRODUCTOS,TOTAL_VENTA,ID_TIPO_PAGO,ID_DESPACHO)
    VALUES(' . $dmIdDetalle . ',"'.$totalProductosPago.'","'.$totalPago .'","'.$idTipoPago.'","'.$idDespacho.'") ';
  $oConexion->conectar();
  $oConexion->execBool($sSql);
  $oConexion->cerrar();
  return $dmIdDetalle;

}
function InsertarDetallePago($dmIdDetalle ,$cantidadProducto,$Montoventa,$codigoProducto)
{

  $oConexion = new Conexion();
  $Montoventa = $cantidadProducto * $Montoventa;
  $sSql='';
  $sSql ='Insert into detalle_ventas (ID_DETALLE,CANTIDAD,VENTA,CODIGO_PRECIO_PRODUCTO)
    VALUES(' . $dmIdDetalle . ',"'.$cantidadProducto.'","'.$Montoventa .'","'.$codigoProducto.'") ';
  $oConexion->conectar();
  $oConexion->execBool($sSql);
  $oConexion->cerrar();

}

function obtieneDatosVentaProducto($sCodigoProducto)
{

  try{
  
    $sSql ='select vp.*,p.descripcion,u.codigo_unidad, u.tamano
           from venta_productos vp, productos p , unidades u
           where vp.id_producto = p.id_producto and 
           u.id_unidad = vp.id_unidad and
           vp.codigo_precio_producto =  "'. $sCodigoProducto . '"';

           $lista= $this->ejecutarConsulta($sSql);
           return $lista;
  }
  catch(Exception $e)
  {
    return NULL;
  }

}


function buscador($sPatron)
{

  try{
  
    $sSql ="select vp.codigo_precio_producto,vp.precio_venta,p.descripcion,VP.IMAGEN ,
            u.codigo_unidad,u.descripcion_unidad, u.tamano,vp.stock
            from venta_productos vp, productos p, unidades u
            where 
              vp.id_unidad = u.id_unidad and
              vp.id_producto= p.id_producto 
              and (p.descripcion like '%".$sPatron."%' or 
              u.tamano like '%".$sPatron."%' or
              u.codigo_unidad like'%".$sPatron."%')
              order by DESCRIPCION,tamano asc";
           $lista= $this->ejecutarConsulta($sSql);
           return $lista;
  }
  catch(Exception $e)
  {
    return NULL;
  }

}

function obtieneCabeceraDespacho($idDespacho)
{
  try
  {
$sSql ='select 
            d.ID_DESPACHO, d.nombre,d.APELLIDOS, c.TOTAL_PRODUCTOS,c.TOTAL_VENTA,
            c.ID_TIPO_PAGO, tp.descripcion as descripcion_tipo_pago,
            td.DESCRIPCION as descripcion_tipo_despacho
        from 
            despacho d, carrito c,tipo_pago tp,tipo_Despacho td
        where 
            d.id_despacho = c.id_despacho and
            c.ID_TIPO_PAGO = tp.id_tipo_pago and
            d.id_TIPO_DESPACHO= td.ID_TIPO_DESPACHO and
            d.id_despacho =  '. $idDespacho;
$lista= $this->ejecutarConsulta($sSql);
return $lista;


  }

  catch(Exception $e)
  {
    return NULL;
  }

}

function obtieneDetalleDespacho($idDespacho)
{
  try
  {
$sSql ='select cantidad,venta, v.codigo_precio_producto,
        p.descripcion as nombre_producto, u.descripcion_unidad, u.tamano
        from carrito c, detalle_ventas v, 
        venta_productos vp, productos p, unidades u
        where 
        c.id_detalle = v.id_detalle and 
        v.codigo_precio_producto = vp.codigo_precio_producto and
        vp.id_producto = p.id_producto and
        vp.id_unidad = u.id_unidad and
        c.id_Despacho ='. $idDespacho;
$lista= $this->ejecutarConsulta($sSql);
return $lista;


  }

  catch(Exception $e)
  {
    return NULL;
  }

}

}






?>