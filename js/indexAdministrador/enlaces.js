var enlacesVue = new Vue({
    el: '#enlaces',
    data: {
        enlaces: [],
        id: '',
        enlace: ''
    },
    created: function () {
        this.obtener();
    },
    methods: {
        obtener: function () {
            let url = document.getElementById('apiEnlace').value;
            this.$http.get(url).then((response) => {
                console.log(response.data.data);
                this.enlaces = response.data.data
            }, response => {
                console.log(response.body)
            })
        },
        modificar: function (button) { 
            $('#' + button.target.id).attr('disabled', 'disabled')
            $('#' + button.target.id).html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Espere...
            `)
            let url = document.getElementById('apiEnlace').value;
            let formData = new FormData();
            formData.append('id', this.id)
            formData.append('enlace', this.enlace)
            this.$http.post(url, formData).then((response) => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Aceptar`)
                herramientaVue.alertas('correcto', 'se realizo el cambio exitosamente');
            }, response => {
                console.log(response)
            })
        },
        abrirModalEditar: function (id, enlace) {
            this.id = id;
            this.enlace = enlace;
            $('#editarEnlace').modal('show');
        }
    }
})