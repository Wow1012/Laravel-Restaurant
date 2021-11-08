@extends('layouts.app')

@section('content')
<?php $input['date_range'] = !empty($input['date_range']) ? $input['date_range'] : null; 
$currency =  setting_by_key("currency");
?>
<link href="{{url('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">

 <link href="{{url('assets/css/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet">

<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@lang('common.expenses')</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                           <tr>
                            <th>#</th>
                            <th>@lang('common.date')</th>
							<th>@lang('common.title')</th>
                            <th>@lang('common.price')</th>
                        </tr>
                            </thead>
                            <tbody>
							<?php $total_amount = 0; ?>
                    @if (!empty($expenses))
                        @forelse ($expenses as $key => $expense)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                               <td>{{ date('d F Y' , strtotime($expense->created_at)) }}</td>
                                
							   <td>{{ $expense->title}}</td>
							   <td>{{$currency}} {{ $expense->price}}</td>
                   
                           
                            </tr>
							<?php $total_amount += $expense->price; ?>
                        @empty
                            @include('backend.partials.table-blank-slate', ['colspan' => 5])
                        @endforelse
                    @endif
                    </tbody>
					
						<tr>
                                <th>{{count($expenses)}}</th>
                                <th></th>
                                <th> @lang('common.total_expense'): </th>
                                 <th>{{$currency}} {{ $total_amount }}</th>
                               
                            </tr>
							
							
                        </table>

                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
            <div class="panel panel-default">
                 <div class="ibox-title">
                        <h5>@lang('reports.date_range')</h5>
                        
                    </div>
                 <div class="ibox-content">    
                    <form action="{{ url('reports/expenses') }}" method="GET">
                
						
						<div class="form-group" id="data_5">
                                <label class="font-noraml">Range select</label>
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" value="{{(!empty($input['start']) and $input['start'] !=  '') ? $input['start'] : '' }}"/>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" value="{{ (!empty($input['end']) and $input['end'] !=  '') ? $input['end'] : '' }}" />
                                </div>
                            </div>

                        

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('common.search')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
	<!-- @lang('reports.date_range') use moment.js same as full calendar plugin -->
	
	 <!-- Data picker -->
   <script src="{{url('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

    <script src="{{url('assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
	
			<script> 
			$('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });
			</script>

@endsection
