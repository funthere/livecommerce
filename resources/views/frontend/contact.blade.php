@extends('frontend')

@section('content')

	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
						<iframe id="gmap" class="contact-map" frameborder="0" style="border:0;" src="https://www.google.com/maps/embed/v1/place?q=place_id:{{$global_params['place_id'] or 'ChIJtwRkSdcHTCwRhfStG-dNe-M'}}&amp;key=AIzaSyAqU2k81RVk8eWh795VIPSUhqVwxkkKJf0" allowfullscreen></iframe>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
	    				{!!Form::open(['class' => 'contact-form row', 'name' => 'contact-form', 'id' => 'main-contact-form'])!!}
	    				@include('partials.error')
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" value="{{old('name')}}" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" value="{{old('email')}}" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" value="{{old('subject')}}" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here">{{old("message")}}</textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>{{$global_params['nama_perusahaan']}}</p>
							<p>{{$global_params['alamat_toko']}}</p>
							<p></p>
							<p>Mobile: {{$global_params['telepon']}}</p>
							<p>Email: {{$global_params['telepon']}}</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="{{$global_params['facebook']}}"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="{{$global_params['twitter']}}"><i class="fa fa-twitter"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->

@stop