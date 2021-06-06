<?php 
include("conexion.php");
class catalogoBD
{
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
    vp.imagen
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
    vp.precio_venta
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

function InsertaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail)
{

  try{
    
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
    $sSql ='Insert into despacho (ID_DESPACHO,NOMBRE,APELLIDOS,DIRECCION,DEPARTAMENTO,COMUNA,CIUDAD,REGION,TELEFONO,EMAIL,ID_CLIENTE)
    VALUES(' . $dmIdDespacho . ',"'.$sNombre.'","'.$sApellidos .'","'.$sDireccion.'","'.$sDepartamento.'","'.$sComuna.'","'.$sCiudad.'","'.$sRegion.'","'.$sTelefono.'","'.$sEmail.'",1) ';
    $oConexion = new Conexion();
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






?>