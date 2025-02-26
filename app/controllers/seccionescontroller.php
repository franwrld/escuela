<?php
include_once "app/models/secciones.php";
class SeccionesController extends Controller {

    private $seccion;

    public function __construct($parametro) {
        $this->seccion = new Secciones();
        parent::__construct("secciones", $parametro, true, "Administrador");
    }

    public function getAll() {
        $records = $this->seccion->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

}