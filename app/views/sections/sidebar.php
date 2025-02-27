<!-- Menu Lateral -->
<div class="sidebar">

    <!-- Logo Menu Lateral -->
    <a href="<?php echo URL;?>dashboard">
        <div class="logo">
            <img src="public_html/iconos/logoescuela200px.png">
        </div>
    </a>
    <hr>
    <!-- MENSAJE DE BIENVENIDA ________________ -->
    <h4 class="welcomestext"><span class="nuser"><?php echo $_SESSION["usuario"]; ?></span></h4>
    <hr>
    <!-- Opciones Menu Lateral -->
    <a href="<?php echo URL;?>dashboard">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Dashboard</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>

    <a href="<?php echo URL;?>escuelas">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Escuelas</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>
  
    <a href="<?php echo URL;?>padres">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Padres</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>

    <a href="<?php echo URL;?>alumnos">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Estudiantes</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>
    <hr>
    <a href="<?php echo URL;?>usuarios">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Usuarios</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>
    <a href="<?php echo URL;?>reportesescuelas">
    <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Rep. Escuela</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>
    <a href="<?php echo URL;?>reportesalumnos">
        <button class="fancymenu">
            <span class="top-keymenu"></span>
            <span class="textsidebar">Rep. Estudiantes</span>
            <span class="bottom-keymenu1"></span>
            <span class="bottom-keymenu2"></span>
        </button >
    </a>
    <hr>
    <!-- Cerrar Sesion -->
    <a href="<?php echo URL;?>login/cerrar" tabindex="-1" aria-disabled="true">
        <button class="fancylogout">Cerrar Sesión</button>
    </a>
    <hr>

</div>