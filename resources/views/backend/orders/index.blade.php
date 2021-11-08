@extends('layouts.app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>@lang('online_orders.order_board')</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">@lang('common.home')</a>
                        </li>
                        
                        <li class="active">
                            <strong>@lang('online_orders.order_board')</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-4">
                    <h3 class="comingOrder">@lang('online_orders.new_orders')</h3>
                    <div class="ibox">
                        <div class="ibox-content">
                            <ul class="sortable-list connectList agile-list" id="incomplete">
								@if(!empty($incomplete))
								@foreach($incomplete as $order)
                                @if(!empty($order->name))
                                <li class="warning-element" id="{{$order->id}}" data-name="{{$order->name}}" data-phone="{{$order->phone}}" data-email="{{$order->email}}" data-address="{{$order->address}}" data-id="{{$order->id}}">                                    
								@foreach($order->items as $item)
                                @if(!empty($item->product->name))
								<span class="orderPage-list">{{ $item->product->name }}({{substr($item->size , 0, 1)}})<span class="pull-right"> {{$item->quantity}}</span></span><br>
                               @endif
								@endforeach
                               
                                <hr>
                                    <div class="agile-detail">
                                        <i class="fa fa-clock-o"></i> {{time_elapsed_string($order->created_at)}}
                                    </div>
                                </li>
                                @endif
								@endforeach
								@endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3 class="completeOrder">@lang('online_orders.completed')</h3>
                    <div class="ibox">
                        <div class="ibox-content">
                             <ul class="sortable-list connectList agile-list" id="completed">
                                @if(!empty($completed))
								@foreach($completed as $order)
                                @if(!empty($order->name))
                                <li class="success-element" id="{{$order->id}}" data-name="{{$order->name}}" data-phone="{{$order->phone}}" data-email="{{$order->email}}" data-address="{{$order->address}}" data-id="{{$order->id}}">                                    
                                @foreach($order->items as $item)
                                @if(!empty($item->product->name))
                                <span class="orderPage-list">{{ $item->product->name }}({{substr($item->size , 0, 1)}})<span class="pull-right"> {{$item->quantity}}</span></span><br>
                                @endif
                                @endforeach
                                <hr>
                                    <div class="agile-detail">
                                        <i class="fa fa-clock-o"></i> {{time_elapsed_string($order->created_at)}}
                                    </div>
                                </li>
                                @endif
                                @endforeach
								@endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3 class="cancelOrder">@lang('online_orders.cancelled')</h3>
                    <div class="ibox">
                        <div class="ibox-content">

                            <ul class="sortable-list connectList agile-list" id="canceled">
                                @if(!empty($canceled))
								@foreach($canceled as $order)
                                @if(!empty($order->name))
                                <li class="danger-element" id="{{$order->id}}" data-name="{{$order->name}}" data-phone="{{$order->phone}}" data-email="{{$order->email}}" data-address="{{$order->address}}" data-id="{{$order->id}}">                                    
                                @foreach($order->items as $item)
                                @if(!empty($item->product->name))
                                <span class="orderPage-list">{{ $item->product->name }}({{substr($item->size , 0, 1)}})<span class="pull-right"> {{$item->quantity}}</span></span><br>
                                @endif
                                @endforeach
                                <hr>
                                    <div class="agile-detail">
                                        <i class="fa fa-clock-o"></i> {{time_elapsed_string($order->created_at)}}
                                    </div>
                                </li>
                                @endif
                                @endforeach
								@endif
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel"> @lang('online_orders.order_detail') </h3>
        </div>
        <div class="modal-body" >
                <div class="col-sm-12">
                        <div class="col-sm-12 form-group">
                            <label>@lang('common.name'): <span id="name_order">  </span></label>                            
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>@lang('common.email'): <span id="email_order">  </span></label>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>@lang('common.phone'): <span id="phone_order">  </span></label>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>@lang('common.address'): <span id="address_order">  </span></label>
                        </div>
						
						<div class="col-sm-12 form-group">
                           <a target="_blank" href="javascript:void(0)" id="href_link" class="btn btn-primary"> @lang('online_orders.order_detail')</a>
                        </div>
                </div>
                          
               
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>
  </div> 
		 <script src="{{url('assets/js/jquery-ui-1.10.4.min.js')}}"></script>
		<script>
		$("body").on("click" , ".danger-element , .warning-element, .success-element " , function() {
			$("#name_order").html($(this).attr("data-name"));
			$("#email_order").html($(this).attr("data-email"));
			$("#phone_order").html($(this).attr("data-phone"));
			$("#address_order").html($(this).attr("data-address"));
			$("#href_link").attr("href" , "<?php echo url('reports/sales/') ?>/" + $(this).attr("data-id"));
			$("#myModal").modal("show");
		});
        $(document).ready(function(){

            $("#incomplete, #canceled, #completed").sortable({
                connectWith: ".connectList",
                update: function( event, ui ) {

                    var incomplete = $( "#incomplete" ).sortable( "toArray" );
					console.log(incomplete);
                    var canceled = $( "#canceled" ).sortable( "toArray" );
						console.log(canceled);
                    var completed = $( "#completed" ).sortable( "toArray" );
						console.log(completed);
					$.ajax({
						method: "POST",
						headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: "<?php echo url('orders/save'); ?>",
                        data: {
                            incomplete: incomplete,
                            canceled: canceled,
                            completed: completed
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown){
                        $("active_msg").html("Unable to save active list order: " + errorThrown);
                        
                    });
                    
                    //$('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
                }
            }).disableSelection();

        });
    </script>
    

@endsection
