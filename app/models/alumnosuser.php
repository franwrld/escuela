<?php
include_once "app/models/db.class.php";

class AlumnosUser extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery(
            "SELECT a.id_alumno, a.nombre_completo, a.direccion, a.telefono, a.email, a.foto, a.genero, a.latitud, a.longitud, 
                    g.grado AS nombre_grado, s.seccion AS nombre_seccion, sc.nombre AS nombre_escuela
             FROM alumnos a
             INNER JOIN grados g ON a.id_grado = g.id_grado
             INNER JOIN secciones s ON a.id_seccion = s.id_seccion
             INNER JOIN school sc ON a.id_school = sc.id_school
             ORDER BY a.id_alumno;"
        );
    }

    public function getAllGrados() {
        return $this->executeQuery("SELECT id_grado, grado FROM grados ORDER BY id_grado;");
    }

    public function getAllSecciones() {
        return $this->executeQuery("SELECT id_seccion, seccion FROM secciones ORDER BY seccion;");
    }

    public function getOneEscuela($id) {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud, foto FROM school WHERE id_school='{$id}'");
    }

    public function getAllAlumnosMapa() {
        return $this->executeQuery(
            "SELECT id_alumno, nombre_completo, direccion, telefono, email, genero, latitud, longitud FROM alumnos;"
        );
    }

    public function getAlumnoInfoUser($id_alumno) {
        return $this->executeQuery(
            "SELECT 
                p.id_padre, 
                p.nombre_padre, 
                pa.parentesco, 
                p.direccion_padre, 
                p.telefono_padre, 
                a.nombre_completo, 
                a.direccion, 
                a.telefono, 
                a.email, 
                a.foto, 
                a.genero, 
                g.grado, 
                s.seccion, 
                sc.nombre AS nombre_escuela
            FROM alumnos a
            LEFT JOIN padres_alumnos pa ON a.id_alumno = pa.id_alumno
            LEFT JOIN padres p ON pa.id_padre = p.id_padre
            INNER JOIN grados g ON a.id_grado = g.id_grado
            INNER JOIN secciones s ON a.id_seccion = s.id_seccion
            INNER JOIN school sc ON a.id_school = sc.id_school
            WHERE a.id_alumno = '{$id_alumno}'"
        );
    }
    
    public function guardarPadre($id_alumno, $padre) {
        $this->executeInsert("INSERT INTO padres SET 
            nombre='{$padre["nombre"]}', 
            direccion='{$padre["direccion"]}', 
            telefono='{$padre["telefono"]}'");
        $id_padre = $this->getLastInsertId();
        $this->executeInsert("INSERT INTO padres_alumnos SET 
            id_alumno='{$id_alumno}', 
            id_padre='{$id_padre}', 
            parentesco='{$padre["parentesco"]}'");
    }
    
    public function getLastInsertId() {
        return $this->conexion->insert_id;
    }

    public function guardarUser($data, $img) {
        return $this->executeInsert("INSERT INTO alumnos SET 
            nombre_completo='{$data["nombre_completo"]}', 
            direccion='{$data["direccion"]}', 
            telefono='{$data["telefono"]}', 
            email='{$data["email"]}', 
            foto='{$img}', 
            genero='{$data["genero"]}', 
            latitud='{$data["latitud"]}', 
            longitud='{$data["longitud"]}', 
            id_grado='{$data["id_grado"]}', 
            id_seccion='{$data["id_seccion"]}', 
            id_school='{$data["id_school"]}'");
    }

    public function guardarPadres($data) {
        // Insertar solo los campos de la tabla padres
        return $this->executeInsert("INSERT INTO padres SET 
            nombre_padre='{$data["nombre_padre"]}', 
            direccion_padre='{$data["direccion_padre"]}', 
            telefono_padre='{$data["telefono_padre"]}'");
    }

    public function updateUser($data, $img) {
        return $this->executeInsert("UPDATE alumnos SET 
            nombre_completo='{$data["nombre_completo"]}', 
            direccion='{$data["direccion"]}', 
            telefono='{$data["telefono"]}', 
            email='{$data["email"]}', 
            foto='{$img}', 
            genero='{$data["genero"]}', 
            latitud='{$data["latitud"]}', 
            longitud='{$data["longitud"]}', 
            id_grado='{$data["id_grado"]}', 
            id_seccion='{$data["id_seccion"]}', 
            id_school='{$data["id_school"]}'
            WHERE id_alumno={$data["id_alumno"]}");
    }

    public function getAlumnoByName($nombre) {
        return $this->executeQuery(
            "SELECT id_alumno, nombre_completo, direccion, telefono, email, foto, genero, latitud, longitud, id_grado, id_seccion, id_school
            FROM alumnos WHERE nombre_completo='{$nombre}'"
        );
    }

    public function getPadresByAlumno($id_alumno) {
        return $this->executeQuery("
            SELECT p.id_padre, p.nombre, p.direccion, p.telefono, pa.parentesco
            FROM padres p
            INNER JOIN padres_alumnos pa ON p.id_padre = pa.id_padre
            WHERE pa.id_alumno = '{$id_alumno}'
        ");
    }

    public function getOneAlumno($id) {
        return $this->executeQuery("SELECT id_alumno, nombre_completo, direccion, telefono, email, foto, genero, latitud, longitud, id_grado, id_seccion, id_school 
            FROM alumnos WHERE id_alumno='{$id}'");
    }

    public function guardarRelacionPadreAlumno($id_alumno, $id_padre, $parentesco) {
        // Insertar la relación en la tabla padres_alumnos
        return $this->executeInsert("INSERT INTO padres_alumnos SET 
            id_alumno='{$id_alumno}', 
            id_padre='{$id_padre}', 
            parentesco='{$parentesco}'");
    }

    public function getOnePadre($id) {
        return $this->executeQuery(
            "SELECT p.id_padre, p.nombre_padre, p.direccion_padre, p.telefono_padre, pa.parentesco 
             FROM padres p 
             INNER JOIN padres_alumnos pa ON p.id_padre = pa.id_padre 
             WHERE p.id_padre='{$id}'"
        );
    }

    public function getPadreByName($nombres){
        return $this->executeQuery("Select id_padre, nombre_padre, direccion_padre, telefono_padre from padres where nombre_padre='{$nombres}'");
    }

    public function updatePadres($data) {
        return $this->executeInsert("update padres set nombre_padre='{$data["nombre_padre"]}', direccion_padre='{$data["direccion_padre"]}', telefono_padre='{$data["telefono_padre"]}' where id_padre='{$data["id_padre"]}'");
    }


    public function deleteAlumno($id) {
        // Eliminar al alumno
        $this->executeInsert("DELETE FROM alumnos WHERE id_alumno='$id'");
    
        // Eliminar padres sin hijos
        $this->executeInsert("DELETE FROM padres WHERE id_padre NOT IN (SELECT id_padre FROM padres_alumnos)");
    }
    

    public function eliminarPadresAlumno($id_alumno) {
        return $this->executeInsert("DELETE FROM padres_alumnos WHERE id_alumno='{$id_alumno}'");
    }

    public function deleteAlumnoWithParents($id_alumno) {
        $this->conexion->begin_transaction();
        try {
            $this->executeInsert("DELETE FROM padres WHERE id_alumno='{$id_alumno}'");
            $this->executeInsert("DELETE FROM alumnos WHERE id_alumno='{$id_alumno}'");
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            $this->conexion->rollback();
            return false;
        }
    }

    // Usuario comun

    public function getAlumnosDeEscuela($id_school) {
        return $this->executeQuery(
            "SELECT a.id_alumno, a.nombre_completo, a.direccion, a.telefono, a.email, a.foto, a.genero, a.latitud, a.longitud, 
            g.grado AS nombre_grado, s.seccion AS nombre_seccion, sc.nombre AS nombre_escuela
             FROM alumnos a
             INNER JOIN grados g ON a.id_grado = g.id_grado
             INNER JOIN secciones s ON a.id_seccion = s.id_seccion
             INNER JOIN school sc ON a.id_school = sc.id_school WHERE sc.id_school = '$id_school';"
        );
    }


}