<?php
include_once "app/models/db.class.php";

class Padres extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll(){
        return $this->executeQuery("SELECT id_padre, nombre_padre, direccion_padre, telefono_padre from padres order by id_padre");
    }

    public function getAllPadreAlumno(){
        return $this->executeQuery("SELECT p.id_padre,p.nombre_padre,pa.parentesco, p.direccion_padre, p.telefono_padre, a.nombre_completo 
        FROM alumnos a INNER JOIN padres_alumnos pa ON a.id_alumno = pa.id_alumno INNER JOIN padres p ON pa.id_padre = p.id_padre;");
    }

    /*public function update($data) {
        return $this->executeInsert(
            "UPDATE padres SET nombre_padre='{$data["nombre_padre"]}', direccion_padre='{$data["direccion_padre"]}', 
            telefono_padre='{$data["telefono_padre"]}' WHERE id_padre='{$data["id_padre"]}'"
        );
    }
    
    public function updateParentesco($id_padre, $parentesco) {
        return $this->executeInsert(
            "UPDATE padres_alumnos SET parentesco='{$parentesco}' WHERE id_padre='{$id_padre}'"
        );
    }*/
    public function update($data) {
        return $this->executeInsert(
            "UPDATE padres SET nombre_padre='{$data["nombre_padre"]}', direccion_padre='{$data["direccion_padre"]}', 
            telefono_padre='{$data["telefono_padre"]}' WHERE id_padre='{$data["id_padre"]}'"
        );
    }
    
    public function updateParentesco($id_padre, $parentesco) {
        return $this->executeInsert(
            "UPDATE padres_alumnos SET parentesco='{$parentesco}' WHERE id_padre='{$id_padre}'"
        );
    }

    public function getOnePadre($id) {
        return $this->executeQuery(
            "SELECT p.id_padre, p.nombre_padre, p.direccion_padre, p.telefono_padre, pa.parentesco 
             FROM padres p 
             INNER JOIN padres_alumnos pa ON p.id_padre = pa.id_padre 
             WHERE p.id_padre='{$id}'"
        );
    }

    public function eliminarPadre ($id) {
        return $this->executeInsert("delete from padres where id_padre='$id'");
        
    }
}