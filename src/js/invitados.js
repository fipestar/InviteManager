(function() {
    //Boton para mostrar el modal de agreagr invitado
    obtenerInvitados();
    let invitados = [];
    let filtradas = [];


    const nuevoInvitadoBtn = document.querySelector('#agregar-invitados');
    nuevoInvitadoBtn.addEventListener('click', function(){
        mostrarFormulario(false);
    });

    //Filtros de busqueda
    const filtros = document.querySelectorAll('#filtros input[type="radio"]');
    filtros.forEach( radio => {
        radio.addEventListener('input', filtrarInvitados);
    })

    function filtrarInvitados(e){
        const filtro = e.target.value;
       
        if(filtro !== ''){
            filtradas = invitados.filter(invitado => invitado.asistencia === filtro);
        } else {
            filtradas = [];
        }
        mostrarInvitados();
    }

    function totalPendientes(){
        const totalPendientes = invitados.filter(invitado => invitado.asistencia === '0');
        const pendientesRadio = document.querySelector('#inasisten');

        if(totalPendientes.length === 0){
            pendientesRadio.disabled = true;
        }else {
            pendientesRadio.disabled = false;
        }
    }

    function totalAsisten(){
        const totalAsisten = invitados.filter(invitado => invitado.asistencia === '1');
        const asistenRadio = document.querySelector('#asisten');

        if(totalAsisten.length === 0){
            asistenRadio.disabled = true;
        }else {
            asistenRadio.disabled = false;
        }
    }


    function mostrarInvitados() {
        limpiarInvitados();

        const arrayInvitados = filtradas.length ? filtradas : invitados;
        if(arrayInvitados.length === 0) {
            const contenedorInvitados = document.querySelector('#listado-invitados');

            const textoNoInvitados = document.createElement('LI');
            textoNoInvitados.textContent = 'No hay invitados aún';
            textoNoInvitados.classList.add('no-invitados');

            contenedorInvitados.appendChild(textoNoInvitados);
            return;
        }

        const asistencia = {
            0: 'Pendiente',
            1: 'Confirmado',
        }

        arrayInvitados.forEach(invitado => {
            const contenedorInvitado = document.createElement('LI');
            contenedorInvitado.dataset.invitadoId = invitado.id;
            contenedorInvitado.classList.add('invitado');

            const nombreInvitado = document.createElement('P');
            nombreInvitado.textContent = invitado.nombre;
            nombreInvitado.ondblclick = function(){
                mostrarFormulario(editar = true, {...invitado});
            }

            const opcionesDiv = document.createElement('DIV');
            opcionesDiv.classList.add('opciones');

            //Botones
            const btnAsistenciaInvitado = document.createElement('BUTTON');
            btnAsistenciaInvitado.classList.add('asistencia-invitado');
            btnAsistenciaInvitado.classList.add(`${asistencia[invitado.asistencia].toLowerCase()}`);
            btnAsistenciaInvitado.textContent = asistencia[invitado.asistencia];
            btnAsistenciaInvitado.dataset.asistenciaInvitado = invitado.asistencia;
            btnAsistenciaInvitado.ondblclick = function(){
                cambiarAsistenciaInvitado({...invitado});
            }

            const btnEliminarInvitado = document.createElement('BUTTON');
            btnEliminarInvitado.classList.add('eliminar-invitado');
            btnEliminarInvitado.dataset.eliminarInvitado = invitado.id;
            btnEliminarInvitado.textContent = 'Eliminar';
            btnEliminarInvitado.ondblclick = function(){
                confirmarEliminarInvitado({...invitado});
            }
            
            
            opcionesDiv.appendChild(btnAsistenciaInvitado);
            opcionesDiv.appendChild(btnEliminarInvitado);

            contenedorInvitado.appendChild(nombreInvitado);
            contenedorInvitado.appendChild(opcionesDiv);

            const listadoInvitados = document.querySelector('#listado-invitados');
            listadoInvitados.appendChild(contenedorInvitado);
        })
    }

    function mostrarFormulario(editar = false, invitado = {}){
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        <form class="formulario nuevo-invitado">
          <legend>${editar ? 'Editar Invitado' : 'Añade un nuevo invitado'}</legend>
          <div class="campo">
            <label>Invitado</label>
             <input
                type="text"
                name="invitado"
                placeholder="${invitado.nombre ? 'Editar Nombre del invitado' : 'Añadir Nombre del invitado'}"
                id="invitado"
                value="${invitado.nombre ? invitado.nombre : ''}"
            />
          </div>
          <div class="opciones">
                    <input 
                        type="submit" 
                        class="submit-nuevo-invitado" 
                        value="${invitado.nombre ? 'Guardar Cambios' : 'Añadir Invitado '}" 
                    />
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>      
        </form>  
        `;
        
        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 0);
        document.querySelector('body').appendChild(modal);

        modal.addEventListener('click', function(e){
            e.preventDefault();

            if(e.target.classList.contains('cerrar-modal') || e.target.classList.contains('modal')) {
               const formulario = document.querySelector('.formulario');
               formulario.classList.add('cerrar');
                setTimeout(() => {
                     modal.remove();
                }, 500);
            }
            if(e.target.classList.contains('submit-nuevo-invitado')){
                const nombreInvitado = document.querySelector('#invitado').value.trim();

                if(nombreInvitado === ''){
                //Mostrar una alerta de error
                mostrarAlerta('El nombre del invitado es obligatorio', 'error', document.querySelector('.formulario legend'));
                return;
                }

                if(editar){
                    invitado.nombre = nombreInvitado;
                    actualizarInvitado(invitado);
                } else {
                    agregarInvitado(nombreInvitado);
                }
            }
        })
        document.querySelector('body').appendChild(modal);    
    }

    function mostrarAlerta(mensaje, tipo, referencia){
        //Prevenir la creacion de multiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if(alertaPrevia){
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        //Insertar la alerta antes del legend
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);
        //Eliminar la alerta despues de 3 segundos
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

    function obtenerEvento(){
        const eventoParams = new URLSearchParams(window.location.search);
        const evento = Object.fromEntries(eventoParams.entries());
        return evento.id;
    }

    async function agregarInvitado(invitado) {
        //Construir la peticion
        const datos = new FormData();
        datos.append('nombre', invitado);
        datos.append('eventoId', obtenerEvento());

        try {
            const url = 'http://localhost:3000/api/invitado';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));

            if(resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 3000);

                //Agregar el objeto de invitado al global de invitados
                const invitadoObj = {
                    id: String(resultado.id),
                    nombre:invitado,
                    asistencia: "0",
                    eventoId: resultado.eventoId
                }
                invitados = [...invitados, invitadoObj];
                mostrarInvitados();
            }
        } catch (error){
            console.log(error);
        }
    }

    async function obtenerInvitados() {
        try {
            const id = obtenerEvento();
            const url = `/api/invitados?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            invitados = resultado.invitados;
            mostrarInvitados();

            
        } catch (error) {
            console.log(error);
        }
    }

    

    function cambiarAsistenciaInvitado(invitado){
        const nuevaAsistencia = invitado.asistencia === "1" ? "0" : "1";
        invitado.asistencia = nuevaAsistencia;
        actualizarInvitado(invitado);
    }
    async function actualizarInvitado(invitado) {
        const {asistencia, id, nombre, eventoId} = invitado;

        const datos = new FormData();
        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('asistencia', asistencia);
        datos.append('eventoId', obtenerEvento());

        try {
            const url = 'http://localhost:3000/api/invitado/actualizar';

            const respuesta = await fetch(url, {
                method: 'POST',
                body:datos
            });
            const resultado = await respuesta.json();

            if(resultado.respuesta.tipo === 'exito'){
                Swal.fire(
                    resultado.respuesta.mensaje,
                    resultado.respuesta.mensaje,
                    'success'
                );
                const modal = document.querySelector('.modal');
                if(modal) {
                    modal.remove();
                }
            }

            invitados = invitados.map(invitadoMemoria => {
                if(invitadoMemoria.id === id) {
                    invitadoMemoria.asistencia = asistencia;
                    invitadoMemoria.nombre = nombre;
                }
                return invitadoMemoria;
            });
            mostrarInvitados();
        } catch (error) {
            console.log(error);
        }
    }

    function limpiarInvitados(){
        const listadoInvitados = document.querySelector('#listado-invitados');
        while(listadoInvitados.firstChild) {
            listadoInvitados.removeChild(listadoInvitados.firstChild);
        }
    }

    function confirmarEliminarInvitado(invitado){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás deshacer esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'

            
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarInvitado(invitado);
            }
        });
    }

    async function eliminarInvitado(invitado) {

        const {asistencia, id, nombre, eventoId} = invitado;
        const datos = new FormData();

        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('asistencia', asistencia);
        datos.append('eventoId', obtenerEvento());

        try {
            const url = 'http://localhost:3000/api/invitado/eliminar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();
            if(resultado.resultado){
                Swal.fire('Eliminado', resultado.mensaje, 'success');
            }

            invitados = invitados.filter( invitadoMemoria => invitadoMemoria.id !== invitado.id);
            mostrarInvitados();
        } catch (error) {
            
        }
    }
})();