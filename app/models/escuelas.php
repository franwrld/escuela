<?php
include_once "app/models/db.class.php";

class Escuelas extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("SELECT s.id_school, s.nombre, s.direccion, s.email, s.latitud, s.longitud, u.nombre AS nombreusuario FROM school s INNER
        JOIN usuarios u USING(id_user) ORDER BY id_school;");
    }
    
    public function getOneEscuela($id) {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud, foto FROM school WHERE id_school='{$id}'");
    }
    public function getEscuelaByName($nombre) {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud FROM school WHERE nombre='{$nombre}'");
    }

    public function getEscuela() {
        return $this->executeQuery("SELECT id_school, nombre FROM school;");
    }

    public function getEscuelaConAlumnos($id_school) {
        // Consulta para obtener la escuela y los alumnos asociados
        $query = "
            SELECT 
                s.id_school, 
                s.nombre AS nombre_escuela, 
                s.latitud AS latitud_escuela, 
                s.longitud AS longitud_escuela,
                s.foto,
                a.id_alumno, 
                a.nombre_completo AS nombre_alumno, 
                a.latitud AS latitud_alumno, 
                a.longitud AS longitud_alumno
            FROM 
                school s
            LEFT JOIN 
                alumnos a ON s.id_school = a.id_school
            WHERE 
                s.id_school = '{$id_school}'
        ";
    
        // Ejecutar la consulta
        $result = $this->executeQuery($query);
    
        // Organizar los datos
        $escuela = [];
        $alumnos = [];
    
        if (count($result) > 0) {
            // Datos de la escuela (tomados del primer registro)
            $escuela = [
                'id_school' => $result[0]['id_school'],
                'nombre' => $result[0]['nombre_escuela'],
                'latitud' => $result[0]['latitud_escuela'],
                'longitud' => $result[0]['longitud_escuela'],
                'foto' => $result[0]['foto']
            ];
    
            // Datos de los alumnos
            foreach ($result as $row) {
                $alumnos[] = [
                    'id_alumno' => $row['id_alumno'],
                    'nombre_completo' => $row['nombre_alumno'],
                    'latitud' => $row['latitud_alumno'],
                    'longitud' => $row['longitud_alumno']
                ];
            }
        }
    
        return [
            'escuela' => $escuela,
            'alumnos' => $alumnos
        ];
    }

    public function getAlumnosByEscuela($id_school) {
        return $this->executeQuery("
            SELECT a.id_alumno, a.nombre_completo, a.latitud, a.longitud 
            FROM alumnos a 
            WHERE a.id_school = '{$id_school}'
        ");
    }

    public function guardar($data, $img) {
        return $this->executeInsert("
            INSERT INTO school 
            SET nombre='{$data["nombre"]}', 
                direccion='{$data["direccion"]}', 
                email='{$data["email"]}', 
                latitud='{$data["latitud"]}', 
                longitud='{$data["longitud"]}', 
                foto='{$img}', 
                id_user='{$data["id_user"]}'
        ");
    }

    public function update($data, $img) {
        return $this->executeInsert("UPDATE school SET nombre='{$data["nombre"]}', direccion='{$data["direccion"]}', email='{$data["email"]}', latitud='{$data["latitud"]}', longitud='{$data["longitud"]}', foto=IF('{$img}'='', foto, '{$img}') WHERE id_school={$data["id_school"]}");
    }

    public function getOnePadre($id) {
        return $this->executeQuery("SELECT id_padre, nombre, direccion, telefono from padres where id_padre='{$id}'");
    }

    public function eliminarEscuela($id) {
        return $this->executeInsert("DELETE FROM school WHERE id_school='$id'");
    }

    // DASHBOARD USER

    public function getEscuelaONLY($id_user) {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud, id_user FROM school WHERE id_user ='$id_user';");
    }

}