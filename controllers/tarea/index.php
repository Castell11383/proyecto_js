<?php
require '../../models/Tarea.php';

header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    switch ($metodo) {
        case 'POST':
            $tarea = new Tarea($_POST);
            switch ($tipo) {
                case '1':
                    $ejecucion = $tarea->guardar();
                    $mensaje = "Tarea Guardado correctamente";
                    $codigo = 1;
                    break;

                case '2':
                    $ejecucion = $tarea->modificar();
                    $mensaje = "Tarea Modificado correctamente";
                    $codigo = 2;
                    break;
                
                case '3':
                    $ejecucion = $tarea->eliminar();
                    $mensaje = "Tarea Eliminado correctamente";
                    $codigo = 3;
                    break;

                default:
                    $mensaje = "Acción no reconocida";
                    $codigo = 0;
                    break;
            }
            http_response_code(200);
            echo json_encode([
                "mensaje" => $mensaje,
                "codigo" => $codigo,
            ]);
            break;

        case 'GET':
            http_response_code(200);
            $tarea = new Tarea($_GET);
            $tareas = $tarea->buscar();
            echo json_encode($tareas);
            break;

        default:
            http_response_code(405);
            echo json_encode([
                "mensaje" => "Método no permitido",
                "codigo" => 9,
            ]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
}

exit;