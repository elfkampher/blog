<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->

    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
          <span class="right badge badge-danger">New</span>
        </p>
      </a>
    </li>
    
    <li class="nav-item has-treeview {{ request()->is('admin/users*') ? 'active menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Usuarios
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('admin/users') }}" class="nav-link">
            <i class="far fa-eye nav-icon"></i>
            <p>Ver todos los usuarios</p>
          </a>
        </li>
        <li class="nav-item {{ request()->is('admin/users/create') ? 'active' : '' }}">
          <a href="{{ url('admin/users/create') }}" class="nav-link">
            <i class="fas fa-pencil-alt nav-icon"></i>
            <p>Crear un Usuario</p>
          </a>
        </li>        
      </ul>
    </li>

    <li class="nav-item has-treeview {{ request()->is('admin/posts*') ? 'active menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Blog
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('admin/posts') }}" class="nav-link">
            <i class="far fa-eye nav-icon"></i>
            <p>Ver todos los post</p>
          </a>
        </li>
        <li class="nav-item {{ request()->is('admin/posts/create') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="modal" data-target="#postModal">
            <i class="fas fa-pencil-alt nav-icon"></i>
            <p>Crear un Post</p>
          </a>
        </li>        
      </ul>
    </li>

  </ul>
</nav>