document.addEventListener('DOMContentLoaded', function () {
    btn_confirm = document.getElementsByClassName('btn-confirm');
    for (i = 0; i < btn_confirm.length; i++) {
        btn_confirm[i].addEventListener('click', confirm_object);
    }
})


function confirm_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var path = this.getAttribute('data-path');
    var action = this.getAttribute('data-action');
    var url = base + '/' + path + '/' + object + '/' + action
    var title, text, icon, text_buton;
    if (action == 'delete') {
        title = "¿Quiere Eliminar Este Elemento?"
        text = "Recuerda que esta Acción Eliminara la Categoria";
        icon = "warning";
        text_buton = "Si, Eliminar";
    }

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: text_buton
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
        else {
            Swal.fire("Has Canselado La Acción!")
        }
    })
}
