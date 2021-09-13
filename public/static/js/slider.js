$(document).ready(function () {
    /*if (router == "sliders_list")
        editor_init('content');*/
})

document.addEventListener('DOMContentLoaded', function () {
    btn_confirm = document.getElementsByClassName('btn-confirm');
    for (i = 0; i < btn_confirm.length; i++) {
        btn_confirm[i].addEventListener('click', confirm_object);
    }
})

function editor_init(field) {
    CKEDITOR.replace(field, {
        cloudServices_tokenUrl: 'http://micms.com/cs-token-endpoint',
        cloudServices_uploadUrl: 'http://micms.com/easyimage/upload/',
        toolbar: [
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote'] },
            { name: 'document', items: ['CodeSnippet', 'EmojiPanel', 'PreView', 'Source'] }
        ]
    });
}

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