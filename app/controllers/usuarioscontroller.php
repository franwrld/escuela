<?php
include_once "app/models/usuarios.php";
class UsuariosController extends Controller {

    private $usuario;

    public function __construct($parametro) {
        $this->usuario = new Usuarios();

        parent::__construct("usuarios", $parametro, true, "Administrador");
    }

    public function getAll() {
        $records = $this->usuario->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function buscar() {
        $query = $_GET['q'] ?? '';
        $records = $this->usuario->buscarPorNombre($query);
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function guardar() {
        if ($_POST["id_user"]=="0") {
            $datosUsuario=$this->usuario->getUsuarioByName($_POST["usuario"]);
            if (count($datosUsuario)>0) {
                $info=array('success'=>false,'msg'=>"El usuario ya existe");
            } else {
                $records=$this->usuario->guardar($_POST);
                $info=array('success'=>true,'msg'=>"Registro guardado con exito");
            }
        } else {
            $records=$this->usuario->update($_POST);
            $info=array('success'=>true,'msg'=>"Registro guardado con exito");
        }
        echo json_encode($info);
    }

    public function update() {
        $records=$this->usuario->update($_POST);
        $info=array('success'=>true,'msg'=>"Registro actualizado con exito");
        echo json_encode($info);
    }

    public function eliminarUsuario() {
        $records=$this->usuario->eliminarUsuario($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Usuario eliminado con exito.");
        echo json_encode($info);
    }

    public function getOneUsuario() {
        $records=$this->usuario->getOneUsuario($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true,'records'=>$records);
        } else {
            $info=array('success'=>false,'msg'=>'El usuario no existe');
        }
        echo json_encode($info);
    }

}