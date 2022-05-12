<!DOCTYPE html>
<html lang="en">

<head>
    <title>Parcial</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <style>
        h1{
            text-align:center;
        }
        p{
        color: rgb(255, 255, 255);
        padding: 30px;
        border: #00FF00 3px solid;
        margin: 30px;
        background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>


<body>
<div class="container">
    <h1>PARCIAL MODULO 2</h1>
    </div>
    <div class="container-fluid">
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
                <div class="card-header">Ingrese los datos</div>
            </div>

            <div class="card-body">

                <form role="form" action="tabla.php" method="POST">

                    <div class="form-row">
                        <div class="form-group col-md-4">

                            <label for="columna">Periodo (mes)</label>

                            <div id="inputPeriodo"></div>
                            <script>
                                container = document.getElementById('inputPeriodo');
                                for (i = 0; i < 6; i++) {
                                    var strdiv = '<input type="number" class="form-control" ';
                                    strdiv += 'id="periodos" name="periodos" readonly ';
                                    strdiv += 'placeholder="Tiempo en meses" value="'+(i+1)+'"> <br>';
                                    
                                    container.innerHTML += strdiv;
                                }
                            </script>
                            
                        </div>

                        <div class="form-group col-md-4">
                            <label for="columna">Requerimientos</label>

                            <div id="inputRequerimientos"></div>
                            <script>
                                container = document.getElementById('inputRequerimientos');
                                for (i = 0; i < 6; i++) {
                                    var strdiv = '<input type="number" class="form-control" ';
                                    //strdiv += 'id="req' + i + '" ';
                                    strdiv += 'id="requerimientos" name="requerimientos[]" ';
                                    strdiv += 'placeholder="Unidades / toneladas"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="columna">Días laborales</label>
                            <div id="inputDiasLab"></div>
                            <script>
                                container = document.getElementById('inputDiasLab');
                                for (i = 0; i < 6; i++) {
                                    var strdiv = '<input type="number" class="form-control" ';
                                    strdiv += 'id="diasLabs" name="diasLabs[]" ';
                                    strdiv += 'placeholder="Días"> <br>';

                                    container.innerHTML += strdiv;
                                }
                            </script>
                        </div>


                    </div>

                    <hr class="my-4">

                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Valores por defecto (siguiendo el ejemplo), se pueden cambiar</div>
                    </div>

                    <br>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="prds">Cantidad de periodos:</label>
                            <input type="text" readonly class="form-control" id="prds" value="6 (meses)">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="costoContratar">Costo de contratar (no se usa):</label>
                            <input type="number" readonly class="form-control" id="costoContratar" placeholder="$ / trabajador" value="350">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="costoSubcon">Costo de subcontratar (no se usa):</label>
                            <input type="number" readonly class="form-control" id="costoSubcon" placeholder=" $ / Tonelada" value="50">
                        </div>                        
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="costoDespedir">Costo de despedir (no se usa):</label>
                            <input type="number" readonly class="form-control" id="costoDespedir" placeholder=" $ / Trabajador" value="420">
                        </div>                       
                        <div class="form-group col-md-4">
                            <label for="costoInvent">Costo de mantenimiento de inventarios:</label>
                            <input type="number" class="form-control" id="costoInvent" placeholder="$ / tonelada" value="3" name="costoInvent">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="costoFaltante">Costo de faltantes:</label>
                            <input type="number" class="form-control" id="costoFaltante" placeholder="$ / Tonelada" value="20" name="costoFaltante">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tiempoProcesamiento:">Tiempo de procesamiento:</label>
                            <input type="number" class="form-control" id="tiempoProcesamiento" placeholder="5h / tonelada" value="5" name="tiempoProcesamiento">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="numEmpleados">Numero empleados:</label>
                            <input type="number" class="form-control" id="numEmpleados" placeholder=" # " value="20"  name="numEmpleados">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="costoNormal">Costo de tiempo normal (mano de obra):</label>
                            <input type="number" class="form-control" id="costoNormal" placeholder="$ / trabajador" value="6" name="costoNormal">
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="costoExtra">Costo de tiempo extra:</label>
                            <input type="number" class="form-control" id="costoExtra" placeholder=" $ / Hora" value="8" name="costoExtra">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="horasTrabajo">Horas de trabajo:</label>
                            <input type="number" class="form-control" id="horasTrabajo" placeholder=" h / Día" value="8" name="horasTrabajo">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success" onclick="Calcular()">Enviar datos</button>
                            <a class="btn btn-primary" href="index.html" role="button">Reiniciar</a>
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