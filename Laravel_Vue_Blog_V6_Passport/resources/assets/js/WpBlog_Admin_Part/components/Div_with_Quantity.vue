<!-- Uses Vuex store: this.$store.state.adm_posts_qunatity-->
<!-- How it is calculated: component/pages/list_all.vue gets ajax data and in success use {that.$store.dispatch('setPostsQuantity', data.data.length);} (triggers Vuex Store action)</p>-->

<template>

    <div class="col-sm-12 col-xs-12 alert alert-info borderX">
		Aricles found(Vuex):  {{ this.$store.state.adm_posts_qunatity }}   <!--{{ this.$store.state.posts.length }}-->
    </div>

</template>

<script>

export default {
    name: 'all-posts',
    data() {
        return {
            //postDialogVisible: false,
        };
    },
  
    //computed property is used to declaratively describe a value that depends on other values. When you data-bind to a computed property inside the template, Vue knows when to update the DOM when any of the values depended upon by the computed property has changed.
    computed: { 
    },
    beforeMount() {
    },
    methods: {
    },
}
</script>