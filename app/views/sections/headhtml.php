<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS fijos -->
    <?php include_once "app/views/sections/css.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/mapinit.js"></script>
    <!-- Bootstrap CSS -->
     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- API de Google Maps -->
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfUAuwD0h0m8nr6gHDWJT0zXXM0rjs5mo" async defer></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Icono del sistema en el navegador -->
    <link rel="shortcut icon" href="<?php echo URL;?>public_html/iconos/worldgraduado24px.png" type="image/x-icon">
    <!-- Titulo Dinamico -->
    <title><?php echo isset($title) ? $title : 'Escuela'; ?></title>
</head>