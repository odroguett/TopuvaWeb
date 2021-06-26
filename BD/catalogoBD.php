<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

require_once("conexion.php");
require_once("respuesta.php");
class catalogoBD
{
 private $oConexion;
 private $oRespuesta;
 
 public function __construct() {
  $this->oRespuesta = new RespuestaOtd();
  $this->oConexion = new Conexion();
  
}

    public function ejecutarConsultaParametros($sSql,$arrayConsulta)
    {

      $lista =$this->oConexion->ejecutarConsulta($sSql,$arrayConsulta);
      return $lista;
    }

    function ejecutarConsultaIndividual($sSql)
    {

      $lista= $this->oConexion->ejecutarConsultaIndividual($sSql);
      return $lista;
    }
    function execBool($sSql,$arrayInsert)
    {
     return $this->oConexion->execBool($sSql,$arrayInsert);

    }
function obtieneCategorias()
{
  $sSql="select * from categorias";
  $lista= $this->ejecutarConsultaIndividual($sSql);
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
$lista= $this->ejecutarConsultaIndividual($sSql);
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
    vp.codigo_precio_producto,
    vp.stock
from 
    unidades u, 
    productos p,
    venta_productos vp,
    categorias c
where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    p.id_categoria =  c.id_categoria and c.id_categoria = :categoria 
    order by VP.ID_PRODUCTO';
    $arrConsulta =array( ':categoria' =>   $sCategoria ) ;
    $lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
    
    


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
    codigo_unidad , tamano,stock
from 
    unidades u, 
    venta_productos vp,
    productos p
where 
    u.id_unidad = vp.id_unidad and
    p.id_producto = vp.id_producto and
    p.descripcion= :producto and  vp.stock > 0';
    $arrConsulta =array( ':producto' =>   $sProducto ) ;
    $lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
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
$sSql ='select * from despacho where id_despacho= :despacho ';
$arrConsulta =array( ':despacho' =>   $idDespacho ) ;
$lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);

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
    vp.precio_venta,
    vp.stock
    from unidades u, 
    productos p,
    venta_productos vp,
    categorias c
    where     
    vp.ID_PRODUCTO =p.ID_PRODUCTO and 
    vp.id_unidad = u.id_unidad and
    vp.stock > 0 and 
    p.id_categoria =  c.id_categoria and p.descripcion= :producto 
    order by vp.ID_PRODUCTO';
    $arrConsulta =array( ':producto' =>   $sProducto ) ;
    $lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
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
 $lista= $this->ejecutarConsultaIndividual($sSql);
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
    foreach($ArraydmIdDespacho as $filas => $value)
           {
            $dmIdDespacho= $value['id'];
           }
    
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
    VALUES(:idDespacho,:nombre,:apellidos,:direccion,:departamento,:comuna,:ciudad,:region,:telefono,:email,:idCliente,:idTipoDespacho) ';
    $arrConsulta =array( ':idDespacho' =>   $dmIdDespacho ,':nombre' => $sNombre,
                         ':apellidos' => $sApellidos,':direccion' => $sDireccion,
                         ':departamento' => $sDepartamento,':comuna' => $sComuna,
                         ':ciudad' => $sCiudad, ':region' => $sRegion,
                         ':telefono' => $sTelefono, ':email' => $sEmail,
                         ':idCliente' => '1',':idTipoDespacho' => 1);
    if($this->execBool($sSql, $arrConsulta))
    {
      $this->oRespuesta ->bEsValido =true;
      $this->oRespuesta ->idDespacho =$dmIdDespacho;
      $this->oRespuesta ->sDireccion =$sDireccion;
      $this->oRespuesta ->sDepartamento =$sDepartamento;
      $this->oRespuesta ->sComuna =$sComuna;
      $this->oRespuesta ->sCiudad =$sCiudad;
      $this->oRespuesta ->sRegion =$sRegion;
      $this->oRespuesta ->sTelefono =$sTelefono;
      $this->oRespuesta ->sEmail =$sEmail;
      $this->oRespuesta ->sMensaje ="Datos para el despacho ingresados correctamente.";
       return $this->oRespuesta;

    }
    else
    {
      $this->oRespuesta ->bEsValido =false;
      $this->oRespuesta ->sMensaje ="Error al insertar registros para despacho.";
       return $this->oRespuesta;

    }
    
    
  
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
    $sSql='';
    $sSql ='update despacho set NOMBRE =  :nombre, APELLIDOS = :apellidos,DIRECCION = :direccion,
           COMUNA =:comuna, CIUDAD =:ciudad,REGION =:region,DEPARTAMENTO = :departamento,
           TELEFONO=:telefono,EMAIL=:email
           WHERE ID_DESPACHO =:idDespacho';
    $arrConsulta =array( ':idDespacho' =>   $idDespacho ,':nombre' => $sNombre,
           ':apellidos' => $sApellidos,':direccion' => $sDireccion,
           ':departamento' => $sDepartamento,':comuna' => $sComuna,
           ':ciudad' => $sCiudad, ':region' => $sRegion,
           ':telefono' => $sTelefono, ':email' => $sEmail);
           
 if($this->execBool($sSql, $arrConsulta))
 {

  $this->oRespuesta ->bEsValido =true;
  $this->oRespuesta ->idDespacho =$idDespacho;
  $this->oRespuesta ->sDireccion =$sDireccion;
  $this->oRespuesta ->sDepartamento =$sDepartamento;
  $this->oRespuesta ->sComuna =$sComuna;
  $this->oRespuesta ->sCiudad =$sCiudad;
  $this->oRespuesta ->sRegion =$sRegion;
  $this->oRespuesta ->sTelefono =$sTelefono;
  $this->oRespuesta ->sEmail =$sEmail;
  $this->oRespuesta ->sMensaje ="Actualización de datos para despacho correcta.";
   
 }

 else
 {

  $this->oRespuesta ->bEsValido =false;
  $this->oRespuesta ->sMensaje ="Error al actualizar datos del despacho.";
 }
 return $this->oRespuesta;
  }
  catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    $this->oRespuesta ->bEsValido =false;
    


  }

  
  
}

function RebajaStock($codigoProducto,$cantidad)
  {
    try{
    
   $oConexion = new Conexion();
   $sSql = 'update venta_productos set STOCK = STOCK - :cantidad
           WHERE CODIGO_PRECIO_PRODUCTO =:codigoProducto';
    $arrConsulta =array( ':cantidad' =>  $cantidad, ':codigoProducto' =>  $codigoProducto );
    
    if( $this->execBool($sSql, $arrConsulta))
    {

      return true;
    }
    else
    {
      return false;

    }
    
    }
    catch(Exception $e)
  {
    //Aca vamos a incorporar el error al archivo de log.
    return false;
    
  }
  
  }
  function ActualizaTipoDespacho($idDespacho,$tipoDespacho)
  {
$sSql = 'update despacho set id_tipo_despacho = :tipoDespacho
        where id_Despacho = :idDespacho';
        $arrConsulta =array( ':idDespacho' =>  $idDespacho, ':tipoDespacho' =>  $tipoDespacho);
    
        if( $this->execBool($sSql, $arrConsulta))
        {
    
          return true;
        }
        else
        {
          return false;
    
        }

  }

function RevisaStock($codigoProducto)
  {
    try{
    
   
  $sSql = 'select STOCK from  venta_productos 
            WHERE CODIGO_PRECIO_PRODUCTO = :codigoProducto';
  $arrConsulta =array( ':codigoProducto' =>   $codigoProducto );
  $Array= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
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
    $sSql = 'delete from despacho where id_despacho = :idDespacho';
    $arrConsulta =array( ':idDespacho' =>  $idDespacho);
    
    if( $this->execBool($sSql, $arrConsulta))
    {
      $this->oRespuesta ->bEsValido =true;
      $this->oRespuesta ->sMensaje ="Información de despacho eliminada correctamente.";
    }
    else
    {
      $this->oRespuesta ->bEsValido =false;
      $this->oRespuesta ->sMensaje ="Despacho eliminado con errores";

    }
    
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

  
  $dmIdDetalle=0;
  $sSql = 'select count(id_detalle) as id from carrito';
  $ArraydmIdDespacho =$this->ejecutarConsultaIndividual($sSql);
  foreach($ArraydmIdDespacho as $filas => $value)
  {
   $dmIdDetalle= $value['id'];
  }
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
    VALUES( :dmIdDetalle ,:totalProductosPago,:totalPago,:idTipoPago,:idDespacho)';
   
    $arrConsulta =array( ':dmIdDetalle' =>   $dmIdDetalle ,':totalProductosPago' => $totalProductosPago, 
                       ':totalPago' =>$totalPago,':idTipoPago' => $idTipoPago,
                      ':idDespacho'=> $idDespacho);
if($this->execBool($sSql, $arrConsulta))
{

  return $dmIdDetalle;

}
else
{
return 0;

}
}
function InsertarDetallePago($dmIdDetalle ,$cantidadProducto,$Montoventa,$codigoProducto)
{

  $Montoventa = $cantidadProducto * $Montoventa;
  $this->RebajaStock($codigoProducto,$cantidadProducto);
  $sSql ='Insert into detalle_ventas (ID_DETALLE,CANTIDAD,VENTA,CODIGO_PRECIO_PRODUCTO)
    VALUES(:dmIdDetalle,:cantidadProducto,:montoVenta,:codigoProducto) ';
    $arrConsulta =array( ':dmIdDetalle' =>   $dmIdDetalle ,':cantidadProducto' => $cantidadProducto, 
                         ':montoVenta' =>$Montoventa,':codigoProducto' => $codigoProducto);
                         
if($this->execBool($sSql, $arrConsulta))
{
 return true;
}
else
{
  return false;

}
}

function obtieneDatosVentaProducto($sCodigoProducto)
{

  try{
  
    $sSql ='select vp.*,p.descripcion,u.codigo_unidad, u.tamano
           from venta_productos vp, productos p , unidades u
           where vp.id_producto = p.id_producto and 
           u.id_unidad = vp.id_unidad and
           vp.codigo_precio_producto = :codigoProducto';
           $arrConsulta =array( ':codigoProducto' =>   $sCodigoProducto );
           $lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
          
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
              and (p.descripcion like  :patron1 or 
              u.tamano like  :patron2  or
              u.codigo_unidad like :patron3 )
              order by DESCRIPCION,tamano asc";
              $arrConsulta =array( ':patron1' =>   '%'.$sPatron .'%', ':patron2' =>  '%'. $sPatron.'%',':patron3' =>  '%'. $sPatron.'%' );
              $lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
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
            d.id_despacho = :idDespacho';
            $arrConsulta =array( ':idDespacho' =>  $idDespacho );
            $lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
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
        c.id_Despacho = :idDespacho ';
        $arrConsulta =array( ':idDespacho' =>  $idDespacho );
        $lista= $this->ejecutarConsultaParametros($sSql,$arrConsulta);
return $lista;


  }

  catch(Exception $e)
  {
    return NULL;
  }

}
}



?>