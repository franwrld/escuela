<?php 
    $title = "Dashboard - Escuela";
    include_once "app/views/sections/headhtml.php"; 
?>
<body data-vista="dashboard">
    <!-- MENU LATERAL ______________________________________-->
    <section id="menu">
        <?php
            if ($_SESSION["tipo"]=="Administrador") {
                include_once "app/views/sections/sidebar.php";
            } else {
                include_once "app/views/sections/sidebaruser.php";
            } 
        ?>
    </section>
    <!-- HEADER ______________________________________-->
    <?php include_once "app/views/sections/header.php"; ?>
    <!-- CONTENIDO ______________________________________-->
    <div class="contenido">
        <!-- Contenido Mapa Foto Escuela Alumnos -->
        <div class="mapaescuelafotoalumnos">
            <!-- Foto de la escuela -->
            <img class="d-none" src="public_html/imagenes/escuela.jpg" alt="Foto de la escuela" style="width:100%; max-width:600px; height: auto; display:block; margin:0 auto;">
            <div class="locationdiv">
                <h4 class="titlelocation">Alumnos</h4>
                <img class="locationimg" src="public_html/iconos/locationazul32px.png">
                <h4 class="titlelocation">Escuelas</h4>
                <img class="locationimg" src="public_html/iconos/locationrojo32px.png">
            </div>
            <!-- Loader -->
            <div class="loader"></div>
            <!-- Mapa de Google -->
            <div id="map" class="mapa"></div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <?php include_once "app/views/sections/scripts.php"; ?>
</body>
</html>