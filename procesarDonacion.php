<?php
//  Incluimos el archivo de configuración de las variables
include 'config.php';

//  Verificamos que las variables que estamos recibiendo no vengan vacías
if (isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['valor']) && !empty($_POST['valor'])) {
    $url = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/'; // Sandbox o url final de payulatam

//    Función para generar un numero alfanumérico de 12 dígitos que servirá como referencia de pago en payulatam
    function numeroAleatorio($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $referenceCode = numeroAleatorio(); // Referencia Única del pedido

//    Variables recibidas por ajax desde el formulario
    $nombre = $_POST['nombre']; // Nombre del Comprador
    $buyerEmail = $_POST['correo']; // Respuesta por PAYU al comprador
    $amount = $_POST['valor'];     //Es el monto total de la transacción. Puede contener dos dígitos decimales. Ej. 10000.00 ó 10000.

//    se genera la firma md5, para apyulatam, que se hace concatenando diferentes variables y luego sacándole el hash md5
    $firma = "$ApiKey~$merchantId~$referenceCode~$amount~$currency";
    $firmaMd5 = md5($firma);
    setlocale(LC_MONETARY, 'en_US');
    $valorPesos = money_format('%.0n', $amount);

//    Se reemplaza el formulario por el que tiene todas las variables necesarias para realizar la transacción junto
//    con un mensaje y un botón de submit
    echo "
	<div class='container'>
	<div class='row'>
        <div class='col'>
             <form method='post' action='$url' target='_parent'>
                 <div class='form-goup text-center'>
                    <input name='merchantId' type='hidden'  value='$merchantId'>
                    <input name='accountId' type='hidden'  value='$accountId'>
                    <input name='description' type='hidden'  value='$description'>
                    <input name='referenceCode' type='hidden'  value='$referenceCode'>
                    <input name='amount' type='hidden'  value='$amount'>
                    <input name='tax' type='hidden'  value='$tax'>
                    <input name='taxReturnBase' type='hidden'  value='$taxReturnBase'>
                    <input name='currency' type='hidden'  value='$currency'>
                    <input name='signature' type='hidden'  value='$firmaMd5'>
                    <input name='test' type='hidden'  value='$test'>
                    <input name='buyerEmail' type='hidden'  value='$buyerEmail'>
                    <input name='responseUrl' type='hidden'  value='$responseUrl'>
                    <input name='confirmationUrl' type='hidden'  value='$confirmationUrl'>
                    <input name='payerFullName' type='hidden'  value='$nombre'>
                    <p>Hola <strong>$nombre</strong> estas a punto de ayudar a los niños con cancer con <strong><i>$valorPesos</i></strong></p>
                    <input class='btn btn-primary shadow p-3' type='submit' name='donacionPaso2' id='donacionPaso2' value='Confirmar Donación' style='background-color:$color; border-color:$color'/>
                </div>
            </form>
        </div>
    </div>
        <div class='row align-items-center p-3 mt-3'>
            <div class='col text-center'>
                <img src='animacion.gif' alt='Muchas Gracias' class='img-fluid'/>
            </div>
        </div>
    </div>
    ";
} else {
    echo "<h2>Hola, lo sentimos, pero parece que escribiste algo mal, vuelve a llenar el formulario por favor</h2>";
}
