const btnGuardar = document.getElementById('btnGuardar')
const btnModificar = document.getElementById('btnModificar')
const btnBuscar = document.getElementById('btnBuscar')
const btnCancelar = document.getElementById('btnCancelar')
const btnLimpiar = document.getElementById('btnLimpiar')
const tablaTarea = document.getElementById('tablaTarea')
const formulario = document.querySelector('form')

btnModificar.parentElement.style.display = 'none'
btnCancelar.parentElement.style.display = 'none'


const getTarea = async (alerta='si') => {
    const programador = formulario.tarea_programador.value
    const aplicacion = formulario.tarea_aplicacion.value
    const descripcion = formulario.tarea_descripcion.value
    const url = `/proyecto_js/controllers/tarea/index.php?tarea_programador=${programador}&tarea_aplicacion=${aplicacion}&tarea_descripcion=${descripcion}`
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        // console.log(respuesta)
        const data = await respuesta.json();
        // console.log(data)
        tablaTarea.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment()
        let contador = 1;
        // console.log(data);
        if (respuesta.status == 200) {
            if(alerta == 'si'){
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: 'Tareas encontrados',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }

            if (data.length > 0) {
                data.forEach(tarea => {
                    const tr = document.createElement('tr')
                    const celda1 = document.createElement('td')
                    const celda2 = document.createElement('td')
                    const celda3 = document.createElement('td')
                    const celda4 = document.createElement('td')
                    const celda5 = document.createElement('td')
                    const celda6 = document.createElement('td')
                    const buttonModificar = document.createElement('button')
                    const buttonEliminar = document.createElement('button')

                    celda1.innerText = contador;
                    celda2.innerText = tarea.tarea_programador;
                    celda3.innerText = tarea.tarea_aplicacion;
                    celda4.innerText = tarea.tarea_descripcion;


                    buttonModificar.textContent = 'Modificar'
                    buttonModificar.classList.add('btn', 'btn-secondary', 'w-100')
                    buttonModificar.innerHTML = '<i class="bi bi-back"></i>'
                    buttonModificar.addEventListener('click', () => llenarDatos(tarea))

                    buttonEliminar.textContent = 'Eliminar'
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100')
                    buttonEliminar.innerHTML = '<i class="bi bi-person-x-fill"></i>'
                    buttonEliminar.addEventListener('click', () => EliminarTareas(tarea.tarea_id))

                    celda5.appendChild(buttonModificar)
                    celda6.appendChild(buttonEliminar)

                    tr.appendChild(celda1)
                    tr.appendChild(celda2)
                    tr.appendChild(celda3)
                    tr.appendChild(celda4)
                    tr.appendChild(celda5)
                    tr.appendChild(celda6)
                    fragment.appendChild(tr);

                    contador++
                });

            } else {
                const tr = document.createElement('tr')
                const td = document.createElement('td')
                td.innerText = 'No hay Tareas disponibles'
                td.classList.add('text-center')
                td.colSpan = 6;

                tr.appendChild(td)
                fragment.appendChild(tr)
            }
        } else {
            // console.log('hola');
        }

        tablaTarea.tBodies[0].appendChild(fragment)
    } catch (error) {
        // console.log(error);
    }
}

//GUARDAR

const guardarTareas = async (e) => {
    e.preventDefault()
    btnGuardar.disabled = true

    const url = '/proyecto_js/controllers/tarea/index.php'
    const formData = new FormData(formulario)
    // console.log(formData);
    formData.append('tipo', 1)
    formData.delete('tarea_id')

    const config = {
        method: 'POST',
        body: formData
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json()
        const {mensaje, codigo, detalle } = data
        // console.log(data)

        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer
                toast.onmouseleave = Swal.resumeTimer
            }
        }).fire()
        if (codigo == 1 && respuesta.status == 200) {
            formulario.reset()
            getTarea(alerta='no');
        } else {
            console.log(detalle)
        }

    } catch (error) {
        console.log(error)
    }
    btnGuardar.disabled = false
}


const llenarDatos = (tarea) => {

    console.log(tarea)

    formulario.tarea_id.value = tarea.tarea_id
    formulario.tarea_programador.value = tarea.tarea_programador
    formulario.tarea_aplicacion.value = tarea.tarea_aplicacion
    formulario.tarea_descripcion.value = tarea.tarea_descripcion

    btnModificar.parentElement.style.display = ''
    btnCancelar.parentElement.style.display = ''
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.parentElement.style.display = 'none'
    btnLimpiar.parentElement.style.display = 'none'

}

//MODIFICAR

const ModificarTareas = async (e) => {
    e.preventDefault()
    btnModificar.disabled = true

    const url = '/proyecto_js/controllers/tarea/index.php'
    const formData = new FormData(formulario)
    // console.log(formulario);
    formData.append('tipo', 2)
    const config = {
        method: 'POST',
        body: formData
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json()
        const { mensaje, codigo, detalle } = data
        console.log(data)
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer
                toast.onmouseleave = Swal.resumeTimer
            }
        }).fire()
        
        if (codigo == 2 && respuesta.status == 200) {
            formulario.reset()
            getTarea(alerta='no');
            btnModificar.parentElement.style.display = 'none'
            btnCancelar.parentElement.style.display = 'none'
            btnGuardar.parentElement.style.display = ''
            btnBuscar.parentElement.style.display = ''
            btnLimpiar.parentElement.style.display = ''
        } else {
            console.log(detalle)
        }

    } catch (error) {
        console.log(error)
    }
    btnModificar.disabled = false
}

const cancelar = () => {
    formulario.reset()
    getTarea();
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.parentElement.style.display = 'none'
    btnGuardar.parentElement.style.display = ''
    btnBuscar.parentElement.style.display = ''
    btnLimpiar.parentElement.style.display = ''
}

//ELIMINAR

const EliminarTareas = async (tarea) => {

    console.log(tarea)

    const url = '/proyecto_js/controllers/tarea/index.php'
    const formData = new FormData(formulario)
    // console.log(formulario);
    formData.append('tipo', 3)
    formData.append('tarea_id', tarea)
    const config = {
        method: 'POST',
        body: formData
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json()
        const { mensaje, codigo, detalle } = data
        // console.log(data)
        Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer
                toast.onmouseleave = Swal.resumeTimer
            }
        }).fire()
        if (codigo == 3 && respuesta.status == 200) {
            formulario.reset()
            getProgramador(alerta='no');
            btnModificar.parentElement.style.display = 'none'
            btnCancelar.parentElement.style.display = 'none'
            btnGuardar.parentElement.style.display = ''
            btnBuscar.parentElement.style.display = ''
            btnLimpiar.parentElement.style.display = ''
        } else {
            console.log(detalle)
        }

    } catch (error) {
        console.log(error)
    }
    btnModificar.disabled = false
}

getTarea();


formulario.addEventListener('submit', guardarTareas)
btnModificar.addEventListener('click', ModificarTareas)
btnBuscar.addEventListener('click',() => { getTarea(alerta='si') } )
btnCancelar.addEventListener('click', cancelar)