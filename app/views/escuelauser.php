<?php 
    $title = "Escuelas - Escuela";
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
        <nav id="SearchNavbar" class="navbar bg-body-tertiary">
            <div class="container-fluid">
                
                <a class="navbar-brand"><img src="public_html/iconos/escuela24px.png"> Escuela</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" id="txtSearch" aria-label="Search">
                </form>
            </div>
        </nav>
        <!-- TABLE -->
        <div id="ContenidoTabla">
            `<div id="contentTable">
                <table class="table table-striped-columns" id="tablaEscuela">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>EMail</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>Escuela MyControlGPS</td>
                        <td>Ave. Independencia, Santa Ana, El Salvador</td>
                        <td>escuela@example.com</td>
                        <td>121033</td>
                        <td>124144</td>
                        <td>
                            
                            <button class="buttonmap" type="button" id="btnVerMapaEAUser" onclick="verMapa()"><img src="public_html/iconos/mapaicon32px.png"></button>
                            <button class="buttonedit"><img src="public_html/iconos/editar16px.png"></button>
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
    </div>
    <!-- CONTENIDO FIN -->
    <!-- Modal para mostrar el mapa -->
    <div class="modal fade" id="mapModalUser" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <img class="" src="public_html/iconos/escuelatitle.png">
                        <h5 class="modal-title" id="escuelanameuser"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenedor para la foto de la escuela -->
                    <div id="escuelaFotoContainer" style="text-align: center; margin-bottom: 20px;">
                        <img id="escuelaFotoUser" src="" alt="Foto de la escuela" style="max-width: 100%; max-height: 200px; display: block; margin: 0 auto;">
                    </div>
                    <div id="mapContainerUser" style="height: 400px; width: 100%;"></div>
                </div>
                <div class="locationdiv">
                    <h4 class="titlelocation">Alumnos</h4>
                    <img class="locationimg" src="public_html/iconos/locationazul32px.png">
                    <h4 class="titlelocation">Escuelas</h4>
                    <img class="locationimg" src="public_html/iconos/locationrojo32px.png">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/escuelauser.js"></script>
</body>
</html>