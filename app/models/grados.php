<?php
include_once "app/models/db.class.php";

class Grados extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("SELECT id_grado, grado FROM grados ORDER BY id_grado;");
    }

    //
}