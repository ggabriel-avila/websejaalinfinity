var gruposBecadosVue = new Vue({
    el: '#gruposSeccion',
    data: {
        grupos: [],
        jugadores: [],
        jugadoresModificar:[]
    },
    created: function () {
        this.obtener();
        let url = document.getElementById('apiJugadores').value;
        this.$http.get(url).then((respuesta) => {
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
            let jugadoresSeleccionados = '';
            for(respaldo of document.getElementsByName('agregarJugador')){
                if(respaldo.checked){
                    jugadoresSeleccionados += 'IGNORE - ' + respaldo.value + ',';
                }
            }
            jugadoresSeleccionados = jugadoresSeleccionados.substring(0, jugadoresSeleccionados.length - 1);
            let titulo = document.getElementById('tituloGrupo').value;
            let formData = new FormData();
            formData.append('jugadores', jugadoresSeleccionados);
            formData.append('titulo', titulo);
            formData.append('method', 'crear');
            this.$http.post(url, formData).then((respuesta) => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Aceptar`)
                $('#agregarGrupo').modal('hide');
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
            let html = '';
            let agregar = false;
            for(jugador of this.jugadores){
                agregar = false;
                for(jugadorSeleccionado of jugadores){
                    if(jugadorSeleccionado.id == jugador.id){
                        agregar = true
                    }
                }
                if(agregar){
                    html += `
                        <div class="mt-1">
                            <label>${jugador.nombre}</label>
                            <input type="checkbox" checked name="modificarJugador" value="${jugador.id}">
                            <br>
                        </div>
                    `;
                }else{
                    html += `
                        <div class="mt-1">
                            <label>${jugador.nombre}</label>
                            <input type="checkbox" name="modificarJugador" value="${jugador.id}">
                            <br>
                        </div>
                    `;
                }
            }
            $('#grupoId').val(grupoId)
            $('#contenedorModificar').html(html);
            $('#grupoTituloModificar').val(titulo)
            $('#modificargrupo').modal('show');
        },
        modificar:function(){
            let url = document.getElementById('apiGrupos').value;
            let grupoId = document.getElementById('grupoId').value;
            let jugadoresSeleccionados = '';
            for(respaldo of document.getElementsByName('modificarJugador')){
                if(respaldo.checked){
                    jugadoresSeleccionados += 'IGNORE - ' + respaldo.value + ',';
                }
            }
            jugadoresSeleccionados = jugadoresSeleccionados.substring(0, jugadoresSeleccionados.length - 1);
            let titulo = document.getElementById('grupoTituloModificar').value;
            let formData = new FormData();
            formData.append('id', grupoId);
            formData.append('jugadores', jugadoresSeleccionados);
            formData.append('titulo', titulo);
            formData.append('method', 'modificar');
            this.$http.post(url, formData).then((respuesta) => {
                $('#modificargrupo').modal('hide');
                this.obtener();
                herramientaVue.alertas('correcto', 'grupo modificado exitosamente');
            }, respuesta => {
                console.log(respuesta);
            })
        }
    }
})