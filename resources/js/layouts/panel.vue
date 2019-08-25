<script>
import navbar from './capas/navbar.vue'
import sidebar from './capas/sidebar.vue'
export default {
    components:{
        'navbar': navbar,
        'sidebar': sidebar,
    },
    mounted() {
        navigator.serviceWorker.register('./sw.js').then((registration) => {
            var messaging;
            messaging=firebase.messaging();
            messaging.useServiceWorker(registration);
            messaging.requestPermission().then(function () {
                return messaging.getToken();
            }).then(function (token) {
                if(local.getItem('push')===null){
                    local.setItem('push',token);
                    /**
                     * Registrar
                     */
                    $.ajax({        
                        type : 'POST',
                        url : "https://iid.googleapis.com/iid/v1:batchAdd",
                        headers : {Authorization : 'key=AIzaSyCUpg8GjUxs56rQyDCO_yEu46Vmbxfpapg'},
                        contentType : 'application/json',
                        dataType: 'json',
                        data: JSON.stringify({"to": "/topics/sistema-general-"+1, "registration_tokens": [token]}),
                        success : function(response) {
                            console.log("Push Registrado");
                        }
                    });
                }
            });
        });
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