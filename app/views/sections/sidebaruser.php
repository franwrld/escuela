<!-- Menu Lateral -->
<div class="sidebar">

    <!-- Logo Menu Lateral -->
    <div class="logo">
        <img src="public_html/iconos/logoescuela200px.png">
    </div>
    <hr>
    <!-- MENSAJE DE BIENVENIDA ________________ -->
    <h4 class="welcomestext"><img src="public_html/iconos/menuside24px.png"> <span class="nuser"><?php echo $_SESSION["usuario"]; ?></h4>
    <hr>
    <!-- Opciones Menu Lateral -->
    <a href="<?php echo URL;?>dashboarduser"><img src="public_html/iconos/home24px.png"> Dashboard</a>
    <hr>
    <a href="<?php echo URL;?>escuelauser"><img src="public_html/iconos/escuela24px.png"> Escuelas</a>
    <hr>
    <a href="<?php echo URL;?>alumnosuser"><img src="public_html/iconos/alumnos24px.png"> Alumnos</a>

    <!-- Cerrar Sesion -->
    <a href="<?php echo URL;?>login/cerrar" class="logout" tabindex="-1" aria-disabled="true"><img src="public_html/iconos/logout24px.png"> Cerrar Sesión</a>
    <hr>

</div>