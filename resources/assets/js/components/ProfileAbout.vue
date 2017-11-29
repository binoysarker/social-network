<template>
    <div class="panel panel-default">
        <div class="well">
            <i class="fa fa-photo" aria-hidden="true"></i>
            About
        </div>
        <div class="panel-body">
            <div class="col-lg-3">
                <div class="list-group">
                    <button type="button" class="list-group-item">Work And Education</button>
                    <button type="button" class="list-group-item">Contact and Basic Info</button>
                    <button type="button" class="list-group-item">Family and Relationship</button>
                    <button type="button" class="list-group-item">Life Events</button>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="well well-sm">
                    some text
                </div>
            </div>
        </div>
    </div>
</template>
<script >
    export default {
        data(){
            return{

            }
        },
        props:['user'],
    }
</script>
<style>

</style>