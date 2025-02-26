//Variables globales y selectores
// Btn Agregar y Cuadro de busqueda
const searchText = document.querySelector("#txtSearch");
const btnAgregar = document.querySelector("#btnAgregar");
const SearchNavbar = document.querySelector("#SearchNavbar");
// Tabla
const ContenidoTabla = document.querySelector("#ContenidoTabla");
const contentTable = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
// Form
const formContent = document.querySelector("#formContent");
const btnCancelar = document.querySelector("#btnCancelar");
const formSchool=document.querySelector("#formSchool");
const btnGuardar = document.querySelector("#btnGuardar");
//Foto
const divFoto = document.querySelector("#divfoto");
const inputFoto = document.querySelector("#foto");
//modal
const mapContainer = document.querySelector("#mapContainer");
const btnVerMapaEA = document.querySelector("#btnVerMapaEA");

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
    btnAgregar.addEventListener("click", agregarEscuela);
    btnCancelar.addEventListener("click", cancelarEscuela);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded", cargarDatos);
    //console.log("Despues de cargar");
    formSchool.addEventListener("submit",guardarEscuela);
    searchText.addEventListener("input", aplicarFiltro);
    divFoto.addEventListener("click", agregarFoto);
    inputFoto.addEventListener("change", actualizarFoto);
}

// Funciones
function cargarDatos() {
    API.get("escuelas/getAll").then(
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

document.getElementById('search_user').addEventListener('input', function() {
    const query = this.value;
    if (query.length > 2) {
        API.get(`usuarios/buscar?q=${query}`).then(data => {
            const results = document.getElementById('userResults');
            results.innerHTML = '';
            if (data.success && data.records.length > 0) {
                data.records.forEach(user => {
                    const item = document.createElement('div');
                    item.classList.add('dropdown-item');
                    item.textContent = user.nombre;
                    item.addEventListener('click', () => {
                        document.getElementById('search_user').value = user.nombre;
                        document.getElementById('id_user').value = user.id_user;
                        results.innerHTML = '';
                    });
                    results.appendChild(item);
                });
                results.style.display = 'block';
            } else {
                results.style.display = 'none';
            }
        }).catch(error => {
            console.error("Error en la llamada:", error);
        });
    } else {
        document.getElementById('userResults').style.display = 'none';
    }
});

function guardarEscuela(event) {
  event.preventDefault();
  const formData = new FormData(formSchool);

  // Verificar que se hayan ingresado latitud y longitud
  const latitud = document.getElementById('latitud').value;
  const longitud = document.getElementById('longitud').value;

  if (!latitud || !longitud) {
      Swal.fire({
          icon: "error",
          title: "Error",
          text: "Debes seleccionar una ubicación en el mapa.",
      });
      return;
  }

  API.post(formData, "escuelas/guardar")
      .then((data) => {
          if (data.success) {
              cancelarEscuela();
              Swal.fire({
                  icon: "info",
                  text: data.msg,
              });
          } else {
              Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: data.msg,
              });
          }
      })
      .catch((error) => {
          console.log("Error:", error);
      });
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

function agregarFoto() {
    inputFoto.click();
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
                const { id_school, nombre, direccion, email, latitud, longitud, nombreusuario } = item;
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
                if (nombreusuario.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
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
                    <tr>
                    <td>${item.id_school}</td>
                    <td>${item.nombre}</td>
                    <td>${item.direccion}</td>
                    <td>${item.email}</td>
                    <td>${item.latitud}</td>
                    <td>${item.longitud}</td>
                    <td>${item.nombreusuario}</td>
                    <td>
                        <button type="button" class="buttonmap" onclick="verMapa(${item.id_school})"><img src="public_html/iconos/mapaicon32px.png"></button>
                        <button type="button" class="buttonedit" onclick="editarEscuela(${item.id_school})"><img src="public_html/iconos/editar24px.png"></button>
                        <button type="button" class="buttondelete" onclick="eliminarEscuela(${item.id_school})"><img src="public_html/iconos/eliminar24px.png"></button>
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

// Aparecer FORM
function agregarEscuela() {
    ContenidoTabla.classList.add("d-none");
    SearchNavbar.classList.add("d-none");
    formContent.classList.remove("d-none");
    limpiarForm();
    initMapEscuela();
}

function cancelarEscuela() {
    ContenidoTabla.classList.remove("d-none");
    SearchNavbar.classList.remove("d-none");
    formContent.classList.add("d-none");
    cargarDatos();
}

function editarEscuela(id) {
  limpiarForm(1);
  ContenidoTabla.classList.add("d-none");
  SearchNavbar.classList.add("d-none");
  formContent.classList.remove("d-none");
  API.get("escuelas/getOneEscuela?id=" + id)
    .then((data) => {
      if (data.success) {
        mostrarDatosForm(data.records[0]);
        const { latitud, longitud } = data.records[0];
        initMapEscuela(latitud, longitud); // Inicializar el mapa con la ubicación de la escuela
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.msg,
        });
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function mostrarDatosForm(record) {
    const { id_school, nombre, direccion, email, foto,latitud, longitud } = record;
    document.querySelector("#id_school").value = id_school;
    document.querySelector("#nombre").value = nombre;
    document.querySelector("#direccion").value = direccion;
    document.querySelector("#email").value = email;
    divFoto.innerHTML = `<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
    document.querySelector("#latitud").value = latitud;
    document.querySelector("#longitud").value = longitud;
    actualizarMarcadorMapa(parseFloat(latitud), parseFloat(longitud));
  }

  function eliminarEscuela(id) {
    Swal.fire({
      title: "¿Ésta seguro de eliminar el registro?",
      showDenyButton: true,
      confirmButtonText: "Si",
      denyButtonText: "No",
    }).then((resultado) => {
      console.log(resultado.isConfirmed);
      if (resultado.isConfirmed) {
        API.get("escuelas/eliminarEscuela?id=" + id)
          .then((data) => {
            if (data.success) {
              cancelarEscuela();
              Swal.fire({
                icon: "info",
                text: data.msg,
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: data.msg,
              });
            }
          })
          .catch((error) => {
            console.log("Error:", error);
          });
      }
    });
    console.log("Mensaje de texto");
  }

  let mapEscuela; // Variable global para el mapa de escuelas
let markerEscuela; // Variable global para el marcador de la escuela

function initMapEscuela(latitud, longitud) {
    // Coordenadas iniciales (si no se proporcionan, usa una ubicación por defecto)
    const initialPosition = latitud && longitud ? 
        { lat: parseFloat(latitud), lng: parseFloat(longitud) } : 
        { lat: 13.7942, lng: -88.8965 }; // Centro de El Salvador

    // Crear el mapa
    mapEscuela = new google.maps.Map(document.getElementById('mapEscuela'), {
        zoom: 14,
        center: initialPosition
    });

    // Agregar un marcador si se proporcionan coordenadas
    if (latitud && longitud) {
        markerEscuela = new google.maps.Marker({
            position: initialPosition,
            map: mapEscuela,
            title: "Ubicación de la escuela"
        });
    }

    // Agregar un evento de clic al mapa para añadir/actualizar el marcador
    mapEscuela.addListener('click', function (event) {
        if (markerEscuela) {
            markerEscuela.setPosition(event.latLng); // Actualizar la posición del marcador
        } else {
            markerEscuela = new google.maps.Marker({
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
  
function verMapa(id_school) {
  API.get(`escuelas/getEscuelaConAlumnos?id=${id_school}`)
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
              $('#mapModal').modal('show');

              // Actualizar el título del modal con el nombre de la escuela
              document.getElementById('escuelaname').textContent = escuela.nombre;

              // Cargar la foto de la escuela
              const escuelaFoto = document.getElementById('escuelaFoto');
              if (escuela.foto) {
                  escuelaFoto.src = escuela.foto; // Asignar la ruta de la foto
                  escuelaFoto.style.display = 'block'; // Mostrar la imagen
              } else {
                  escuelaFoto.style.display = 'none'; // Ocultar la imagen si no hay foto
              }

              // Inicializar el mapa después de que el modal esté completamente visible
              $('#mapModal').on('shown.bs.modal', function () {
                  const mapContainer = document.getElementById('mapContainer');
                  const map = new google.maps.Map(mapContainer, {
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