<?php
require_once 'Conexion.php';

class Programador extends Conexion
{
    public $progra_id;
    public $progra_nombre;
    public $progra_apellido;
    public $progra_edad;
    public $progra_correo;
    public $progra_direccion;
    public $progra_telefono;
    public $progra_dependencia;
    public $progra_genero;
    public $progra_situacion;


    public function __construct($args = [])
    {
        $this->progra_id = $args['progra_id'] ?? null;
        $this->progra_nombre = $args['progra_nombre'] ?? '';
        $this->progra_apellido = $args['progra_apellido'] ?? '';
        $this->progra_edad = $args['progra_edad'] ?? '';
        $this->progra_correo = $args['progra_correo'] ?? '';
        $this->progra_direccion = $args['progra_direccion'] ?? '';
        $this->progra_telefono = $args['progra_telefono'] ?? '';
        $this->progra_dependencia = $args['progra_dependencia'] ?? '';
        $this->progra_genero = $args['progra_genero'] ?? '';
        $this->progra_situacion = $args['progra_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO programadores(progra_nombre, progra_apellido, progra_edad, progra_correo, progra_direccion, progra_telefono, progra_dependencia, progra_genero) VALUES ('$this->progra_nombre','$this->progra_apellido', '$this->progra_edad', '$this->progra_correo', '$this->progra_direccion', '$this->progra_telefono', '$this->progra_dependencia', '$this->progra_genero')";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar()
{
    $sql = "SELECT * FROM programadores WHERE progra_situacion = 1";

    if ($this->progra_nombre != '') {
        $sql .= " AND progra_nombre LIKE '%$this->progra_nombre%'";
    }

    if ($this->progra_apellido != '') {
        $sql .= " AND progra_apellido LIKE '%$this->progra_apellido%'";
    }

    if ($this->progra_edad != '') {
        $sql .= " AND progra_edad = $this->progra_edad";
    }

    if ($this->progra_genero != '') {
        $sql .= " AND progra_genero = '$this->progra_genero'";
    }

    if ($this->progra_dependencia != '') {
        $sql .= " AND progra_dependencia LIKE '%$this->progra_dependencia%'";
    }

    if ($this->progra_id != null) {
        $sql .= " AND progra_id = $this->progra_id";
    }

    $resultado = self::servir($sql);
    return $resultado;
}

    public function modificar()
    {
        $sql = "UPDATE programadores SET progra_nombre = '$this->progra_nombre', progra_apellido = '$this->progra_apellido', progra_edad = '$this->progra_edad', progra_correo = '$this->progra_correo', progra_direccion = '$this->progra_direccion', progra_telefono = '$this->progra_telefono', progra_dependencia = '$this->progra_dependencia', progra_genero = '$this->progra_genero' where progra_id = $this->progra_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE programadores SET progra_situacion = 0 where progra_id = $this->progra_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}