//Variables y selectores
const btnViewReport=document.querySelector("#btnViewReport");
const id_school=document.querySelector("#id_school");
const frameReporte=document.querySelector("#framereporte");
const API=new Apix();

//Eventos

eventListener();

document.addEventListener("DOMContentLoaded", function() {
    $('#id_school').select2({
        placeholder: "Seleccione una escuela...",
        allowClear: true,
        width: 'resolve'
    });

    cargarDatos();
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
            optionTodos.textContent = "Selecciona una escuela";
            id_school.append(optionTodos);

            data.records.forEach(item => {
                const option = document.createElement("option");
                option.value = item.id_school;
                option.textContent = item.nombre;
                id_school.append(option);
            });
        }
        $('#id_school').trigger('change');
    }).catch(error => {
        console.error("Error:", error);
    });
}


function verReporte() {
    const selectedSchoolId = document.querySelector("#id_school").value;
    document.querySelector("#framereporte").src = `${BASE_API}reportesalumnos/getReporte?id_school=${selectedSchoolId}`;
}

document.querySelector("#btnViewReport").addEventListener("click", verReporte);

