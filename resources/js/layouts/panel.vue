<script>
import navbar from './capas/navbar.vue'
import sidebar from './capas/sidebar.vue'
export default {
    components:{
        'navbar': navbar,
        'sidebar': sidebar,
    },
    
}
</script>
<template>
    <div>
        <div class="navbar-lateral full-reset">
            <div class="visible-xs font-movile-menu mobile-menu-button"></div>
            <navbar></navbar>
        </div>
        <div class="content-page-container full-reset custom-scroll-containers">
            <sidebar></sidebar>
            <slot/>
        </div>
    </div>
</template>