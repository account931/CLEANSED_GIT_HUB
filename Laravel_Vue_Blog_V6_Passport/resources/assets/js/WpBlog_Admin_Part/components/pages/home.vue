<template>
  <div class="home">
    <h1>{{title}}</h1>
	
    <div class="row fix-for-non-working-click-in-mobile"> <!-- .fix-for-non-working-click-in-mobile is a fix for non-working click in mobile -->
	
        <p>This is an Admin Start Page</p>
        <p>Go List All to view the posts to edit</p>
	  
    </div>
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return { 
      title: 'Admin Home Page',
      products:[ ]
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
</style>