require('./bootstrap');

Vue.component('vue-pagination', require('./components/Pagination.vue'));

const  app = new Vue({
    el: '#app',
    data: {
        items: [],
        counter: 0,
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        
    },
    mounted : function() {
        this.getItems(this.pagination.current_page);
    },
    methods: {
        getItems(page) {
            var _this = this;
            $.ajax({
                url: '/blog?page='+page,
                success: (response) => {
                   _this.items = response.data;
                   _this.pagination = response;
                }
            });
        },
        
    }
});