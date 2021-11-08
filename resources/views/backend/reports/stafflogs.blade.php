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
                        <h5>@lang('reports.user_activities')</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                           <tr>
                            <th>#</th>
                            <th>Date time</th>
							<th>Action</th>
                        </tr>
                            </thead>
                            <tbody>
							<?php $total_amount = 0; ?>
                    @if (!empty($activities))
                        @forelse ($activities as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                               <td>{{ date('d F Y - h:i A' , strtotime($row->datetime)) }}</td>
                                
							   <td>{{ $row->activity}}</td>
							   
                           
                            </tr>
                        @empty
                            @include('backend.partials.table-blank-slate', ['colspan' => 4])
                        @endforelse
                    @endif
                    </tbody>
					
						
							
							
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
                   	
						<div class="form-group" id="data_5">
                                <label class="font-noraml">@lang('reports.range_select')</label>
                                <div class="input-daterange input-group" id="datepicker">
									
                                    <select onChange="javascript:location.href = this.value" class="input-sm form-control" name="start"> 
									@foreach($users as $u)
										<option value="{{url('reports/staff_log/' . $u->id )}}" <?php if($user->id == $u->id) echo "selected" ?>> {{$u->name}} </option>
									@endforeach
									</select>
                                    
                                </div>
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
