<!DOCTYPE html>
<html lang="en-US">
 @include('frontend.head')


<body>

    <!-- Preloader Area Start 
    ====================================================== -->
    <div id="mask">
        <div id="loader">      
        </div>
    </div>
    <!-- =================================================
    Preloader Area End -->
    
    
    <!-- Header Area Start 
    ====================================================== -->

	
        @include('frontend.header')
        @include('frontend.slider')
        
        @yield('content')
		@include('frontend.footer')
		 
</body>
</html>