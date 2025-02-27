//Variables globales y selectores
// Btn Agregar y Cuadro de busqueda
const searchText = document.querySelector("#txtSearch");
const SearchNavbar = document.querySelector("#SearchNavbar");
// Tabla
const ContenidoTabla = document.querySelector("#ContenidoTabla");
const contentTable = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");

//Foto
const divFoto = document.querySelector("#divfoto");
const inputFoto = document.querySelector("#foto");
//modal
const mapContainerUser = document.querySelector("#mapContainerUser");
const btnVerMapaEA = document.querySelector("#btnVerMapaEAUser");

const API = new Apix();

const objDatos = {
    records: [],
    recordsFilter: [],
    currentPage: 1,
    // Cantidad de celdas a mostrar por pagina
    recordsShow: 10,
    filter: ""
}

//Configuracion de eventos
eventListiners();
function eventListiners() {
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded", cargarDatos);
    //console.log("Despues de cargar");
    searchText.addEventListener("input", aplicarFiltro);
}

// Funciones
function cargarDatos() {
    API.get("escuelauser/getEscuelaONLY?id_user=${id_user}").then(
        data => {
            if (data.success) {
                objDatos.records = data.records;
                objDatos.currentPage = 1;
                crearTabla();
            } else {
                console.log("Error al recuperar los registros");
            }
        }
    ).catch(
        error => {
            console.error("Error en la llamada:", error);
        }
    );
}

function actualizarFoto(el) {
    if (el.target.files && el.target.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            divFoto.innerHTML = `<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}


function guardarCoordenadas() {
    var latitud = marker.getPosition().lat();
    var longitud = marker.getPosition().lng();
    console.log("Latitud:", latitud);
    console.log("Longitud:", longitud);
}

function crearPaginacion() {
    pagination.innerHTML = "";
    const elAnterior = document.createElement("li");
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML = `<a class="page-link" href="#">Anterior</a>`;
    elAnterior.onclick = () => {
      objDatos.currentPage =
        objDatos.currentPage == 1 ? 1 : --objDatos.currentPage;
      crearTabla();
    };
    pagination.append(elAnterior);
    const totalPage = Math.ceil(
      objDatos.recordsFilter.length / objDatos.recordsShow
    );
    for (let i = 1; i <= totalPage; i++) {
      const el = document.createElement("li");
      el.classList.add("page-item");
      el.innerHTML = `<a class="page-link" href="#">${i}</a>`;
      el.onclick = () => {
        objDatos.currentPage = i;
        crearTabla();
      };
      pagination.append(el);
    }
    const elSiguiente = document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML = `<a class="page-link" href="#">Siguiente</a>`;
    elSiguiente.onclick = () => {
      objDatos.currentPage =
        objDatos.currentPage == totalPage ? totalPage : ++objDatos.currentPage;
      crearTabla();
    };
    pagination.append(elSiguiente);
}  

function crearTabla() {
    if (objDatos.filter == "") {
        objDatos.recordsFilter = objDatos.records.map(item => item);
    } else {
        objDatos.recordsFilter = objDatos.records.filter(
            item => {
                const { id_school, nombre, direccion, email, latitud, longitud } = item;
                if (id_school.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (nombre.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (direccion.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (email.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (latitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (longitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
            }
        );
    }

    const recordIni = (objDatos.currentPage * objDatos.recordsShow) - objDatos.recordsShow;
    const recordFin = (recordIni + objDatos.recordsShow) - 1;

    let html = "";
    objDatos.recordsFilter.forEach(
        (item, index) => {
            if ((index >= recordIni) && (index <= recordFin)) {
                html += `
                    <tr class="table-info">
                    <td>${item.id_school}</td>
                    <td>${item.nombre}</td>
                    <td>${item.direccion}</td>
                    <td>${item.email}</td>
                    <td>${item.latitud}</td>
                    <td>${item.longitud}</td>
                    <td>
                        <button type="button" class="buttonmap" onclick="verMapaUser(${item.id_school})"><img src="public_html/iconos/mapaicon32px.png"></button>
                    </td>
                    </tr>                
                `;
            }
        }
    );
    contentTable.innerHTML = html;
    crearPaginacion();
}

function limpiarForm(op) {
    formSchool.reset();
    document.querySelector("#id_school").value = "0";
    divFoto.innerHTML = "";
}

function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter = this.value;
    crearTabla();
}

let mapEscuelaUser; // Variable global para el mapa de escuelas
let markerEscuelaUser; // Variable global para el marcador de la escuela

function initMapEscuelaUser(latitud, longitud) {
    // Coordenadas iniciales (si no se proporcionan, usa una ubicación por defecto)
    const initialPosition = latitud && longitud ? 
        { lat: parseFloat(latitud), lng: parseFloat(longitud) } : 
        { lat: 13.7942, lng: -88.8965 }; // Centro de El Salvador


    // Agregar un marcador si se proporcionan coordenadas
    if (latitud && longitud) {
        markerEscuelaUser = new google.maps.Marker({
            position: initialPosition,
            map: mapEscuelaUser,
            title: "Ubicación de la escuela"
        });
    }

    // Agregar un evento de clic al mapa para añadir/actualizar el marcador
    mapEscuelaUser.addListener('click', function (event) {
        if (markerEscuelaUser) {
            markerEscuelaUser.setPosition(event.latLng); // Actualizar la posición del marcador
        } else {
            markerEscuelaUser = new google.maps.Marker({
                position: event.latLng,
                map: mapEscuela,
                title: "Ubicación de la escuela"
            });
        }

        // Actualizar los campos de latitud y longitud en el formulario
        document.getElementById('latitud').value = event.latLng.lat();
        document.getElementById('longitud').value = event.latLng.lng();
    });
}
  
function verMapaUser(id_school) {
  API.get(`escuelauser/getEscuelaConAlumnos?id=${id_school}`)
      .then(data => {
          if (data.success) {
              const escuela = data.escuela;
              const alumnos = data.alumnos;

              // Verificar que los datos de la escuela y los alumnos estén definidos
              if (!escuela || !alumnos) {
                  console.error("Datos de la escuela o alumnos no definidos.");
                  return;
              }

              // Mostrar el modal
              $('#mapModalUser').modal('show');

              // Actualizar el título del modal con el nombre de la escuela
              document.getElementById('escuelanameuser').textContent = escuela.nombre;

              // Cargar la foto de la escuela
              const escuelaFotoUser = document.getElementById('escuelaFotoUser');
              if (escuela.foto) {
                escuelaFotoUser.src = escuela.foto; // Asignar la ruta de la foto
                escuelaFotoUser.style.display = 'block'; // Mostrar la imagen
              } else {
                escuelaFotoUser.style.display = 'none'; // Ocultar la imagen si no hay foto
              }

              // Inicializar el mapa después de que el modal esté completamente visible
              $('#mapModalUser').on('shown.bs.modal', function () {
                  const mapContainerUser = document.getElementById('mapContainerUser');
                  const map = new google.maps.Map(mapContainerUser, {
                      zoom: 14,
                      center: { lat: parseFloat(escuela.latitud), lng: parseFloat(escuela.longitud) }
                  });

                  // Agregar marcador de la escuela
                  new google.maps.Marker({
                      position: { lat: parseFloat(escuela.latitud), lng: parseFloat(escuela.longitud) },
                      map: map,
                      title: escuela.nombre,
                      icon: {
                          url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
                      }
                  });

                  // Agregar marcadores de los alumnos
                  alumnos.forEach(alumno => {
                      new google.maps.Marker({
                          position: { lat: parseFloat(alumno.latitud), lng: parseFloat(alumno.longitud) },
                          map: map,
                          title: alumno.nombre_completo,
                          icon: {
                              url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                          }
                      });
                  });
              });
          } else {
            Swal.fire({
                icon: 'warning',
                title: 'No tiene alumnos asociados',
                text: data.msg,
            });
        }
    })
    .catch(error => {
        console.error("Error en la llamada:", error);
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: 'Ocurrió un error al obtener los datos de la escuela.',
        });
    });
}