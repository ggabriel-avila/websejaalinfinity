var anunciosVue = new Vue({
    el: '#AnunciosSeccion',
    data: {
        anuncios: [],
        id: 0,
        titulo: '',
        fecha: '',
        descripcion: ''
    },
    created: function () {
        this.fecha = new Date().toISOString().substring(0, 10);;
        this.obtener();
    },
    methods: {
        obtener: function () {
            let url = document.getElementById('apiAnuncios').value;
            this.$http.get(url).then((response) => {
                let anuncios = [];
                response.data.data.forEach((datos) => {
                    anuncios.push({
                        id: datos.id,
                        titulo: datos.titulo,
                        fecha: datos.fecha.split('-')[2] + '/' + datos.fecha.split('-')[1] + '/' + datos.fecha.split('-')[0],
                        descripcion: datos.descripcion
                    })
                });
                this.anuncios = anuncios;
            }, response => {
                console.log(response)
            })
        },
        agregar: function (button) {
            $('#' + button.target.id).attr('disabled', 'disabled')
            $('#' + button.target.id).html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Espere...
            `)
            let url = document.getElementById('apiAnuncios').value;
            let formData = new FormData();
            formData.append('method', 'post');
            formData.append('titulo', this.titulo);
            formData.append('fecha', this.fecha);
            formData.append('descripcion', this.descripcion);
            this.$http.post(url, formData).then((response) => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Aceptar`)
                $('#agregarAnuncio').modal('hide');
                herramientaVue.alertas('correcto', 'se creo el nuevo anuncio exitosamente');
                this.obtener()
            }, response => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Aceptar`)
                console.log(response)
            })
        },
        modificar: function (button) {
            $('#' + button.target.id).attr('disabled', 'disabled')
            $('#' + button.target.id).html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Espere...
            `)
            let url = document.getElementById('apiAnuncios').value;
            let formData = new FormData();
            formData.append('method', 'put');
            formData.append('id', this.id);
            formData.append('titulo', this.titulo);
            formData.append('fecha', this.fecha);
            formData.append('descripcion', this.descripcion);
            this.$http.post(url, formData).then((response) => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Modificar`)
                $('#modificarAnuncio').modal('hide');
                herramientaVue.alertas('correcto', 'se modifico el anuncio exitosamente');
                this.obtener()
            }, response => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Aceptar`)
                console.log(response)
            })
        },
        eliminar: function (button) {
            $('#' + button.id).attr('disabled', 'disabled')
            $('#' + button.id).html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Espere...
            `)
            let url = document.getElementById('apiAnuncios').value;
            let formData = new FormData();
            formData.append('method', 'delete');
            formData.append('id', this.id);
            this.$http.post(url, formData).then((response) => {
                $('#' + button.id).removeAttr('disabled')
                $('#' + button.id).html(`Aceptar`)
                herramientaVue.alertas('correcto', 'se elimino el anuncio exitosamente');
                $('#eliminarAnuncio').modal('hide');
                this.obtener()
            }, response => {
                $('#' + button.id).removeAttr('disabled')
                $('#' + button.id).html(`Aceptar`)
                console.log(response)
            })
        },
        abrirModalEditar: function (anuncio) {
            this.id = anuncio.id
            this.titulo = anuncio.titulo
            this.fecha = anuncio.fecha.split('/')[2] + '-' + anuncio.fecha.split('/')[1] + '-' + anuncio.fecha.split('/')[0]
            this.descripcion = anuncio.descripcion
            $('#modificarAnuncio').modal('show');
        }
    }
})