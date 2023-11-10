<?php
// URL del servicio web y espacio de nombres
$url = 'http://localhost/tarea6.1/servidorSoap/servicioW.php';
$uri = 'http://localhost/tarea6.1/servidorSoap';

try {
    // Crear un cliente SOAP
    $cliente = new SoapClient(null, ['location' => $url, 'uri' => $uri]);
} catch (SoapFault $f) {
    // Manejar errores en la creación del cliente SOAP
    die("Error en cliente SOAP:" . $f->getMessage());
}

// Parámetros para las operaciones
$codP = 8;
$codT = 3;
$codF = 'EBOOK';

// Llamadas a las operaciones del servicio web
$pvp = $cliente->__soapCall('getPvp', ['id' => $codP]);
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;

$familias = $cliente->__soapCall('getFamilias', []);
$productos = $cliente->__soapCall('getProductosFamilia', ['codF' => $codF]);
$unidades = $cliente->__soapCall('getStock', ['codP' => $codP, 'codT' => $codT]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <!-- Tabla para mostrar resultados -->
    <h1>PRODUCTOS</h1>
    <table>
        <tr>
            <th>Código producto</th>
            <th>Precio</th>
        </tr>
        <tr>
            <td><?php echo $codP; ?></td>
            <td><?php echo $precio; ?></td>
        </tr>
    </table>

    <!-- Lista de códigos de familias -->
    <h2>Códigos por Familias</h2>
    <ul>
        <?php foreach ($familias as $k => $v) : ?>
            <li><code><?php echo $v; ?></code></li>
        <?php endforeach; ?>
    </ul>

    <!-- Lista de productos de una familia -->
    <h2>Familia de productos <?php echo $codF; ?></h2>
    <ul>
        <?php foreach ($productos as $k => $v) : ?>
            <li><?php echo $v; ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Resultado de unidades en una tienda -->
    <h2>Unidades del producto con código <?php echo $codP; ?> en la tienda <?php echo $codT; ?></h2>
    <p><?php echo $unidades; ?></p>
</body>

</html>
