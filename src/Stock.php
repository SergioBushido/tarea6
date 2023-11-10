<?php

namespace Clases;

use \PDO;

require '../vendor/autoload.php';

class Stock extends Conexion
{
    private $producto;
    private $tienda;
    private $unidades;

    public function __construct()
    {
        parent::__construct();
    }

    public function getProducto()
    {
        return $this->producto;
    }

    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    public function getTienda()
    {
        return $this->tienda;
    }

    public function setTienda($tienda)
    {
        $this->tienda = $tienda;
    }

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }
    
    public function getUnidadesTienda()
    {
        $consulta = "select unidades from stocks where producto=:p AND tienda=:t";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':p' => $this->producto, 
                ':t' => $this->tienda
            ]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los unidades: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return 0;
        return ($stmt->fetch(PDO::FETCH_OBJ))->unidades;
    }
}
