<?php
require_once "app/views/view.php";
class Controller {
    protected $view;
    public function __construct($view, $parametro, $validar = false, $tipoRequerido = null) {
        $this->view = new View();
        if ($validar) {
            if (!isset($_SESSION)) {
                session_start();
            }
            if (!isset($_SESSION["id_user"])) {
                $this->view->render("login");
                return;
            }
            // Validar el tipo de usuario si se especifica
            if ($tipoRequerido && $_SESSION["tipo"] !== $tipoRequerido) {
                // Redirigir a una vista de error o a la vista correspondiente al tipo de usuario
                if ($_SESSION["tipo"] == "Administrador") {
                    header("Location: " . URL . "dashboard");
                } else {
                    header("Location: " . URL . "dashboarduser");
                }
                return;
            }
        }
        if (empty($parametro)) {
            $this->view->render($view);
            return;
        }
        if (method_exists($this, $parametro)) {
            $this->$parametro();
        } else {
            echo "<h1>Método no existe</h1>";
        }
    }
}