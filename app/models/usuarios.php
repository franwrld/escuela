<?php
include_once "app/models/db.class.php";

class Usuarios extends BaseDeDatos {

    public function __construct()
    {
        $this->conectar();
    }

    public function getAll() {
        return $this->executeQuery("SELECT id_user, nombre, usuario, tipo FROM usuarios ORDER BY nombre;");
    }

    public function buscarPorNombre($nombre) {
        return $this->executeQuery("SELECT id_user, nombre FROM usuarios WHERE nombre LIKE '%{$nombre}%'");
    }

    public function guardar($data){
        return $this->executeInsert("INSERT INTO usuarios set nombre='{$data["nombre"]}',usuario='{$data["usuario"]}', password=sha1('{$data["password"]}'), tipo='{$data["tipo"]}'");
    }

    public function getUsuarioByName($usuario) {
        return $this->executeQuery("Select id_user,nombre, usuario, tipo from usuarios where usuario='{$usuario}'");
    }

    // Funcion para Actualizar
    public function update($data) {
        return $this->executeInsert("update usuarios set 
        nombre='{$data["nombre"]}',
        usuario='{$data["usuario"]}',
        password=if('{$data["password"]}'='',password,sha1('{$data["password"]}')),
        tipo='{$data["tipo"]}' 
        where id_user={$data["id_user"]}");
    }

    public function getOneUsuario($id) {
        return $this->executeQuery("Select id_user, nombre, usuario, password, tipo 
        from usuarios where id_user='{$id}'");
    }

    public function eliminarUsuario($id) {
        return $this->executeInsert("delete from usuarios where id_user='$id'");
    }
    
}