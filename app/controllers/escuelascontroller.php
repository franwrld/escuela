<?php
include_once "app/models/escuelas.php";
class EscuelasController extends Controller {

    private $escuela;

    public function __construct($parametro) {
        $this->escuela = new Escuelas();

        parent::__construct("escuelas", $parametro, true, "Administrador");
    }

    public function getAll() {
        $records = $this->escuela->getAll();
        $info = array('success' => true, 'records' => $records);
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
        $data = $this->escuela->getEscuelaConAlumnos($id_school);
    
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

    public function getEscuela() {
        $records = $this->escuela->getEscuela();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function getEscuelaByName($nombre) {
        $records = $this->escuela->getEscuelaByName($nombre);
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function guardar() {
        $img = "";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                if (($_FILES["foto"]["type"] == "image/png") ||
                    ($_FILES["foto"]["type"] == "image/jpeg")
                ) {
                    copy(
                        $_FILES["foto"]["tmp_name"],
                        __DIR__ . "/../../public_html/fotos/" . $_FILES["foto"]["name"]
                    )
                        or die("No se pudo copiar el archivo");
                    $img = URL . "public_html/fotos/" . $_FILES["foto"]["name"];
                }
            }
        }
    
        if ($_POST["id_school"] == 0) {
            $datosEscuela = $this->escuela->getEscuelaByName($_POST["nombre"]);
            if (count($datosEscuela) > 0) {
                $info = array('success' => false, 'msg' => "La escuela ya existe.");
            } else {
                // Incluir el ID del usuario en los datos
                $_POST["id_user"] = $_SESSION["id_user"];
                $records = $this->escuela->guardar($_POST, $img);
                $info = array('success' => true, 'msg' => "La escuela se ha guardado con éxito.");
            }
        } else {
            $records = $this->escuela->update($_POST, $img);
            $info = array('success' => true, 'msg' => "La escuela se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneEscuela() {
        $records = $this->escuela->getOneEscuela($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'La escuela no existe.');
        }
        echo json_encode($info);
    }

    public function eliminarEscuela() {
        $escuela = $this->escuela->getOneEscuela($_GET["id"]);
        
        if (count($escuela) > 0) {
            $foto = $escuela[0]['foto'];
            
            // Eliminar al Escuela
            $this->escuela->eliminarEscuela($_GET["id"]);
            
            if (!empty($foto)) {
                // Extraer la ruta relativa de la foto
                $rutaRelativa = str_replace('/escuela/public_html', '', $foto);
    
                // Construir la ruta absoluta al archivo de la foto
                $rutaFoto = __DIR__ . "/../../public_html" . $rutaRelativa;
    
                // Depuración: Verifica la ruta absoluta construida
                //var_dump("Ruta absoluta de la foto:", $rutaFoto);
    
                if (file_exists($rutaFoto)) {
                    if (unlink($rutaFoto)) {
                        $info = array('success' => true, 'msg' => "Escuela eliminada y foto eliminada.");
                    } else {
                        $info = array('success' => true, 'msg' => "Escuela eliminada, error al eliminar la foto.");
                    }
                } else {
                    $info = array('success' => true, 'msg' => "Escuela eliminada. No se ha encontrado la foto.");
                }
            } else {
                $info = array('success' => true, 'msg' => "Escuela eliminada. Sin foto.");
            }
        } else {
            $info = array('success' => false, 'msg' => "No existe el Escuela.");
        }
    
        echo json_encode($info);
    }

    // DASHBOARD USER

    public function getEscuelaONLY() {
        session_start(); // Iniciar sesión si no está iniciada
        if (!isset($_SESSION["id_user"])) {
            // Redirigir al login si no hay sesión activa
            header("Location: " . URL . "login");
            exit();
        }
    
        $records = $this->escuela->getEscuelaONLY($_GET["id"]);
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

}