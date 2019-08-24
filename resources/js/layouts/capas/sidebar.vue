<template>
    <div class="sidebar" data-color="azure" data-background-color="black" data-image="https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-4.jpg">
        <div class="sidebar-background" style="background-image: url(https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-4.jpg) "></div>
        <div class="logo">
            <router-link to="/" class="simple-text logo-normal">
                Sistema
            </router-link>
        </div>
        <div class="profile">
            <ul class="nav">
                <router-link tag="li" class="nav-item"  to="/notificaciones">
                    <a class="nav-link">
                        <i class="material-icons">notifications</i>
                        NOTIFICACIONES
                        <span class="notification">5</span>
                    </a>
                </router-link>
            </ul>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <router-link tag="li" class="nav-item"  to="/home" exact>
                    <a class="nav-link">
                        <i class="material-icons">dashboard</i>   
                        <p>Panel</p>
                    </a>
                </router-link>
                <router-link tag="li" class="nav-item"  to="/compra">
                    <a class="nav-link">
                        <i class="material-icons">library_books</i>
                        <p>Compra</p>
                    </a>
                </router-link>
                <router-link tag="li" class="nav-item"  to="/venta">
                    <a class="nav-link">
                        <i class="material-icons">library_books</i>
                        <p>Venta</p>
                    </a>
                </router-link>
                <router-link tag="li" class="nav-item"  to="/producto">
                    <a class="nav-link">
                        <i class="material-icons">
                            work_outline
                        </i>
                        <p>Producto</p>
                    </a>
                </router-link>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#componentInformes" aria-expanded="false">
                        <i class="material-icons">content_paste</i>                                
                        <p> Informes
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="componentInformes">
                        <ul class="nav">
                            <router-link tag="li" class="nav-item"  to="/lista-venta">
                                <a class="nav-link">
                                    <p>lista de Ventas</p>
                                </a>
                            </router-link>
                            <router-link tag="li" class="nav-item"  to="/lista-compra">
                                <a class="nav-link">
                                    <p>lista de compras</p>
                                </a>
                            </router-link>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#componentInventario" aria-expanded="false">
                        <i class="material-icons">content_paste</i>                                
                        <p> Inventario
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="componentInventario">
                        <ul class="nav">
                            <router-link tag="li" class="nav-item"  to="/stock">
                                <a class="nav-link">
                                    <!-- <i class="material-icons">dashboard</i> -->
                                    <!-- <i class="material-icons">content_paste</i>                                 -->
                                    <p>Stock</p>
                                </a>
                            </router-link>
                            <router-link tag="li" class="nav-item"  to="/lote">
                                <a class="nav-link">
                                    <!-- <i class="material-icons">content_paste</i>                                 -->
                                    <!-- <i class="material-icons">dashboard</i> -->
                                    <p>Lote</p>
                                </a>
                            </router-link>
                            <router-link tag="li" class="nav-item"  to="/kardex">
                                <a class="nav-link">
                                    <!-- <i class="material-icons">content_paste</i>                                 -->
                                    <!-- <i class="material-icons">dashboard</i> -->
                                    <p>Kardex</p>
                                </a>
                            </router-link>
                            <router-link tag="li" class="nav-item"  to="/reorden">
                                <a class="nav-link">
                                    <!-- <i class="material-icons">content_paste</i>                                 -->
                                    <!-- <i class="material-icons">dashboard</i> -->
                                    <p>Bajo Stock</p>
                                </a>
                            </router-link>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#componentContactos" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p> Contactos
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="componentContactos">
                        <ul class="nav">
                            <router-link tag="li" class="nav-item"  to="/usuario">
                                <a class="nav-link">
                                    <!-- <i class="material-icons">person</i> -->
                                    <p>Usuarios</p>
                                </a>
                            </router-link>
                            <router-link tag="li" class="nav-item"  to="/proveedor">
                                <a class="nav-link">
                                    <!-- <i class="material-icons">person</i> -->
                                    <p>Proveedores</p>
                                </a>
                            </router-link>
                            <router-link tag="li" class="nav-item"  to="/cliente">
                                <a class="nav-link">
                                    <!-- <i class="material-icons">person</i> -->
                                    <p>Clientes</p>
                                </a>
                            </router-link>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>