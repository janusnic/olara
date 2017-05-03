require('./bootstrap');

Vue.component('vue-pagination', require('./components/Pagination.vue'));

new Vue({

    el: '#app',

    data: {
        items: [],
        loading: false,
        error: false,
        query: ''
    },

    methods: {
        search: function() {
            // Clear the error message.
            this.error = '';
            // Empty the products array so we can fill it with the new products.
            this.items = [];
            // Set the loading property to true, this will display the "Searching..." button.
            this.loading = true;

            // Making a get request to our API and passing the query to it.
            this.$http.get('/search?q=' + this.query).then((response) => {
                // If there was an error set the error message, if not fill the products array.
                console.log(response);
                //response.body.error ? this.error = response.body.error : this.items = response.body;
                this.items = response.data;                
                // The request is finished, change the loading to false again.
                this.loading = false;
                // Clear the query.
                this.query = '';
            });
        }
    }

});

