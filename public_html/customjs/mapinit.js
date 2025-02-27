// Variables globales para el mapa y los marcadores
var map;
var MarcadorActual = null;
var escuelasMarkers = [];
var alumnosMarkers = [];

// Inicializar el mapa
function initMap() {
    
    // Coordenadas aproximadas del centro de El Salvador
    var sv = { lat: 13.7942, lng: -88.8965 };

    // Crear el mapa
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10, // Un zoom más amplio para mostrar todo el país
        center: sv // Centrar el mapa en El Salvador
    });

    // Llamada al resize un momento después
    setTimeout(function() {
        google.maps.event.trigger(map, 'resize');
        map.setCenter(sv); // Volver a centrar en El Salvador (opcional)
    }, 300)

    // Cargar las escuelas y los alumnos
    cargarEscuelas();
    cargarAlumnos();

    // Agregar un evento de clic al mapa para añadir marcadores dinámicamente
    map.addListener('click', function (event) {
        // Si ya existe un marcador, lo eliminamos
        if (MarcadorActual) {
            MarcadorActual.setMap(null);
        }
        // Agregamos el nuevo marcador
        MarcadorActual = addMarker(event.latLng, map);

        // Actualizar los campos de latitud y longitud en el formulario
        document.getElementById('latitud').value = event.latLng.lat();
        document.getElementById('longitud').value = event.latLng.lng();
    });
}

// Función para cargar las escuelas desde la base de datos
function cargarEscuelas() {
    fetch('escuelas/getAll')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.records.forEach(escuela => {
                    addEscuelaMarker(escuela);
                });
            } else {
                console.error("Error al cargar las escuelas:", data.msg);
            }
        })
        .catch(error => {
            console.error("Error en la llamada:", error);
        });
}

// Función para cargar los alumnos desde la base de datos
function cargarAlumnos() {
    fetch('alumnos/getAllAlumnosMapa')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.records.forEach(alumno => {
                    addAlumnosMarker(alumno);
                });
            } else {
                console.error("Error al cargar los alumnos:", data.msg);
            }
        })
        .catch(error => {
            console.error("Error en la llamada:", error);
        });
}

// Función para agregar un marcador de escuela
function addEscuelaMarker(escuela) {
    var marker = new google.maps.Marker({
        position: { lat: parseFloat(escuela.latitud), lng: parseFloat(escuela.longitud) },
        map: map,
        title: escuela.nombre,
        icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
        }
    });
    escuelasMarkers.push(marker);
}

// Función para agregar un marcador de alumno
function addAlumnosMarker(alumno) {
    var marker = new google.maps.Marker({
        position: { lat: parseFloat(alumno.latitud), lng: parseFloat(alumno.longitud) },
        map: map,
        title: alumno.nombre_completo,
        icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
        }
    });
    alumnosMarkers.push(marker);
}

// Función para agregar un marcador en una posición específica
function addMarker(location, map) {
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'Nuevo Marcador'
    });

    // Opcional: Puedes agregar un evento de clic al marcador para eliminarlo
    marker.addListener('click', function () {
        marker.setMap(null); // Elimina el marcador
    });

    return marker; // Devolvemos el marcador creado
}

// Función para actualizar el marcador en el mapa
function actualizarMarcadorMapa(latitud, longitud) {
    if (map && MarcadorActual) {
        var nuevaPosicion = new google.maps.LatLng(latitud, longitud);
        MarcadorActual.setPosition(nuevaPosicion);
        map.setCenter(nuevaPosicion);
    } else if (map) {
        // Si no hay un marcador, crea uno nuevo
        MarcadorActual = addMarker({ lat: latitud, lng: longitud }, map);
        map.setCenter({ lat: latitud, lng: longitud });
    }
}

// Función para actualizar los campos de latitud y longitud en el formulario
function actualizarPosicion(latitud, longitud) {
    document.getElementById("latitud").value = latitud;
    document.getElementById("longitud").value = longitud;
}

// Función para guardar las coordenadas
function guardarCoordenadas() {
    var latitud = MarcadorActual.getPosition().lat();
    var longitud = MarcadorActual.getPosition().lng();
    console.log("Latitud:", latitud);
    console.log("Longitud:", longitud);
}