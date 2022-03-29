<!-- Vue Menu for One Item (menu switch for login/logged)(component used in Menu in /views/layouts/app.php) -->

<template>
	<span>  {{ ifPassportTokenSet == null ? 'LoginX' :  'Logged-Dashboard' }} </span>  
</template>

<script>
    export default {
        mounted() {
        },
		computed: { 
            ifPassportTokenSet() {
                return this.$store.state.passport_api_tokenY;
			},
		},
    }
</script>