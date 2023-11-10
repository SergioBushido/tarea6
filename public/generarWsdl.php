<?php
require '../vendor/autoload.php';

use PHP2WSDL\PHPClass2WSDL;

// Configuración para generar el archivo WSDL
$class = "Clases\\Operaciones";
$uri = 'http://localhost/tarea6.1/servidorSoap/servicioW.php';
$wsdlGenerator = new PHPClass2WSDL($class, $uri);
$wsdlGenerator->generateWSDL(true);
$fichero = $wsdlGenerator->save('../servidorSoap/servicio.wsdl'); // Ruta donde se guarda el archivo WSDL

// Nota: Este proceso debería ejecutarse solo una vez para generar el archivo WSDL.
