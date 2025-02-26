<?php
include_once "app/models/escuelauser.php";
class EscuelaUserController extends Controller {

    private $escuelau;

    public function __construct($parametro) {
        $this->escuelau = new EscuelaUser();

        parent::__construct("escuelauser", $parametro, true, "Usuario");
    }

    public function getAllUser() {
        $records = $this->escuelau->getAllUser($_GET["id"]);
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function getOneEscuelaUser() {
        $records = $this->escuelau->getOneEscuelaUser($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'La escuela no existe.');
        }
        echo json_encode($info);
    }

    public function getEscuelaConAlumnos() {
        // Obtener el ID de la escuela desde la URL
        $id_school = $_GET['id'] ?? null;
    
        if (!$id_school) {
            echo json_encode([
                'success' => false,
                'msg' => 'ID de la escuela no proporcionado.'
            ]);
            return;
        }
    
        // Obtener los datos de la escuela y los alumnos
        $data = $this->escuelau->getEscuelaConAlumnos($id_school);
    
        if (count($data['escuela']) > 0) {
            $info = array(
                'success' => true,
                'escuela' => $data['escuela'],
                'alumnos' => $data['alumnos']
            );
        } else {
            $info = array(
                'success' => false,
                'msg' => 'Intenta agrega alumnos o Escuela No Encontrada.'
            );
        }
    
        echo json_encode($info);
    }

    public function getEscuelaONLY() {
        $id_user = $_SESSION["id_user"];
        $records = $this->escuelau->getEscuelaONLY($id_user);
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }
    

}