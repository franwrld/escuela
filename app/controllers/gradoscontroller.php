<?php
include_once "app/models/grados.php";
class GradosController extends Controller {

    private $grado;

    public function __construct($parametro) {
        $this->grado = new Grados();
        parent::__construct("grados", $parametro, true, "Administrador");
    }

    public function getAll() {
        $records = $this->grado->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }
}