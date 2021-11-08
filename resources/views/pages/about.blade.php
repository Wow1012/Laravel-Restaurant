@extends('frontend.appother')

@section('content')

 <!-- Header Area Start 
    ====================================================== -->
    <section class="banner-sec internal-banner" style="background-image:url(assets/frontend/img/about-banner.jpg)">
    
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
                            	<h2>About Us</h2>
                                <div class="hr-outtr-line"><hr><i class="fa fa-heart" aria-hidden="true"></i><hr></div>
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
                <h2><span>Discover</span>Our Story</h2>
                <div class="hr-outtr-line"><hr><i class="fa fa-heart" aria-hidden="true"></i><hr></div>
                
                <div class="abut-stry-mid">
                    <!-- Start: Our Story-left -->
                    <div class="col-md-6 abut-story-left">
                        <img src="{{url('uploads/pages/' . $page->image)}}" alt="">
                    </div>
                    <!-- End: Our Story-left -->
                    
                    <!-- Start: Our Story-right -->
                    <div class="col-md-6 abut-story-right">
					{!! $page->body !!}

                    </div>
                    <!-- End: Our Story-right -->
                </div>
                
            </div>
        </div>
    </section>
    <!-- =================================================
    About Our Story  Area End -->
    
   
@endsection