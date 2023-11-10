<?php

namespace Clases;

require '../vendor/autoload.php';

use Clases\{Producto, Stock, Familia};

class Operaciones
{
    public function getPvp($codP)
    {
        $producto = new Producto();
        $producto->setId($codP);
        $precio = $producto->getPrecio();
        $producto = null;
        return $precio;
    }

    public function getStock($codP, $codT)
    {
        $stock = new Stock();
        $stock->setProducto($codP);
        $stock->setTienda($codT);
        $uni = $stock->getUnidadesTienda();
        $stock = null;
        return $uni;
    }

    public function getFamilias()
    {
        $familias = new Familia();
        $valores = $familias->getFamilias();
        $familias = null;
        return $valores;
    }

    public function getProductosFamilia($codF)
    {
        $productos = new Producto();
        $datos = $productos->productoFamila($codF);
        $productos = null;
        return $datos;
    }
}
