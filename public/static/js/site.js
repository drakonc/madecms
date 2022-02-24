const base = location.protocol + '//' + location.host;
const router = document.getElementsByName('routeName')[0].getAttribute('content')
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content')
const currency = document.getElementsByName('currency')[0].getAttribute('content')
var page = 1;
var page_section = ""


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
    
    var slider = new MDSlider;
    var load_more_products = document.getElementById('load_more_products');
    
    if (router == 'account_edit') {
        LinkInputFileOpen('lnk_avatar_edit', 'input_file_avatar', 'form_avatar_edit')
    }
    if(load_more_products){
        load_more_products.addEventListener('click', function (e) {
            e.preventDefault();
            load_products(page_section);
        })
    }
    
    
    slider.show();
    if (router == 'home') {
        load_products('home');
    }
});

function load_products(section){
    page_section = section;
    var products_list = document.getElementById('products_list');
    var url = `${base}/api/md/load/products/${page_section}?page=${page}`;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            page = page + 1;
            var result = JSON.parse(this.responseText);

            if (result.data.length == 0) {
                load_more_products.style.display = 'none';
            }
            
            result.data.forEach(function (product, index) {
                var div = `<div class="product">
                            <div class="image">
                                <div class="overlay">
                                    <div class="btns">
                                        <a href="${base}/product/${product.id}/${product.slug}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver"><i class="fas fa-eye"></i></a>
                                        <a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Añadir"><i class="fas fa-cart-plus"></i></a>
                                        <a href="#" onclick="add_to_favorites(${product.id}, '1');  return false" data-bs-toggle="tooltip" data-bs-placement="top" title="Me Gusta"><i class="fas fa-heart"></i></a>
                                    </div>
                                </div>
                                <img src="${base}/uploads/${product.file_path}/t_${product.image}" />
                            </div>
                            <a href="${base}/product/${product.id}/${product.slug}">
                                <div class="title">${product.name}</div>
                                <div class="price">${currency}${product.price}</div>
                                <div class="options"></div>
                            </a>
                        </div>`;
                products_list.innerHTML += div;
            })
        }
    }

}

function add_to_favorites(object_id, module){
    url = `${base}/api/md/favorites/add/${object_id}/${module}`;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
        }
    }
}
