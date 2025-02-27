<?php 
    $title = "Usuarios - Escuela";
    include_once "app/views/sections/headhtml.php"; 
?>
<body>
    <!-- MENU LATERAL -->
    <section id="menu">
        <?php
            if ($_SESSION["tipo"]=="Administrador") {
                include_once "app/views/sections/sidebar.php";
            } else {
                include_once "app/views/sections/sidebaruser.php";
            } 
        ?>
    </section>
    <!-- HEADER Usuario Info -->
    <?php include_once "app/views/sections/header.php"; ?>
    <!-- CONTENIDO -->
    <div class="contenido">
        <!-- NAV, Buscar y Agregar -->
        <nav id="SearchNavbar" class="navbar" style="background-color:rgb(186, 239, 255)">
            <div class="container-fluid">
                
                <a class="navbar-brand"><img src="public_html/iconos/worldgraduado24px.png"> Usuarios</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" id="txtSearch" aria-label="Search">
                    <button class="btn btn-outline-success" id="btnAgregar" type="button">Agregar</button>
                </form>
            </div>
        </nav>
        <!-- TABLE -->
        <div id="ContenidoTabla">
            `<div id="contentTable">
                <table class="table table-bordered" id="tablaUsuarios">
                    <thead class="table-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>Nombre Usuario</td>
                        <td>user123</td>
                        <td>Administrador</td>
                        <td>
                            <button class="buttonedit"><img src="public_html/iconos/editar16px.png"></button>
                            <button class="buttondelete"><img src="public_html/iconos/eliminar24px.png"></button>
                        </td>
                    </tbody>
                </table>
            </div>
            <!-- PAGINACION -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Anterior</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- FORM -->
        <div class="formulario d-none" id="formContent">
            <h2>Agregar un usuario</h2>
            <form class="form" id="formUsuario" enctype="multipart/form-data">

                <input type="hidden" name="id_user" id="id_user" value="0">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input name="usuario" id="usuario" type="text" class="form-control" placeholder="Usuario" aria-label="Usuario" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input name="password" id="password" type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña" required>
                </div>

                <label class="form-label">Tipo de Usuario</label>
                <div class="input-group mb-3">
                    
                    <select class="form-select" aria-label="Default select example" id="tipo" name="tipo" required>
                        <option selected>Seleccione tipo de usuario...</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Usuario">Usuario</option>
                    </select>
                </div>


                <button type="button" id="btnCancelar" class="btn btn-secondary">Cancelar</button> 
                <button type="submit" class="btn btn-primary">Guardar</button>                   
            </form>
        </div>
    </div>
    <!-- CONTENIDO FIN -->
    <!-- SCRIPTS -->
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/usuarios.js"></script>
</body>
</html>