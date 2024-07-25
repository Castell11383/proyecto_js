const btnGuardar = document.getElementById('btnGuardar')
const btnModificar = document.getElementById('btnModificar')
const btnBuscar = document.getElementById('btnBuscar')
const btnCancelar = document.getElementById('btnCancelar')
const btnLimpiar = document.getElementById('btnLimpiar')
const tablaProgramador = document.getElementById('tablaProgramadores')
const formulario = document.querySelector('form')

btnModificar.parentElement.style.display = 'none'
btnCancelar.parentElement.style.display = 'none'


const getProgramador = async (alerta='si') => {
    const nombre = formulario.progra_nombre.value
    const apellido = formulario.progra_apellido.value
    const edad = formulario.progra_edad.value
    const correo = formulario.progra_correo.value
    const direccion = formulario.progra_direccion.value
    const telefono = formulario.progra_telefono.value
    const dependencia = formulario.progra_dependencia.value
    const genero = formulario.progra_genero.value
    const url = `/proyecto_js/controllers/programador/index.php?progra_nombre=${nombre}&progra_apellido=${apellido}&progra_edad=${edad}&progra_correo=${correo}$progra_direccion=${direccion}&progra_telefono=${telefono}&progra_dependencia=${dependencia}&progra_genero=${genero}`
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        console.log(respuesta)
        const data = await respuesta.json();

        // console.log(data)

        tablaProgramador.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment()
        let contador = 1;
        console.log(data);
        if (respuesta.status == 200) {
            if(alerta == 'si'){
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: 'Programadores encontrados',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }

            if (data.length > 0) {
                data.forEach(programador => {
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
                    celda2.innerText = programador.progra_nombre;
                    celda3.innerText = programador.progra_apellido;
                    celda4.innerText = programador.progra_Dependencia;


                    buttonModificar.textContent = 'Modificar'
                    buttonModificar.classList.add('btn', 'btn-success', 'w-100')
                    buttonModificar.innerHTML = '<i class="bi bi-back"></i> Modificar'
                    buttonModificar.addEventListener('click', () => llenarDatos(programador))

                    buttonEliminar.textContent = 'Eliminar'
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100')
                    buttonEliminar.innerHTML = '<i class="bi bi-person-x-fill"></i> Eliminar'
                    buttonEliminar.addEventListener('click', () => EliminarProgramadores(programador.progra_id))

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
                td.innerText = 'No hay Programadores disponibles'
                td.classList.add('text-center')
                td.colSpan = 6;

                tr.appendChild(td)
                fragment.appendChild(tr)
            }
        } else {
            // console.log('hola');
        }

        tablaProgramador.tBodies[0].appendChild(fragment)
    } catch (error) {
        // console.log(error);
    }
}

const llenarDatos = (programador) => {

    // console.log(programador)

    formulario.progra_id.value = programador.progra_id
    formulario.progra_nombre.value = programador.progra_nombre
    formulario.progra_apellido.value = programador.progra_apellido
    formulario.progra_edad.value = programador.progra_edad
    formulario.progra_correo.value = programador.progra_correo
    formulario.progra_direccion.value = programador.progra_direccion
    formulario.progra_telefono.value = programador.progra_telefono
    formulario.progra_dependencia.value = programador.progra_dependencia
    formulario.progra_genero.value = programador.progra_genero

    btnModificar.parentElement.style.display = ''
    btnCancelar.parentElement.style.display = ''
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.parentElement.style.display = 'none'
    btnLimpiar.parentElement.style.display = 'none'

}

//GUARDAR

const guardarProgramadores = async (e) => {
    e.preventDefault()
    btnGuardar.disabled = true

    const url = '/proyecto_js/controllers/programador/index.php'
    const formData = new FormData(formulario)
    console.log(formData);
    formData.append('tipo', 1)
    formData.delete('progra_id')

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
            timer: 2000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer
                toast.onmouseleave = Swal.resumeTimer
            }
        }).fire()
        alert(mensaje)
        if (codigo == 1 && respuesta.status == 200) {
            formulario.reset()
            getProgramador(alerta='no');
        } else {
            console.log(detalle)
        }

    } catch (error) {
        console.log(error)
    }
    btnGuardar.disabled = false
}

const ModificarProgramadores = async (e) => {
    e.preventDefault()
    btnModificar.disabled = true

    const url = '/proyecto_js/controllers/programador/index.php'
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
            timer: 2000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer
                toast.onmouseleave = Swal.resumeTimer
            }
        }).fire()
        alert(mensaje)
        if (codigo == 2 && respuesta.status == 200) {
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

const cancelar = () => {
    formulario.reset()
    getProgramador();
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.parentElement.style.display = 'none'
    btnGuardar.parentElement.style.display = ''
    btnBuscar.parentElement.style.display = ''
    btnLimpiar.parentElement.style.display = ''
}

 const EliminarProgramadores = async (programador) => {

    console.log(programador)

    const url = '/proyecto_js/controllers/programador/index.php'
    const formData = new FormData(formulario)
    // console.log(formulario);
    formData.append('tipo', 3)
    formData.append('programador_id', programador)
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
            timer: 2000,
            timerProgressBar: true,
            icon: "success",
            title: mensaje,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer
                toast.onmouseleave = Swal.resumeTimer
            }
        }).fire()
        alert(mensaje)
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

getProgramador();


formulario.addEventListener('submit', guardarProgramadores)
btnModificar.addEventListener('click', ModificarProgramadores)
btnBuscar.addEventListener('click',() => { getProgramador(alerta='si') } )
btnCancelar.addEventListener('click', cancelar)