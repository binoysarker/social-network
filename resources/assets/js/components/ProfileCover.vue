<template>
    <div>
        <slot name="profile-cover"></slot>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <slot name="cover-navbar"></slot>

                </div>
            </div>
        </nav>
    </div>
</template>
<script >
    export default {
			data(){
			    return{
			    
					}
			},
			methods:{
   
			},
			props:[],
			created(){
			
			},
    }
</script>
<style scoped="">
.coverImg{
    position: relative;
    border: 2px solid gray;
		width: 840px;
		height: 310px;
    box-shadow: 1px 3px 2px 1px;
}
.profileImg{
    position: absolute;
    z-index: 100;
    width: 170px;
    height: 170px;
    top:170px;
    left: 40px;
    border: 2px solid gray;
    box-shadow: 1px 3px 2px 1px;
}
.ProfileEditIcon{
	position: absolute;
	z-index: 110;
	top: 23rem;
	left: 9.2rem;
}
.CoverEditIcon{
	position: absolute;
	z-index: 110;
	top: 12rem;
	left: 42.2rem;
}
</style>