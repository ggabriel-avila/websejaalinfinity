var jugadoresVue = new Vue({
    el: '#jugadoresId',
    data: {
        jugadores:[]
    },
    created:function(){
        this.traer();
    },
    methods: {
        traer: function () {
            let url = document.getElementById('apiJugadores').value;
            this.$http.get(url).then((respuesta) => {
                this.jugadores = respuesta.data.data
            }, respuesta => {
                console.log(respuesta)
            })
        }
    }
})