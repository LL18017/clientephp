<?php
session_start(); 
$url = "http://localhost:9080/cine-1.0-SNAPSHOT/v1/tipoproducto";
include 'rest.php'; // Asegúrate de incluir el archivo que contiene las funciones update y delete

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $comentarios = $_POST['comentarios'] ?? '';
    $accion = $_POST['accion'] ?? '';
    $activo = isset($_POST['activo']) ? true : false;

    $datos = [
        "idTipoProducto" => $id,
        "nombre" => $nombre,
        "comentarios" => $comentarios,
        "activo" => $activo
    ];

    $registro = json_encode($datos, JSON_PRETTY_PRINT);
    echo "<pre>$registro</pre>"; // Muestra el JSON enviado

    if ($accion === "ELIMINAR") {
        $resultado = delete($url, $registro);
        if ($resultado['status'] === 200) {
            $_SESSION['mensaje'] = "El registro fue eliminado correctamente.";
            $_SESSION['estadoPeticion'] = "completada";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar el registro: " . ($resultado['data']['message'] ?? 'Desconocido');
        }
    } elseif ($accion === "MODIFICAR") {
        $resultado = update($url, $registro);
        if ($resultado['status'] === 200) {
            $_SESSION['mensaje'] = "El registro fue modificado correctamente.";
            $_SESSION['estadoPeticion'] = "completada";
        } else {
            $_SESSION['mensaje'] = "Error al modificar el registro: " . ($resultado['data']['message'] ?? 'Desconocido');
        }
    } elseif ($accion === "CREAR") {
        $resultado = create($url, $registro);
        if ($resultado['status'] === 201) { // Suponiendo que 201 es el código para "Creado"
            $_SESSION['mensaje'] = "El registro fue creado correctamente.";
            $_SESSION['estadoPeticion'] = "completada";
        } else {
            $_SESSION['mensaje'] = "Error al crear el registro: " . ($resultado['data']['message'] ?? 'Desconocido');
        }
    }
    header("Location: index.php");
    exit();
}
?>



