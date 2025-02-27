<?php 
    $title = "Padres - Escuela";
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
        <nav class="navbar" style="background-color:rgb(186, 239, 255)">
            <div class="container-fluid">
                <a class="navbar-brand"><img src="public_html/iconos/parents24px.png"> Padres</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" id="txtSearch" aria-label="Search">
                </form>
            </div>
        </nav>
        <!-- TABLE -->
        <div id="ContenidoTabla">
            `<div id="contentTable">
                <table class="table table-bordered" id="tablaEscuela">
                    <thead class="table-dark">
                        <th>ID</th>
                        <th>Nombre Padre</th>
                        <th>Parentesco</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Nombre Alumno</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>Nombre Padre</td>
                        <td>Parentesco1</td>
                        <td>Ave. Independencia, Santa Ana, El Salvador</td>
                        <td>2414144</td>
                        <td>Nombre Alumno</td>
                        <td>
                            <button class="buttonedit"><img src="public_html/iconos/editar24px.png"></button>
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
        <hr>
        <div class="formulario d-none" id="formContent">
            <h2>Editar Responsable del Alumno</h2>
            <form class="form" id="formPadre" enctype="multipart/form-data">

                <input type="hidden" name="id_padre" id="id_padre" value="0">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input name="nombre_padre" id="nombre_padre" type="text" class="form-control" placeholder="Nombre" aria-label="Nombre">
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input name="direccion_padre" id="direccion_padre" type="text" class="form-control" placeholder="Dirección" aria-label="Dirección">
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input name="telefono_padre" id="telefono_padre" type="text" class="form-control" placeholder="Telefono" aria-label="telefono" maxlength="8" required>
                    <div id="telefonoErrorPadre" class="text-danger" style="display: none;">Solo se aceptan numeros, Maximo 8 Digitios.</div>
                </div>

                <label class="form-label">Parentesco</label>
                <div class="input-group mb-3">
                    
                    <select class="form-select" aria-label="Default select example" id="parentesco" name="parentesco" required>
                        <option selected>Seleccione parentesco...</option>
                        <option value="Padre">Padre</option>
                        <option value="Madre">Madre</option>
                        <option value="Sobrino/a">Hermano/a</option>
                        <option value="Abuelo/a">Abuelo/a</option>
                        <option value="Tio/a">Tio/a</option>
                        <option value="Primo/a">Primo/a</option>
                        <option value="Sobrino/a">Sobrino/a</option>
                        <option value="Sin Parentesco">Sin Parentesco</option>
                    </select>
                </div>

                <button type="button" id="btnCancelar" class="btn btn-secondary">Cancelar</button> 
                <button type="submit" class="btn btn-primary">Submit</button>                   
            </form>
        </div>
        <hr>
    </div>
    <!-- CONTENIDO FIN -->
    <!-- SCRIPTS -->
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/padres.js"></script>
</body>
</html>