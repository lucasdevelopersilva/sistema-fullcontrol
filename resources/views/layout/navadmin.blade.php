
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item ">
            <a href="{{route("dashboard")}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard 
                </p>
            </a>        
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Rádios
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("users.index")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("users.create")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Novo</p>
                    </a>
                </li>              
            </ul>
        </li>  
        <li class="nav-item ">
            <a href="{{route("dashboard")}}" class="nav-link">
                <i class="nav-icon fa fa-tag"></i>
                <p>
                    Configurar 
                </p>
            </a>        
        </li>
    </ul>
</nav>
