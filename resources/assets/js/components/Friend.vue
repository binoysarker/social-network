<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            <slot name="imgUrl"></slot>
            <span class="badge badge-default">{{numberOfFriends}}</span>
        </a>

        <ul class="dropdown-menu ">
            <li class="list-group-item"
                v-for="friends in related_friends[related_friends.length -1]"
                v-if="!status" :key="friends.id">
                <span>{{friends.name.slice(0,8)}}</span>
                <a :href="'/remove-friend/'+user_id+'&'+friends.id" class="btn btn-primary btn-sm pull-right" >
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </li>

</template>

<script>
    export default {
        watch:{
            related_friends(value){
                this.numberOfFriends = _.first(value).length;
            },
        },
        mounted() {
//            to get all the related friends
            axios.get('/all-friends/'+this.user_id)
                .then(
                    (response) => {
                        console.log(response.data);
                        let friends = response.data;
                        this.related_friends.push(friends);
                    })
                .catch((error) => console.log(error));
        },
        props:['user_id'],
        data(){
            return{
                related_friends:[],
                status:false,
                numberOfFriends:0,
            }
        },
        methods:{

        },


    }
</script>
