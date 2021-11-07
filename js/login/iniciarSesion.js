var iniciarSesionVue = new Vue({
    el: "#login",
    data: {
        usuario: '',
        clave: ''
    },
    methods: {
        iniciarSesion: function () {
            let url = document.getElementById('apiLogin').value;
            let formData = new FormData();
            formData.append('usuario', this.usuario);
            formData.append('clave', this.clave);
            this.$http.post(url, formData).then((response) => {
                window.location.reload();
            }, response => {
                if(response.data !== null){
                    herramientaVue.alertas('error', response?.data?.message);
                }else{
                    herramientaVue.alertas('informacion', 'ocurrio un error en el servidor')
                }
            })
        }
    }
})