@extends('frontend.app')

@section('content')

<!-- Our Story  Area Start 
    ====================================================== -->
    <section class="story-area" id="Welcome">
    	<div class="container">
            <div class="row">
                <!-- Start: Our Story-left -->
                <div class="col-md-6 story-left">
                    <img src="assets/frontend/img/about-01.jpg" alt="">
                </div>
                <!-- End: Our Story-left -->
                
                <!-- Start: Our Story-right -->
                <div class="col-md-6 story-right">
                    <div class="story-our-text">
                        <h2>{!!homepage_by_key('story_title')!!}</h2>
                        <div class="hr-outtr-line"><hr><i class="fa fa-heart" aria-hidden="true"></i><hr></div>
                        <p>{!!homepage_by_key('story_desc')!!}</p>
                        <a href="#">About Us</a>
                    </div>
                </div>
                <!-- End: Our Story-right -->
            </div>
        </div>
    </section>
    <!-- =================================================
    Our Story  Area End -->
    
    
    <!-- Parallax-01 Area Start 
    ====================================================== -->
    <section class="parallax-action">
    <div class="balck-solid-paralax"></div>
    	<div class="container">
        	<div class="row">
            	<!-- Start: parallax-content -->
            	<div class="parallax-content-sec">
                	{!!homepage_by_key('img_title1')!!}
                </div>
                <!-- End: parallax-content -->
            </div>
        </div>
    </section>
    <!-- =================================================
    Parallax-01 Area End -->
    
    
    <!-- Our Menu Area Start 
    ====================================================== -->
    <section class="menu-area" id="Menu">
        <div class="container">
            <div class="row">
                <div class="menu-content-mid">
                    <h2>{!!homepage_by_key('menu_title')!!}</h2>
                    <div class="hr-outtr-line"><hr><i class="fa fa-heart" aria-hidden="true"></i><hr></div>
                    <p>{!!homepage_by_key('menu_desc')!!}</p>
                    <div class="menu-items-box clearfix">
					
                    <?php $cat_array = array();
                    $cats = homepage_by_key('category');
					
                    if(!empty($cats)) {
                        foreach(explode(",", $cats) as $c) { 
                            $cat_array[] = getCategory($c);
                        }
                        $category = explode(",", $cats);
                    }   
					
        ?>
                        <!-- Start: Menu-Starters -->
						@if(!empty($cats))
                        @foreach($cat_array as $cat)
                        <a href="{{url('our-menu')}}" class="menu-items col-md-3">
                            <div class="overlay-outr">
                                <figure class="img-hme">
                                <img src="{{asset('uploads/category/thumb/' . $cat->id . '.jpg')}}" alt="">
                                </figure>
                                <span class="overlay-sec"></span>                            </div>
                            <div class="text-outr">
                                <strong>{{$cat->name}}</strong>
                            </div>
                        </a>
                        @endforeach 
						@endif
                        
                    </div>
                    
                    <a href="{{url('our-menu')}}">View The Full menu</a>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- =================================================
    Our Menu Area End -->
    
    
    <!-- Parallax-02 Area Start 
    ====================================================== -->
    <section class="parallax-action-two">
    <div class="balck-solid-paralax"></div>
        <div class="container">
            <div class="row">
                <!-- Start: parallax-content -->
                <div class="parallax-content-sec">
                {!!homepage_by_key('img_title2')!!}
                    
                </div>
                <!-- End: parallax-content -->
            </div>
        </div>
    </section>
    <!-- =================================================
    Parallax-02 Area End -->
    
    
    <?php /*   <!-- Reserve  Area Start 
    ====================================================== -->
    <section class="story-area reserve" id="Reservations">
    	<div class="container">
            <div class="row">
                <!-- Start: Our Story-left -->
                <div class="col-md-6 story-left">
                    <img src="assets/frontend/img/flwr-img.png" alt="">
                </div>
                <!-- End: Our Story-left -->
                
                <!-- Start: Our Story-right -->
                <div class="col-md-6 story-right">
                    <div class="story-our-text">
                        <h2><span>Reserve</span>Your Dining</h2>
                        <div class="hr-outtr-line"><hr><i class="fa fa-glass"></i><hr></div>
                        <p>accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.</p>
                        <a href="#">Reserve Now</a>
                    </div>
                </div>
                <!-- End: Our Story-right -->
            </div>
        </div>
    </section>
    <!-- =================================================
    Reserve  Area End --> */ ?>

@endsection
