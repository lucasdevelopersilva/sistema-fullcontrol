
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
        <li class="nav-item ">
            <a href="{{route("dashboard")}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Recados 
                </p>
            </a>        
        </li> 
        <li class="nav-item ">
            <a href="{{route("dashboard")}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Pedidos 
                </p>
            </a>        
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Notícias
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("noticia")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("editar")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Programação
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("noticia")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("editar")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Equipe
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("noticia")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("editar")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Promoção
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("noticia")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("editar")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
        <li class="nav-header">Configuração</li>
        <li class="nav-item">
            <a href="{{route("config")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Configurações
                    <span class="badge badge-info right">2</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("notificacao")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Configurações
                    <span class="badge badge-info right">2</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("logotipo")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Logotipo
                    <span class="badge badge-info right">2</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route("background")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Background
                    <span class="badge badge-info right">2</span>
                </p>
            </a>
        </li>

    </ul>
</nav>
