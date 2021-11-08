@extends('layouts.app')

@section('content')
<?php $currency =  setting_by_key("currency"); ?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Sale Invoice </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('')}}">@lang('common.home')</a>
                        </li>
                     
                        <li class="active">
                            <strong>Invoice </strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
			

<div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
					<div class="row">
                                <div class="col-sm-6">
                                    <h5>From:</h5>
                                    <address>
                                        <strong>{{$sale->name}}</strong><br>
                                        {{$sale->address}}<br>
                                        <abbr title="Phone">P:</abbr> {{$sale->phone}}<br>
                                        <abbr title="Email">E:</abbr> {{$sale->email}}
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Invoice No.</h4>
                                    <h4 class="text-navy"> {{ $sale->invoice_no }}</h4>
                                    
                                    <p>
                                        <span><strong>Date:</strong> <?php echo date('d M, Y' , strtotime($sale->created_at)); ?></span><br/>
                                    </p>
                                </div>
                            </div>
							
                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Amount </th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
									@foreach($sale->items as $k=>$item)
                                    <tr>
                                        <td>{{ $item->product->name }}({{substr($item->size , 0, 1)}})</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{$currency}}{{$item->price}}</td>
                                        <td>{{$currency}}{{$item->quantity * $item->price}}</td>
                                    </tr>
									@endforeach
                                    
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Sub Total :</strong></td>
                                    <td>{{$currency}}{{$sale->subtotal}}</td>
                                </tr>
								 <tr>
                                    <td><strong>TAX :</strong></td>
                                    <td>{{$currency}}{{$sale->vat}}</td>
                                </tr>
								
								<tr>
                                    <td><strong>Delivery Cost :</strong></td>
                                    <td>{{$currency}}{{$sale->delivery_cost}}</td>
                                </tr>
								
								
                                <tr>
                                    <td><strong>DISCOUNT :</strong></td>
                                    <td>{{$currency}}{{$sale->discount}}</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>{{$currency}}{{$sale->subtotal + $sale->vat + $sale->delivery_cost}}</td>
                                </tr>
                                </tbody>
                            </table>
							
                            <div class="well m-t"><strong>Comments</strong>
                               {{$sale->comment}}
                            </div>
                        </div>
                </div>
@endsection