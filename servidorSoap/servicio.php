<?php
require '../vendor/autoload.php';

$uri = "http://localhost/tarea6.1/servidorSoap";
$parametros = ['uri' => $uri];

try {
    $server = new SoapServer(NULL, $parametros);
    // El objeto SoapServer se crea sin un archivo WSDL (NULL) y se especifica el URI del servicio.
    
    $server->setClass('Clases\Operaciones');
    // Se establece la clase (Clases\Operaciones) que contiene los métodos que se expondrán como servicios web.

    $server->handle();
    // Inicia el servidor SOAP y espera las solicitudes de los clientes.
} catch (SoapFault $f) {
    die("Error en el servidor: " . $f->getMessage());
}
