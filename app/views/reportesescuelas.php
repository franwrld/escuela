<?php 
    $title = "Reportes Escuela";
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
        <div class="selectreporte">
            <!-- Select-->
            <div class="mb-3">
                    <label class="form-label">Buscar Escuela</label>
                    <select class="form-select" id="id_school" name="id_school" style="width: 100%;">
                        <option selected>Seleccione una escuela...</option>
                    </select>
            </div>
            <!-- Boton Ver Reporte -->
            <div class="formbtn">
                <button class="btnverreporte" type="button" id="btnViewReport"><img src="<?php echo URL;?>public_html/iconos/informe24px.png" alt="x"/> Ver Reporte</button>
            </div>
            <!-- Aqui se muestra el reporte -->
            <div class="row">
                <iframe src="" frameborder="0" width="100%" height="700px" id="framereporte"></iframe>
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <?php include_once "app/views/sections/scripts.php"; ?>
    <script src="<?php echo URL;?>public_html/customjs/reportesescuelas.js"></script>
</body>
</html>