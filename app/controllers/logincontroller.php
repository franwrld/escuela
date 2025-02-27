<?php
include_once "app/models/login.php";
class LoginController extends Controller {
    private $usuario;
    public function __construct($parametro) {
        $this->usuario = new Login();
        parent::__construct("login", $parametro);
    }

    public function validar() {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $record = $this->usuario->validarLogin($usuario, $password);
        if ($record) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION["id_user"] = $record["id_user"];
            $_SESSION["tipo"] = $record["tipo"];
            $_SESSION["usuario"] = $record["usuario"];
            $_SESSION["nameuser"] = $record["nombre"];
            
            // Guardar id_school en la sesión si está disponible
            if (isset($record["id_school"])) {
                $_SESSION["id_school"] = $record["id_school"];
            } else {
                $_SESSION["id_school"] = null; // O maneja el caso en que no haya id_school
            }
    
            if ($record["tipo"] == "Administrador") {
                $info = array("success" => true, "msg" => "Usuario correcto", "url" => URL . "dashboard");
            } else {
                $info = array("success" => true, "msg" => "Usuario correcto", "url" => URL . "escuelauser");
            }
        } else {
            $info = array("success" => false, "msg" => "Usuario o Contraseña Incorrectos");
        }
        echo json_encode($info);
    }

    public function cerrar() {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        // Redirigir a la URL de login
        header("Location: " . URL . "login");
        exit(); 
    }
}