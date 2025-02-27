<?php 
    $title = "Login - Escuela";
    include_once "app/views/sections/headhtml.php";
?>
<body>
<!-- Login 9 - Bootstrap Brain Component -->
    <section class="bg-light vh-100 vw-100 d-flex align-items-center justify-content-center py-5 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center text-bg-light">
                        <div class="col-12 col-xl-9">
                            <img class="img-fluid rounded mb-4" loading="lazy" src="<?php echo URL;?>public_html/iconos/logoescuela400x214.png" alt="logo">
                            <h3 class="h3 mb-4">Bienvenido al sistema.</h3>
                            <p class="lead mb-2">Accede a la información de las escuelas y sus alumnos</p>
                            <p class="lead mb-5">con el mapa de Google obten la ubicación más fácilmente</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4 d-flex align-items-center justify-content-center">
                                        <h3>Ingresa tus credenciales</h3>
                                    </div>
                                </div>
                            </div>
                            <form action="login.php" method="post" id="formlogin">
                                <div class="row gy-3 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
                                            <label for="usuario" class="form-label">Usuario</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Contraseña" required>
                                            <label for="password" class="form-label">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <br>
                                    </div>

                                    <button class="fancy" type="submit">
                                        <span class="top-key"></span>
                                        <span class="text">INICIAR SESIÓN</span>
                                        <span class="bottom-key-1"></span>
                                        <span class="bottom-key-2"></span>
                                    </button >
                                </div>
                                <!-- Mensaje de alerta si el usuario y password son incorrectos -->
                                <div class="loginmensaje" role="alert" id="mensaje">
                                </div>
                            </form>
                            <div class="row">
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Scripts -->
    <script src="<?php echo URL; ?>public_html/customjs/api.js"></script>
    <script src="<?php echo URL; ?>public_html/customjs/login.js"></script>
    
</body>
</html>