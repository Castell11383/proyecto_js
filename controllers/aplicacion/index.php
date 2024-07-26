<?php
require '../../models/Aplicacion.php';

$_POST['app_registro'] = str_replace('T', ' ', $_POST['app_registro']);
$_POST['app_entrega'] = str_replace('T', ' ', $_POST['app_entrega']);

header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];
//    echo json_encode($_POST);
//   exit;
try {
    switch ($metodo) {
        case 'POST':
            $aplicacion = new Aplicacion($_POST);
            switch ($tipo) {
                case '1':
                    $ejecucion = $aplicacion->guardar();
                    $mensaje = "Aplicacion Guardado correctamente";
                    $codigo = 1;
                    break;

                case '2':
                    $ejecucion = $aplicacion->modificar();
                    $mensaje = "Aplicacion Modificado correctamente";
                    $codigo = 2;
                    break;

                case '3':
                    $ejecucion = $aplicacion->eliminar();
                    $mensaje = "Aplicacion Eliminado correctamente";
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
                "SQL" => $ejecucion,
                "post" => $_POST,
            ]);
            break;

        case 'GET':
            http_response_code(200);
            $aplicacion = new Aplicacion($_GET);
            $aplicaciones = $aplicacion->buscar();
            echo json_encode($aplicaciones);
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
        "post" => $_POST,
        "codigo" => 0,
    ]);
}

exit;