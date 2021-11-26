var gruposBecadosVue = new Vue({
    el: '#gruposSeccion',
    data: {
        grupos: []
    },
    created: function () {
        this.obtener();
        let url = document.getElementById('apiJugadores').value;
        this.$http.get(url).then((respuesta) => {
            let vectorJugadores = [];
            for (jugador of respuesta.data.data) {
                vectorJugadores.push(`${jugador.nombre} - ${jugador.id}`)
            }
            var input = document.getElementById('agregarJugador');
            tagify = new Tagify(input, {
                whitelist: vectorJugadores,
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
                dropdown: {
                    classname: "color-blue",
                    enabled: 0,
                    maxItems: 5,
                    position: "text",
                    closeOnSelect: false,
                    highlightFirst: true
                }
            });
            var input = document.getElementById('jugadoresImpresos');
            tagify = new Tagify(input, {
                whitelist: vectorJugadores,
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
                dropdown: {
                    classname: "color-blue",
                    enabled: 0,
                    maxItems: 5,
                    position: "text",
                    closeOnSelect: false,
                    highlightFirst: true
                }
            });
            this.jugadores = respuesta.data.data
        }, respuesta => {
            console.log(respuesta)
        })
    },
    methods: {
        cargarJugadores: function () {
            jugadores = jugadoresVue.jugadores;
        },
        crear: function (button) {
            let url = document.getElementById('apiGrupos').value;
            $('#' + button.target.id).attr('disabled', 'disabled')
            $('#' + button.target.id).html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Espere...
            `)
            let jugadoresSeleccionados = document.getElementById('agregarJugador').value;
            let titulo = document.getElementById('tituloGrupo').value;
            let formData = new FormData();
            formData.append('jugadores', jugadoresSeleccionados);
            formData.append('titulo', titulo);
            formData.append('method', 'crear');
            this.$http.post(url, formData).then((respuesta) => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Aceptar`)
                this.obtener();
                herramientaVue.alertas('correcto', 'grupo creado exitosamente');
            }, respuesta => {
                console.log(respuesta);
            })
        },
        obtener: function () {
            let url = document.getElementById('apiGrupos').value;
            this.$http.get(url).then((respuesta) => {
                this.grupos = respuesta.data.data;
            }, respuesta => {
                console.log(respuesta);
            })
        },
        eliminar: function (id) {
            let url = document.getElementById('apiGrupos').value;
            let formData = new FormData();
            formData.append('id', id);
            formData.append('method', 'eliminar');
            console.log(id);
            this.$http.post(url, formData).then((respuesta) => {
                this.obtener();
                herramientaVue.alertas('correcto', 'grupo eliminado exitosamente');
            }, respuesta => {
                console.log(respuesta);
            })
        },
        abrirModalModificar:function(jugadores, titulo, grupoId){
            let html = ``;
            for(jugador of jugadores){
                console.log(jugador.id);
                html += `${jugador.nombre} - ${jugador.id},`;
            }
            $('#grupoId').val(grupoId)
            $('#grupoTituloModificar').val(titulo)
            $('#jugadoresImpresos').val(html)
            $('#modificargrupo').modal('show');
        },
        modificar:function(){
            let url = document.getElementById('apiGrupos').value;
            let grupoId = document.getElementById('grupoId').value;
            let jugadoresSeleccionados = document.getElementById('jugadoresImpresos').value;
            let titulo = document.getElementById('grupoTituloModificar').value;
            let formData = new FormData();
            formData.append('id', grupoId);
            formData.append('jugadores', jugadoresSeleccionados);
            formData.append('titulo', titulo);
            formData.append('method', 'modificar');
            this.$http.post(url, formData).then((respuesta) => {
                this.obtener();
                herramientaVue.alertas('correcto', 'grupo modificado exitosamente');
            }, respuesta => {
                console.log(respuesta);
            })
        }
    }
})