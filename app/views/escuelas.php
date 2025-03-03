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
        <nav id="SearchNavbar" class="navbar" style="background-color:rgb(186, 239, 255)">
            <div class="container-fluid">
                
                <a class="navbar-brand"><img src="public_html/iconos/escuela24px.png"> Escuelas</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" id="txtSearch" aria-label="Search">
                    <button class="btn btn-outline-success" id="btnAgregar" type="button">Agregar</button>
                </form>
            </div>
        </nav>
        <!-- TABLE -->
        <div id="ContenidoTabla">
            <div id="contentTable">
                <table class="table table-bordered" id="tablaEscuela">
                    <thead class="table-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>EMail</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Usuario</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <td class="table-info">1</td>
                        <td>Escuela MyControlGPS</td>
                        <td class="table-info">Ave. Independencia, Santa Ana, El Salvador</td>
                        <td>escuela@example.com</td>
                        <td class="table-info">121033</td>
                        <td>124144</td>
                        <td class="table-info">User</td>
                        <td>
                            
                            <button class="buttonmap" type="button" id="btnVerMapaEA" onclick="verMapa()"><img src="public_html/iconos/mapaicon32px.png"></button>
                            <<!--<button class="buttonedit"><img src="public_html/iconos/mapaicon32px.png"></button>-->
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
            <h2>Agregar una Escuela</h2>
            <form class="form" id="formSchool" enctype="multipart/form-data">

                <input type="hidden" name="id_school" id="id_school" value="0">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input name="email" id="email" type="text" class="form-control" placeholder="Correo" aria-label="Correo" required>
                </div>

                
                <div class="mb-3">
                    <label class="form-label">Escribe el nombre de un usuario para vincularlo a la escuela</label>
                    <input type="text" name="search_user" id="search_user" class="form-control" placeholder="Buscar usuario..." aria-label="Buscar usuario">
                    <input type="hidden" name="id_user" id="id_user" value="">
                    <div id="userResults" class="dropdown-menu"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Usuario vinculado</label>
                    <input type="text" name="nombre_usuario_vinculado" id="nombre_usuario_vinculado" class="form-control" readonly>
                </div>

                <h4>Marca en el mapa la ubicación de la escuela.</h4>
                <hr>
                <div id="mapEscuela" style="height: 400px; max-width: 100%; margin: 0 auto;"></div>
                <hr>
                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input name="direccion" id="direccion" type="text" class="form-control" placeholder="Dirección" aria-label="Dirección" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Latitud</label>
                    <input name="latitud" id="latitud" type="text" class="form-control" placeholder="Latitud" aria-label="Latitud" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Longitud</label>
                    <input name="longitud" id="longitud" type="text" class="form-control" placeholder="Longitud" aria-label="Longitud" readonly>
                </div>

                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label">Foto:</label>
                    <div class="col-sm-10">
                        <div class="img-thumbnail" id="divfoto" style="width:200px; height:200px">
                        </div>
                        <span>
                            Haga click para seleccionar la foto
                        </span>
                        <input type="file" name="foto" id="foto" class="d-none">
                    </div>
                </div>

                <button type="button" id="btnCancelar" class="btn btn-secondary">Cancelar</button> 
                <button type="submit" class="btn btn-primary">Guardar</button>                   
            </form>
        </div>
    </div>
    <!-- CONTENIDO FIN -->
    <!-- Modal para mostrar el mapa -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <img class="" src="public_html/iconos/escuelatitle.png">
                        <h5 class="modal-title" id="escuelaname"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenedor para la foto de la escuela -->
                    <div id="escuelaFotoContainer" style="text-align: center; margin-bottom: 20px;">
                        <img id="escuelaFoto" src="" alt="Foto de la escuela" style="max-width: 100%; max-height: 200px; display: block; margin: 0 auto;">
                    </div>
                    <div id="mapContainer" style="height: 400px; width: 100%;"></div>
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
    <script src="<?php echo URL;?>public_html/customjs/escuelas.js"></script>
</body>
</html>