<template>
    <div class="home">
        <h1>{{title}}</h1>
        <div class="row fix-for-non-working-click-in-mobile"> <!-- .fix-for-non-working-click-in-mobile is a fix for non-working click in mobile -->
            <p>This is an Admin Home Page</p>
            <p>Go to <router-link class="nav-link" to="/list_all">View all list </router-link>  to view the posts, edit and delete </p>
        </div>
    </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return { 
      title: 'Admin Home Page',
      products:[]
    }
  },
  methods:{
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.row img{
    max-height: 15em;
    width: 100%;
}
.row h3{
    cursor:pointer;
}
.row{margin-bottom: 10em;}
</style>