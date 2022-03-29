@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 col-md-offset-1">
            <div class="panel panel-default">
			
			    <!-- Flash message if Success -->
				@if(session()->has('flashMessageX'))
                    <div class="alert alert-success">
                        {!! session()->get('flashMessageX') !!} <!--Displays content without html escaping -->
                    </div>
                @endif
				<!-- Flash message -->
				

                <!-- Flash message if Failed -->
				@if(session()->has('flashMessageFailX'))
                    <div class="alert alert-danger">
                        {!! session()->get('flashMessageFailX') !!} 
                    </div>
                @endif
				<!-- Flash message if Failed -->				
				

                <!-- Display form validation errors var 2 -->
				@if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <!-- End Display form validation errors var 2 -->				
											
                <div class="panel-heading text-warning borderX" style="border:1px solid black;">
				    <p>
					    <img class="vue-logo" src="{{URL::to("/")}}/images/admin.jpg"  alt="a"/>
				        <button style="font-size:28px">Wpress Admin Part <span class="tiny-text">(Passport + Spatie RBAC)</span> <i class="fa fa-book"></i></button>
					</p>
				    WpBlog with Images on Vue.js framework + Vuex Store 
				</div>
                
                <div class="alert alert-danger">
                   <p>Admin Part: View/Edit/Delete</p>
                   <p>Currently Admin Part is protected by Spatie RBAC via middleware. It protects access to REST controller (in routes/api.php)</p>
                </div>
                
                <div class="panel-body">
		        </div>
		    </div>
			
			<!----------- Vue.js Components + VUEX Store + VUE ROUTER ------------>	 
			<div class="col-sm-12 col-xs-12" >

			    <!-- Show blogs quantity component -->
				<div id="quant" class="col-sm-12 col-xs-12">
					<show-quantity-of-posts/> <!-- Vue component -->
                </div>
                    
			    <!-- Vue route menu. Main -->
			    <div  id="vue-menu" class="col-sm-12 col-xs-12">  
                    <!-- My Vue component with Menu Links -->
                    <vue-router-menu-with-link-content-display> </vue-router-menu-with-link-content-display/>
                </div>
					
            </div>		
		    <!----------- Vue.js Componenet + VUEX ------------>	 		
					
        </div>
    </div>
</div>

<!--------- Loader (for ajax, hidden by default) ----------------->
<div class="loader-x">
    <img src="{{URL::to("/")}}/images/loader-black.gif"  alt="a"/>
</div>
<!--------- Loader (for ajax, hidden by default)  ----------------->

@endsection
