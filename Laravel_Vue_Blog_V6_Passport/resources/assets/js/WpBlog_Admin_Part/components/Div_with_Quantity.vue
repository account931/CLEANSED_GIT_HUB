<!-- Uses Vuex store: this.$store.state.adm_posts_qunatity-->
<!-- How it is calculated: component/pages/list_all.vue gets ajax data and in success use {that.$store.dispatch('setPostsQuantity', data.data.length);} (triggers Vuex Store action) -->

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
        };
    },
  
    computed: { },
    beforeMount() { },
    methods: { },
}
</script>