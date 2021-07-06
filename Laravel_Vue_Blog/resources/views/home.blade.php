@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                                    
                
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
					
					
                    <div class="panel-heading text-warning">
                        <i class="fa fa-window-restore" style="font-size:84px"></i>
                        Laravel Vue Blog with VUEX Store <span class="small text-danger">*</span> 
                    </div>
                    <div class="panel-body">
                                         
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Laravel Rest Api Blog on Vue + Vuex Store + Vue Router + Bearer token Header Authentication (middleware 'auth:api'). </p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Uses UI Toolkit Element-UI, Vue 2.0 based component library. </p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Login/password auth via session, REST API auth via Bearer token . </p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Token is User's table 'api_token' field. </p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Blog with images </p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Loaded via ajax, Rest Api Endpoints </p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Uses Vuex Store </p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> Auth via token.</p>
                        <p> <i class="fa fa-check-circle-o" style="font-size:24px"></i> <a href="{{ route('wpBlogVueFrameWork')}}"> Go to Blog </a></p>
                    </div>
                
                </div>          
            </div>
        </div>
    </div>
</div>
@endsection
