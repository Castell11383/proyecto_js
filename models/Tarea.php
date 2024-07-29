<?php
require_once 'Conexion.php';

class Tarea extends Conexion
{
    public $tarea_id;
    public $tarea_programador;
    public $tarea_aplicacion;
    public $tarea_descripcion;
    public $tarea_situacion;


    public function __construct($args = [])
    {
        $this->tarea_id = $args['tarea_id'] ?? null;
        $this->tarea_programador = $args['tarea_programador'] ?? '';
        $this->tarea_aplicacion = $args['tarea_aplicacion'] ?? '';
        $this->tarea_descripcion = $args['tarea_descripcion'] ?? '';
        $this->tarea_situacion = $args['tarea_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO tarea(tarea_programador, tarea_aplicacion, tarea_descripcion) VALUES ('$this->tarea_programador','$this->tarea_aplicacion', '$this->tarea_descripcion')";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar()
    {
        $sql = "SELECT  tarea_id, progra_nombre ||' '|| progra_apellido  AS nombre_completo, app_nombre, app_entrega, app_tipo, app_dependencia, tarea_descripcion, tarea_situacion from tarea
        inner join aplicaciones on tarea_aplicacion = app_id
        inner join programadores on tarea_programador = progra_id
        where tarea_situacion = 1";

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar()
    {
        $sql = "UPDATE tarea SET nombre_completo = (SELECT progra_nombre || ' ' || progra_apellido FROM programadores WHERE programadores.progra_id = tarea.tarea_programador)
        WHERE tarea_situacion = 1";
        
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE tarea SET tarea_situacion = 0 WHERE tarea_id = $this->tarea_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}