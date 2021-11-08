@extends('layouts.app')

@section('content')
<?php 
$currency =  setting_by_key("currency");
?>
 <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@lang('online_orders.all_orders')</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('common.name')</th>
                            <th>@lang('common.email')</th>
                            <th>@lang('common.phone')</th>
							<th>@lang('common.amount')</th>
                            <th>@lang('common.status')</th>
							
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($orders))
                        @forelse ($orders as $key => $sale)
                            <tr>
                               <td>{{ $key + 1 }}</td>
                               <td>{{ $sale->name }}</td>
                               <td>{{ $sale->email }}</td>
                               <td>{{ $sale->phone }}</td>
                               <td>{{$currency}} {{ $sale->amount }}</td>
									@if($sale->status == 1)  
								<td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-xs ">@lang('online_orders.completed')</a>
                                </td>
									@elseif($sale->status == 2)  
								<td>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-xs">@lang('online_orders.pending')</a>
                                </td>
									@else
									<td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-xs">@lang('online_orders.cancelled')</a>
                                </td>
								@endif
								
                                <td>
								
                                    <a target="_blank" href="{{ url('sales/receipt/' . $sale->id) }}" class="btn btn-primary btn-xs pull-right">@lang('common.show')</a>
                                </td>
                            </tr>
                        @empty
                           <tr> 
						  <td colspan="5">
								 @lang('common.no_record_found')
									
                                </td>
								</tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
				{!! $orders->render() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection