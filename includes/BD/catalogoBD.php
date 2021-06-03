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
  $sSql="SELECT * FROM VENTA_PRODUCTOS WHERE DESTACADO=1";
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



}






?>