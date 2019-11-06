<?php
include 'config.php';

$merchant_id = $_REQUEST['merchantId'];
$referenceCode = $_REQUEST['referenceCode'];
$TX_VALUE = $_REQUEST['TX_VALUE'];
$New_value = number_format($TX_VALUE, 1, '.', '');
$currency = $_REQUEST['currency'];
$transactionState = $_REQUEST['transactionState'];
$firmaOriginal = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firma = $_REQUEST['signature'];
$firmaMd5 = md5($firmaOriginal);
$reference_pol = $_REQUEST['reference_pol'];
$cus = $_REQUEST['cus'];
$extra1 = $_REQUEST['description'];
$pseBank = $_REQUEST['pseBank'];
$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
$transactionId = $_REQUEST['transactionId'];


switch ($transactionState) {
    case 4:
        $estadoTx = "Transacción aprobada";
        $claseTabla = "table-success";
        break;
    case 6:
        $estadoTx = "Transacción rechazada";
        $claseTabla = "table-danger";
        break;
    case 7:
        $estadoTx = "Transacción pendiente";
        $claseTabla = "table-warning";
        break;
    case 104:
        $estadoTx = "Error";
        $claseTabla = "table-danger";
        break;
    default:
        $estadoTx = $_REQUEST['mensaje'];
}

if (strtoupper($firma) == strtoupper($firmaMd5)) {
    ?>
    <html lang="">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <style>.form-control:focus {
                border-color: <? echo $color ?>;
                box-shadow: 0 0 0 0.2rem #67676742;
            }</style>
        <title>Respuesta de Transacción</title><title></title>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col p-3 text-center">
                <img src="<?php echo $logo ?>>" class="img-fluid w-75"
                     alt="Logo DAR">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Resumen Transacción</h2>
                <table class="table">
                    <tbody>
                    <tr class="<?php echo $claseTabla; ?>">
                        <th scope="row">Estado de la transacción</th>
                        <td><?php echo $estadoTx; ?></td>

                    </tr>
                    <tr>
                        <th>ID de la transacción:</th>
                        <td><?php echo $transactionId; ?></td>
                    </tr>
                    <tr>
                        <th>Referencia de la venta:</th>
                        <td><?php echo $reference_pol; ?></td>
                    </tr>
                    <tr>
                        <th>Referencia de la transacción:</th>
                        <td><?php echo $referenceCode; ?></td>
                    </tr>
                    <!--respuesta si la transacción se realiza por pse-->
                    <?php
                    if ($pseBank != null) {
                        ?>

                        <tr>
                            <th>Cus:</th>
                            <td><?php echo $cus; ?></td>
                        </tr>
                        <tr>
                            <th>Banco:</th>
                            <td><?php echo $pseBank; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <th>Valor total:</th>
                        <td>$<?php echo number_format($TX_VALUE); ?></td>
                    </tr>
                    <tr>
                        <th>Moneda:</th>
                        <td><?php echo $currency; ?></td>
                    </tr>
                    <tr>
                        <th>Descripción:</th>
                        <td><?php echo($extra1); ?></td>
                    </tr>
                    <tr>
                        <th>Entidad:</th>
                        <td><?php echo($lapPaymentMethod); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col p-3 text-center">
                <a class="btn btn-primary" href="<?php echo $urlBoton ?>" role="button"
                   style="background-color:<?php echo $color ?>; border-color:<?php echo $color ?>"> <?php echo $textoBotonRespuesta ?></a>
            </div>
        </div>
    </div>
    </body>
    </html>

    <?php
} else {
    ?>

    <h1>Error validando firma digital.</h1>

    <?php
}
?>