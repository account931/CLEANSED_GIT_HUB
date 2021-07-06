
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
                        {!! session()->get('flashMessageFailX') !!} <!--Displays content without html escaping -->
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
				        <button style="font-size:24px">Get token <i class="fa fa-book"></i></button>
					</p>
				</div>

                <div class="panel-body">
		        </div>
		    </div>
				 
				 
				 
					
			<div class="col-sm-12 col-xs-12" >
                @if ($userToken != null)
                    <div class="alert alert-success">
                        <center>
                            <h4> You have alredy your token </h4>
                            <p class="alert ">{{$userToken}} </p>
                        </center>
                    </div>    
			 	@else
                    <div class="alert alert-danger">
                        <p> You have no token. Generate? </p>
                        <p> <a href="{{ url('/generateToken') }}"><button class="btn"> Generate </button> </a> </p>
                    </div> 
                @endif
               
            </div>
            
            
        </div>
    </div>
</div>





@endsection
