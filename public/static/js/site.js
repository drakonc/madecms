const base = location.protocol + '//' + location.host;
const router = document.getElementsByName('routeName')[0].getAttribute('content')
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content')

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
    if (router == 'home') {
     load_products('home');
    }
});

function load_products(section){
    var url = `${base}/md/api/load/products/${section}`;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            console.log(result.data);
        }else {
            // Mensaje de error
        }
    }

}
