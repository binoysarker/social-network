<template>

    <form action="" id="form">
        <input type="text" class="form-control"  v-model="search" placeholder="Search...">
        <span class="small" v-if="loading" >Searching...</span>
        <ul class=" list-group myResult" v-show="loading" >
            <li v-for="single in result[result.length -1]" class="list-group-item" @blur="loading = false">
                <h3><a :href="'/profile/'+single.slug" @click="loading = false">{{single.name}}</a></h3>
            </li>
        </ul>
    </form>

</template>
<script>
    export default {
        data(){
            return{
                search:'',
                loading:false,
                result:[],
            }
        },
        watch:{
            search(value){
                if(value.length > 3){
                    let search = value;
                    this.loading = true;
                    setTimeout(() =>{
                        axios.get('/search/'+search )
                            .then((res) =>{
                                this.result.push(res.data);
                            })
                            .catch((error) =>{
                                console.log(error);
                            })
                    },2000);

                }
            },

        },

        methods:{


        },

    }
</script>
<style scoped="">

    #form{
        position: relative;
    }
    .myResult{
        background-color: white;
        position: absolute;
    }
</style>