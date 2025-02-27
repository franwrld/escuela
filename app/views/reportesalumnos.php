<?php 
    $title = "Reportes Alumnos";
    include_once "app/views/sections/headhtml.php"; 
?>
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
    <!-- Contenido Reporte -->
    <div class="contenido">
        <h2>Reportes de Escuelas</h2>
    <div class="selectreporte">
        <!-- Selector de Escuela -->
        <div class="mb-3">
            <label class="form-label">Buscar Alumnos Por Escuela</label>
            <select class="form-select" id="id_school" name="id_school" style="width: 100%;">
                <option value="0">Todos</option>
                <?php foreach ($alumno as $alumno): ?>
                    <option value="<?php echo $alumno['id_school']; ?>"><?php echo $alumno['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Botón Ver Reporte -->
        <div class="formbtn">
            <button class="btnverreporte" type="button" id="btnViewReport">
                <img src="<?php echo URL; ?>public_html/iconos/reportes24px.png" alt="x"/> Ver Reporte
            </button>
        </div>
        <!-- Aquí se muestra el reporte -->
        <div class="row">
            <iframe src="" frameborder="0" width="100%" height="700px" id="framereporte"></iframe>
        </div>
    </div>
</div>
    <!-- SCRIPTS -->
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/reportesalumnos.js"></script>
</body>
</html>