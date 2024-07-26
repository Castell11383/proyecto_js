<?php
require_once 'Conexion.php';

class Aplicacion extends Conexion
{
    public $app_id;
    public $app_nombre;
    public $app_cantidad;
    public $app_registro;
    public $app_tipo;
    public $app_entrega;
    public $app_dependencia;
    public $app_descripcion;
    public $app_situacion;


    public function __construct($args = [])
    {
        $this->app_id = $args['app_id'] ?? null;
        $this->app_nombre = $args['app_nombre'] ?? '';
        $this->app_cantidad = $args['app_cantidad'] ?? '';
        $this->app_registro = $args['app_registro'] ?? null;
        $this->app_tipo = $args['app_tipo'] ?? '';
        $this->app_entrega = $args['app_entrega'] ?? null;
        $this->app_dependencia = $args['app_dependencia'] ?? '';
        $this->app_descripcion = $args['app_descripcion'] ?? '';
        $this->app_situacion = $args['app_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO aplicaciones(app_nombre, app_cantidad, app_registro, app_tipo, app_entrega, app_descripcion, app_dependencia) VALUES ('$this->app_nombre','$this->app_cantidad', '$this->app_registro', '$this->app_tipo', '$this->app_entrega', '$this->app_descripcion', '$this->app_dependencia')";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar()
{
    $sql = "SELECT * FROM aplicaciones WHERE app_situacion = 1";

    if ($this->app_nombre != '') {
        $sql .= " AND app_nombre LIKE '%$this->app_nombre%'";
    }

    if ($this->app_cantidad != '') {
        $sql .= " AND app_cantidad LIKE '%$this->app_cantidad%'";
    }

    if ($this->app_registro != '') {
        $sql .= " AND app_registro = $this->app_registro";
    }

    if ($this->app_entrega != '') {
        $sql .= " AND app_entrega = '$this->app_entrega'";
    }

    if ($this->app_tipo != '') {
        $sql .= " AND app_tipo = '$this->app_tipo'";
    }

    if ($this->app_dependencia != '') {
        $sql .= " AND app_dependencia LIKE '%$this->app_dependencia%'";
    }

    if ($this->app_descripcion != '') {
        $sql .= " AND app_descripcion LIKE '%$this->app_descripcion%'";
    }

    if ($this->app_id != null) {
        $sql .= " AND app_id = $this->app_id";
    }

    $resultado = self::servir($sql);
    return $resultado;
}

    public function modificar()
    {
        $sql = "UPDATE aplicaciones SET app_nombre = '$this->app_nombre', app_cantidad = '$this->app_cantidad', app_tipo = '$this->app_tipo', app_registro = '$this->app_registro', app_entrega = '$this->app_entrega', app_descripcion = '$this->app_descripcion', app_dependencia = '$this->app_dependencia' where app_id = $this->app_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE aplicaciones SET app_situacion = 0 where app_id = $this->app_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}