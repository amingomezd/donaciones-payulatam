<?php

$ApiKey = '4Vj8eK4rloUd272L48hsrarnUA'; // Obtener este dato dela cuenta de Payu
$merchantId = '508029'; // Obtener este dato dela cuenta de Payu
$accountId = '512321'; // Obtener este dato dela cuenta de Payu
$description = ' Fundación Ejemplo'; //Descripción del pedido
$tax = '0'; // Es el valor del IVA de la transacción, si se envía el IVA nulo el sistema aplicará el 19% automáticamente. Puede contener dos dígitos decimales. Ej: 19000.00. En caso de no tener IVA debe enviarse en 0.
$taxReturnBase = '0'; // Es el valor base sobre el cual se calcula el IVA. En caso de que no tenga IVA debe enviarse en 0.
$currency = 'COP'; // Moneda
$test = '1'; // Variable para poder utilizar tarjetas de crédito de pruebas, los valores pueden ser 1 ó 0.
$responseUrl = 'https://ejemplo.com/respuesta.php'; // URL de respuesta,
$confirmationUrl = 'https://ejemplo.com/confirmacion.php'; // URL de confirmación
$confirmacionEmail = 'donaciones@reinodar.org'; // Confirmación email

//imagen que saldrá en la parte superior de la pagina de respuesta
$logo = 'https://ejemplo.com/Logotipo.png';
//imagen o gif animado que saldra en el segundo formulario
$rutaImagen = '/animacion.gif';
//Color de los botones
$color = '#791cb5';
//Url  y texto del botón en la pagina de respuesta
$urlBoton = "https://ejemplo.com";
$textoBotonRespuesta = "Regresar al sitio";

//Si el script se va a insertar en un iframe, colocar la siguiente url completa (https://ejemplo.com/donaciones)
$urlDonaciones = "https://ejemplo.com/donaciones";

//Colocar el siguiente código en la misma pagina donde se va a colocar el iframe
//
//<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
//<script>
//window.addEventListener("message", receiveMessage, false);
//function receiveMessage(event)
//{
//    if (event.origin !== "aca escribir la url completa del dominio en donde esta el script de donaciones con https o http")
//        return;
//    if (event.data == "scrollTop"){
//        $('html, body').animate({
//      scrollTop: $("#donacionesIframe").offset().top
//      }, 1000);
//  }
//}
//</script>