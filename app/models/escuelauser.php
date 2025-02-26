<?php
include_once "app/models/db.class.php";

class EscuelaUser extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

    public function getAllUser($id_school) {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud FROM school WHERE id_school='{$id_school}'");
    }

    public function getOneEscuelaUser($id) {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud, foto FROM school WHERE id_school='{$id}'");
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
            INNER JOIN 
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
    
    // DASHBOARD USER

    public function getEscuelaONLY($id_user) {
        return $this->executeQuery("SELECT id_school, nombre, direccion, email, latitud, longitud, id_user FROM school WHERE id_user ='$id_user';");
    }

}