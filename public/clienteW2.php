<?php
require '../vendor/autoload.php';

use Clases\Clases1\ClasesOperacionesService;

$url = 'http://localhost/tarea6.1/servidorSoap/servicio.wsdl';

try {
    $cliente = new SoapClient($url);
} catch (SoapFault $f) {
    die("Error en cliente SOAP:" . $f->getMessage());
}

$codP = 5;
$codT = 1;
$codF = 'ORDENA';

$objeto = new ClasesOperacionesService();

$pvp = $objeto->getPvp($codP);
$precio = ($pvp == null) ? "No existe es Producto" : $pvp;

$familias = $objeto->getFamilias();

$productos = $objeto->getProductosFamilia($codF);

$unidades = $objeto->getStock($codP, $codT);
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

    <h2>Códigos de Familias</h2>
    <ul>
        <?php foreach ($familias as $k => $v) : ?>
            <li><code><?php echo $v; ?></code></li>
        <?php endforeach; ?>
    </ul>

    <h2>Productos de la Familia <?php echo $codF; ?></h2>
    <ul>
        <?php foreach ($productos as $k => $v) : ?>
            <li><?php echo $v; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Unidades del producto con código <?php echo $codP; ?> en la tienda <?php echo $codT; ?></h2>
    <p><?php echo $unidades; ?></p>
</body>

</html>
