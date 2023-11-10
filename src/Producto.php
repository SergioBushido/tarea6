<?php

namespace Clases;

require '../vendor/autoload.php';

use \PDO;

class Producto extends Conexion
{
    
    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $famila;
    private $descripcion;

    
    public function __construct()
    {
        parent::__construct();
    }

    // Getters y setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNombreCorto()
    {
        return $this->nombre_corto;
    }

    /**
     * @param mixed $nombre_corto
     */
    public function setNombreCorto($nombre_corto)
    {
        $this->nombre_corto = $nombre_corto;
    }

    /**
     * @return mixed
     */
    public function getPvp()
    {
        return $this->pvp;
    }

    /**
     * @param mixed $pvp
     */
    public function setPvp($pvp)
    {
        $this->pvp = $pvp;
    }

    /**
     * @return mixed
     */
    public function getFamila()
    {
        return $this->famila;
    }

    /**
     * @param mixed $famila
     */
    public function setFamila($famila)
    {
        $this->famila = $famila;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Devuelve los nombres de los productos de una familia específica.
     *
     * @param string $codF Código de la familia
     * @return array|null Lista de nombres de productos o null si no hay productos en la familia
     */
    public function productoFamila($codF)
    {
        // Consulta para obtener el nombre de productos según la familia
        $consulta = "select nombre from productos where familia=:f";
        $stmt = self::$conexion->prepare($consulta); 
        try {
            $stmt->execute([':f' => $codF]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos x familia: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
            $productos[] = $fila->nombre;
        }
        return $productos;
    }

    /**
     * Obtiene el precio de un producto específico.
     *
     * @return float|null Precio del producto o null si no se encuentra el producto
     */
    public function getPrecio()
    {
        // Consulta para obtener el precio de un producto según su ID
        $consulta = "select pvp from productos where id=:i"; 
        $stmt = self::$conexion->prepare($consulta);
        try {
            $stmt->execute([':i' => $this->id]);
        } catch (\PDOException $ex) {
            die("Error al recuperar los productos x familia: " . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) return null;
        return ($stmt->fetch(PDO::FETCH_OBJ))->pvp;
    }
}
