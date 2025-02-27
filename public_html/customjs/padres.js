//Variables globales y selectores
const searchText = document.querySelector("#txtSearch");
// Tabla
const ContenidoTabla = document.querySelector("#ContenidoTabla");
const contentTable = document.querySelector("#contentTable table tbody");
const pagination = document.querySelector(".pagination");
// Form
const formContent = document.querySelector("#formContent");
const formPadre=document.querySelector("#formPadre");
const btnCancelar = document.querySelector("#btnCancelar");
const btnGuardar = document.querySelector("#btnGuardar");
const telefonoInputPadre = document.querySelector("#telefono_padre");

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
    btnCancelar.addEventListener("click", cancelarPadres);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded", cargarDatos);
    //console.log("Despues de cargar");
    formPadre.addEventListener("submit",guardarPadresCambios);
    searchText.addEventListener("input", aplicarFiltro);
}

// Funciones
function cargarDatos() {
    API.get("padres/getAllPadreAlumno").then(
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

telefonoInputPadre.addEventListener("input", function (event) {
    // Eliminar cualquier carácter que no sea un número
    this.value = this.value.replace(/\D/g, '');

    // Limitar la longitud a 8 dígitos
    if (this.value.length > 8) {
        this.value = this.value.slice(0, 8);
    }

    // Mostrar u ocultar el mensaje de error
    const telefonoErrorPadre = document.querySelector("#telefonoErrorPadre");
    if (this.value.length !== 8) {
        telefonoErrorPadre.style.display = "block";
    } else {
        telefonoErrorPadre.style.display = "none";
    }
});
// Guardar Form Cambios
function guardarPadresCambios(event) {
  event.preventDefault();
  // Validar el campo de teléfono
  const telefono = document.querySelector("#telefono_padre").value;
  const telefonoErrorPadre = document.querySelector("#telefonoErrorPadre");
  if (telefono.length !== 8 || !/^\d+$/.test(telefono)) {
      telefonoErrorPadre.style.display = "block"; // Mostrar el mensaje de error
      return; // Detener el envío del formulario
  } else {
      telefonoErrorPadre.style.display = "none"; // Ocultar el mensaje de error
  }
  const formData = new FormData(formPadre);
  
  API.post(formData, "padres/update").then(
      data => {
          if (data.success) {
              cancelarPadres();
              Swal.fire({
                  icon: "info",
                  text: data.msg
              });
          } else {
              Swal.fire({
                  icon: "error",
                  background: "#ff7f00",
                  title: "Error",
                  text: data.msg
              });
          }
      }
  ).catch(
      error => {
          console.log("Error:", error);
      }
  );
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
                const { id_padre, nombre_padre,parentesco, direccion_padre, telefono_padre, nombre_completo } = item;
                if (id_padre.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (nombre_padre.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (parentesco.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                  return item;
              }
                if (direccion_padre.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (telefono_padre.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
                    return item;
                }
                if (nombre_completo.toUpperCase().search(objDatos.filter.toLocaleUpperCase()) != -1) {
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
                    <td>${item.id_padre}</td>
                    <td>${item.nombre_padre}</td>
                    <td>${item.parentesco}</td>
                    <td>${item.direccion_padre}</td>
                    <td>${item.telefono_padre}</td>
                    <td>${item.nombre_completo}</td>
                    <td>
                        <button type="button" class="buttonedit" onclick="editarPadre(${item.id_padre})"><img src="public_html/iconos/editar24px.png"></button>
                        <button type="button" class="buttondelete" onclick="eliminarPadre(${item.id_padre})"><img src="public_html/iconos/eliminar24px.png"></button>
                    </td>
                    </tr>                
                `;
            }
        }
    );
    contentTable.innerHTML = html;
    crearPaginacion();
}

function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter = this.value;
    crearTabla();
}

function cancelarPadres() {
    ContenidoTabla.classList.remove("d-none");
    formContent.classList.add("d-none");
    cargarDatos();
}

function limpiarForm(op) {
    formPadre.reset();
    document.querySelector("#id_padre").value = "0";
}

function editarPadre(id) {
    limpiarForm(1);
    ContenidoTabla.classList.add("d-none");
    formContent.classList.remove("d-none");
    API.get("padres/getOnePadre?id=" + id)
      .then((data) => {
        if (data.success) {
          mostrarDatosForm(data.records[0]);
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
    const { id_padre, nombre_padre, direccion_padre, telefono_padre, parentesco } = record;
    document.querySelector("#id_padre").value = id_padre;
    document.querySelector("#nombre_padre").value = nombre_padre;
    document.querySelector("#direccion_padre").value = direccion_padre;
    document.querySelector("#telefono_padre").value = telefono_padre;
    document.querySelector("#parentesco").value = parentesco;
}

  function eliminarPadre(id) {
    Swal.fire({
      title: "¿Ésta seguro de eliminar el registro?",
      showDenyButton: true,
      confirmButtonText: "Si",
      denyButtonText: "No",
    }).then((resultado) => {
      console.log(resultado.isConfirmed);
      if (resultado.isConfirmed) {
        API.get("padres/eliminarPadre?id=" + id)
          .then((data) => {
            if (data.success) {
              cancelarPadres();
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