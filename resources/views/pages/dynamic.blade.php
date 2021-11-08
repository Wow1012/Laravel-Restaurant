@extends('frontend.appother')

@section('content')

 <!-- Header Area Start 
    ====================================================== -->
    <section class="banner-sec internal-banner" style="background-image:url(assets/frontend/img/other_page.jpg)">
    
        <!-- Start: slider-overview -->
        <div class="balck-solid">
        
        	<!-- Start: slider -->
            <div class="container">
                <div class="banner-mid-text internal-header">
                
                    <!-- Start: flexslider -->
                    <div class="flexslider">
                        <ul>
                            <!-- Start: flexslider-one -->
                            <li>
                            	<h2>{{$page->title}}</h2>
                                <div class="hr-outtr-line"><hr><i class="fa fa-glass"></i><hr></div>
                            </li>
                            <!-- End: flexslider-one -->
                        </ul>
                    </div>
                    <!-- End: flexslider -->
            
                </div>
            </div> 
            <!-- End: slider -->
            
        </div>  
        <!-- End: slider-overview -->
    </section>
    <!-- =================================================
    Header Area End -->
    
    
    <!-- About Our Story  Area Start 
    ====================================================== -->
    <section class="about-story-area" id="Welcome">
    	<div class="container">
            <div class="row">
			
				<h2>{{$page->title}}</h2>
                <div class="hr-outtr-line"><hr><i class="fa fa-glass"></i><hr></div>
                
				
				
                <div class="abut-stry-mid">
				@if(file_exists('uploads/pages/' . $page->image))  
                    <!-- Start: Our Story-left -->
                    <div class="col-md-6 abut-story-left">
                        <img src="{{url('uploads/pages/' . $page->image)}}" alt="">
                    </div>
                    <!-- End: Our Story-left -->
				@endif
                    
                    <!-- Start: Our Story-right -->
					@if(file_exists('uploads/pages/' . $page->image))
						<div class="col-md-6 abut-story-right">
					@else
						 <div class="col-md-12 abut-story-right">
					@endif
					{!! $page->body !!}

                    </div>
                    <!-- End: Our Story-right -->
                </div>
                
            </div>
        </div>
        </div>
    </section>
    <!-- =================================================
    About Our Story  Area End -->
    <br>
    <br>
    <br>
    <br>
   
@endsection