<?php
$url = 'http://localhost/tarea6.1/servidorSoap/servicio.wsdl';

try {
    $cliente = new SoapClient($url); // Se utiliza el archivo WSDL
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}

$codP = 2;
$codT = 1;
$codF = 'MEMFLA';

$pvp = $cliente->__soapCall('getPvp', ['id' => $codP]);
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;

$familias = $cliente->__soapCall('getFamilias', []);
$productos = $cliente->__soapCall('getProductosFamilia', ['cofF' => $codF]);
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

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        code {
            font-family: monospace;
        }
    </style>
</head>

<body>
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

    <h2>Código por Familias</h2>
    <ul>
        <?php foreach ($familias as $k => $v) : ?>
            <li><code><?php echo $v; ?></code></li>
        <?php endforeach; ?>
    </ul>

    <h2>Productos de Familia <?php echo $codF; ?></h2>
    <ul>
        <?php foreach ($productos as $k => $v) : ?>
            <li><?php echo $v; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Unidades del producto con código <?php echo $codP; ?> en la tienda <?php echo $codT; ?></h2>
    <p><?php echo $unidades; ?></p>
</body>

</html>
