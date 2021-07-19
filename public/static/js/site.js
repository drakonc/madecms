var base = location.protocol + '//' + location.host;
var router = document.getElementsByName('routeName')[0].getAttribute('content')
var slider = new MDSlider;

function LinkInputFileOpen(link_img, button_img, frm_img) {
    var lnk_img = document.getElementById(link_img);
    var btn_img = document.getElementById(button_img);
    var avatar_change_overlay = document.getElementById('avatar_change_overlay')
    lnk_img.addEventListener('click', function () {
        btn_img.click();
    }, false);
    btn_img.addEventListener('change', function () {
        var load_img = '<img src="' + base + '/static/images/loader.svg" />'
        avatar_change_overlay.innerHTML = load_img;
        avatar_change_overlay.style.display = 'flex';
        document.getElementById(frm_img).submit()
    }, false)
}

document.addEventListener('DOMContentLoaded', function () {
    if (router == 'account_edit') {
        LinkInputFileOpen('lnk_avatar_edit', 'input_file_avatar', 'form_avatar_edit')
    }
    slider.show();
})
