<?php
include_once "app/models/padres.php";
class PadresController extends Controller {

    private $padre;

    public function __construct($parametro) {
        $this->padre = new Padres();
        parent::__construct("padres", $parametro, true, "Administrador");
    }

    public function getAll() {
        $records = $this->padre->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function getAllPadreAlumno() {
        $records = $this->padre->getAllPadreAlumno();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function update() {
        // Actualizar los datos del padre
        $records = $this->padre->update($_POST);
        
        // Si se proporciona un parentesco, actualizarlo en la tabla padres_alumnos
        if (isset($_POST['parentesco'])) {
            $this->padre->updateParentesco($_POST['id_padre'], $_POST['parentesco']);
        }
    
        $info = array('success' => true, 'msg' => "Registro actualizado con éxito");
        echo json_encode($info);
    }

    public function getOnePadre() {
        $records = $this->padre->getOnePadre($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'El padre no existe.');
        }
        echo json_encode($info);
    }

    public function eliminarPadre() {
        $records = $this->padre->eliminarPadre($_GET["id"]);
        $info = array('success' => true, 'msg' => "Se ha eliminado el responsable con éxito.");
        echo json_encode($info);
    }
}