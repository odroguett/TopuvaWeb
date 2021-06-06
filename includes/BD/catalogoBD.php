<?php 
include("includes/BD/conexion.php");
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
function obtieneCategorias()
{
  $sSql="select * from categorias";
  $lista= $this->ejecutarConsulta($sSql);
  return $lista;

}

function obtieneProductosDestacados()
{
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

function obtienePrecioProductos($sCategoria)
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

function obtieneDisponibleProductos($sProducto)
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

function obtieneProductosRelacionados($sProducto)
{

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

function InsertaDespacho($sNombre,$sApellidos,$sDireccion,$sDepartamento,$sCiudad,$sComuna,$sRegion,$sTelefono,$sEmail)
{

$sSql ='Insert into despacho (ID_DESPACHO,NOMBRE,APELLIDOS,DIRECCION,DEPARTAMENTO,COMUNA,CIUDAD,REGION,COMENTARIOS,TELEFONO,EMAIL)
       VALUES("'.$sNombre.'","'.$sApellidos .'","'.$sDireccion.'","'.$sDepartamento.'","'.$sCiudad.'","'.$sComuna.'","'.$sRegion.'","'.$sTelefono.'","'.$sEmail.'") ';
       $oConexion = new Conexion();
       $oConexion->conectar();
       $oConexion->execBool($sSql);
       $oConexion->cerrar();

}



}






?>