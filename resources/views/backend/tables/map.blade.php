@extends('layouts.app')

@section('content')
<?php $currency =  setting_by_key("currency"); ?>


<link href="{{url('assets/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{url('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>@lang('pos.tables')</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/')}}">@lang('common.home')</a>
                        </li>
                     
                        <li class="active">
                            <strong>@lang('Gestione Tavoli')</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
				<!-- Cancella tutto -->
											<a href="{{url('tables/clear')}}"class="btn btn-danger" onclick=" return confirm('Sei sicuro di voler cancellare?')"> Cancella</a>

                </div>
            </div>

             <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>@lang('Gestione Tavoli')	</h5>
                            
                        </div>
                        <div class="ibox-content">s
                        <div class="text-center  ">

                            <button type="button"  class="btn btn-w-m btn-success dim alltables">Tutti</button>
                            @foreach($rooms as $room)
                            <button type="button" data-id="{{$room->id}}" class="btn btn-w-m btn-warning dim selectRoom">Sala {{$room->id}}</button>
                            @endforeach
                        </div>
                        <br>
                        
                        <p class="text-center">
                            @foreach($tables as $table)
                                <?php 
                                   
                                    if($table->hold)  {
                                ?>
                                <a href="javascript:void(0);" type="button" data-hold="{{$table->hold_id}}" data-table="{{$table->id}}" data-id="{{$room->id}}" class="busyTable btn btn-w-m btn-danger dim selectTable selectTable{{$table->room_id}}"> {{$currency}}{{$table->total}} <br>{{$table->table_name}}</a>
                                    <?php } else { ?>
                                <a href="{{url('sales/create?t=' . $table->id)}}" target="_blank" type="button" data-id="{{$room->id}}" class="btn btn-w-m btn-primary dim selectTable selectTable{{$table->room_id}}"> <i class="fa fa-check"></i> <br>{{$table->table_name}}</a>
                                    <?php } ?>
                            @endforeach
				
			            </p>

                        <small> Note: Verde Libero, Rosso Occupato

                        </div>
                    </div>
            </div>
        </div>
    </div>

<?php

function clean($string) 
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add New</h4>
            </div>
            <form role="form" action="<?php echo url("tables/save"); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {!! csrf_field() !!} 

                    <div class="form-group">
                        <label> Name </label>
                        <input class="form-control" required type="text" id="title" name="table_name">
                        <input class="form-control" type="hidden" id="id" name="id">
                    </div>
                    <div class="form-group">
                        <label> Select Room </label>
                        <select class="form-control" name="room_id" id="room_id">
                            @foreach($rooms as $room) 
                                <option value="{{$room->id}}">{{$room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script type="text/javascript">

$("body").on("click" , ".alltables" , function() { 
    $(".selectRoom").addClass("btn-warning");
    $(".selectRoom").removeClass("btn-success");
    $(this).removeClass("btn-warning");
    $(this).addClass("btn-success");
    $(".selectTable").show();
});

$("body").on("click" , ".selectRoom" , function() { 
	$(".selectRoom").removeClass("btn-success");
	$(".selectRoom").addClass("btn-warning");
	$(this).removeClass("btn-warning");
	$(this).addClass("btn-success");
	$("#room_number").val($(this).attr("data-id"));
	$(".selectTable").hide();
	$(".selectTable" + $(this).attr("data-id")).show();
    $(".alltables").removeClass("btn-success");
    $(".alltables").addClass("btn-warning");
});
$("body").on("click" , ".selectTable" , function() { 
	
});



    $("body").on("click", ".add_new", function () {
        $("#title").val("");
        $("#id").val("");
    });
    $("body").on("click", ".edit", function () {
        var id = $(this).attr("data-id");
        var form_data = {
            id: id
        };
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '<?php echo url("tables/get"); ?>',
            data: form_data,
            success: function (msg) {
                var obj = $.parseJSON(msg);
                $("#title").val(obj['table_name']);
                $("#room_id").val(obj['room_id']);
                $("#id").val(obj['id']);
            }
        });

    });


    $("body").on("click", ".delete", function () {
        var id = $(this).attr("data-id");
        var form_data = {
            id: id
        };
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '<?php echo url("tables/delete"); ?>',
            data: form_data,
            success: function (msg) {
                $("#" + id).hide(1);
            }
        });
    });

</script>



<script src="{{url('assets/js/lodash.min.js')}}"></script>


<script type="text/javascript">    
 

let cart = [];
$("body").on("click" , ".busyTable" , function() { 
    var table_id = $(this).attr("data-table");
    var hold_id = $(this).attr("data-hold");
    $("#table_id").val(table_id);
    $("#hold_id").val(hold_id);

    var form_data = {
        id:hold_id
    }
    
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        },
        url: '<?php echo url("sale/view_hold_order"); ?>',
        data: form_data,
        success: function ( msg ) {
            cart = JSON.parse(msg);
            show_cart();
            $("#cart").val(msg);
        }
    });

    $("#myModall").modal("show");

});

$("body").on("click" , "#holdOrder" , function() { 
    var url = "<?php echo url("sales/create?h="); ?>" + $("#hold_id").val();
    
    window.open(url, '_blank').focus();

})



 $( "body" ).on( "click", "#completeOrder", function () {
		
		if ( cart.length < 1 || $("#CartHTML").html() == "") {

			$( "#myModal" ).modal( "hide" );

			swal( "", "Cart is Empty", "error" );

			return false;
		}
		
		var status = 1;
		// if($("#OrderType").val() == "order") { 
		// status = 2;
		// }
		var form_data = {
			
			discount: 0,
			cashier_id: $( "#cashier_id" ).val(),
			payment_with: $( "#payment_type" ).val(),
			type: "pos",
			status:status,
			vat: $( "#vat" ).val(),
			table_id: $( "#table_id" ).val(),
			delivery_cost: $( "#delivery_cost" ).val(),
			customer_id: $( "#customer_id" ).val(),
			items: _.map( cart, function ( cart ) {
				return {
					product_id: cart.product_id,
					size: cart.size,
					quantity: cart.quantity,
					note: cart.note,
					price: cart.price
				}
			} )
		};
		var total_amount = Number( localStorage.getItem( "total_amount" ) );
		_.map( cart, function ( cart ) {
			localStorage.setItem( "total_amount", total_amount + ( cart.quantity * cart.price ) );
		} );

		$( "#completeOrder" ).html( '<i class="fa fa-spinner fa-spin" style="font-size:18px"></i>' );
		$( "#completeOrder" ).prop( "disabled", true );

		$.ajax( {
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
			},
			url: '<?php echo url("sales/complete_sale"); ?>',
			data: form_data,
			success: function ( msg ) {

                var form_dataa = {
					id:$("#hold_id").val()
				}

				$("#holdOrderID").val("");
				$.ajax( {
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
					},
					url: '<?php echo url("sale/hold_order_remove"); ?>',
					data: form_dataa,
					success: function ( msg ) {
						
					}
				});

 $("#myModall").modal("hide");
				swal( {
					title: '@lang("pos.order_complete")',
					type: 'success',
					text: ''
				}).then( function () {
					location.reload();
				})
			}
		} );
	} );


  setInterval(page_refresh, 60000); //NOTE: period is passed in milliseconds
    function page_refresh() { 
        location.reload();
    }


</script>



<div class="modal inmodal" id="myModall" tabindex="-1" role="dialog" aria-hidden="true">

<div class="modal-dialog">

    <div class="modal-content animated bounceInRight confirm-modal">

        <div class="modal-header">

            <?php /*?><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?php */?>
            <h4 style="float:left; color:red" id="TableNoCart"></h4>
            <h4 class="modal-title" id="total_amount_model">0.00</h4>
        </div>

        <div class="modal-body clearfix">

            <input type="hidden" id="cashier_id" class="form-control" value="{{Auth::user()->id}}">
            <input type="hidden" id="vat" class="form-control" value="0.00">
            <input type="hidden" id="delivery_cost" class="form-control" value="0">
            <input type="hidden" id="total_amount" class="form-control" value="0">
            <input type="hidden" id="customer_id" class="form-control" value="">
            <input type="hidden" id="table_id" class="form-control" value="">
            <input type="hidden" id="hold_id" class="form-control" value="">
            <input type="hidden" id="cart" class="form-control" value="">

            <input type="hidden" id="payment_type" class="form-control" value="Cash">

            <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-warning"  id="holdOrder" >@lang('Visualizza e Stampa')</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">@lang('pos.close')</button>
                <input type="hidden" value="" id="id" />
                <input type="hidden" value="Yes" id="VatInclude" />
                <button type="button" id="completeOrder" class="btn btn-primary">@lang('pos.complete_order')</button>
               
            </div>

        </div>

    </div>

</div>

</div>

<script> 
function show_cart() {
		if ( cart.length > 0 ) {
			var qty = 0;
			var total = 0;
			var cart_html = "";
			var obj = cart;
			$.each( obj, function ( key, value ) {
				
				qty = Number( value.quantity );
				total = Number( total ) + Number( value.price * qty );
			} );

var vat = 0;
var discount = 0;
			<?php //if(Auth::user()->role_id == 1) { ?>
			// var VatInclude = $("#VatInclude").val();
			
			// if(VatInclude == "Yes") { 
			// 	vat = ( Number( total ) * <?php // echo setting_by_key("vat"); ?> ) / 100;
			// }
			
			
			<?php // } ?>

		

		

			var total_amount = Number( total );
			$( "#total_amount" ).val( total_amount );		
			$( "#total_amount_model" ).html("<?php echo $currency; ?>" + total_amount.toFixed( 2 ) );		
			$( "#vat" ).val( vat );

		} else {
				$( ".TotalAmount" ).html( 0 );
				$( "#p_subtotal" ).html( "0.00" );
				$( "#total_amount_model" ).html( "0.00" );
				$( "#p_hst" ).html( "0.00" );
				$( "#CartHTML" ).html( "" );
		}
		
		

	}

</script>


@endsection
