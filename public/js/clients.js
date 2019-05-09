Vue.component('table-clients', {
    template: `
    <table class="table table-striped">
        <thead>
            <th><input type="checkbox" id="all_readers_check" value=""></th>
            <th>Дата рег-ции</th>
            <th>Фед.округ-Регион</th>
            <th>Телефон</th>
            <th>ФИО</th>
            <th>Email</th>
            <th>Компания</th>
            <th>Оплата</th>
            <th>Период активности</th>
            <th>Статус</th>
            <th class="text-right"></th>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
    `
});

var client = {
    template: `
        <tr class="reader">
            <td> <input type="checkbox" class="reader_checkbox" value="1"> </td>
            <td> {{ data_client.created_at }} </td>
            <td> {{ data_client.fed_okrug }} - {{ data_client.region }} </td>
            <td> {{ data_client.phone }} </td>
            <td> {{ data_client.f_name }} {{ data_client.i_name }} {{ data_client.o_name }} </td>
            <td> {{ data_client.email }} </td>
            <td> {{ data_client.company }} </td>
            <td> {{ data_client.status_pay }} </td>
            <td> {{ data_client.range_pay }} </td>
            <td> {{ data_client.status_activity }} </td>
            <td> actions </td>
        </tr>
    `,
    props: {
        'data_client': Object
    },
    data: function () {
        return {
            //title: 'my title'
        }
    },
};

var vm = new Vue({
    el: '#readers_vue',
    //template: `<p>111</p>`,
    components: {
        'client': client
    },
    data: {
        clients: {
            //0: {id: '111', title: 'my TIT'},
            //1: {id: '222', title: 'my TIT22'}
        }
    },
    mounted: function () {
        this.$http.get('http://localhost:8000/wpadmin/clients/readersvuejson').then(response => {
            this.clients = response.body.clients;
            //this.clients = Object.assign({}, this.clients, {id: '222', title: 'my TIT22'});
            console.log(response.body);

        }, response => {
            console.log(response);
        });
    }
})
