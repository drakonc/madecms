/*
    -> Cuando Escucha un evento
    -> Para usar una etiqueta a para abrir Input Tipo FIle y Mandar a su Ves el formulario.
    -> Funcionalidad Galeria en Formulario Editar Productos
*/
document.addEventListener('DOMContentLoaded', function () {
    var btn_search = document.getElementById('btn_search')
    if (btn_search) {
        btn_search.addEventListener('click', function (e) {
            var form_search = document.getElementById('form_search')
            var sbfilter = document.getElementById('sbfilter')
            e.preventDefault();
            if (form_search.style.display === 'block') {
                form_search.style.display = 'none';
                sbfilter.style.display = 'inline-block';
            } else {
                form_search.style.display = 'block';
                sbfilter.style.display = 'none'
            }
        });
    }
    // Volver enlace un Input File
    if (router == "product_edit") {
        var btn_product_file_image = document.getElementById('btn_product_file_image');
        var product_file_image = document.getElementById('product_file_image');
        btn_product_file_image.addEventListener('click', function () {
            product_file_image.click();
        }, false);
        product_file_image.addEventListener('change', function () {
            document.getElementById('form_product_gallery').submit()
        }, false)
    }

    btn_confirm = document.getElementsByClassName('btn-confirm');
    for (i = 0; i < btn_confirm.length; i++) {
        btn_confirm[i].addEventListener('click', confirm_object);
    }
});

/*
    -> Cuando Lee El Documento
    -> Se Ejecutan Las Funciones Creadas cuando se ejecutan los eventos particulares de cada etiqueta
*/
$(document).ready(function () {
    //SecondSelectProduct('#indiscount', '#status');
    if (router == "product_edit" || router == "product_add")
        editor_init('content');
    PrevisualizarImagen("#customFile", "#img");

})

function confirm_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var path = this.getAttribute('data-path');
    var action = this.getAttribute('data-action');
    var url = base + '/' + path + '/' + object + '/' + action
    var title, text, icon;
    if (action == 'delete') {
        title = "¿Quiere Eliminar Este Elemento?"
        text = "Recuerda que esta Acción Enviara el Producto a la Papelera";
        icon = "warning";
    }
    if (action == "restore") {
        title = "¿Quiere Restaurara este Elemento?"
        text = "Recuerda que esta Acción Sacara el Elemento de la Papelera";
        icon = "info";
    }

    swal({ title: title, text: text, icon: icon, buttons: true, dangerMode: true })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
            }
            else {
                swal("Has Canselado La Acción!");
            }
        });
}

/*
    -> Visualizar imagen al momento de seleccionar antes de gusrdar
*/
function PrevisualizarImagen(input, preview) {
    $(input).change(function (e) {
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = function () {
            $(preview).attr('src', reader.result);
        };
    });
}

/*
    -> Colocar Editor de Testo en Text Area
*/
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

/*LLenar un segundo Select dependiendo de lo que se escoja en el padre*/
function SecondSelectProduct(padre, hijo) {
    $(padre).on('change', function (e) {
        let Nombre = $('#name').val()
        let select = 3;
        console.log('Nombre: ' + Nombre)
        console.log(e.target.value);
        $(hijo).empty();
        $(hijo).append('<option value="0" disable="true" ">Seleccione una Opción</option>')
        axios
            .get('/admin/product/category')
            .then(data => {
                let category = data.data;
                for (let index = 0; index < category.length; index++) {
                    $(hijo).append('<option value=' + category[index].id + '> ' + category[index].name + ' </option>')
                }

                if (e.target.value == 1)
                    $(hijo).val(select);
            })
    })
}
