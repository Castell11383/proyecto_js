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
    $sql = "SELECT * FROM tarea WHERE tarea_situacion = 1";

    if ($this->tarea_programador != '') {
        $sql .= " AND tarea_programador LIKE '%$this->tarea_programador%'";
    }

    if ($this->tarea_aplicacion != '') {
        $sql .= " AND tarea_aplicacion LIKE '%$this->tarea_aplicacion%'";
    }

    if ($this->tarea_descripcion != '') {
        $sql .= " AND tarea_descripcion LIKE '%$this->tarea_descripcion%'";
    }

    if ($this->tarea_id != null) {
        $sql .= " AND tarea_id = $this->tarea_id";
    }

    $resultado = self::servir($sql);
    return $resultado;
}

    public function modificar()
    {
        $sql = "UPDATE tarea SET tarea_programador = '$this->tarea_programador', tarea_aplicacion = '$this->tarea_aplicacion', tarea_descripcion = '$this->tarea_descripcion' where tarea_id = $this->tarea_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE tarea SET tarea_situacion = 0 where tarea_id = $this->tarea_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}