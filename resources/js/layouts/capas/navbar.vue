<template>
    <div class="full-reset container-menu-movile nav-lateral-scroll">
        <div class="logo full-reset all-tittles">
            <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i>
            TEC. Chiclayo
        </div>
        <div class="nav-lateral-divider full-reset"></div>
        <div class="full-reset" style="padding: 10px 0; color:#fff;">
            <figure>
                <img src="assets/img/logo.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
            </figure>
            <p class="text-center" style="padding-top: 15px;">Sistema de Reparacion</p>
        </div>
        <div class="nav-lateral-divider full-reset"></div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <router-link tag="li" to="/">
                        <a>
                            <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Home
                        </a>
                    </router-link>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp; Reparaciones <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <router-link tag="li" to="/nota">
                                <a>
                                    <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Nota de Entrada
                                </a>
                            </router-link>
                            <router-link tag="li" to="/reparaciones">
                                <a>
                                    <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Lista de Reparaciones
                                </a>
                            </router-link>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp; Objetos <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <router-link tag="li" to="/herramienta">
                                <a>
                                    <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Herramienta
                                </a>
                            </router-link>
                            <router-link tag="li" to="/pieza">
                                <a>
                                    <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Pieza
                                </a>
                            </router-link>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp; Contactos <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <router-link tag="li" to="/usuario">
                                <a>
                                    <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Usuario
                                </a>
                            </router-link>
                            <li>
                                <router-link to="/proveedor">
                                    <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Proveedor
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/cliente">
                                    <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Cliente
                                </router-link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
</template>
<script>
export default {
    data() {
        return {
            cuenta: cuenta,
        }
    }
}
</script>

