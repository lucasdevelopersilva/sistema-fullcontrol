
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
            <a href="{{route("recados.index")}}" class="nav-link">
                <i class="nav-icon fa fa-comment-medical"></i>
                <p>
                    Recados 
                </p>
            </a>        
        </li> 
        <li class="nav-item ">
            <a href="{{route("dashboard")}}" class="nav-link">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                    Pedidos 
                </p>
            </a>        
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-rss"></i>
                <p>
                    Notícias
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("noticia.index")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("noticia.create")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Programação
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("programacao.index")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("programacao.create")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Equipe
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("equipe.index")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("equipe.create")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                    Promoção
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route("promocao.index")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lista</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route("promocao.create")}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Nova</p>
                    </a>
                </li>              
            </ul>
        </li> 
   
        <li class="nav-header">Configuração</li>
        <li class="nav-item">
            <a href="{{route("app.editar")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Gerar aplicativo
                    <!--<span class="badge badge-info right">2</span>-->
                </p>
            </a>
        </li>        
        <li class="nav-item">
            <a href="{{route("config.index")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Geral
                    <!--<span class="badge badge-info right">2</span>-->
                </p>
            </a>
        </li>        
        <li class="nav-item">
            <a href="{{route("config.menu")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Menu
                    <!--<span class="badge badge-info right">2</span>-->
                </p>
            </a>
        </li>        
        <li class="nav-item">
            <a href="{{route("config.logotipo")}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Logotipo e Background                    
                </p>
            </a>
        </li>
        

    </ul>
</nav>
