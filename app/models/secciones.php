<?php
include_once "app/models/db.class.php";

class Secciones extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("SELECT id_seccion, seccion FROM secciones ORDER BY seccion;");
    }

}