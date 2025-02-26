//Variables globales y selectores
// Btn Agregar y Cuadro de busqueda
const searchText = document.querySelector("#txtSearch");
const btnAgregarPadres = document.querySelector("#agregarPadres");
const btnAgregar = document.querySelector("#btnAgregar");
const SearchNavbar = document.querySelector("#SearchNavbar");
// Tabla
const ContenidoTabla = document.querySelector("#ContenidoTabla");
const contentTable = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
// Form
const formContent = document.querySelector("#formContent");
const formContentPadres = document.querySelector("#formContentPadres");
const btnCancelar = document.querySelector("#btnCancelar");
const btnCancelarPadres = document.querySelector("#btnCancelarPadres");
const formAlumnos=document.querySelector("#formAlumnos");
const formPadres=document.querySelector("#formPadres");
const btnGuardar = document.querySelector("#btnGuardar");
//Foto
const divFoto = document.querySelector("#divfoto");
const inputFoto = document.querySelector("#foto");

const API = new Apix();

const objDatos = {
    records: [],
    recordsFilter: [],
    currentPage: 1,
    // Cantidad de celdas a mostrar por pagina
    recordsShow: 6,
    filter: ""
}

//Configuracion de eventos
eventListiners();
function eventListiners() {
    btnAgregar.addEventListener("click", agregarAlumnos);
    btnAgregarPadres.addEventListener("click", agregarPadres);
    btnCancelar.addEventListener("click", cancelarAlumnos);
    btnCancelarPadres.addEventListener("click", cancelarPadres);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded", cargarDatos);
    //console.log("Despues de cargar");
    formAlumnos.addEventListener("submit",guardarAlumnos);
    formPadres.addEventListener("submit",guardarPadres);
    searchText.addEventListener("input", aplicarFiltro);
    divFoto.addEventListener("click", agregarFoto);
    inputFoto.addEventListener("change", actualizarFoto);
}


function cargarDatos() {
    API.get("alumnos/getAll")
      .then((data) => {
        console.log(data.records);
        if (data.success) {
          objDatos.records = data.records;
          objDatos.currentPage = 1;
          crearTabla();
          cargarGrados();
          cargarSecciones();
          cargarEscuelas();
        } else {
          console.log("Error al recuperar los registros");
        }
      })
      .catch((error) => {
        console.error("Error en la llamada:", error);
      });
  }

function cargarEscuelas() {
    API.get("escuelas/getAll").then(
        data => {
            if (data.success) {
                const selectEscuela = document.querySelector("#id_school");
                selectEscuela.innerHTML = "<option selected>Seleccione una escuela...</option>";
                data.records.forEach(escuela => {
                    const option = document.createElement("option");
                    option.value = escuela.id_school;
                    option.textContent = escuela.nombre;
                    selectEscuela.appendChild(option);
                });
                $(selectEscuela).select2({
                    placeholder: "Seleccione una escuela",
                    allowClear: true
                });
            } else {
                console.log("Error al recuperar las escuelas");
            }
        }
    ).catch(
        error => {
            console.error("Error en la llamada:", error);
        }
    );
}
function cargarGrados() {
    API.get("grados/getAll").then(
        data => {
            if (data.success) {
                const selectGrado = document.querySelector("#id_grado");
                selectGrado.innerHTML = "<option selected>Seleccione un grado...</option>";
                data.records.forEach(grado => {
                    const option = document.createElement("option");
                    option.value = grado.id_grado;
                    option.textContent = grado.grado;
                    selectGrado.appendChild(option);
                });
            } else {
                console.log("Error al recuperar los grados");
            }
        }
    ).catch(
        error => {
            console.error("Error en la llamada:", error);
        }
    );
}

function cargarSecciones() {
    API.get("secciones/getAll").then(
        data => {
            if (data.success) {
                const selectSeccion = document.querySelector("#id_seccion");
                selectSeccion.innerHTML = "<option selected>Seleccione la seccion...</option>";
                data.records.forEach(seccion => {
                    const option = document.createElement("option");
                    option.value = seccion.id_seccion;
                    option.textContent = seccion.seccion;
                    selectSeccion.appendChild(option);
                });
            } else {
                console.log("Error al recuperar las secciones");
            }
        }
    ).catch(
        error => {
            console.error("Error en la llamada:", error);
        }
    );
}

function guardarAlumnos(event) {
    event.preventDefault();
    const formData = new FormData(formAlumnos);
  
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
  
    API.post(formData, "alumnos/guardar")
        .then((data) => {
            if (data.success) {
                cancelarAlumnos();
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

function guardarPadres(event){
    event.preventDefault();
    const formData = new FormData(formPadres);
    API.post(formData,"alumnosuser/guardarPadres").then(
        data=>{
            if (data.success){
                cancelarPadres();
                Swal.fire({
                    icon:"info",
                    text:data.msg
                });
            } else {
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                });
            }
        }
    ).catch(
        error=>{
            console.log("Error:",error);
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
                const { id_alumno, nombre_completo, direccion, telefono, email, genero, latitud, longitud, nombre_grado, nombre_seccion, nombre_escuela } = item;
                if (id_alumno.toString().toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (nombre_completo.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (direccion.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (telefono.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (email.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (genero.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (latitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (longitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (nombre_grado.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (nombre_seccion.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (nombre_escuela.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
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
                        <td>${item.id_alumno}</td>
                        <td>${item.nombre_completo}</td>
                        <td>${item.direccion}</td>
                        <td>${item.telefono}</td>
                        <td>${item.email}</td>
                        <td>${item.genero}</td>
                        <td>${item.latitud}</td>
                        <td>${item.longitud}</td>
                        <td>${item.nombre_grado}</td>
                        <td>${item.nombre_seccion}</td>
                        <td>${item.nombre_escuela}</td>
                        <td>
                            <button type="button" class="buttoninfoalumnos" onclick="VerAlumnoInfo(${item.id_alumno})"><img src="public_html/iconos/alumnoprofile24px.png"></button>
                            <button type="button" class="buttonaddparents" id="agregarPadres" onclick="agregarPadres(${item.id_alumno})"><img src="public_html/iconos/familia24px.png"></button>
                            <button type="button" class="buttonedit" onclick="editarAlumno(${item.id_alumno})"><img src="public_html/iconos/editar24px.png"></button>
                            <button type="button" class="buttondelete" onclick="eliminarAlumno(${item.id_alumno})"><img src="public_html/iconos/eliminar24px.png"></button>
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
    formAlumnos.reset();
    document.querySelector("#id_alumno").value = "0";
    divFoto.innerHTML = "";
    document.querySelector("#id_grado").value = "";
    document.querySelector("#id_seccion").value = "";
    document.querySelector("#id_school").value = "";
}

function limpiarFormPadres(op) {
    formPadres.reset();
    document.querySelector("#id_padre").value = "0";
}

function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter = this.value;
    crearTabla();
}

// Aparecer FORM
function agregarAlumnos() {
    ContenidoTabla.classList.add("d-none");
    SearchNavbar.classList.add("d-none");
    formContent.classList.remove("d-none");
    limpiarForm();

    initMapAlumno();
}

function agregarPadres(id_alumno) {
    ContenidoTabla.classList.add("d-none");
    SearchNavbar.classList.add("d-none");
    formContentPadres.classList.remove("d-none");
    document.querySelector("#id_alumno_padre").value = id_alumno;
    limpiarFormPadres();
}

function cancelarAlumnos() {
    ContenidoTabla.classList.remove("d-none");
    SearchNavbar.classList.remove("d-none");
    formContent.classList.add("d-none");
    cargarDatos(); // Esto debería actualizar la tabla
}

function cancelarPadres() {
    ContenidoTabla.classList.remove("d-none");
    SearchNavbar.classList.remove("d-none");
    formContentPadres.classList.add("d-none");
    cargarDatos();
}

function editarAlumno(id) {
    limpiarForm(1);
    ContenidoTabla.classList.add("d-none");
    formContent.classList.remove("d-none");
    API.get("alumnos/getOneAlumno?id=" + id)
      .then((data) => {
        if (data.success) {
          mostrarDatosForm(data.records[0]);
          // Obtener la lat y long.
          const { latitud, longitud } = data.records[0];
          initMapAlumno(latitud, longitud);
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
    const { id_alumno, nombre_completo, direccion, telefono, email, foto, genero, latitud, longitud, id_grado, id_seccion, id_school } = record;
    document.querySelector("#id_alumno").value = id_alumno;
    document.querySelector("#nombre_completo").value = nombre_completo;
    document.querySelector("#direccion").value = direccion;
    document.querySelector("#telefono").value = telefono;
    document.querySelector("#email").value = email;
    divFoto.innerHTML = `<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
    document.querySelector("#genero").value = genero;
    document.querySelector("#latitud").value = latitud;
    document.querySelector("#longitud").value = longitud;
    document.querySelector("#id_grado").value = id_grado;
    document.querySelector("#id_seccion").value = id_seccion;
    document.querySelector("#id_school").value = id_school;
    actualizarMarcadorMapa(parseFloat(latitud), parseFloat(longitud));
}

function mostrarDatosFormPadres(record) {
    const { id_padre, nombre_padre, direccion_padre, telefono_padre, parentesco } = record;
    document.querySelector("#id_padre").value = id_padre;
    document.querySelector("#nombre_completo").value = nombre_padre;
    document.querySelector("#direccion_padre").value = direccion_padre;
    document.querySelector("#telefono_padre").value = telefono_padre;
    document.querySelector("#parentesco").value = parentesco;
}

function eliminarAlumno(id) {
    Swal.fire({
        title: "¿Ésta seguro de eliminar el registro?",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: "No",
    }).then((resultado) => {
        if (resultado.isConfirmed) {
            API.get("alumnos/deleteAlumno?id=" + id)
    .then((data) => {
        console.log("Respuesta del servidor:", data);
        if (data.success) {
            cancelarAlumnos();
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
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un problema al eliminar el alumno.",
        });
    });
        }
    });
}

let mapAlumno; // Variable global para el mapa de alumnos
let markerAlumno; // Variable global para el marcador del alumno

function initMapAlumno(latitud, longitud) {
    // Coordenadas iniciales (si no se proporcionan, usa una ubicación por defecto)
    const initialPosition = latitud && longitud ? 
        { lat: parseFloat(latitud), lng: parseFloat(longitud) } : 
        { lat: 13.7942, lng: -88.8965 }; // Centro de El Salvador

    // Crear el mapa
    mapAlumno = new google.maps.Map(document.getElementById('mapAlumno'), {
        zoom: 14,
        center: initialPosition
    });

    // Agregar un marcador si se proporcionan coordenadas
    if (latitud && longitud) {
        markerAlumno = new google.maps.Marker({
            position: initialPosition,
            map: mapAlumno,
            title: "Ubicación del alumno"
        });
    }

    // Agregar un evento de clic al mapa para añadir/actualizar el marcador
    mapAlumno.addListener('click', function (event) {
        if (markerAlumno) {
            markerAlumno.setPosition(event.latLng); // Actualizar la posición del marcador
        } else {
            markerAlumno = new google.maps.Marker({
                position: event.latLng,
                map: mapAlumno,
                title: "Ubicación del alumno"
            });
        }

        // Actualizar los campos de latitud y longitud en el formulario
        document.getElementById('latitud').value = event.latLng.lat();
        document.getElementById('longitud').value = event.latLng.lng();
    });
}

function VerAlumnoInfo(id_alumno) {
    API.get(`alumnos/getAlumnoInfo?id_alumno=${id_alumno}`)
        .then((data) => {
            if (data.success) {
                const alumno = data.alumno;
                const padres = data.padres;

                document.querySelector("#alumnofoto").src = alumno.foto;
                document.querySelector("#nombrealumno").textContent = alumno.nombre_completo;
                document.querySelector("#direccionalumno").textContent = alumno.direccion;
                document.querySelector("#telefonoalumno").textContent = alumno.telefono;
                document.querySelector("#emailalumno").textContent = alumno.email;
                document.querySelector("#generoalumno").textContent = alumno.genero;
                document.querySelector("#escuela").textContent = alumno.nombre_escuela;
                document.querySelector("#grado").textContent = alumno.grado;
                document.querySelector("#seccion").textContent = alumno.seccion;


                // Limpiar la sección de padres antes de agregar nuevos elementos
                const padresContainer = document.querySelector("#padresContainer");
                padresContainer.innerHTML = "";

                // Agregar cada padre
                padres.forEach(padre => {
                    const padreElement = document.createElement("div");
                    padreElement.innerHTML = `
                        <hr>
                        <h5>Encargado: ${padre.nombre_padre}</h5>
                        <h5>Parentesco: ${padre.parentesco}</h3>
                        <h5>Teléfono del responsable: ${padre.telefono_padre}</h5>
                        <hr>
                    `;
                    padresContainer.appendChild(padreElement);
                });

                // Mostrar el modal
                const alumnoModal = new bootstrap.Modal(document.getElementById('alumnoModal'));
                alumnoModal.show();
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
