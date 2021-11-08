@extends('layouts.app')

@section('content')


<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@lang('reports.product_by_sale')</h5>
                       
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                   <table class="table table-striped export_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('common.product_name')</th>
                            <th>@lang('common.sales')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($sales_by_product))
                        @forelse ($sales_by_product as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->total_sales }}</td>
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
                        </div>
<div class="text-right">
	<a href="javascript:void(0);"  class="btn btn-sm btn-info export">@lang('reports.download_csv')</a>
	<a target="_blank" href="?pdf=yes"  class="btn btn-sm btn-warning">@lang('reports.download_pdf')</a>
</div>

<script> 
$(document).ready(function () {

    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(th,td)').not("#notslect"),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td,th');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }

    // This must be a hyperlink
    $(".export").on('click', function (event) {
        // CSV
       var name = $(".no-margin-bottom").html();
        exportTableToCSV.apply(this, [$('.export_table'),'sales_by_product.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});
		
	</script>
                 </div>
                </div>
            </div>
            </div>
           
        </div>
		
@endsection
