<?php
session_start();
// Incluir el archivo de funciones PHP
include('rest.php');

// URL de la API
$url = 'http://localhost:9080/cine-1.0-SNAPSHOT/v1/tipoproducto';

// Llamada a la función findRange para obtener registros entre el rango 0 y 10
$records = findRange($url, 0, 10);
$mensaje = $_SESSION['mensaje'] ?? null;
$estadoPeticion = $_SESSION['estadoPeticion'] ?? null;
unset($_SESSION['mensaje']);
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Lista de Registros</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='style.css'>

</head>
<body>
    
            <?php 
            if ($mensaje && $estadoPeticion) {
                echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
                        " . htmlspecialchars($mensaje) . "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            } elseif ($mensaje) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        " . htmlspecialchars($mensaje) . "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
            ?>
        <div class='container d-flex justify-content-center' >
            

            <div class='col'>
                <h1 class='text-center text-white p-4'>Tipo de productos</h1>
                <div class='row'>
                    <div  id='tableContainer'>
                        <div class='d-flex justify-content-end mb-3'>
                            <select class='form-select form-select-lg w-auto' id='opciones' aria-label='Large select example'>
                                <option value='50' selected>tamaño</option>
                                <option value='2'>2</option>
                                <option value='5'>5</option>
                                <option value='10'>10</option>
                            </select>
                        </div>
                        <table class='table table-dark alighment table-bordered table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th>
                                        id
                                    </th>
                                    <th>
                                        nombre
                                    </th>
                                    <th>
                                        comentarios
                                    </th>
                                    <th>
                                        activo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
        <?php
        // Ejemplo de datos obtenidos
        foreach ($records as $record) {
            $activo = $record['activo'] ? 'ACTIVO' : 'INACTIVO';
            echo "<tr>
                    <td>
                        <form action='detalle.php' method='POST'>
                            <input type='hidden' name='estatus' value='MODIFICADO'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($record['idTipoProducto']) . "'>
                            <input type='hidden' name='nombre' value='" . htmlspecialchars($record['nombre']) . "'>
                            <input type='hidden' name='comentarios' value='" . htmlspecialchars($record['comentarios']) . "'>
                            <input type='hidden' name='activo' value='" . htmlspecialchars($activo) . "'>
                            <button class='btnForm' type='submit'>" . htmlspecialchars($record['idTipoProducto']) . "</button>
                        </form>
                    </td>
                    <td>
                        <form action='detalle.php' method='POST'>
                            <input type='hidden' name='estatus' value='MODIFICADO'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($record['idTipoProducto']) . "'>
                            <input type='hidden' name='nombre' value='" . htmlspecialchars($record['nombre']) . "'>
                            <input type='hidden' name='comentarios' value='" . htmlspecialchars($record['comentarios']) . "'>
                            <input type='hidden' name='activo' value='" . htmlspecialchars($activo) . "'>
                            <button class='btnForm' type='submit'>" . htmlspecialchars($record['nombre']) . "</button>
                        </form>
                    </td>
                    <td>
                        <form action='detalle.php' method='POST'>
                            <input type='hidden' name='estatus' value='MODIFICADO'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($record['idTipoProducto']) . "'>
                            <input type='hidden' name='nombre' value='" . htmlspecialchars($record['nombre']) . "'>
                            <input type='hidden' name='comentarios' value='" . htmlspecialchars($record['comentarios']) . "'>
                            <input type='hidden' name='activo' value='" . htmlspecialchars($activo) . "'>
                            <button class='btnForm' type='submit'>" . htmlspecialchars($record['comentarios']) . "</button>
                        </form>
                    </td>
                    <td>
                        <form action='detalle.php' method='POST'>
                            <input type='hidden' name='estatus' value='MODIFICADO'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($record['idTipoProducto']) . "'>
                            <input type='hidden' name='nombre' value='" . htmlspecialchars($record['nombre']) . "'>
                            <input type='hidden' name='comentarios' value='" . htmlspecialchars($record['comentarios']) . "'>
                            <input type='hidden' name='activo' value='" . htmlspecialchars($activo) . "'>
                            <button class='btnForm' type='submit'>" . htmlspecialchars($activo) . "</button>
                        </form>
                    </td>
                </tr>";
        }
        ?>
    </tbody>

                        </table>
                    </div>
                

                    <div class='buttonContainer d-flex justify-content-left'>
                        <form action='detalle.php' method='POST'>
                        <input type='hidden' name='estatus' value='CREAR'>
                            <button class='btn btn-secondary me-4' id='btnNuevo'>Nuevo</button>
                        </form>

                    </div>
                    
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
   
</html>

