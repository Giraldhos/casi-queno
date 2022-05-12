<?php
#incluye el archivo que contiene la clase
include_once("backend.php");


$periodos = $_POST["periodos"];
$requerimientos = $_POST["requerimientos"];
$diasLabs = $_POST["diasLabs"];

$costoInvent = $_POST["costoInvent"];
$costoFaltante = $_POST["costoFaltante"];
$tiempoProcesamiento = $_POST["tiempoProcesamiento"];
$numEmpleados = $_POST["numEmpleados"];
$costoNormal = $_POST["costoNormal"];
$costoExtra = $_POST["costoExtra"];
$horasTrabajo = $_POST["horasTrabajo"];


# Crea un objeto de la clase

$unaClase = new Ejercicio(
    $periodos,
    $requerimientos,
    $diasLabs,
    $costoInvent,
    $costoFaltante,
    $tiempoProcesamiento,
    $numEmpleados,
    $costoNormal,
    $costoExtra,
    $horasTrabajo
);

#Calcula el indice
$unaClase->calcular();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>PARCIALMODULA2</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>



    <div class="container">
        <div class="jumbotron">
            <p>
            Una compañía desea un software que le permita determinar su plan agregado de 
            producción para los próximos 6 meses. El software le deberá permitir ingresar los 
            requerimientos de producción necesarios y la información correspondiente al 
            negocio necesaria para generar el plan agregado.
            </p>
            <p>
            Se deberá aplicar el método heurístico de fuerza laboral promedio – horas extras.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="card">

            <div class="card text-white bg-success mb-3">
                <div class="card-header">Por favor ingrese el resto de los datos</div>
            </div>

            <div class="card-body">

                <form role="form" action="index.php" method="POST">

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="columna">Periodo (mes)</label>

                            <div id="inputPeriodo"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                container = document.getElementById('inputPeriodo');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="number" class="form-control" ';
                                    strdiv += 'id="periodos" name="periodos" readonly ';
                                    strdiv += 'value="' + (i + 1) + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Días Laborales</label>

                            <div id="inputDiasLabs"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getDiasLabs()); ?>;
                                container = document.getElementById('inputDiasLabs');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="dLabs" name="dLabs[]" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';
                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Tiempo disponible</label>
                            <div id="inputTiemDisp"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getTiemDisponible()); ?>;
                                console.log("test " + newArray);
                                container = document.getElementById('inputTiemDisp');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="tDisponible" name="tDisponible[]" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';
                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Producción real</label>
                            <div id="inputProdReal"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getProdReal()); ?>;
                                container = document.getElementById('inputProdReal');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" readonly ';
                                    strdiv += 'id="pReal" name="pReal[]" ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Requerimientos</label>
                            <div id="inputReqs"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getRequerimientos()); ?>;
                                container = document.getElementById('inputReqs');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" readonly ';
                                    strdiv += 'id="requs" name="requs[]" ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Inventario final</label>
                            <div id="inputInvFinal"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getInvFinal()); ?>;
                                container = document.getElementById('inputInvFinal');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="invFinal" name="invFinal[]" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Continuación</div>
                    </div>

                    <br>

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="columna">Periodo (mes)</label>

                            <div id="inputPeriodo2"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                container = document.getElementById('inputPeriodo2');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="periodo" name="periodo" readonly ';
                                    strdiv += 'value="' + (i + 1) + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Programar T. Extra</label>

                            <div id="inputProgExtra"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getPTiempoExtra()); ?>;
                                container = document.getElementById('inputProgExtra');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="pTimeExtra" name="pTimeExtra" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Costo horas extra</label>

                            <div id="inputCostoExtra"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getCHoraExtra()); ?>;
                                container = document.getElementById('inputCostoExtra');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="cHoraExtra" name="cHoraExtra" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Unidades sobrantes</label>

                            <div id="inputCostoAlma"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getInvFinal()); ?>;
                                container = document.getElementById('inputCostoAlma');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="uniSobrantes" name="uniSobrantes" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="columna">Costo almacenamiento</label>

                            <div id="inputCostoNormal"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getCostoAlmacena()); ?>;
                                container = document.getElementById('inputCostoNormal');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="costoAlmacena" name="costoAlmacena" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>


                        <div class="form-group col-md-2">
                            <label for="columna">Costo tiempo normal</label>

                            <div id="inputUniSobra"></div>
                            <script>
                                count = "<?php echo $periodos; ?>";
                                var newArray = <?php echo json_encode($unaClase->getCostoTiempoNormal()); ?>;
                                container = document.getElementById('inputUniSobra');
                                for (i = 0; i < count; i++) {
                                    var strdiv = '<input type="text" class="form-control" ';
                                    strdiv += 'id="periodo" name="periodo" readonly ';
                                    strdiv += 'value="' + newArray[i] + '"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                    </div>

                    <hr class="my-4">


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Volver...</button>
                            <a class="btn btn-info" href="index.html" role="button">Reiniciar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>