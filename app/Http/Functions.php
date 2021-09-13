<?php
// Key Value Fron Json
function kvfj($json, $key){
    if($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json,true);
        if(array_key_exists($key,$json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
}

function getModulesArray(){
    $a =['0' => 'Productos','1' => 'Blog'];
    return $a;
}

function getRoleUserArray($mode,$id){
    $roles =[ '0' => 'Usuario', '1' => 'Administrador'];
    if(!is_null($mode)):
         return $roles;
    else:
        return $roles[$id];
    endif;
}

function getUserStatusArray($mode,$id){
    $status =[ '0' => 'Registrado', '1' => 'Verificado','100' =>'Suspendido'];
    if(!is_null($mode)):
        return $status;
    else:
         return $status[$id];
    endif;
}

function user_permissions(){
    $p = [
        'dashboard' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => 'Modulo de Dashboard',
            'key' => [
                'dashboard' => 'Puede Ver el Dashboard.',
                'dashboard_small_stats' => 'Puede Ver las Estadisticas Rapidas.',
                'dashboard_sell_today' => 'Puede Ver lo Facturado Hoy.'
            ]
        ],
        'categories' => [
            'icon' => '<i class="fas fa-folder-open"></i>',
            'title' => 'Modulo de Categorias',
            'key' => [
                'categories' => 'Puede Ver el Listado de Categorias.',
                'category_add' => 'Puede Agregar Nuevas Categorias.',
                'category_edit' => 'Puede Editar las Categorias.',
                'category_delete' => 'Puede Eliminar las Categorias.'
            ]
        ],
        'products' => [
            'icon' => '<i class="fas fa-boxes"></i>',
            'title' => 'Modulo de Productos',
            'key' => [
                'products' => 'Puede Ver el Listado de Productos.',
                'product_search' => 'Puede Buscar Productos.',
                'product_add' => 'Puede Agregar Nuevos Productos.',
                'product_edit' => 'Puede Editar los Productos.',
                'product_delete' => 'Puede Eliminar los Productos.',
                'product_restore' => 'Puede Restaurar los Productos.',
                'product_galery_add' => 'Puede Agreger Imagenes a la Galeria.',
                'product_galery_delete' => 'Puede Eliminar Imagenes a la Galeria.'
            ]
        ],
        'orders' => [
            'icon' => '<i class="fas fa-clipboard-list"></i>',
            'title' => 'Modulo de Ordenes',
            'key' => [
                'orders' => 'Puede Ver el Listado de Ordenes.'
            ]
        ],
        'users' => [
            'icon' => '<i class="fas fa-user-friends"></i>',
            'title' => 'Modulo de Usuario',
            'key' => [
                'user_list' => 'Puede Ver el Listado de Usuarios.',
                'user_edit' => 'Puede Editar Los Usuarios.',
                'user_permissinons' => 'Puede Dar Permisos a Usuarios.',
                'user_banned' => 'Puede Bannear a los Usuarios.'
            ]
        ],
        'sider' => [
            'icon' => '<i class="fas fa-images"></i>',
            'title' => 'Modulo de Sliders',
            'key' => [
                'sliders_list' => 'Puede Ver La Lista de Los Sliders.',
                'slider_add' => 'Puede Crear Sliders.',
                'slider_edit' => 'Puede Editar Sliders.',
                'slider_delete' => 'Puede Eliminar Sliders.',
            ]
            ],
        'config' => [
            'icon' => '<i class="fas fa-cogs"></i>',
            'title' => 'Modulo de Configuraciones',
            'key' => [
                'settings' => 'Puede Modificar la Configuración.'
            ]
        ]
    ];

    return $p;
}

function getUserYears(){
    $ya = date('Y');
    $ym = $ya - 18;
    $yo = $ym - 62;
    return [$ym,$yo];
}

function getMonths($mode,$key){
    $meses = [
        '1' => 'Enero',
        '2' => 'Febereo',
        '3' => 'Marzo',
        '4' => 'Abril',
        '5' => 'Mayo',
        '6' => 'Junio',
        '7' => 'Julio',
        '8' => 'Agosto',
        '9' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];
    if(!is_null($mode)):
        return $meses;
    else:
         return $meses[$key];
    endif;
}

function getFechaMinMaxEdad(){
    $fecha_actual = date("Y-m-d");
    $fecha_minima = date("Y-m-d",strtotime($fecha_actual."- 18 year"));
    $fecha_maxima = date("Y-m-d",strtotime($fecha_minima."- 62 year"));
    return [$fecha_minima,$fecha_maxima];
}
