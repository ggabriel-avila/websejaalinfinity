var gruposBecadosVue = new Vue({
    el:'#gruposBecadosId',
    data:{
        grupos:[]
    },
    created:function(){
        this.obtener();
        let url = document.getElementById('apiJugadores').value;
        this.$http.get(url).then((respuesta) => {
            let vectorJugadores = [];
            for(jugador of respuesta.data.data){
                vectorJugadores.push(`${jugador.nombre} - ${jugador.promedio_spl}`)
            }
            var input = document.getElementById('agregarJugador');
            tagify = new Tagify(input, {
                whitelist : vectorJugadores,
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
                dropdown : {
                    classname     : "color-blue",
                    enabled       : 0,
                    maxItems      : 5,
                    position      : "text",         
                    closeOnSelect : false,          
                    highlightFirst: true
                }
            });
            this.jugadores = respuesta.data.data
        }, respuesta => {
            console.log(respuesta)
        })
    },
    methods:{
        cargarJugadores:function(){
            jugadores = jugadoresVue.jugadores;
        },
        crear:function(button){
            let url = document.getElementById('apiGrupos').value;
            $('#' + button.target.id).attr('disabled', 'disabled')
            $('#' + button.target.id).html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Espere...
            `)
            let jugadoresSeleccionados = document.getElementById('agregarJugador').value;
            let titulo = document.getElementById('tituloGrupo').value;
            console.log(document.getElementById('agregarJugador').value);
            let formData = new FormData();
            formData.append('jugadores', jugadoresSeleccionados);
            formData.append('titulo', titulo);
            this.$http.post(url, formData).then((respuesta) => {
                $('#' + button.target.id).removeAttr('disabled')
                $('#' + button.target.id).html(`Aceptar`)
                herramientaVue.alertas('correcto', 'grupo creado exitosamente');
            }, respuesta => {
                console.log(respuesta);
            })
        },
        obtener:function(){
            let url = document.getElementById('apiGrupos').value;
            this.$http.get(url).then((respuesta) => {
                console.log(respuesta);
                this.grupos = respuesta.data.data;
            }, respuesta => {
                console.log(respuesta);
            })
        }
    }
})