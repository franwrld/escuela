<?php 
    $title = "Alumnos - Escuela";
    include_once "app/views/sections/headhtml.php";
?>
<script>
  const id_school = "<?= $_SESSION['id_school'] ?>";
</script>
<body>
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
    <!-- CONTENIDO -->
    <div class="contenido">
        <!-- NAV, Buscar y Agregar -->
        <nav id="SearchNavbar" class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand"><img src="public_html/iconos/world34px.png"> Alumnos</a>
                <form class="d-flex" role="search">
                    
                    <input class="form-control me-2" type="search" placeholder="Buscar" id="txtSearch" aria-label="Search">
                    
                    <button class="addbtn" id="btnAgregar" type="button"><img src="public_html/iconos/add24px.png"></button>
                </form>
            </div>
        </nav>
        <!-- TABLE -->
        <div id="ContenidoTabla">
            <div id="contentTable">
                <table class="table table-striped-columns" id="tablaAlumnos">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>EMail</th>
                        <th>Genero</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Grado</th>
                        <th>Seccion</th>
                        <th>Escuela</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>Carlos Francisco Ruiz Cortez</td>
                        <td>BO Santa Ana,</td>
                        <td>01010101</td>
                        <td>carlos@example.com</td>
                        <td>Masculino</td>
                        <td>A</td>
                        <td>ITCA Santa Ana</td>
                        <td>
                            <button id="infoalumnos" class="btn btn-warning">                      
                            </button>
                            <button id="agregarPadres" class="btn btn-warning">                      
                                <span>Agregar Padres</span>
                            </button>
                            <button class="buttonedit">
                                <img src="public_html/iconos/editar24px.png">
                            </button>
                            <button class="buttondelete">
                                <img src="public_html/iconos/eliminar24px.png">
                            </button>
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
        <!-- FORM Alumnos -->
        <div class="formulario d-none" id="formContent">
            <form class="form" id="formAlumnosUser" enctype="multipart/form-data">
                <h2>Agregar Alumno</h2>

                <input type="hidden" name="id_alumno" id="id_alumno" value="0">
                
                <input type="hidden" name="id_school" id="id_school">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input name="nombre_completo" id="nombre_completo" type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" required>
                </div>

                

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input name="telefono" id="telefono" type="number" class="form-control" placeholder="Telefono" aria-label="telefono" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input name="email" id="email" type="text" class="form-control" placeholder="Correo" aria-label="Correo" required>
                </div>

                <label class="form-label">Genero</label>
                <div class="input-group mb-3">    
                    <select class="form-select" id="genero" name="genero" required>
                        <option selected>Seleccione su sexo...</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                    <label class="input-group-text" for="inputGroupSelect02">Opciones</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grado</label>
                    <select class="form-select" id="id_grado" name="id_grado" style="width: 100%;">
                        <option selected>Seleccione un grado...</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sección</label>
                    <select class="form-select" id="id_seccion" name="id_seccion" style="width: 100%;">
                        <option selected>Seleccione una seccion...</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Latitud</label>
                    <input name="latitud" id="latitud" type="text" class="form-control" placeholder="Latitud" aria-label="Latitud" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Longitud</label>
                    <input name="longitud" id="longitud" type="text" class="form-control" placeholder="Longitud" aria-label="Longitud" readonly>
                </div>

                <div id="mapAlumno" style="height: 400px; max-width: 100%; margin: 0 auto;"></div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input name="direccion" id="direccion" type="text" class="form-control" placeholder="Dirección" aria-label="Dirección" required>
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

                <button type="button" id="btnCancelar" name="btnCancelar" class="btn btn-secondary">Cancelar</button> 
                <button type="submit" class="btn btn-primary">Guardar</button>                   
            </form>
        </div>
        <!-- Form Padres -->
        <div class="formulario2 d-none" id="formContentPadres">
            <h2>Agregar Padres</h2>
            <form class="form" id="formPadres" enctype="multipart/form-data">
                <input type="hidden" name="id_padre" id="id_padre" value="0">
                <input type="hidden" name="id_alumno" id="id_alumno_padre" value="0">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input name="nombre_padre" id="nombre_padre" type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input name="direccion_padre" id="direccion_padre" type="text" class="form-control" placeholder="Dirección" aria-label="Dirección" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefono</label>
                    <input name="telefono_padre" id="telefono_padre" type="text" class="form-control" placeholder="Telefono" aria-label="Telefono">
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

                <button type="button" id="btnCancelarPadres" name="btnCancelarPadres" class="btn btn-secondary">Cancelar</button> 
                <button type="submit" class="btn btn-primary">Guardar</button>                   
            </form>
        </div>
    </div>
    <!-- CONTENIDO FIN -->
    <!-- Modal para mostrar el mapa -->
    <div class="modal fade" id="alumnoModal" tabindex="-1" aria-labelledby="alumnoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                        <img class="" src="public_html/iconos/alumnoprofile24px.png">
                        <h5 class="modal-title"> Información Estudiante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido -->


                    <div class="cardalumno">
                        <div class="infos">
                            <div class="imagealumno"><img class="imagealumno" id="alumnofoto" alt="Foto del Alumno">
                            </div>
                            <div class="info">
                                <div>
                                    <p class="name" id="nombrealumno">
                                        
                                    </p>
                                    <p class="function" id="emailalumno">
                                        
                                    </p>
                                </div>
                                <p id="escuela"></p>
                                <div class="stats">
                                        <p class="flex flex-col">
                                            Grado
                                            <span id="grado" class="state-value">
                                            
                                            </span>
                                        </p>
                                        <p class="flex">
                                            Sección
                                            <span id="seccion" class="state-value">
                                                
                                            </span>
                                        </p>
                                        <p class="flex">
                                            Genero
                                            <span id="generoalumno" class="state-value">
                                                
                                            </span>
                                        </p>
                                        
                                </div>
                                <div class="datosal">
                                    <h2 class="titledatos1">Dirección:</h2>
                                    <h3 id="direccionalumno" class="titledatos"> </h3>
                                </div>
                                <div class="datosal">
                                    <h2 class="titledatos1">Telefóno:</h2>
                                    <h3 id="telefonoalumno" class="titledatos"> </h3>
                                </div>
                                
                                <div id="padresContainer">
                                    <!-- Aqui se correran los padres dinamicamente -->
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    <div>
                        
                    </div>         
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/alumnosuser.js"></script>
</body>
</html>