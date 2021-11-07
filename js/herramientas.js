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
            //TODO
            //cambiar el sistema de alertas
            switch (alerta) {
                case 'correcto':
                    alert(mensaje)
                    break;
                case 'informacion':
                    alert(mensaje)
                    break;
                case 'incorrecto':
                    alert(mensaje)
                    break;
                default:
                    alert(mensaje)
            }
        }
    }
})