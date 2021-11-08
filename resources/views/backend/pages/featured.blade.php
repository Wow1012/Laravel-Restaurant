@extends('backend.layouts.app')

@section('content') 


<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="dashboard">@lang('common.home')</a>
        </li>



        <li class="active">Payment</li>
    </ul><!-- /.breadcrumb -->


</div>
<div class="panel-body">


<br> <br>
		 <div class="col-xs-12 col-md-5">
       
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form role="form" id="payment-form" method="POST" action="<?php echo url("/postPayment"); ?>">
                    {!! csrf_field() !!}
                    <span style="color:red" class="payment-errors"></span>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">CARD NUMBER</label>
                                    <div class="input-group">
                                       <input type="text" class="form-control" placeholder="################" size="20" data-stripe="number">
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <input type="hidden" name="property_id" value="<?php echo $property->id; ?>" />
                        <input type="hidden" name="property_title" value="<?php echo $property->title; ?>" />
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-inline">
                                    <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                   <input type="text" class="form-control" placeholder="MM" size="4" data-stripe="exp-month">
                                    <p class="form-control-static">/</p>
                                    <input type="text" class="form-control"  placeholder="YYYY" size="4" data-stripe="exp-year">
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">CV CODE</label>
                                    <input type="text" class="form-control" placeholder="###" size="4" data-stripe="cvc">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit Payment">
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
            OR 
            <br>
            <br>
    <?php  $setting = get_setting(); ?>
    <?php if($setting->paypal_mode == "test") { ?>
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <?php } else { ?>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <?php } ?>
                <input type="hidden" value="_cart" name="cmd">
                <input type="hidden" value="1" name="upload">
                <input type="hidden" value="<?php  echo $setting->paypal_email; ?>" name="business">
                <input type="hidden" value="<?php echo $property->title; ?>" name="item_name_1">
                <input type="hidden" value="<?php echo $setting->featured_price;?>" name="amount_1">
                <input type="hidden" value="1" name="quantity_1">
                <input type="hidden" value="<?php echo $property->id;?>" name="custom">
                <input type="hidden" value="<?php echo url("listing/featured/" .$property->id); ?>" name="notify_url">
                <input type="hidden" value="<?php echo url("paypalCallback"); ?>" name="return">
                <input type="hidden" value="2" name="rm">
                <input type="hidden" value="Return to The Store" name="cbt">
                <input type="hidden" value="<?php echo url("listing/featured/" .$property->id); ?>" name="cancel_return">
                <input type="hidden" value="USD" name="lc">
                <input type="hidden" value="<?php echo $setting->currency;?>" name="currency_code">
                <input type="image" alt="Make payments with PayPal - its fast, free and secure!" name="submit" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif">
            </form>
            
            
            
        </div>            
        
        <div class="col-xs-12 col-md-7" style="font-size: 12pt; line-height: 2em;">
            <p><h3>Details</h3>
                <ul>
                    <li><strong>Amount :</strong> <?php echo $setting->currency . $setting->featured_price;?></li>
                    <li><strong>Property :</strong> <?php echo $property->title;?></li>
                    <li><strong>Address : </strong><?php echo $property->address;?></li>
                    
                    
                </ul>
            </p>
            
        </div>
        
        <style> 
            .credit-card-box .panel-title {
                display: inline;
                font-weight: bold;
            }
            .credit-card-box .form-control.error {
                border-color: red;
                outline: 0;
                box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
            }
            .credit-card-box label.error {
              font-weight: bold;
              color: red;
              padding: 2px 8px;
              margin-top: 2px;
            }
            .credit-card-box .payment-errors {
              font-weight: bold;
              color: red;
              padding: 2px 8px;
              margin-top: 2px;
            }
            .credit-card-box label {
                display: block;
            }
            /* The old "center div vertically" hack */
            .credit-card-box .display-table {
                display: table;
            }
            .credit-card-box .display-tr {
                display: table-row;
            }
            .credit-card-box .display-td {
                display: table-cell;
                vertical-align: middle;
                width: 50%;
            }
            /* Just looks nicer */
            .credit-card-box .panel-heading img {
                min-width: 180px;
            }
        </style>



    <!-- PAGE CONTENT BEGINS -->
    <div class="page-content"> 
      <!-- #section:pages/pricing.large --> 
      
      <script type="text/javascript" src="https://js.stripe.com/v2/"></script> 
      <script type="text/javascript">
                Stripe.setPublishableKey('pk_test_EN9mCtJUh2pp2dse6woPPGDm');
                
                jQuery(function($) {
              $('#payment-form').submit(function(event) {
                
                // Grab the form:
                var $form = $(this);

                // Disable the submit button to prevent repeated clicks:
                $('#submit').prop('disabled', true);

                // Request a token from Stripe:
                Stripe.card.createToken($form, stripeResponseHandler);

                // Prevent the form from being submitted:
                return false;
              });
            });
            
            
            function stripeResponseHandler(status, response) {response

              // Grab the form:
              var $form = $('#payment-form');

              if (response.error) { // Problem!

                // Show the errors on the form:
                $form.find('.payment-errors').text(response.error.message);
                $('#submit').prop('disabled', false); // Re-enable submission

              } else { // Token was created!

                // Get the token ID:
                var token = response.id;

                // Insert the token ID into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="stripeToken">').val(token));

                // Submit the form:
                $form.get(0).submit();
              }
            };

            </script>
      <!-- /section:pages/pricing.large --> 
    </div>
    </div>
    
    
    
    
    <div class="ajax-loading"></div>
    <style> 
        .ajax-loading {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('<?php echo url("/"); ?>/assets/ajax-loader.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .ajax-loading {
    display: block;
}
    </style>
    <script type="text/javascript"> 
    
        $body = $("body");
        $(document).on({
            ajaxStart: function() { $body.addClass("loading");    },
             ajaxStop: function() { $body.removeClass("loading"); }    
        });
        
        </script>
        
@endsection 
