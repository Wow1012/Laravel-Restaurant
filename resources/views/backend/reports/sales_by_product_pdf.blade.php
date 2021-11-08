<style type="text/css">
	/*@import url("https://fonts.googleapis.com/css?family=Roboto");*/
	body {
		/*font-family: 'Roboto', sans-serif;*/
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
		font-size: 15px;
		line-height: 1.5;
	}
	.report-title-bg {
		padding: 5px;
		background-color: #18A689;
		color: #fff;
		font-size: 15px;
	}
	.pdf-footer p {
		margin: 0px;
		padding: 10px 0;
		border-top: #000 1px solid;
		font-size: 9px;
	}
	.m-tb0 {
		margin-top: 0px !important;
		margin-bottom: 0px !important;
	}
	.m-b0 {
		margin-bottom: 0px !important;
	}
</style>

<style>
	
	.table-stats {
		margin-top: 5px;
		font-size:10px;
	}
	.table-stats, .table-stats th, .table-stats td {
		border: #000 1px solid;
	}
	.table-stats thead {
		background-color: #d81921;
		text-align: left;
		color: #FFF;
	}
	.table-stats th, .table-stats td {
		padding: 3px 5px;
	}
	.table-stats tbody tr:nth-child(even) {
		background-color: #EEE;
	}
	
	.pdf-footer {
		position: fixed;
		left: 0px;
		bottom: 0px;
		width: 100%;
	}
	
</style>
<style>
	
	
		@page {
			size: portrait;
			/*margin-left: 1%;
			margin-right: 1%;*/
		}
	
	
	.table-stats tfoot th {
		background-color: #afb0d8;
		text-align: center;
	}
	.table-stats tfoot tr th:first-child {
		background-color: #21409a;
		color: #FFF;
		text-align: right;
	}
	
</style>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td style="background-color: #18A689; padding: 15px 20px;">
				<span style="float: right;margin-top: 10px; color: #FFF;">As of: {{date("m/d/Y")}}</span>
				<img src="{{url('uploads/logo.jpg')}}" alt="">
			</td>
		</tr>
		
		<?php /*?><tr>
			
				<td align="right">As of: {{date("m/d/Y")}}</td>

		</tr><?php */?>
		<tr>
			<td align="center" class="report-title-bg"><strong>{{$title}}</strong></td>
		</tr>
	</tbody>
</table><br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-stats" >
                            <thead>
                           <tr>
                            <th>#</th>
                            <th>@lang('common.product_name')</th>
                            <th>@lang('common.sales')</th>
                           
                        </tr>
                            </thead>
                            <tbody>
							<?php $total_sales = 0; ?>
                    @if (!empty($sales_by_product))
                        @forelse ($sales_by_product as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->total_sales }}</td>
                            </tr>
							<?php $total_sales += $item->total_sales; ?>
                        @empty
                            @include('backend.partials.table-blank-slate', ['colspan' => 3])
                        @endforelse
                    @endif
                    </tbody>
					
						<tr>
                                <th></th>
                                <th></th>
                                <th>Total Sales: {{$total_sales}}</th>
                                
                                
							    
                                
                            </tr>
							
</table>

<br><br>

<div class="pdf-footer">
	<p>Created by {{Auth::user()->name}} on {{date("m/d/Y")}}.</p>
</div>
