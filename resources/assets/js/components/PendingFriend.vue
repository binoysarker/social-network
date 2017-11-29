<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            <slot name="imgUrl2"></slot>
            <span class="badge badge-default">{{numberOfFriends}}</span>
        </a>

        <ul class="dropdown-menu">
            <li class="list-group-item"
                v-for="friends in pending_friend[pending_friend.length -1]"
                v-if="!status" :key="friends.id">
                <span >
                    {{friends.name.slice(0,8)}}
                </span>
                <a :href="'/accept-friend/'+user_id+'&'+friends.id" class="btn btn-primary pull-right" >
                    <i class="fa fa-check" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        watch:{
            pending_friend(value){
                this.numberOfFriends = _.first(value).length;
            },
        },
        mounted() {
            //                to get the pending friends
            axios.get('/pending-request/'+this.user_id)
                .then(
                    (response) => {
                        console.log(response.data);
                        this.pending_friend.push(response.data);
                    });
        },
        props:['user_id'],
        data(){
            return{
                pending_friend:[],
                status:false,
                numberOfFriends:0,
            }
        },
        methods:{

        },
        computed:{

        },
    }
</script>
