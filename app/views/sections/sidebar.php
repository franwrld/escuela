<!-- Menu Lateral -->
<div class="sidebar">

    <!-- Logo Menu Lateral -->
    <div class="logo">
        <img src="public_html/iconos/logoescuela200px.png">
    </div>
    <hr>
    <!-- MENSAJE DE BIENVENIDA ________________ -->
    <h4 class="welcomestext"><img src="public_html/iconos/menuside24px.png"> <span class="nuser"><?php echo $_SESSION["usuario"]; ?></span></h4>
    <hr>
    <!-- Opciones Menu Lateral -->
    <a href="<?php echo URL;?>dashboard"><img src="public_html/iconos/home24px.png"> Dashboard</a>
    <hr>
    <a href="<?php echo URL;?>escuelas"><img src="public_html/iconos/escuela24px.png"> Escuelas</a>
    <hr>
    <a href="<?php echo URL;?>padres"><img src="public_html/iconos/parents24px.png"> Padres</a>
    <hr>
    <a href="<?php echo URL;?>alumnos"><img src="public_html/iconos/alumnos24px.png"> Alumnos</a>
    <hr>
    <a href="<?php echo URL;?>usuarios"><img src="public_html/iconos/worldgraduado24px.png"> Usuarios</a>
    <a href="<?php echo URL;?>reportes"><img src="public_html/iconos/reportes24px.png"> Reportes</a>
    <hr>
    <!-- Cerrar Sesion -->
    <a href="<?php echo URL;?>login/cerrar" class="logout" tabindex="-1" aria-disabled="true"><img src="public_html/iconos/logout24px.png"> Cerrar Sesión</a>
    <hr>

</div>