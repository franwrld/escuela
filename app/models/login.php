<?php
include_once "app/models/db.class.php";
class Login extends BaseDeDatos {

    public function __construct() {
        $this->conectar();
    }

    public function validarLogin($usuario, $password) {
        $result = $this->conexion->query(
            "SELECT u.*, s.id_school 
             FROM usuarios u 
             LEFT JOIN school s ON u.id_user = s.id_user 
             WHERE u.usuario = '$usuario' AND u.password = SHA1('$password')"
        );
        if ($record = $result->fetch_assoc()) {
            return $record;
        } else {
            return false;
        }
    }
}