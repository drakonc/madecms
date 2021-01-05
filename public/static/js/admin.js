var base = location.protocol + '//' + location.host;

/*
    -> Obtener mediante etiqueta meta la ruta donde estamos en este caso las de productos
*/
var router = document.getElementsByName('routeName')[0].getAttribute('content')

/*
    -> Cuando Escucha un evento
    -> Para El SideBar Opción Activa, Agregar Clase CSS a las etiquetas
*/
document.addEventListener('DOMContentLoaded', function () {
    document.getElementsByClassName('lk-' + router)[0].classList.add('active');
});

/*
    -> Cuando Lee El Documento
    -> Mensaje al colocar mause en lo iconos
*/
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
