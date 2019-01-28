const vm = new Vue({
    el: '#readers_vue',
    data: {
        name: 'dddddd',
        items: [
            { message: 'Foo' },
            { message: 'Bar' }
        ]
    },
    mounted: function() {
        console.log(this.name);
    }
})