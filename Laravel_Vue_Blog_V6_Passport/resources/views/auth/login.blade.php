@extends('layouts.app')

@section('content')

<div class="col-md-9 col-md-offset-2 alert alert-danger">
    <center>Login via Passport Api Vue</center>
</div>


<!----------------------------- Vue Login component (Rest Api Login) ---------------------------------->
<div id="vue-login" class="col-md-9 col-md-offset-2">
    <login-vue-component> <login-vue-component/>
</div>
<!------------------------------ END Vue Login component ----------------------------------------------->

<!-- Include js file for thisview only -->
<script src="{{ asset('js/login/login.js')}}"></script>
<!-- Include js file for thisview only -->

@endsection
