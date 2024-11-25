<?php
// Recuperar los datos enviados por el formulario
include('rest.php');

$id = $_POST['id'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$comentarios = $_POST['comentarios'] ?? '';
$activo = isset($_POST['activo']) ? 'Sí' : 'No';
$accion = $_POST['accion'] ?? ''; // Determinar cuál botón fue presionado
$estatus=$_POST['estatus']
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Detalle del Registro</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id='formContainer' class='container my-4 w-50'>
    <h1 class="text-center text-white p-4">Tipo de productos</h1>

    <form action="procesar.php" method="POST" class="row">
        
        <div class='row align-items-center my-2'>
            <div class='col-2'>
                <label class='text-white form-label' for='inputId'>ID:</label>
            </div>
            <div class='col'>
                <input value='<?= $id ?>' id='inputId' name='id' class='form-control' type='text' readonly>
            </div>
        </div>
        <div class='row align-items-center my-2'>
            <div class='col-2'>
                <label class='text-white form-label' for='inputNombre'>NOMBRE:</label>
            </div>
            <div class='col'>
                <input value='<?= $nombre ?>' id='inputNombre' name='nombre' class='form-control' type='text'>
            </div>
        </div>
        <div class='row align-items-center my-2'>
            <div class='col-2'>
                <label class='text-white form-label' for='chkActivo'>ACTIVO:</label>
            </div>
            <div class='col'>
                <input class='form-check-input' name='activo' type='checkbox' id='chkActivo' <?= $activo === 'Sí' ? 'checked' : '' ?>>
            </div>
        </div>
        <div class='row align-items-center my-2'>
            <div class='col-2'>
                <label class='text-white form-label' for='inputComentarios'>COMENTARIOS:</label>
            </div>
            <div class='col'>
                <input value='<?= $comentarios ?>' class='form-control' name='comentarios' id='inputComentarios' type='text'>
            </div>
        </div>
        <div class='btn-container d-flex justify-content-center my-4'>
        <form action="index.php" method="post">
            <button type='submit' class='btn btn-secondary me-4'>CANCELAR</button>
            </form>
            <?php
                if ($estatus==="MODIFICADO") {
                    echo "<button type='submit' class='btn btn-secondary me-4' name='accion' value='MODIFICAR'>MODIFICAR</button>
                    <button type='submit' class='btn btn-secondary me-4' name='accion' value='ELIMINAR'>ELIMINAR</button>";
                }elseif ($estatus==="CREAR") {
                    echo"
                    <button type='submit' class='btn btn-secondary me-4' name='accion' value='CREAR'>CREAR</button>
                    ";
                }
            ?>

            
        </div>
    </form>

    <?php if ($accion): ?>
        
        <div class="alert alert-success mt-4">
            Acción realizada: <?= htmlspecialchars($accion) ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
