<?php $sliders = getSlider(); ?>

<!-- Header Area 
    ====================================================== -->
    <section class="banner-sec clearfix">
        <!-- Start: flexslider -->
        <div id="banner-slider" class="flexslider clearfix">
            <ul class="slides">
                @foreach($sliders as $slider) 
                <!-- Start: flexslider-one -->
                <li class="bg-banner-full slider_one" style="background:url({{url('uploads/slider/' . $slider->image)}}) no-repeat fixed; background-size:cover;">
                    <div class="balck-solid">
                    <div class="banner-mid-text">
                        <div class="container">
                        <h1>{!!$slider->title!!}</h1>
                        </div>
                    </div>
                    </div>
                </li>
                
                @endforeach
               
            </ul>
        </div>
        <!-- End: flexslider -->
    </section>
    <!-- =================================================
    Header Area End -->
    
