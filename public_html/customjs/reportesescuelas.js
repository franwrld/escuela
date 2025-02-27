//Variables y selectores
const btnViewReport=document.querySelector("#btnViewReport");
const id_school=document.querySelector("#id_school");
const frameReporte=document.querySelector("#framereporte");
const API=new Apix();

//Eventos

eventListener();

document.addEventListener("DOMContentLoaded", function() {
    // Inicializa el select como un searchbox usando Select2
    $('#id_school').select2({
        placeholder: "Seleccione una escuela...",
        allowClear: true,
        width: 'resolve'  // Se ajusta al ancho del contenedor
    });

    cargarDatos();  // Tu función para cargar las escuelas desde la API
});

function eventListener(){
    document.addEventListener("DOMContentLoaded", cargarDatos);
    btnViewReport.addEventListener("click", verReporte);
    

}

function cargarDatos(){
    API.get("escuelas/getAll").then(data => {
        if(data.success) {
            id_school.innerHTML = "";
            const optionTodos = document.createElement("option");
            optionTodos.value = "0";
            optionTodos.textContent = "Todos";
            id_school.append(optionTodos);

            data.records.forEach(item => {
                const option = document.createElement("option");
                option.value = item.id_school;
                // Suponiendo que en el registro se incluya el nombre de la escuela, por ejemplo, en item.nombre:
                option.textContent = item.nombre;
                id_school.append(option);
            });
        }
        // Si usas Select2, es posible que necesites refrescarlo:
        $('#id_school').trigger('change');
    }).catch(error => {
        console.error("Error:", error);
    });
}


function verReporte() {
    const selectedSchoolId = id_school.value;
    frameReporte.src = `${BASE_API}reportesescuelas/getReporte?id_school=${selectedSchoolId}`;
}

