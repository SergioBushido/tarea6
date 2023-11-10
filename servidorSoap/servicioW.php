<?php
/*esto es una copia de servicio.php, es decir, creamos un servidor soap pero añadiendo como parámetro el servicio.wsdl en vez del 
primer parámetro null que tenía servicio.php. También indica qué clase contiene las funciones (Clase Operaciones)*/

require '../vendor/autoload.php';
$url = "http://localhost/tarea6.1/servidorSoap/servicio.wsdl"; //ruta del archivo wsdl

try {
    $server = new SoapServer($url);//creamos el servidor
    $server->setClass('Clases\Operaciones'); //indica la clase que contiene las funciones
    $server->handle(); //inicia el servidor Soap
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}
