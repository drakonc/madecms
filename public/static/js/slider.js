/*
    -> Cuando Lee El Documento
    -> Se Ejecutan Las Funciones Creadas cuando se ejecutan los eventos particulares de cada etiqueta
*/
$(document).ready(function () {
    if (router == "sliders_list")
        editor_init('content');
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