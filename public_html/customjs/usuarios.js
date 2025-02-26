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
const formUsuario=document.querySelector("#formUsuario");
const btnGuardar = document.querySelector("#btnGuardar");

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
    btnAgregar.addEventListener("click", agregarUsuarios);
    btnCancelar.addEventListener("click", cancelarUsuarios);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded", cargarDatos);
    //console.log("Despues de cargar");
    formUsuario.addEventListener("submit",guardarUsuarios);
    searchText.addEventListener("input", aplicarFiltro);

}

function cargarDatos() {
    API.get("usuarios/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
            } else {
                console.log("Error al recuperar los registros");
            }
        }
    ).catch(
        error=>{
            console.error("Error en la llamada:",error);
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
    if (objDatos.filter==""){
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(
            item=>{
                const {id_user,nombre, usuario, tipo}=item;
                if (id_user.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (nombre.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (usuario.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (tipo.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
            }
        );
    }

    const recordIni=(objDatos.currentPage*objDatos.recordsShow)-objDatos.recordsShow;

    const recordFin=(recordIni+objDatos.recordsShow)-1;

    let html="";
    objDatos.recordsFilter.forEach(
        (item,index)=>{
            if ((index>=recordIni) && (index<=recordFin)){
                        
                html+=`
                    <tr>
                    <td>${item.id_user}</td>
                    <td>${item.nombre}</td>
                    <td>${item.usuario}</td>
                    <td>${item.tipo}</td>
                    <td>
                        <button type="button" class="buttonedit" onclick="editarUsuario(${item.id_user})"><img src="public_html/iconos/editar24px.png"></button>
                        <button type="button" class="buttondelete" onclick="eliminarUsuario(${item.id_user})"><img src="public_html/iconos/eliminar24px.png"></button>
                    </td>
                    </tr>
                
                `;
            }
        }
    );
    //console.log(html);
    contentTable.innerHTML=html;
    crearPaginacion(); 
}

function guardarUsuarios(event){
    event.preventDefault();
    const formData = new FormData(formUsuario);
    //console.log(formData);
    API.post(formData,"usuarios/guardar").then(
        data=>{
            //console.log(data.msg);
            if (data.success){
                cancelarUsuarios();
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

function limpiarForm(op) {
    formUsuario.reset();
    document.querySelector("#id_user").value="0";
}

function aplicarFiltro(element) {
    element.preventDefault();
    objDatos.filter = this.value;
    crearTabla();
}

function agregarUsuarios() {
    ContenidoTabla.classList.add("d-none");
    SearchNavbar.classList.add("d-none");
    formContent.classList.remove("d-none");
    limpiarForm();
}

function cancelarUsuarios() {
    ContenidoTabla.classList.remove("d-none");
    SearchNavbar.classList.remove("d-none");
    formContent.classList.add("d-none");
    cargarDatos();
}

function editarUsuario(id) {
    limpiarForm(1);
    ContenidoTabla.classList.add("d-none");
    SearchNavbar.classList.add("d-none");
    formContent.classList.remove("d-none");
    API.get("usuarios/getOneUsuario?id=" + id)
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
    const {id_user, nombre, usuario, password, tipo}=record;
    document.querySelector("#id_user").value=id_user;
    document.querySelector("#nombre").value=nombre;
    document.querySelector("#usuario").value=usuario;
    document.querySelector("#password").value=password;
    document.querySelector("#tipo").value=tipo;
}

function eliminarUsuario(id) {
    Swal.fire({
      title: "¿Ésta seguro de eliminar el registro?",
      showDenyButton: true,
      confirmButtonText: "Si",
      denyButtonText: "No",
    }).then((resultado) => {
      console.log(resultado.isConfirmed);
      if (resultado.isConfirmed) {
        API.get("usuarios/eliminarUsuario?id=" + id)
          .then((data) => {
            if (data.success) {
              cancelarUsuarios();
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