<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Items
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Administrador</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Cliente</a>
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Empleado</a>
                            </li>                           
                            
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Almacen </a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=20" class="nav-item">
                                        <a class="nav-link" href="#"><i class="icon-notebook"></i> Categorias</a>
                            </li>
                            <li @click="menu=21" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Articulos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras </a>
                        <ul class="nav-dropdown-items">
                            
                            <li @click="menu=23" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Ingresos</a>
                            </li>
                            <li @click="menu=22" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Proveedores</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Platillos</a>
                            <ul class="nav-dropdown-items">
                                <li @click="menu=3" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-bag"></i> Categoria</a>
                                </li>
                                <li @click="menu=2" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-bag"></i> Platillo</a>
                                </li>
                                
                                <li @click="menu=4" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-bag"></i> Mesas</a>
                                </li>
                            </ul>
                        </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                        <ul class="nav-dropdown-items">
                                <li @click="menu=24" class="nav-item">
                                        <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Pedidos</a>
                                    </li>
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Ventas</a>
                            </li>
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Cliente</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Roles</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Usuarios</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=14" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ingresos</a>
                            </li>
                            <li @click="menu=15" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                            </li>
                            <li @click="menu=30" class="nav-item">
                                    <a class="nav-link" href="#"><i class="icon-chart"></i> APIS</a>
                                </li>
                        </ul>
                    </li>
                    <li @click="menu=16" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=17" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>