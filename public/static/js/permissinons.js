//Variables Modilo Dashboard
var dashboard = document.getElementById('dashboard');
var dashboard_small_stats = document.getElementById('dashboard_small_stats');
var dashboard_sell_today = document.getElementById('dashboard_sell_today');

//Variables Modilo Productos
var products = document.getElementById('products');
var product_search = document.getElementById('product_search');
var product_add = document.getElementById('product_add');
var product_edit = document.getElementById('product_edit');
var product_delete = document.getElementById('product_delete');
var product_restore = document.getElementById('product_restore');
var product_galery_add = document.getElementById('product_galery_add');
var product_galery_delete = document.getElementById('product_galery_delete');

$(document).ready(function () {
    permissinons_dashboard_initials();
    permissinons_dashboard_control();

    permissinons_products_initials();
    permissinons_products_control();
})

//Funciones Modilo Dashboard
function permissinons_dashboard_initials() {
    if (dashboard.checked == false) {
        dashboard_small_stats.disabled = true;
        dashboard_sell_today.disabled = true;
    }
}

function permissinons_dashboard_control() {
    dashboard.addEventListener('change', function () {
        if (dashboard.checked == true) {
            dashboard_small_stats.disabled = false;
            dashboard_sell_today.disabled = false;
        }
        else {
            dashboard_small_stats.disabled = true;
            dashboard_small_stats.checked = false;

            dashboard_sell_today.disabled = true;
            dashboard_sell_today.checked = false;
        }
    })
}

//Funciones Modilo Producto
function permissinons_products_initials() {
    if (products.checked == false) {
        product_search.disabled = true;
        product_search.disabled = true;
        product_add.disabled = true;
        product_edit.disabled = true;
        product_delete.disabled = true;
        product_restore.disabled = true;
        product_galery_add.disabled = true;
        product_galery_delete.disabled = true;
    }
}

function permissinons_products_control() {
    products.addEventListener('change', function () {
        if (products.checked == true) {
            product_search.disabled = false;
            product_search.disabled = false;
            product_add.disabled = false;
            product_edit.disabled = false;
            product_delete.disabled = false;
            product_galery_add.disabled = false;
        } else {
            product_search.disabled = true;
            product_search.checked = false;

            product_search.disabled = true;
            product_search.checked = false;

            product_add.disabled = true;
            product_add.checked = false;

            product_edit.disabled = true;
            product_edit.checked = false;

            product_delete.disabled = true;
            product_delete.checked = false;

            product_galery_add.disabled = true;
            product_galery_add.checked = false;
        }

        if (product_delete.checked == true) {
            product_restore.disabled = false;
        } else {
            product_restore.disabled = true;
            product_restore.checked = false;
        }

        if (product_galery_add == true) {
            product_galery_delete.disabled = false
        } else {
            product_galery_delete.disabled = true;
            product_galery_delete.checked = false;
        }

    })

    product_delete.addEventListener('change', function () {
        if (product_delete.checked == true) {
            product_restore.disabled = false;
        } else {
            product_restore.disabled = true;
            product_restore.checked = false;
        }
    })

    product_galery_add.addEventListener('change', function () {
        if (product_galery_add.checked == true) {
            product_galery_delete.disabled = false
        } else {
            product_galery_delete.disabled = true;
            product_galery_delete.checked = false;
        }
    })
}
