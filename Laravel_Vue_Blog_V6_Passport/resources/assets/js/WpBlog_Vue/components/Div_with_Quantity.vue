<template>
    <div class="col-sm-12 col-xs-12 alert alert-info borderX">
		Aricles found(Vue): {{ this.posts.length }}  {{ /* this.$store.state.posts.length */ }}
	</div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
    name: 'all-posts',
    data() {
        return {
           //posts: [],
        };
    },
  
    computed: {
        ...mapState(['posts']),	
    },
    beforeMount() {
    },
    methods: {
    },
}
</script>