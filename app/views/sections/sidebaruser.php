<!-- Menu Lateral -->
<div class="sidebar">

    <!-- Logo Menu Lateral -->
    <div class="logo">
        <img src="public_html/iconos/logoescuela200px.png">
    </div>
    <hr>
    <!-- MENSAJE DE BIENVENIDA ________________ -->
    <h4 class="welcomestext"><span class="nuser"><?php echo $_SESSION["usuario"]; ?></h4>
    <hr>
    <!-- Opciones Menu Lateral -->
    <hr>
    <a href="<?php echo URL;?>escuelauser">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Escuela</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>
    <hr>
    <a href="<?php echo URL;?>alumnosuser">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Estudiantes</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>

    <!-- Cerrar Sesion -->
    <a href="<?php echo URL;?>login/cerrar" tabindex="-1" aria-disabled="true">
        <button class="fancylogout">Cerrar Sesión</button>
    </a>
    <hr>

</div>