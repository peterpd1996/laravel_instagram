<template>
    <div>
        <button class="btn btn-primary" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props:['userid','follows'],

        mounted() {
            console.log('Component mounted.')
        },
        data:function(){
            return { 
                status: this.follows,
            }
        },
        methods:{
            followUser()
            {
                axios.post('/follow/'+ this.userid)
                .then(reponse =>{
                    // như kểu toggle
                   this.status  = !this.status;
                })
                .catch(errors =>{
                    if(errors.response.status == 401){
                       // window.location('/login');
                         window.location.href = '/login';
                    }
                });
            }
        },
        computed:{
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }

</script>
