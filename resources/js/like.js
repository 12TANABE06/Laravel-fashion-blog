
   var app = new Vue({
        el: '#like',
        data:{},
        methods: {
            favorite() {
                axios.get('/posts/' + this.post.id +'/likes')
                    .catch(function(error) {
                        console.log(error);
                        });
                    }
                }
                    
            })
