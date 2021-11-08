

<!-- Subscribe Our Newsletter Area Start 
    ====================================================== -->
    <section class="subscribe-area">
    	<div class="container">
            <div class="row">
                <!-- Start: Speak-left -->
                <div class="subscribe-left">
                    <img src="assets/frontend/img/news-ltr-img.png" alt="">
                </div>
                <!-- End: Speak-left -->
                
                <!-- Start: Speak-right -->
                <div class="subscribe-right">
                    <div class="subscribe-newsletr">
                        <h4>Subscribe Our Newsletter</h4>
                        <input type="text" id="email_newsletter" placeholder="Enter Your Email">
                        <button type="button" class="subscribeNewsletter">Subscribe</button>
                    </div>
                </div>
                <!-- End: Speak-right -->
            </div>
        </div>
    </section>
    <!-- =================================================
    Subscribe Our Newsletter Area End -->
    
    <!-- Footer Black Area Start 
    ====================================================== -->
    <section class="footer-black">
    	<div class="container">
            <div class="row">
                <!-- Start: Footer Black Area -->
				<div class="ftr-black-middle">
                    <!-- Start: Footer Working Hours Section -->
                    <div class="col-md-4 ftr-black-left">
                        <h6>Working Hours</h6>
                        <hr>
                        <div class="two-itm-btm">
                            <p>Monday To Thursday : <span> {!! setting_by_key('timing1')!!}</span></p>
                            <p>Sunday<span> {!! setting_by_key('sunday')!!}</span></p>
                        </div>
                    </div>
                    <!-- End: Footer Working Hours Section -->
					
					 <!-- Start: Footer Our Locations Section -->
                    <div class="col-md-4 ftr-black-rgt">
                        <h6>Other Pages</h6>
                        <hr>
                        <div class="two-itm-btm">
                            <p><a href="{{url('faq')}}"> FAQs </a> <br> 
                            <p><a href="{{url('terms-condition')}}"> Term & Conditions</a> </p>
                            <p><a href=""> </a> </p>
                        </div>
                    </div>
                    <!-- End: Footer Our Locations Section -->
					
					
                    
                    <!-- Start: Footer Our Locations Section -->
                    <div class="col-md-4 ftr-black-rgt">
                        <h6>Address & Info</h6>
                        <hr>
                        <div class="two-itm-btm">
                            <p>{!! setting_by_key('address')!!}, {!! setting_by_key("country") !!} </p>
                            <p> {!! setting_by_key('email')!!}, {!! setting_by_key('phone')!!}</p>
                        </div>
                    </div>
                    <!-- End: Footer Our Locations Section -->
                    
                </div>	
                <!-- End: Footer Black Area -->
            </div>
        </div>
    </section>
    <!-- =================================================
    Footer Black Area End -->
	
	<!-- Scroll to Top Start 
    ====================================================== -->

	<a href="#" id="return-to-top"><i class="fa fa-chevron-up faa-float animated"></i></a>
    
    <!-- =================================================
    Scroll to Top End -->
    
	
		
		<!-- Footer Area Start 
    ====================================================== -->
    <footer class="footer-area">
    	<div class="container">
        	<div class="row">
                <!-- Start: Footer Social Icons Section -->
                <div class="social-icons">
                	<ul>
                    	<li><a href="{{ setting_by_key('facebook') }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    	<li><a href="{{ setting_by_key('twitter') }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    	<!-- <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    	<li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li> -->
                    </ul>
                </div>
                <!-- End: Footer Social Icons Section -->
                <p>&copy; {{ setting_by_key('title') }} •  {{date('Y')}}  <a href="#"> Bit Solution</a></p>
            </div>
        </div>
    </footer>
    <!-- =================================================
    Footer Area End -->
    
    
    <script type="text/javascript" src="{{url('assets/frontend/js/bootstrap.js')}}"></script><!-- Bootstrap Js -->
    <script type="text/javascript" src="{{url('assets/frontend/js/jquery.flexslider.js')}}"></script><!-- Flexslider Js -->
    <script type="text/javascript" src="{{url('assets/frontend/js/jquery.isotope.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/frontend/js/jquery.magnific-popup.js')}}"></script>

    <script type="text/javascript" src="{{url('assets/frontend/js/settings.js')}}"></script><!-- Settings Js -->
    <script type="text/javascript" src="{{url('assets/frontend/js/forms.js')}}"></script><!-- Contact Form Js -->
	
	<script type="text/javascript"> 
	$("body").on("click" , ".subscribeNewsletter" , function() {
		var email = $("#email_newsletter").val();
		var form_data = { 
			email : email
		};
		
		$.ajax({
								type: 'POST',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								url: '<?php echo url("newsletter/store"); ?>',
								data: form_data,
								success: function (msg) {
									if(msg == "already") { 
										swal("Great" , "You are already Subscribed" , "info");
										return false;
									}
									swal("Great" , msg , "success");
								}	
							});
	});
	</script>