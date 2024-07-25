<?php
require '../../models/Programador.php';

header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    switch ($metodo) {
        case 'POST':
            $programador = new Programador($_POST);
            switch ($tipo) {
                case '1':
                    $ejecucion = $programador->guardar();
                    $mensaje = "Programador Guardado correctamente";
                    $codigo = 1;
                    break;

                case '2':
                    $ejecucion = $programador->modificar();
                    $mensaje = "Cliente Modificado correctamente";
                    $codigo = 2;
                    break;
                
                case '3':
                    $ejecucion = $programador->eliminar();
                    $mensaje = "Cliente Eliminado correctamente";
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
            $programador = new Programador($_GET);
            $programadors = $programador->buscar();
            echo json_encode($programadors);
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