<script src="<?php echo URL;?>public_html/customjs/api.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--Cargar loader  -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Al cargar la página, se mostrará el loader mientras se espera
    setTimeout(function(){
         // Ocultar el loader
         document.querySelector('.loader').style.display = 'none';
         // Mostrar el contenedor del mapa
         document.getElementById('map').style.display = 'block';
         // Inicializar el mapa
         initMap();
    }, 2000); // 2000 ms = 2 segundos
});
</script>

