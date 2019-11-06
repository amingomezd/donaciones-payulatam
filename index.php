<?php
include 'config.php';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        //función para enviar variables al servidor con ajax, el cual responderá con un nuevo formulario de confirmación
        $(function () {
            $("#donacionPaso1").on("click",function () {
                let nombre_donante = $("#nombre").val();
                let correo_donante = $("#correo").val();
                let valor_donacion = "0";
                //comprobamos si se selecciono otro valor, en ese caso se copia su valor a la variable valor_donación
                if ($('#valorPersonalizado').is(':checked')) {
                    valor_donacion = $("#otroValor").val();
                } else {
                    //si no, entonces se asigna a valor_donación el valor seleccionado en los radio buttons
                    valor_donacion = $("input[name='valorDonacion']:checked").val();
                }
                //se valida formulario por html antes de enviar al servidor
                let valid = this.form.checkValidity();
                $("#donacionPaso1").html(valid);
                if (valid) {
                    event.preventDefault();
                    //se envían con ajax las variables al servidor
                    $.ajax({
                        url: '/procesarDonacion.php',
                        data: {
                            nombre: nombre_donante,
                            correo: correo_donante,
                            valor: valor_donacion
                        },
                        type: 'POST',
                        success: function (data) {
                            $("#formularioDonacion").html(data);
                        }
                    })
                }
                //Si el script se inserta en un iframe en otro dominio, se envía el mensaje scrollTop para que suba la pantalla
                window.parent.postMessage("scrollTop", "<?php echo $urlDonaciones ?>");
            });
        });
    </script>
    <script type="text/javascript">
        //función para habilitar o deshabilitar el textbox del radio button de otro valor
        $(function () {
            let otroValor = $("#otroValor");
            $("input[name='valorDonacion']").on("click",function () {
                if ($("#valorPersonalizado").is(":checked")) {
                    otroValor.removeAttr("disabled");
                    otroValor.focus();
                } else {
                    $("#otroValor").attr("disabled", "disabled");
                }
            });
        });
    </script>
    <title></title>
</head>

<body>
<div id="formularioDonacion" class="container">
    <div class="row">
        <div class="col">
            <form id="donaciones" method="post" target="_parent">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nombre">Nombre Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="Nombre" id="nombre" class="form-control"
                               placeholder="Ingresa tu nombre completo" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="correo">Correo Electronico</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="Correo" id="correo"
                               aria-describedby="ayudaCorreo" placeholder="Ingresa tu correo electronico" required>
                        <small id="ayudaCorreo" class="form-text text-muted">Se usará para notificarte del resultado
                            de la donación.</small>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Cantidad del donativo</legend>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="valorDonacion" id="opcion1"
                                       value="10000" required>
                                <label class="form-check-label" for="opcion1"><i>$10.000</i></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="valorDonacion" id="opcion2"
                                       value="50000">
                                <label class="form-check-label" for="opcion2"><i>$50.000</i></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="valorDonacion" id="opcion3"
                                       value="200000">
                                <label class="form-check-label" for="opcion3"><i>$200.000</i></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="valorDonacion"
                                       id="valorPersonalizado" value=""/>
                                <input type="number" min="20000" step="10000" name="valorDonacion" value=""
                                       id="otroValor" placeholder="Otro Valor" disabled="disabled"
                                       class="form-control" required/>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <input type="submit" name="donacionPaso1" id="donacionPaso1" value="Donar"
                       class="btn btn-primary shadow-lg p-3"
                       style="background-color: <? echo $color ?>; border-color: <? echo $color ?>;"/>
            </form>
        </div>
    </div>
</div>
</body>

</html>