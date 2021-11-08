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
                        <h5>Tutte le vendite</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                    <thead>
                        <tr>
                            <th>Data vendita</th>
                            <th>Sconti</th>
                            <th>Totale</th>
                            <th>Stato</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($sales))
                        @forelse ($sales as $key => $sale)
                            <tr>
                                <td>{{ $sale->created_at->format('d F Y') }}</td>
								<td>{{$currency}} {{ $sale->discount }}</td>
                                <td>{{$currency}} {{ ($sale->amount )}}</td>
									@if($sale->status == 1)  
								<td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-xs ">Completato</a>
                                </td>
									@else
								<td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-xs">Cancellato</a>
                                </td>
									@endif
								
								
                                <td>
								<a href="{{ url('sales/cancel/' . $sale->id) }}" class="btn btn-danger btn-xs pull-right">Cancella</a>
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
				{!! $sales->render() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection