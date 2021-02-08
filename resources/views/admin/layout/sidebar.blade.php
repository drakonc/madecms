<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('/static/images/logo.png') }}" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle">Hola:</span>
            <div class="name">
                {{ Auth::user()->name }} {{ Auth::user()->lastname }}
            </div>
            <div class="email"> {{ Auth::user()->email }} </div>
        </div>
    </div>

    <div class="main">
        <ul>
            <li @if(!kvfj(Auth::user()->permissions,'dashboard')) hidden @endif>
                <a href="{{url('/admin')}}" class="lk-dashboard"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li @if(!kvfj(Auth::user()->permissions,'categories')) hidden @endif>
                <a href="{{url('/admin/categories/0')}}" class="lk-categories lk-category_add lk-category_edit lk-category_delete"><i class="far fa-folder-open"></i> Categorias</a>
            </li>
            <li @if(!kvfj(Auth::user()->permissions,'products')) hidden @endif>
                <a href="{{url('/admin/products/all')}}" class="lk-products lk-product_search lk-product_add lk-product_edit lk-product_get_category"><i class="fas fa-boxes"></i> Productos</a>
            </li>
            <li @if(!kvfj(Auth::user()->permissions,'orders')) hidden @endif>
                <a href="{{url('/admin/orders/all')}}" class="lk-orders"><i class="fas fa-clipboard-list"></i> Ordenes</a>
            </li>
            <li @if(!kvfj(Auth::user()->permissions,'user_list')) hidden @endif>
                <a href="{{url('/admin/users/all')}}" class="lk-user_list lk-user_edit lk-user_permissinons"><i class="fas fa-user-friends"></i> Usuarios</a>
            </li>
            <li @if(!kvfj(Auth::user()->permissions,'settings')) hidden @endif>
                <a href="{{url('/admin/settings')}}" class="lk-settings"><i class="fas fa-cogs"></i> Configuraciones</a>
            </li>
        </ul>
    </div>
</div>
