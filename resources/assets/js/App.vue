<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Hello World</div>

                    <div class="panel-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            console.log('Component mounted.');
            this.$store.dispatch('initUser', [
                {
                name : "andy chan",
                age  : 18
                },
                {
                name : "andy chan",
                age  : 18
                },
            ]);
        }
    }
</script>
