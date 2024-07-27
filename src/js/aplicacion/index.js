const btnGuardar = document.getElementById('btnGuardar')
const btnModificar = document.getElementById('btnModificar')
const btnBuscar = document.getElementById('btnBuscar')
const btnCancelar = document.getElementById('btnCancelar')
const btnLimpiar = document.getElementById('btnLimpiar')
const tablaAplicacion = document.getElementById('tablaAplicacion')
const formulario = document.querySelector('form')

btnModificar.parentElement.style.display = 'none'
btnCancelar.parentElement.style.display = 'none'

const getAplicacion = async (alerta='si') => {
    const nombre = formulario.app_nombre.value
    const cantidad = formulario.app_cantidad.value
    const registro = formulario.app_registro.value
    const tipo = formulario.app_tipo.value
    const entrega = formulario.app_entrega.value
    const dependencia = formulario.app_dependencia.value
    const descripcion = formulario.app_descripcion.value
    const url = `/proyecto_js/controllers/aplicacion/index.php?app_nombre=${nombre}&app_cantidad=${cantidad}&app_registro=${registro}&app_tipo=${tipo}&app_entrega=${entrega}&app_descripcion=${descripcion}&app_dependencia=${dependencia}`
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        // Console.log(respuesta)
        const data = await respuesta.json();

        // console.log(data)

        tablaAplicacion.tBodies[0].innerHTML = ''
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
                    title: 'Aplicaciones encontrados',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }

            if (data.length > 0) {
                data.forEach(aplicacion => {
                    const tr = document.createElement('tr')
                    const celda1 = document.createElement('td')
                    const celda2 = document.createElement('td')
                    const celda3 = document.createElement('td')
                    const celda4 = document.createElement('td')
                    const celda5 = document.createElement('td')
                    const celda6 = document.createElement('td')
                    const celda7 = document.createElement('td')
                    const celda8 = document.createElement('td')
                    const buttonModificar = document.createElement('button')
                    const buttonEliminar = document.createElement('button')

                    celda1.innerText = contador;
                    celda2.innerText = aplicacion.app_nombre;
                    celda3.innerText = aplicacion.app_registro;
                    celda4.innerText = aplicacion.app_tipo;
                    celda5.innerText = aplicacion.app_dependencia;
                    celda6.innerText = aplicacion.app_entrega;


                    buttonModificar.textContent = 'Modificar'
                    buttonModificar.classList.add('btn', 'btn-secondary', 'w-100')
                    buttonModificar.innerHTML = '<i class="bi bi-back"></i>'
                    buttonModificar.addEventListener('click', () => llenarDatos(aplicacion))

                    buttonEliminar.textContent = 'Eliminar'
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100')
                    buttonEliminar.innerHTML = '<i class="bi bi-person-x-fill"></i>'
                    buttonEliminar.addEventListener('click', () => EliminarAplicacion(aplicacion.app_id))

                    celda7.appendChild(buttonModificar)
                    celda8.appendChild(buttonEliminar)

                    tr.appendChild(celda1)
                    tr.appendChild(celda2)
                    tr.appendChild(celda3)
                    tr.appendChild(celda4)
                    tr.appendChild(celda5)
                    tr.appendChild(celda6)
                    tr.appendChild(celda7)
                    tr.appendChild(celda8)
                    fragment.appendChild(tr);

                    contador++
                });

            } else {
                const tr = document.createElement('tr')
                const td = document.createElement('td')
                td.innerText = 'No hay Aplicaciones disponibles'
                td.classList.add('text-center')
                td.colSpan = 6;

                tr.appendChild(td)
                fragment.appendChild(tr)
            }
        } else {
            // console.log('hola');
        }

        tablaAplicacion.tBodies[0].appendChild(fragment)
    } catch (error) {
        // console.log(error);
    }
}

//GUARDAR

const guardarAplicacion = async (e) => {
    e.preventDefault()
    btnGuardar.disabled = true
    const url = '/proyecto_js/controllers/aplicacion/index.php'
    const formData = new FormData(formulario)
    // console.log(formulario.app_entrega.value);
    // console.log(formulario.app_registro.value);
    formData.append('tipo', 1)
    formData.delete('app_id')

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
            getAplicacion(alerta='no');
        } else {
            console.log(detalle)
        }

    } catch (error) {
        console.log(error)
    }
    btnGuardar.disabled = false
}


const llenarDatos = (aplicacion) => {

    console.log(aplicacion)

    formulario.app_id.value = aplicacion.app_id
    formulario.app_nombre.value = aplicacion.app_nombre
    formulario.app_cantidad.value = aplicacion.app_cantidad
    formulario.app_registro.value = aplicacion.app_registro
    formulario.app_tipo.value = aplicacion.app_tipo
    formulario.app_entrega.value = aplicacion.app_entrega
    formulario.app_descripcion.value = aplicacion.app_descripcion
    formulario.app_dependencia.value = aplicacion.app_dependencia

    btnModificar.parentElement.style.display = ''
    btnCancelar.parentElement.style.display = ''
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.parentElement.style.display = 'none'
    btnLimpiar.parentElement.style.display = 'none'

}

//MODIFICAR

const ModificarAplicacion = async (e) => {
    e.preventDefault()
    btnModificar.disabled = true
    const url = '/proyecto_js/controllers/aplicacion/index.php'
    const formData = new FormData(formulario)
    console.log(formulario);
    formData.append('tipo', 2)
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
        
        if (codigo == 2 && respuesta.status == 200) {
            formulario.reset()
            getAplicacion(alerta='no');
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
    getAplicacion();
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.parentElement.style.display = 'none'
    btnGuardar.parentElement.style.display = ''
    btnBuscar.parentElement.style.display = ''
    btnLimpiar.parentElement.style.display = ''
}

//ELIMINAR

const EliminarAplicacion = async (aplicacion) => {

    console.log(aplicacion)

    const url = '/proyecto_js/controllers/aplicacion/index.php'
    const formData = new FormData(formulario)
    // console.log(formulario);
    formData.append('tipo', 3)
    formData.append('app_id', aplicacion)
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
            getAplicacion(alerta='no');
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

getAplicacion();

formulario.addEventListener('submit', guardarAplicacion)
btnModificar.addEventListener('click', ModificarAplicacion)
btnBuscar.addEventListener('click',() => { getAplicacion(alerta='si') } )
btnCancelar.addEventListener('click', cancelar)