<?php
include_once "app/models/alumnos.php";
class AlumnosController extends Controller {

    private $alumno;

    public function __construct($parametro) {
        $this->alumno = new Alumnos();
        parent::__construct("alumnos", $parametro, true, "Administrador");
    }

    public function getAll() {
        $records = $this->alumno->getAll();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function getAllAlumnosMapa() {
        $records = $this->alumno->getAllAlumnosMapa();
        $info = array('success' => true, 'records' => $records);
        echo json_encode($info);
    }

    public function getAlumnoInfo() {
        if (isset($_GET["id_alumno"])) {
            $id_alumno = $_GET["id_alumno"];
            $records = $this->alumno->getAlumnoInfo($id_alumno);
            if (count($records) > 0) {
                $info = array(
                    'success' => true, 
                    'alumno' => array(
                        'nombre_completo' => $records[0]['nombre_completo'],
                        'direccion' => $records[0]['direccion'],
                        'telefono' => $records[0]['telefono'],
                        'email' => $records[0]['email'],
                        'foto' => $records[0]['foto'],
                        'genero' => $records[0]['genero'],
                        'grado' => $records[0]['grado'],
                        'seccion' => $records[0]['seccion'],
                        'nombre_escuela' => $records[0]['nombre_escuela']
                    ),
                    'padres' => array_map(function($record) {
                        return array(
                            'nombre_padre' => $record['nombre_padre'],
                            'parentesco' => $record['parentesco'],
                            'telefono_padre' => $record['telefono_padre']
                        );
                    }, $records)
                );
            } else {
                $info = array('success' => false, 'msg' => 'No se encontró información del alumno.');
            }
        } else {
            $info = array('success' => false, 'msg' => 'ID de alumno no proporcionado.');
        }
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
        if ($_POST["id_alumno"] == 0) {
            $datosAlumno = $this->alumno->getAlumnoByName($_POST["nombre_completo"]);
            if (count($datosAlumno) > 0) {
                $info = array('success' => false, 'msg' => "El alumno ya existe.");
            } else {
                $records = $this->alumno->guardar($_POST, $img);
                $info = array('success' => true, 'msg' => "El alumno se ha guardado con éxito.");
            }
        } else {
            $records = $this->alumno->update($_POST, $img);
            $info = array('success' => true, 'msg' => "El alumno se ha actualizado con éxito.");
        }
        echo json_encode($info);
    }

    public function guardarPadres() {
        if ($_POST["id_padre"] == 0) {
            $datosPadres = $this->alumno->getPadreByName($_POST["nombre_padre"]);
            if (count($datosPadres) > 0) {
                $info = array('success' => false, 'msg' => "El Padre ya existe.");
            } else {
                // Guardar el padre en la tabla padres
                $records = $this->alumno->guardarPadres($_POST);
                $id_padre = $this->alumno->getLastInsertId();
    
                // Guardar la relación en la tabla padres_alumnos
                $id_alumno = $_POST["id_alumno"];
                $parentesco = $_POST["parentesco"];
                $this->alumno->guardarRelacionPadreAlumno($id_alumno, $id_padre, $parentesco);
    
                $info = array('success' => true, 'msg' => "El padre se ha guardado con éxito.");
            }
        } else {
            // Actualizar los datos del padre (sin tocar la relación)
            $records = $this->alumno->updatePadres($_POST);
            $info = array('success' => true, 'msg' => "Los datos del padre han sido actualizados con éxito.");
        }
        echo json_encode($info);
    }

    public function getOneAlumno() {
        $records = $this->alumno->getOneAlumno($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'El alumno no existe.');
        }
        echo json_encode($info);
    }

    public function getOnePadre() {
        $records = $this->alumno->getOnePadre($_GET["id"]);
        if (count($records) > 0) {
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'El padre no existe.');
        }
        echo json_encode($info);
    }
    
    public function deleteAlumno() {
        $alumno = $this->alumno->getOneAlumno($_GET["id"]);
        
        if (count($alumno) > 0) {
            $foto = $alumno[0]['foto'];
            
            // Eliminar al alumno
            $this->alumno->deleteAlumno($_GET["id"]);
            
            if (!empty($foto)) {
                // Extraer la ruta relativa de la foto
                $rutaRelativa = str_replace('/escuela/public_html', '', $foto);
    
                // Construir la ruta absoluta al archivo de la foto
                $rutaFoto = __DIR__ . "/../../public_html" . $rutaRelativa;
    
                // Depuración: Verifica la ruta absoluta construida
                //var_dump("Ruta absoluta de la foto:", $rutaFoto);
    
                if (file_exists($rutaFoto)) {
                    if (unlink($rutaFoto)) {
                        $info = array('success' => true, 'msg' => "Alumno eliminado y foto eliminada.");
                    } else {
                        $info = array('success' => true, 'msg' => "Alumno eliminado, error al eliminar la foto.");
                    }
                } else {
                    $info = array('success' => true, 'msg' => "Alumno eliminado. No se ha encontrado la foto.");
                }
            } else {
                $info = array('success' => true, 'msg' => "Alumno eliminado. Sin foto.");
            }
        } else {
            $info = array('success' => false, 'msg' => "No existe el Alumno.");
        }
    
        echo json_encode($info);
    }

    //Dashboard user

    public function getAlumnosDeEscuela() {
        session_start(); // Iniciar sesión si no está iniciada
        if (!isset($_SESSION["id_user"])) {
            // Redirigir al login si no hay sesión activa
            header("Location: " . URL . "login");
            exit();
        }
    
        if (isset($_GET["id_school"])) {
            $records = $this->alumno->getAlumnosDeEscuela($_GET["id_school"]);
            $info = array('success' => true, 'records' => $records);
        } else {
            $info = array('success' => false, 'msg' => 'ID de escuela no proporcionado');
        }
        echo json_encode($info);
    }
    
}