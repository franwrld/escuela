<?php
include_once "app/models/db.class.php";

class Dashboard extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

}