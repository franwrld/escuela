<?php
define("URL","/escuela/");
require_once "app/controllers/errorescontroller.php";
require_once "app/controllers/controller.php";

$url=$_GET["action"] ?? null;
$url=rtrim($url,"/");
$url=explode("/",$url);

// Si no hay acción, redirigir al login
if (empty($url[0])) {
    $archivoController="app/controllers/login";
    $url[0]="login";
} else {
    $archivoController="app/controllers/{$url[0]}";
}

$archivoController.="controller.php";

//echo $archivoController;
if (file_exists($archivoController)) {
    require_once $archivoController; 
    $url[0].="controller";
    $parametro=$url[1] ?? "";

    // Crear una instancia del controlador
    $controller=new $url[0]($parametro);
    

} else {
    $controller= new ErroresController();
}




