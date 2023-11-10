<?php

namespace Clases;

require '../vendor/autoload.php';

use PDO;

class Familia extends Conexion
{
    private $cod;
    private $nombre;

    public function __construct()
    {
        parent::__construct();
    }

    public function getCod()
    {
        return $this->cod;
    }

    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getFamilias()
    {
        $consulta = "select cod from familias order by cod";
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute();
        } catch (\PDOException $ex) {
            die("Error al devolver las familias: " . $ex->getMessage());
        }
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
            $familias[] = $fila->cod;
        }
        return $familias;
    }
}
