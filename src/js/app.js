const mobileMenuBtn = document.querySelector('#mobile-menu');
const sidebar = document.querySelector('.sidebar');
const cerrarMenuBtn = document.querySelector('#cerrar-menu');
const anchoPantalla = document.body.clientWidth;

window.addEventListener('resize', function(){
    const anchoPantalla = document.body.clientWidth;
    if(anchoPantalla >= 768) {
        sidebar.classList.remove('mostrar');
    }
})

if(mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', () => {
        sidebar.classList.add('mostrar');
    })
}

if(cerrarMenuBtn) {
    cerrarMenuBtn.addEventListener('click', () => {
        sidebar.classList.add('ocultar');
        setTimeout(() => {
            sidebar.classList.remove('mostrar');
            sidebar.classList.remove('ocultar');
        }, 500);
    })
}

// Detalles del evento
const mostrarDetallesBtn = document.querySelector('#mostrar-detalles-evento');
if(mostrarDetallesBtn) {
    mostrarDetallesBtn.addEventListener('click', () => {
        const contenedorDetalles = document.querySelector('#contenedor-detalles');
        contenedorDetalles.classList.toggle('mostrando');

        if(contenedorDetalles.classList.contains('mostrando')) {
            mostrarDetallesBtn.textContent = 'Ocultar Detalles del Evento';
        } else {
            mostrarDetallesBtn.textContent = 'Mostrar Detalles del Evento';
        }
    });
}