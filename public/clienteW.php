<?php
$url = 'http://localhost/tarea6.1/servidorSoap/servicio.wsdl';

/*********************************** COMENTARIO SOBRE clienteW.php *************************************************/

/* La diferencia entre cliente.php y clienteW.php es que en esta última utilizamos el archivo servicio.wsdl, por lo tanto
cuando creamos el soapCliente, sólo tenemos que pasarle la url del servicio.wsdl
con el objeto del SoapClient hacemos llamadas con la función soapCall, la cual le pasamos, como primer parámetro, el
nombre de la función y como segundo parámetro, un array, el cual nos indica los parámetros de la función anterior */

try {
    $cliente = new SoapClient($url); //ponemos el wsdl
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}

$codP = 2;
$codT = 14;
$codF = 'CONSOL';

//funcion getPvp ----------------------------------------------------------------------------
$pvp = $cliente->__soapCall('getPvp', ['id' => $codP]);
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;
echo "Código de producto de Código $codP: $precio";

//funcion getFamilias -----------------------------------------------------------------------
echo "<br>Código de Familas";
$familias = $cliente->__soapCall('getFamilias', []);
echo "<ul>";
foreach ($familias as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

//funcion getProductosFamila ----------------------------------------------------------------
$productos = $cliente->__soapCall('getProductosFamilia', ['cofF' => $codF]);
echo "<br>Productos de la Famila $codF:";
echo "<ul>";
foreach ($productos as $k => $v) {
    echo "<code><li>$v</li></code>";
}
echo "</ul>";

// funcion getStock -------------------------------------------------------------------------
$unidades = $cliente->__soapCall('getStock', ['codP' => $codP, 'codT' => $codT]);
echo "<br>Unidades del producto de código; $codP en la tienda de código: $codT: $unidades";
