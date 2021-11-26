var herramientaVue = new Vue({
    el: "",
    data: {

    },
    methods: {
        /**
         * imprime una alerta en pantalla
         * @param {string} alerta 
         * @param {string} mensaje 
         */
        alertas: function (alerta = null, mensaje = null) {
            let html = '';
            switch (alerta) {
                case 'correcto': ;
                    html = `
                    <div id="alerta" style="position:fixed;top:0%;right:3%;z-index:2147483647">
                        <div class="alert alert-success" role="alert">
                            ${mensaje}
                        </div>
                    </div>`
                    $('body').append(html);
                    break;
                case 'informacion':
                    html = `
                    <div id="alerta" style="position:fixed;top:0%;right:3%;z-index:2147483647">
                        <div class="alert alert-warning" role="alert">
                            ${mensaje}
                        </div>
                    </div>`
                    $('body').append(html);
                    break;
                case 'incorrecto':
                    html = `
                    <div id="alerta" style="position:fixed;top:0%;right:3%;z-index:2147483647">
                        <div class="alert alert-error" role="alert">
                            ${mensaje}
                        </div>
                    </div>`
                    $('body').append(html);
                    break;
                default:
                    alert(mensaje)
            }
            window.setTimeout(function () {
                $('#alerta').remove();
            }, 5000);
        }
    }
})