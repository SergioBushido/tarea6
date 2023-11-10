<?php
// Incluimos la biblioteca de autoloading de Composer para cargar las clases automáticamente.
require '../vendor/autoload.php';

// Definimos la URL del archivo WSDL que utilizará el servidor.
$url = "http://localhost/tarea6.1/servidorSoap/servicio.wsdl"; 

try {
    // Creamos un objeto SoapServer utilizando la URL del archivo WSDL.
    $server = new SoapServer($url);

    // Establecemos la clase que contiene las funciones que se expondrán como servicios web.
    $server->setClass('Clases\Operaciones'); 

    // Manejamos las solicitudes SOAP entrantes.
    $server->handle(); 
} catch (SoapFault $f) {
    // En caso de error, mostramos un mensaje con la descripción del error.
    die("error en server: " . $f->getMessage());
}
