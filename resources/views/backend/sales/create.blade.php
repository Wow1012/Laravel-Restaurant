@extends( 'layouts.app' )
@section( 'content' )
<?php $currency =  setting_by_key("currency");
//ALTER TABLE `customers`  ADD `neighborhood` VARCHAR(255) NULL;
//ALTER TABLE `customers` ADD `comments` VARCHAR(255) NULL;
 ?>
<link href="{{url('assets/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{url('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
<script src="{{url('assets/js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

<div class="wrapper wrapper-content animated fadeInRight">

	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
			<div class="row">
				<div class="col-sm-12">

					<div class="ibox" style="margin-bottom: 0px;">
						<div class="ibox-title">
							<h5>@lang('pos.cart_items') <span id="TableNo"> </span></h5>
							<button type="button" class="btn btn-sm btn-success m-r-sm"  style="float:right; margin:-7px 7px;  " data-toggle="modal" data-target="#myTableModal">T</button>
							<button data-price="1" data-id="1000" data-key="S" style="float:right; margin:-7px;margin-left:4px !important;" data-size="S" data-name="Servizio" type="button" class="btn btn-sm btn-primary m-r-sm AddToCartNoteS tag-margin tag-btn">S</button> 					
							<button data-price="1" data-id="1001" data-key="M" style="float:right; margin:-7px;  " data-size="S" data-name="Servizio" type="button" class="btn btn-sm btn-primary m-r-sm AddToCartNoteM tag-margin tag-btn" >M</button> 					
							
						</div>
						<div class="ibox-content" id="car_items" style="padding: 5px;">
							<div class="cart-table-wrap">

								<table width="100%" border="0" style="border-spacing: 5px; border-collapse: separate;" class="">

									<tbody id="CartHTML">

									</tbody>

								</table>
							</div>
							<hr>
							<table width="100%" border="0" style="border-spacing: 5px; border-collapse: separate;" class="">

								<tbody>

									<tr>

										<td>

											<h4>@lang('pos.sub_total')</h4>

										</td>

										<td class="text-right">

											<h4 id="p_subtotal">0.00</h4>

										</td>
									</tr>
									@if(Auth::user()->role_id == 1)
									<tr>

										<td>

											<h4>@lang('pos.discount')</h4>

										</td>

										<td class="text-right">
											<i style="font-size:20px" id="updateDiscount" class="fa fa-refresh"></i> <input type="number" id="discount_p" value="0">
										</td>
									</tr> 
									<tr>

										<td>

											<h4>@lang('pos.tax')(<?php echo setting_by_key("vat"); ?>%)</h4>

										</td>

										<td class="text-right">

											<h4 id="p_hst">0.00</h4>

										</td>
									</tr>
									@endif
									
									<tr>
										<td colspan=2>
										<select id="OrderType" style="display:none" class="form-control"> 
											<option value="pos" >@lang('online_orders.order_store')</option>
											<option value="order">@lang('online_orders.order_home')</option>
										</select>
										</td>
									</tr>
									<input type="hidden" id="OrderType" value="pos">
								</tbody>

							</table>

						</div>
						<div class="panel-footer green-bg">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
										<td>

											<h4><strong>@lang('pos.total')</strong></h4>

										</td>
										<td class="text-right ">

											<h4 class="TotalAmount">0</h4>

										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="ibox-content" style="padding-bottom: 0px;">
						<div class="row">							
						<div class="col-sm-6 col-md-12 col-lg-6">
								@if(Auth::user()->role_id != 1)
								<div class="form-group">
									<button type="button" id="holdOrder" class="btn btn-primary btn-block text-center">@lang('Ordina')</button>		 
								</div>
								@else 
								<div class="form-group">
									<button type="button" id="holdOrder" class="btn btn-primary btn-block text-center">@lang('Ordina')</button>		 
								</div>
								<div class="form-group">
									<button type="button" id="completeOrder" class="btn btn-primary btn-block text-center">@lang('Completa e stampa')</button>		
										 
								</div>
								
								@endif
						</div>
						@if(Auth::user()->role_id == 1)
							<div class="col-sm-6 col-md-12 col-lg-6">
								<div class="form-group">
									<button type="button" id="ClearCart" class="btn btn-danger btn-block text-center">@lang('pos.clear_cart')</button>
								</div>
							</div>
								<div class="col-sm-6 col-md-12 col-lg-6">
								<div class="form-group">
									<button type="button" id="ClearCart" class="btn btn-danger btn-block text-center">@lang('Libera tavolo')</button>
							<a href="{{url('tables/map')}}"class="btn btn-primary btn-block text-center">@lang('Mappa tavoli')</a>


               
								</div>
							</div>
							@else
						
							@endif
						</div>
						

						<div class="row">							
							<div class="col-sm-6 col-md-12 col-lg-12">
									<div class="form-group">
										<button type="button" id="holdOrders" class="btn btn-success btn-block text-center">@lang('pos.hold_tables')</button>		 
									</div>
							</div>
							
						</div>
						
					</div>

				</div>
				
			</div>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="ibox float-e-margins">
				<div class="ibox-title" style="margin-bottom: 10px;">
					<div class="toolbar mb2 mt2">
						<button class="btn fil-cat" href="" data-rel="all">@lang('common.all')</button> @foreach($categories as $category)
						<button class="btn fil-cat" data-rel="{{$category->id}}">{{ $category->name }}</button> @endforeach

					</div>				
				</div>
					<div class="ibox-content m-b-sm border-bottom">

                <div class="row">

                    <div class="col-sm-8">

                        <div class="form-group">

                            <input type="text" id="product_name" name="product_name" value="" placeholder="Cerca" class="form-control">

                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myTableModal">Tutti T</button>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#busyTableModal">Occupati</button>

                        </div>

                    </div>
                </div>
            </div> 

			<script>
$(document).ready(function(){
  $("#product_name").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#portfolio .ssHere").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
	<?php $imageWidth= 50; if(Auth::user()->role_id == 1) { 
		$imageWidth = 100;
	} ?>
				<div class="row" id="portfolio">

					@foreach($products as $product)
					@if($product->category_id != 0)
					<div class="col-xs-6 col-sm-4 col-md-6 col-lg-2 {{$product->category_id}} all ssHere">
						<div class="widget white-bg text-center product_list h-100">
							@if(file_exists('uploads/products/' . $product->id . '.jpg'))
							<img width="{{$imageWidth}}px" alt="image" class="img-circle" src="{{url('uploads/products/thumb/' . $product->id . '.jpg')}}">
							<h2 class="m-xs heading-size_image">{{$product->name}}</h2> @else
							<img width="{{$imageWidth}}px" alt="image" class="img-circle" src="{{url('herbs/noimage.jpg')}}">
							<h2 style="padding-left:5px; text-align:left" class="m-xs heading-size_image">{{$product->name}}</h2> @endif
							<?php $prices = json_decode($product->prices); $titles = json_decode($product->titles);?> @foreach($titles as $key=>$t)
							<button data-price="{{$prices[$key]}}" data-id="{{$product->id}}" data-key="{{$key}}" data-size="{{$t}}" data-name="{{$product->name}} ({{$t}})" type="button" class="btn btn-sm btn-primary m-r-sm AddToCartNote tag-margin tag-btn">{{ $t }}</button> @endforeach						
							</div>
					</div>
					@endif
					@endforeach
				</div>			</div>
		</div>
	</div>
</div>

<input type="hidden" id="hold_id"  class="form-control" @if(!empty($holdOrder))  value="{{$holdOrder->id}}" @endif>

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">

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

				<input type="hidden" id="payment_type" class="form-control" value="Cash">

		
				<div class="col-sm-12">

					<p class="text-center">@lang('pos.how_would_you_pay')</p>

				</div>

				<div class="col-sm-3 col-sm-offset-3">

					<div class="form-group text-center">

						<div data-id="Cash" class="payment-option-icon text-success">

							<i class="fa fa-money fa-4x"></i>

						</div>

					</div>

				</div>

				<div class="col-sm-3">

					<div class="form-group text-center">

						<div data-id="Card" class="payment-option-icon">

							<i class="fa fa-credit-card fa-4x"></i>

						</div>

					</div>

				</div>
				<div class="clearfix"></div>

				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" id="total_given" placeholder="@lang('pos.total_paid')" class="form-control numberPad">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" id="change" readonly placeholder="@lang('pos.change')" class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						 <select class="form-control" id="table_id">
							 @foreach ($tables as $table)
								<option value="{{$table->id}}">{{$table->table_name}}</option>
							 @endforeach
							
						 </select>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<textarea id="comments" placeholder="@lang('pos.comment')" class="form-control"></textarea>
					</div>
				</div>

				<div class="col-sm-12 text-right">
					<button type="button" class="btn btn-warning"  id="holdOrder" >@lang('Invio ordine')</button>
					<button type="button" class="btn btn-white" data-dismiss="modal">@lang('pos.close')</button>
					<input type="hidden" value="" id="id" />
					<input type="hidden" value="Yes" id="VatInclude" />
					@if(Auth::user()->role_id == 1)
					<button type="button" id="completeOrder" class="btn btn-primary">@lang('pos.complete_order')</button>
					@endif
				</div>

			</div>

		</div>

	</div>

</div>


<div class="modal inmodal" id="ItemNoteModal" tabindex="-1" role="dialog" aria-hidden="true">

<div class="modal-dialog">
	<div class="modal-content animated bounceInRight confirm-modal">
		<div class="modal-header">
			<h4 class="modal-title" id="ItemNote">Note</h4>
		</div>
		<div class="ibox-content">
		<div class="chat-form">
		
			<form role="form">
				<div class="form-group">
					<textarea class="form-control" id="itemNote" placeholder="Note"></textarea>
				</div>
				<div class="text-right">
					<button type="button" class="btn btn-sm btn-primary m-t-n-xs addToCartFinal"><strong>Aggiungi</strong></button>
				</div>
			</form>
		</div>
		</div>
</div>

</div>

<div class="modal inmodal" id="manualModal" tabindex="-1" role="dialog" aria-hidden="true">

<div class="modal-dialog">
	<div class="modal-content animated bounceInRight confirm-modal">
		<div class="modal-header">
			<h4 class="modal-title" id="ItemNote">Prodotto manuale</h4>
		</div>
		<div class="ibox-content">
		<div class="chat-form">
		
			<form role="form">
				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" id="m_name" placeholder="Nome" class="form-control ">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" id="m_price" placeholder="Prezzo" class="form-control">
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<textarea class="form-control" id="m_note" placeholder="Note"></textarea>
					</div>
				</div>
				<div class="text-right">
					<button type="button" class="btn btn-sm btn-primary m-t-n-xs addToCartFinalMM"><strong>Aggiungi</strong></button>
				</div>
			</form>
		</div>
		</div>
</div>

</div>


<script>
	$(document).ready(function() {
		$("#TableNo").html("( Sala-" + $("#room_number").val() + " " + "Tavolo-" + $("#table_number").val() + ")")
	});

	$(document).ready(function() { 
		$(".selectRoom").addClass("btn-warning");
		$(this).removeClass("btn-warning");
		$(this).addClass("btn-primary");
		$("#room_number").val($(this).attr("data-id"));
		$(".selectTable").hide();
		$(".selectTable" + $(this).attr("data-id")).show();
	});
</script>
<script type="text/javascript"> 
let cItem = [];
$("body").on('keydown','#m_price',function (event) {
      

	  if (event.shiftKey == true) {
		  event.preventDefault();
	  }

	  if ((event.keyCode >= 48 && event.keyCode <= 57) || 
		  (event.keyCode >= 96 && event.keyCode <= 105) || 
		  event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
		  event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

	  } else {
		  event.preventDefault();
	  }

	  if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
		  event.preventDefault(); 
	  //if a decimal has been added, disable the "."-button

  });
$("body").on("click", ".AddToCartNote" , function() { 
	if($("#table_number").val() == "") { 
		swal( "Seleziona Tavolo", "Scegli un tavolo prima di inserire prodotti", "error" );
		return false;
	}
	
	cItem["id"] = $( this ).attr( "data-id" ) + $( this ).attr( "data-key" ) + Math.floor(Math.random() * 100);
	cItem["product_id"] = $( this ).attr( "data-id" );
	cItem["price"] = $( this ).attr( "data-price" );
	cItem["size"] = $( this ).attr( "data-size" );
	cItem["name"] = $( this ).attr( "data-name" );
	
	$("#ItemNoteModal").modal("show");
	
});


$("body").on("click", ".AddToCartNoteS" , function() { 
	if($("#table_number").val() == "") { 
		swal( "Seleziona Tavolo", "Scegli un tavolo prima di inserire prodotti", "error" );
		return false;
	}
	
	cItem["id"] = $( this ).attr( "data-id" ); 
	cItem["product_id"] = $( this ).attr( "data-id" );
	cItem["price"] = $( this ).attr( "data-price" );
	cItem["size"] = $( this ).attr( "data-size" );
	cItem["name"] = $( this ).attr( "data-name" );

	$(".addToCartFinal").click();
	
});

let mItem = [];

$("body").on("click", ".AddToCartNoteM" , function() { 
	if($("#table_number").val() == "") { 
		swal( "Seleziona Tavolo", "Scegli un tavolo prima di inserire prodotti", "error" );
		return false;
	}
	$("#manualModal").modal("show");
});

$("body").on("click", ".addToCartFinalMM" , function() { 
	if($("#table_number").val() == "") { 
		swal( "Seleziona Tavolo", "Scegli un tavolo prima di inserire prodotti", "error" );
		return false;
	}
	let mItem = [];
	var form_dataa = {
		price:$("#m_price").val(),
		name:$("#m_name").val(),
		description:$("#m_note").val()
	}
	$.ajax( {
		type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
		},
		url: '<?php echo url("sales/add_product"); ?>',
		data: form_dataa,
		success: function ( msg ) {
			cItem["id"] = Number(msg);
			cItem["product_id"] = Number(msg);
			cItem["price"] = $("#m_price").val();
			cItem["size"] = "M";
			cItem["name"] = $("#m_name").val();
			cItem["note"] = $("#m_note").val();

			$("#itemNote").val($("#m_note").val());
			$("#m_name").val("");
			$("#m_note").val("");
			$("#m_price").val("");

			$("#manualModal").modal("hide");
			$(".addToCartFinal").click();

		}
	});

	
	


	
});

</script>


<div class="modal inmodal" id="myHoldOrderModal" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">

		<div class="modal-content animated bounceInRight confirm-modal">
			<div class="modal-header">
				<h4 class="modal-title" id="total_amount_model">@lang('pos.hold_tables')</h4>
			</div>
			<input type="hidden" id="holdOrderID">
			<div class="modal-body clearfix">
				<div id="HoldOrdersList"> </div>
			</div>
		</div>
	</div>
</div>


<div class="modal inmodal" id="myTableModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">

		<div class="modal-content animated bounceInRight confirm-modal">

			<div class="modal-header">
				<h4 class="modal-title" id="total_amount_model">@lang('Tavoli')</h4>
				<button style="margin-top:-30px" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="font-size:30px">&times;</span>
				</button>
			</div>
			<input type="hidden" id="holdOrderID">
			<div class="modal-body clearfix">
				<div class="text-center  "> 
					@foreach($rooms as $k=>$room)
						<?php 
							$bb = "btn-warning";
							if($k==0) $bb = "btn-primary";
						?>
					
					<button type="button" data-id="{{ $room->id ? $room->id : 1 }}" class="btn btn-w-m {{$bb}} dim selectRoom">Sala {{$room->id}}</button>
					@endforeach
				</div>
				<br>

				<p class="text-center">
					@foreach($tables as $table)
					<?php if($table->hold)  { ?>
									<button type="button" data-id="{{$table->hold_id}}"  data-table_id="{{$table->id}}" data-room-id="{{$table->room_id}}" data-table="{{$table->table_name}}" class="btn btn-w-m btn-danger dim ViewHoldOrder supasiTable selectTable selectTable{{$table->room_id}}"> {{$table->table_name}} </button>
									<?php } else { ?>
										<button type="button" data-id="{{$table->id}}" data-table_id="{{$table->id}}" data-room-id="{{$table->room_id}}"  class="btn btn-w-m btn-primary dim table{{$table->id}} supasiTable selectTable selectTable{{$table->room_id}}" onclick="sessionFull()"> {{$table->table_name}}</button>
									<?php } ?>

						
					@endforeach
					
				</p>


	<input type="hidden" id="room_number" class="form-control" value="{{ $table_room['room_number'] ? $table_room['room_number'] : '' }}">
	<input type="hidden" id="table_number"  class="form-control" value="{{ $table_room['table_number'] ? $table_room['table_number'] : '' }}">

			</div>

		</div>

	</div>
</div>


<div class="modal inmodal" id="busyTableModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">

		<div class="modal-content animated bounceInRight confirm-modal">

			<div class="modal-header">
				<h4 class="modal-title" id="total_amount_model">@lang('Tavoli')</h4>
				<button style="margin-top:-30px" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="font-size:30px">&times;</span>
				</button>
			</div>
			<input type="hidden" id="holdOrderID">
			<div class="modal-body clearfix">
				<div class="text-center  ">
					
					@foreach($rooms as $k=>$room)
					<?php 
						$bb = "btn-warning";
						if($k==0) $bb = "btn-primary";
					?>
					
					<button type="button" data-id="{{$room->id}}" class="btn btn-w-m {{$bb}} dim selectRoomB">Sala {{$room->id}}</button>
					@endforeach
				</div>
				<br>

				<p class="text-center">
					@foreach($tables as $table)
					<?php if($table->hold)  { ?>
									<button type="button" data-id="{{$table->hold_id}}" data-room-id="{{$table->room_id}}" data-table_id="{{$table->id}}" data-table="{{$table->table_name}}" class="btn btn-w-m btn-danger supasiTable dim ViewHoldOrder selectTableB selectTableB{{$table->room_id}}"> {{$table->table_name}} </button>
									<?php } else { ?>
										<!-- <button type="button" data-id="{{$table->id}}" class="btn btn-w-m btn-primary dim selectTable selectTable{{$table->room_id}}"> {{$table->table_name}}</button> -->
									<?php } ?>

						
					@endforeach
					
				</p>

			</div>

		</div>

	</div>
</div>



<script type="text/javascript"> 


	<?php if(!empty($_GET["t"]) and $_GET["t"] > 0) {  $tableID = $_GET["t"];?>
		$("#TableNo").text(" Table (" + <?php echo $tableID; ?> + ")");
		$("#TableNoCart").text(" Table (" + <?php echo $tableID; ?> + ")");
		$("#table_id").val(<?php echo $tableID; ?>);
		$("#table_number").val(<?php echo $tableID; ?>);
		
	<?php } ?>
	<?php if(!empty($_GET["h"]) and $_GET["h"] > 0 and !empty($holdOrder)) {
		$holdId = $_GET["h"];
	?>
	setTimeout(() => {
		var form_data = {
			id:<?php echo $holdOrder->id; ?>
		}
		$("#myTableModal").modal("hide");
		$("#holdOrderID").val(<?php echo $holdOrder->id; ?>);
		$("#TableNo").text(" Table (" + <?php echo $holdOrder->table_id; ?> + ")");
		$("#TableNoCart").text(" Table (" + <?php echo $holdOrder->table_id; ?> + ")");
		$("#table_id").val(<?php echo $holdOrder->table_id; ?>);
		$("#table_number").val(<?php echo $holdOrder->table_id; ?>);
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
				$("#myHoldOrderModal").modal("hide");
			}
		});

	}, 500);
<?php } else {  ?>
	// $(function() {
	// 	$("#myTableModal").modal("show");
	// 	$(".selectTable").hide();
	// 	$(".selectTable1").show();
	// });	
<?php } ?>


$("body").on("click" , ".selectRoom" , function() { 
	$(".selectRoom").addClass("btn-warning");
	$(this).removeClass("btn-warning");
	$(this).addClass("btn-primary");
	$("#room_number").val($(this).attr("data-id"));
	$(".selectTable").hide();
	$(".selectTable" + $(this).attr("data-id")).show();
});
$("body").on("click" , ".selectTable" , function() { 
	$(this).removeClass("btn-danger");
	$(this).addClass("btn-primary");
	$("#table_number").val($(this).attr("data-table_id"));
	$("#table_id").val($(this).attr("data-table_id"));
	$('#room_number').val($(this).attr("data-room-id"));
	$("#myTableModal").modal("hide");
	$.ajax({
		url: '{!! url('sales/update_table') !!}',
		method: 'POST',
		data: {
			_token: '{!! csrf_token() !!}',
			room_number: $("#room_number").val(),
			table_number: $('#table_number').val()
		},
		success: function() {
			console.log('success')
		}
	});
	$("#TableNo").html("( Sala-" + $("#room_number").val() + " " + "Tavolo-" + $("#table_number").val() + ")")
});


$("body").on("click" , ".selectRoomB" , function() { 
	$(".selectRoomB").addClass("btn-warning");
	$(this).removeClass("btn-warning");
	$(this).addClass("btn-primary");
	$("#room_number").val($(this).attr("data-id"));
	$(".selectTableB").hide();
	$(".selectTableB" + $(this).attr("data-id")).show();
});

$("body").on("click" , ".selectTableB" , function() { 
	$(".selectTableB").addClass("btn-danger");
	$(this).removeClass("btn-danger");
	$(this).addClass("btn-primary");
	$("#table_number").val($(this).attr("data-id"));
	$("#table_id").val($(this).attr("data-id"));
	$("#myTableModal").modal("hide");
	$("#TableNo").html("( Sala-" + $("#room_number").val() + " " + "Tavolo-" + $("#table_number").val() + ")")
});

$("body").on("click" , ".supasiTable" , function() { 
	//alert($(this).attr("data-table_id"));
	$(".selectTableB").addClass("btn-danger");
	$(this).removeClass("btn-danger");
	$(this).addClass("btn-primary");
	$("#table_number").val($(this).attr("data-table_id"));
	$("#table_id").val($(this).attr("data-table_id"));
	$('#room_number').val($(this).attr("data-room-id"));
	$("#myTableModal").modal("hide");
	$.ajax({
		url: '{!! url('sales/update_table') !!}',
		method: 'POST',
		data: {
			_token: '{!! csrf_token() !!}',
			room_number: $("#room_number").val(),
			table_number: $('#table_number').val()
		},
		success: function() {
			console.log('success')
		}
	});
	$("#TableNo").html("( Sala-" + $("#room_number").val() + " " + "Tavolo-" + $("#table_number").val() + ")")
});

$( "body" ).on( "click", "#holdOrders", function () {
			var form_data = {
				id:""
			};
			$.ajax({
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
				},
				url: '<?php echo url("sale/hold_orders"); ?>',
				data: form_data,
				success: function ( msg ) {
					
					var obj = JSON.parse(msg);
					var html = "";
					$.each(obj , function(key,value) { 
						html += '<div class="holdt"> <a style="color:red" href="javascript:void(0)" data-id= "' +  value.id + '" class="deleteHoldOrder"><i class="fa fa-trash"> </i></a> <a href="javascript:void(0)" class="ViewHoldOrder supasiTable" data-room-id="' + value.room_id + '" data-table="' + value.table + '" data-table_id="' + value.table_id + '" data-id= "' +  value.id + '">@lang('pos.order_no'):: ' +  value.id + "</a> <span style='padding-left:30px'>@lang('pos.held_by'):  " + value.username + "<span style='padding-left:30px'>@lang('pos.Table No'):  " +  value.table + "</span></div>";
					});
					if(html == "") { 
						html = "Nessun ordine sospeso";
					}
					$("#HoldOrdersList").html(html);
					$("#myHoldOrderModal").modal("show");
				}
			});
		});
		$( "body" ).on( "click", ".ViewHoldOrder", function () {
			var form_data = {
				id:$(this).attr("data-id")
			}

			$("#myTableModal").modal("hide");
			$("#hold_id").val($(this).attr("data-id"));
			$("#holdOrderID").val($(this).attr("data-id"));
			$("#TableNo").text(" (" + $(this).attr("data-table") + ")");
			$("#TableNoCart").text(" (" + $(this).attr("data-table") + ")");
			$("#table_id").val($(this).attr("data-table_id"));
			$("#table_number").val($(this).attr("data-table_id"));
			var table_id = $(this).attr("data-table_id");
			$.ajax( {
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
				},
				url: '<?php echo url("sale/view_hold_order"); ?>',
				data: form_data,
				success: function ( msg ) {
					h_cart = JSON.parse(msg);
					$.each(h_cart, function(key, value){
						var data = {
								_token: "{!! csrf_token() !!}",
								id: Number(value.id),
								product_id:  value.product_id,
								price:  value.price,
								size:  value.size,
								name:  value.name,
								quantity: 1,
								note:  value.note,
								table_id: table_id,
								deleted:0,
						}

						$.ajax({
							url: "{{ url("sales/add_to_cart") }}",
							type: 'post',
							async: false, 
							//very important: else php_data will be returned even before we get Json from the url
							dataType: 'json',
							data: data,
							success: function (json) {
							php_data = json;
							}
						});
					});
					$("#myHoldOrderModal").modal("hide");
					location.reload()
				}
			});


		});

		function update_view_hold(value)
		{
			setTimeout(() => {
				
			},  );
			var data = {
					_token: "{!! csrf_token() !!}",
					id: Number(value.id),
					product_id:  value.product_id,
					price:  value.price,
					size:  value.size,
					name:  value.name,
					quantity: 1,
					note:  value.note,
					deleted:0,
			}

			$.post('{{ url("sales/add_to_cart") }}', data, function(data){
				console.log(data)
			}).then(function() {
				location.reload()
			});
		}

		$( "body" ).on( "click", "#holdOrder", function () {
			var form_data = {
				id:$("#holdOrderID").val(),
				table_id: '{{ $table_room['table_number'] }}',
				room_id:  '{{ $table_room['room_number'] }}',
				comment:$("#comments").val(),
				discount:$("#discount_p").val(),
				cart: cart,
			};

			
			$.ajax( {
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
				},
				url: '<?php echo url("sale/hold_order"); ?>',
				data: form_data,
				success: function ( msg ) {
					var obj = JSON.parse(msg);
					if(obj["status"] == false) {
						swal( "Tavolo Occupato", "Completa ordine sospeso o fai liberare il tavolo", "errore" );
						$.each( cart, function( key, value ) {
							sessionFull(value.id);
						});
					} else if(obj["status"] == true){ 
						window.open( obj["url"], "_blank" );
						$.each( cart, function( key, value ) {
							sessionFull(value.id);
						});
					}
				}
			});
		});



$("body").on("click","#Checkout", function() {
	var OrderType = $("#OrderType").val();
	if(OrderType == "order") { 
		$("#myModalHome").modal("show");
	} else { 
		$("#myModal").modal("show");
	}
});

$("body").on("keyup" , "#mobile_number", function(e) {
	var phone = $("#mobile_number").val();
	if(phone.length < 7) { 
		return false;
	}
	
  $.getJSON("findcustomer?phone=" + $("#mobile_number").val(),
        function(data) {
			if(data) { 
				$("#full_name").val(data['name']);
				//$("#phone").val(data['mobile_number']);
				$("#address_c").val(data['address']);
				$("#neighborhood").val(data['neighborhood']);
				$("#comments_c").val(data['comments']);
				$("#id").val(data['id']);
				$("#Client").html("@lang('pos.is_former_client')");
			} else { 
				$("#Client").html("@lang('pos.is_new_client')");
				$("#id").val("");
			}
			
        });
});



$("body").on("click",".deleteHoldOrder", function() {
				$(this).parent(".holdt").remove();
				
				var form_dataa = {
					id:$(this).attr("data-id")
				}
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
				
});


</script>

<div class="modal inmodal" id="myModalHome" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">

		<div class="modal-content animated bounceInRight confirm-modal">

			<div class="modal-header">
				<h4 class="modal-title" id="total_amount_model">@lang('pos.customer_information')</h4>
			</div>

			<div class="modal-body clearfix">
			
				<div class="col-sm-12">
					<div class="form-group">
						<input type="text" id="mobile_number" placeholder="@lang('pos.mobile_number')" class="form-control numberPad">
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<h3 id="Client" style="text-align:center">Is a new client/is a former client</h3>
					</div>
				</div>
				
				
				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" id="full_name" placeholder="@lang('pos.full_name')" class="form-control ">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" id="address_c" placeholder="@lang('pos.address')" class="form-control">
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<input type="text" id="comments_c" placeholder="@lang('pos.comment')" class="form-control">
					</div>
				</div>
				
				
				
	             <div class="col-sm-12 ">
					<span id="errorMessage" style="color:red"> </span>
				</div>

				<div class="col-sm-12 text-right">
					<button type="button" id="ClearForm" class="btn btn-white" >@lang('pos.close')</button>

					<button type="button" id="CustomerNext" class="btn btn-primary">@lang('pos.Next')</button>
					<span id="errorMessage" style="color:red"> </span>
				</div>
				
				

			</div>

		</div>

	</div>

</div>

<script type="text/javascript"> 
$("body").on("click","#ClearForm", function() {
	$("#full_name").val("");
	$("#neighborhood").val("");
	$("#address_c").val("");
	$("#comments_c").val("");
	$("#id").val("");
	$("#mobile_number").val("");
	$("#myModalHome").modal("hide");
});
$("body").on("click","#CustomerNext", function() {
	var form_data = {
		name:$("#full_name").val(),
		phone:$("#mobile_number").val(),
		neighborhood:$("#neighborhood").val(),
		address:$("#address_c").val(),
		comments:$("#comments_c").val(),
		id:$("#id").val()
	}
	
	if($("#mobile_number").val() == "" || $("#full_name").val() == "") { 
		$("#errorMessage").html("@lang('pos.required')");
		return false;
	}
	
	
					$.ajax({
						type: 'POST',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: '<?php echo url("sales/store_customer"); ?>',
						data: form_data,
						success: function (msg) {
							var obj = $.parseJSON(msg);
							if(obj['message'] == "OK") { 
								$("#myModalHome").modal("hide");
								$("#myModal").modal("show");
								$("#customer_id").val(obj['id']);
							} else { 
								
							}
						}
					});
					
});
</script>



<link rel="stylesheet" href="{{url('assets/numpad/jquery.numpad.css')}}">

<script src="{{url('assets/js/lodash.min.js')}}"></script>

<script src="{{url('assets/numpad/jquery.numpad.js')}}"></script>

<style type="text/css">

	.nmpd-grid {

		border: none;

		padding: 20px;

	}

	

	.nmpd-grid>tbody>tr>td {

		border: none;

	}

	/* Some custom styling for Bootstrap */

	

	.qtyInput {

		display: block;

		width: 100%;

		padding: 6px 12px;

		color: #555;

		background-color: white;

		border: 1px solid #ccc;

		border-radius: 4px;

		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);

		box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);

		-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;

		-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;

		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;

	}

</style>
<script>

$("body").on("click",".payment-option-icon", function() {
		$(".payment-option-icon").removeClass("text-success");
		$(this).addClass("text-success");
		$("#payment_type").val($(this).attr("data-id"));
	});
	$( function () {

		$( ".navbar-minimalize" ).click();

	} );

	$.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';

	$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';

	$.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';

	$.fn.numpad.defaults.buttonNumberTpl = '<button type="button" class="btn btn-default"></button>';

	$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';

	$.fn.numpad.defaults.onKeypadCreate = function () {

		$( this ).find( '.done' ).addClass( 'btn-primary' );

	};
	$( document ).ready( function () {
		$( '.numberPadkk' ).numpad();
	} );

	$( "body" ).on( "keyup", "#total_given", function () {
		var total_amount = $( "#total_amount" ).val();
		var total_given = $( this ).val();
		var change = Number( total_given ) - Number( total_amount );
		$( "#change" ).val( change.toFixed( 2 ) );
	} );
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"progressBar": true,
		"preventDuplicates": false,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "400",
		"hideDuration": "1000",
		"timeOut": "2000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	var products = new Array();

	var count_items = 0;
	var cart = JSON.parse('{!! json_encode($cart) !!}')
	show_cart()
	$( "body" ).on( "click", ".addToCartFinal", function () {

if($("#table_number").val() == "") { 
		swal( "Seleziona Tavolo", "Scegli un tavolo prima di inserire prodotti", "error" );
		return false;
	}
		// var item = localStorage.getItem("tempItem");
		cItem["note"] = $("#itemNote").val();
		$("#ItemNoteModal").modal("hide");
		count_items++;

		var ids = _.map( cart, 'id' );

		var item = {
			id: Number(cItem.id),
			product_id:  cItem.product_id,
			price:  cItem.price,
			size:  cItem.size,
			name:  cItem.name,
			note:  cItem.note,
			table_id: <?php echo $table_id ?>,
			deleted:0,
		};

		console.log(item);

		$.ajax({
			url: '{{ url('sales/add_to_cart') }}',
			method: 'POST',
			data: {
				_token: "{!! csrf_token() !!}",
				id: Number(cItem.id),
				product_id:  cItem.product_id,
				price:  cItem.price,
				size:  cItem.size,
				name:  cItem.name,
				table_id: <?php echo $table_id ?>,
				quantity: 1,
				note:  cItem.note,
				deleted:0,
			},
			success: function(response) {
				show_cart();
				toastr.success(response.message);
				location.reload();
			}
		});
		

	   /*if ( !_.includes( ids, item.id ) ) {
			item.quantity = 1;
			item.p_qty = 1;
			cart.push( item );
		} else {
			var index = _.findIndex( cart, item );
			cart[ index ].quantity = Number(cart[ index ].quantity) + 1
		}
		*/

		
		$("#itemNote").val("");
			show_cart();	
		});
		
		$( "body" ).on( "click", "#ClearCart", function () {
			$("#TableNo").text("");
			$("#TableNoCart").text("");
			let cart = [];
			$( ".TotalAmount" ).html( 0 );
			$( "#CartHTML" ).html("");
			$( "#p_subtotal" ).html( "0.00" );
			$( "#p_hst" ).html( "0.00" );
			$( "#p_discount" ).html( "0.00" );
			$( "#total_amount_model" ).html( "0.00" );
			var obj = cart;
			$.each( obj, function ( key, value ) {
				var item = {
					id: Number(value.id)
				};
				
				deleteItemFromCartFull( item );
			});

			    var form_dataa = {
					id:$("#hold_id").val()
				}
				$.ajax( {
					type: 'POST',
					headers: {
						'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
					},
					url: '<?php echo url("sale/hold_order_remove"); ?>',
					data: form_dataa,
					success: function ( msg ) {
						location.reload();
					}
				});

		});
	$( "body" ).on( "click", ".DecreaseToCart", function () {
		var data_id = $(this).attr( "data-id" );
		deleteItemFromCart( data_id )  
	} );

	$( "body" ).on( "click", ".IncreaseToCart", function () {
		var data_id = $( this ).attr( "data-id" )
		$.ajax({
			url: "{!! url('sales/increase_to_cart') !!}",
			method: 'POST',
			data: {
				_token : "{!! csrf_token() !!}",
				id: data_id
			},
			success: function() {
				show_cart();
				location.reload();
			}
		})
	} );

	$( "body" ).on( "click", ".DeleteItem", function () {
		var data_id = $(this).attr( "data-id" )
		deleteItemFromCartFull( data_id );
	} );

	$( "body" ).on( "keyup", "#discount_p", function () {
		show_cart();
	});
	$( "body" ).on( "click", "#updateDiscount", function () {
		show_cart();
	});

	function deleteItemFromCart( item_id ) {
	
		$.ajax({
			url: "{!! url('sales/decrease_to_cart') !!}",
			method: 'POST',
			data: {
				_token : "{!! csrf_token() !!}",
				id: item_id
			},
			success: function() {
				show_cart();
				location.reload();
			}
		})
	}
	function deleteItemFromCartFull( item_id ) {
		$.ajax({
			url: "{!! url('sales/delete_to_cart') !!}",
			method: 'POST',
			data: {
				_token : "{!! csrf_token() !!}",
				id: item_id
			},
			success: function() {
				show_cart();
				location.reload();
			}
		})
		//show_cart();
		//location.reload()
	}

	function sessionFull()
	{
		setTimeout(() => {
			$.ajax({
				url: "{!! url('sales/session_flush') !!}",
				method: 'POST',
				data: {
					_token : "{!! csrf_token() !!}"
				},
				success: function() {
					show_cart();
					location.reload();
				}
			})
		}, 1000);
		//alert('hello');
	}

	$( "body" ).on( "click", "#completeOrder", function () {
		
		if ( cart.length < 1 || $("#CartHTML").html() == "") {

			$( "#myModal" ).modal( "hide" );

			swal( "", "Cart is Empty", "error" );

			return false;
		}
		$("#TableNo").text("");
		
		var status = 1;
		// if($("#OrderType").val() == "order") { 
		// status = 2;
		// }
		var form_data = {
			comments: $( "#comments" ).val(),
			customer_id: $( "#customer_id" ).val(),
			discount: $( "#discount_p" ).val(),
			cashier_id: $( "#cashier_id" ).val(),
			payment_with: $( "#payment_type" ).val(),
			type: $( "#OrderType" ).val(),
			status:status,
			total_given: $( "#total_given" ).val(),
			change: $( "#change" ).val(),
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
				$( "#myModal" ).modal( "hide" );
				cart = [];
				$( "#total_given" ).val( "" );
				$( "#change" ).val( "" );
				$( "#comments" ).val( "" );
				$( "#total_amount_model" ).html( "0.00" );
				$( "#completeOrder" ).html( 'Checkout' );
				$( "#completeOrder" ).prop( "disabled", false );
				
				$("#full_name").val("");
				$("#address_c").val("");
				$("#neighborhood").val("");
				$("#comments_c").val("");
				$("#id").val("");

				var form_dataa = {
					id:$("#holdOrderID").val()
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
				
				swal( {
					title: '@lang("pos.order_complete")',
					type: 'success',
					text: ''
				} ).then( function () {

					window.open( msg, "_blank" );
					location.reload();

					// if ( Number( localStorage.getItem( "total_amount" ) ) >= 500 ) {

						// swal( "$500 of sales", "Empty the cash drawer", "error" );

						// localStorage.setItem( "total_amount", 0 );

					// }
				} )
				$( "#p_subtotal" ).html( "0.00" );

				$( "#p_hst" ).html( "0.00" );

				$( "#p_discount" ).html( "0.00" );
				show_cart();
			}
		} );
	} );

	$("body").on("change" , "#VatInclude" , function() { 
		show_cart();
	});

	<?php 
		$fontwidth = "80";
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
			$fontwidth = "40";
		}

	?>

	function show_cart() {
		if(cart != '') {
			var qty = 0;
			var total = 0;
			var cart_html = "";
			var obj = cart;

			$.each( obj, function ( key, value ) {
				if(value.quantity == 0)
					var del = 1
				else
					var del = 0
				cart_html += '<tr>';
				cart_html += '<td width="10" valign="top"><a href="javascript:void(0)" class="text-danger DeleteItem" data-id=' + value.id + '><i class="fa fa-trash"></i></a></td>';
				if(del == 1) { 
					cart_html += '<td><h4 style="margin:0px;"><del>' + value.name + '</del></h4> <br> <small> ' + value.note + ' </small></td>';
					cart_html += '<td width="<?php echo $fontwidth; ?>"> </td>';
					cart_html += '<td width="15%" class="text-right"><h4 style="margin:0px;"> <?php echo $currency; ?>' + value.price + '</h4> </td>';
				} else { 
					cart_html += '<td><h4 style="margin:0px;">' + value.name + '</h4> <br> <small> ' + value.note + ' </small></td>';
					cart_html += '<td width="<?php echo $fontwidth; ?>"><span class="btn btn-primary btn-sm text-center IncreaseToCart" style="padding: 2px 6px;font-size: 12px;line-height: 1;" data-id=' + value.id + '>+</span> ' + value.quantity + ' <span style="padding: 2px 6px;font-size: 12px;line-height: 1;" class="btn btn-primary btn-sm DecreaseToCart" data-id=' + value.id + '>-</span> </td>';
				cart_html += '<td width="15%" class="text-right"><h4 style="margin:0px;"> <?php echo $currency; ?>' + value.price + '</h4> </td>';
				}
				
				
				cart_html += '</tr>';
				qty = Number( value.quantity );
				if(del != 1) {  
					total = Number( total ) + Number( value.price * qty );
				 }
				
			} );

			var vat = 0;
			var discount = 0;
			<?php if(Auth::user()->role_id == 1) { ?>
			var VatInclude = $("#VatInclude").val();
			
			if(VatInclude == "Yes") { 
				vat = ( Number( total ) * <?php echo setting_by_key("vat"); ?> ) / 100;
			}
			
			discount = $("#discount_p").val();
			<?php } ?>

			$( "#p_subtotal" ).html( "<?php echo $currency; ?>" + total.toFixed( 2 ) );

			$( "#p_hst" ).html( "<?php echo $currency; ?>" + vat.toFixed( 2 ) );
			//// Discount 

			

			// if ( Number( count_items ) >= 2 ) {

				// discount = <?php //echo setting_by_key('discount'); ?>;

			// }
			// $( "#discount" ).val( discount );

			// $( "#p_discount" ).html( "<?php echo $currency; ?>" + discount.toFixed( 2 ) );
			// cart_html += '<div class="panel-footer"> Total Items' ;
			// cart_html += '<span class="pull-right"> ' + qty ;
			// cart_html += '</span></div>' ;

			var total_amount = Number( total ) + vat - Number(discount);
			$( "#total_amount" ).val( total_amount );
			$( "#total_amount_model" ).html("<?php echo $currency; ?>" + total_amount.toFixed( 2 ) );			
			$( "#vat" ).val( vat );

			$( ".TotalAmount" ).html( "<?php echo $currency; ?>" + total_amount.toFixed( 2 ) );
			$( "#CartHTML" ).html( "" );
			$( "#CartHTML" ).html( cart_html );
		}else{
			$( ".TotalAmount" ).html( 0 );
			$( "#p_subtotal" ).html( "0.00" );
			$( "#total_amount_model" ).html( "0.00" );
			$( "#p_hst" ).html( "0.00" );
			$( "#CartHTML" ).html( "" );
		}
	}

</script>

<style>

	.cart-item {

		max-height: 160px;

		overflow-y: scroll;

	}

	

	.scale-anm {

		transform: scale(1);

	}

	

	.tile {

		-webkit-transform: scale(0);

		transform: scale(0);

		-webkit-transition: all 350ms ease;

		transition: all 350ms ease;

	}

	

	.tile:hover {}

	

	.product_list {

		min-height: 160px !important;

		margin-top: 0px;

	}

	.product_list h2 {

		padding: 2px 8px;

		margin-bottom: 8px !important;

		text-align: left;
	}

</style>



<script>

	$( "body" ).on( "click", ".close", function () {
		
	} );
	$( function () {
		var selectedClass = "";
		$( ".fil-cat" ).click( function () {
			selectedClass = $( this ).attr( "data-rel" );
			$( "#portfolio" ).fadeTo( 100, 0.1 );
			$( "#portfolio > div" ).not( "." + selectedClass ).fadeOut().removeClass( 'scale-anm' );
			setTimeout( function () {
				$( "." + selectedClass ).fadeIn().addClass( 'scale-anm' );
				$( "#portfolio" ).fadeTo( 300, 1 );
			}, 300 );

		} );
	} );

	$("body").on("click", "#completeOrder1", function() {

if (cart.length < 1 || $("#CartHTML").html() == "") {

	$("#myModal").modal("hide");

	swal("", "Cart is Empty", "error");

	return false;
}
$("#TableNo").text("");

var status = 1;
// if($("#OrderType").val() == "order") { 
// status = 2;
// }
var form_data = {
	comments: $("#comments").val(),
	customer_id: $("#customer_id").val(),
	discount: $("#discount_p").val(),
	cashier_id: $("#cashier_id").val(),
	payment_with: $("#payment_type").val(),
	type: $("#OrderType").val(),
	status: status,
	total_given: $("#total_given").val(),
	change: $("#change").val(),
	vat: $("#vat").val(),
	table_id: $("#table_id").val(),
	delivery_cost: $("#delivery_cost").val(),
	customer_id: $("#customer_id").val(),
	items: _.map(cart, function(cart) {
		return {
			product_id: cart.product_id,
			size: cart.size,
			quantity: cart.quantity,
			note: cart.note,
			price: cart.price
		}
	})
};
var total_amount = Number(localStorage.getItem("total_amount"));
_.map(cart, function(cart) {
	localStorage.setItem("total_amount", total_amount + (cart.quantity * cart.price));
});

$.ajax({
	type: 'POST',
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
	url: '<?php echo url("sales/complete_sale"); ?>',
	data: form_data,
	success: function(msg) {
		$("#myModal").modal("hide");
		cart = [];
		$("#total_given").val("");
		$("#change").val("");
		$("#comments").val("");
		$("#total_amount_model").html("0.00");
		$("#completeOrder").html('Checkout');
		$("#completeOrder").prop("disabled", false);

		$("#full_name").val("");
		$("#address_c").val("");
		$("#neighborhood").val("");
		$("#comments_c").val("");
		$("#id").val("");

		var form_dataa = {
			id: $("#holdOrderID").val()
		}

		$("#holdOrderID").val("");
		$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '<?php echo url("sale/hold_order_remove"); ?>',
			data: form_dataa,
			success: function(msg) {

			}
		});

		swal({
			title: '@lang("pos.order_complete")',
			type: 'success',
			text: ''
		}).then(function() {

			window.open(msg, "_blank");
			location.reload();
		})
		$("#p_subtotal").html("0.00");

		$("#p_hst").html("0.00");

		$("#p_discount").html("0.00");
		show_cart();
	}
});
});

</script>





@endsection
