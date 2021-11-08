<div class="body">


<?php $currency =  setting_by_key("currency"); ?>
     <div class="page" >
      <br>
      <br>
<table width="80%" cellpadding="10" class="tableS" cellspacing="10" style="font-family: Times New Roman; font-size: 11.5px !important;margin-left:20px" >
 <tr>
    <td colspan="2" style="text-align:center" class="noborder"><img src="{{url('uploads/logo.jpg')}}" width="220" alt="PRA"></td>
    
 </tr>

</table>

<table width="90%" cellpadding="10" class="tableS" cellspacing="10" style="font-family: Times New Roman; font-size: 11.5px !important;margin-left:20px;">
    <thead>
 
 <tr>
    <td colspan="3" class="noborder"><strong>@lang('slip.date')</strong> <?php echo date('d M, Y'); ?>
        
    </td>
     <td colspan="3"  class="noborder" align="right"><strong>@lang('slip.time')</strong> <?php echo date('h:i A'); ?> </td>
 </tr>
 <tr>
    <td class="noborder" colspan="5"><strong>@lang('slip.invoice_no')</strong> {{ $sale->invoice_no }}</td>
 </tr>
 <tr>
         <td colspan="5" class="noborder">&nbsp;</td>
 </tr>
 <tr>
    <td width="15"><strong>@lang('slip.s_no')</strong></td>
    <td width="150"><strong>@lang('slip.menu')</strong></td>
    <td id="kitchenph" width="100"><strong>@lang('slip.unit_price')</strong></td>
	<td width="15"><strong>@lang('slip.qty')</strong></td>
    <td id="kitchentotalh" width="60"><strong>@lang('slip.total')</strong></td>
 </tr>
</thead>


        


    <?php $i=1; ?>
                    @foreach($sale->items as $item)
                       
                            <?php
                            if($i%35==0) {
                                //$page_break = "page-break-after: always;";
                                ?>
                           
   <tr height colspan="5" class="tableStyle">
  
       <td>
                               <table width="90%" cellpadding="10" class="tableS" cellspacing="10" style="margin-left:20px">
                                <tr>

                                    
  
 
                                </tr>

                                </table>
 
       </td>
   </tr>
                         
                                <!-- $page_break = "page-break-after: always;"; -->
                                <?php
                            }

                            ?>
                      <tr>
                            <td width="15"><strong>0<?php echo $i; ?></strong></td>
                            <td width="100"><strong>{{ $item->product->name }}({{$item->size}})</strong><br><small>{{ $item->note }}</small></td>
                            <td class="kitchen" width="50"><strong><?php echo $currency; ?>{{$item->price}}</strong></td>
							<td width="15"><strong>{{ $item->quantity }}</strong></td>
                            
                            <td class="kitchen" width="50"><strong><?php echo $currency; ?>{{ number_format($item->quantity * $item->price,2) }}</strong></td>
                        </tr>
                        <?php $i++;  ?>
                       @endforeach


                        

   
</table>

<table style="page-break-inside:avoid;font-family: Times New Roman; font-size: 11.5px !important;margin-left:20px" width="90%" cellpadding="5" class="tableS kitchen" cellspacing="5" id="kitchen">


    <?php /*<tr>
    <td></td>
    <td></td>
    <td><strong>SERVICE CHARGRES</strong></td>
    <td><strong><?php echo $invoince->service_charge_per; ?> %</strong></td>
    <td><strong><?php echo trim(str_replace(" ","",$invoince->service_charge_amt)); ?></strong></td>
    </tr>  
    <tr>
    <td></td>
    <td></td>
    <td><strong>PST</strong></td>
    <td><strong>16 %</strong></td>
    <td><strong><?php echo trim(str_replace(" ","",$invoince->inv_invoice_tax_amount)); ?></strong></td>
    </tr> */ ?>  
 <hr>
 
 
 
 <tr>
    <td colspan="3"><strong>@lang('slip.tax'):</strong></td>
    <td><strong></strong></td>
    <td class="grandtotalFont"><strong><?php echo $currency; ?>{{number_format($sale->vat,2)}}</strong></td>
 </tr> 
 
 @if($sale->discount > 0 and !empty($sale->discount))
  <tr>
    <td colspan="3"><strong>@lang('slip.discount'):</strong></td>
    <td><strong></strong></td>
    <td class="grandtotalFont"><strong><?php echo $currency; ?>{{number_format($sale->discount,2)}}</strong></td>
 </tr>  
 @endif
 
 
 <!-- <tr>
    <td colspan="3"><strong>@lang('slip.total_given'):</strong></td>
    <td><strong></strong></td>
    <td class="grandtotalFont"><strong><?php echo $currency; ?>{{number_format($sale->total_given,2)}}</strong></td>
 </tr>  -->
 
 <tr>
    <td colspan="3"><strong>@lang('slip.payment_with'):</strong></td>
    <td><strong></strong></td>
    <td class="grandtotalFont"><strong><?php if($sale->payment_with == "cash") { echo "Efectivo"; } else { echo "Tarjeta"; } ?></strong></td>
 </tr>
 
 <tr>
    <td colspan="3"><strong>@lang('slip.grand_total'):</strong></td>
    <td><strong></strong></td>
    <td class="grandtotalFont"><strong><?php echo $currency; ?>{{number_format($sale->subtotal - $sale->discount + $sale->vat,2)}}</strong></td>
 </tr>   

  <tr>
  <td class="removeborder"></td>
    <td class="removeborder">&nbsp;</td>
    <td class="removeborder"></td>
    <td class="removeborder"></td>
    <td class="removeborder"></td>
 </tr> 
 <tr>
  <td class="removeborder"></td>
    <td class="removeborder">&nbsp;</td>
    <td class="removeborder"></td>
    <td class="removeborder"></td>
    <td class="removeborder"></td>
 </tr> 
 

  <tr>
    <td colspan="5" align="center">
    <strong>@lang('slip.thanks_visting') {{setting_by_key('title')}}, {{setting_by_key('address')}}, {{setting_by_key('phone')}}</strong></td>
    
 </tr>  

 
 
</table>
    

</div>

<?php 
    $fontSize = "20px";
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
        $fontSize = "35px";
    }

?>
</div>
<p align="center"><input style="font-size:<?php echo $fontSize; ?>" type="button" id="pr" value="Print" onclick="printpage()" class="btn btn-success" /> </p>
<p align="center"><a style="text-align:center" href="{{url('sales/create')}}"> @lang('slip.back') </a> </p>


</center>
 

  
       
    
    

  
       
<script type="text/javascript" src="{{url('assets/frontend/js/jquery-1.11.1.min.js')}}"></script><!-- jquery -->
	  
<script type="text/javascript">
function printpage() {
 
    var form_data = { 
        "id": <?php echo $sale->id; ?>
    }
     $.ajax({
            type: 'POST',
            url: '<?php echo url("print/receipt"); ?>',
            data: form_data,
            success: function ( msg ) {
                window.close();
            }
        });
}


    // function printpage() {
    //     //Get the print button and put it into a variable
    //     var printButton = document.getElementById("pr");
    //    // var printButtonk = document.getElementById("prK");
    //     //Set the print button visibility to 'hidden' 
    //    // printButton.style.visibility = 'hidden';
    //    // printButtonk.style.visibility = 'hidden';
    //     document.title = "";
    //     document.URL   = "";
        
    //     //Print the page content
    //     window.print()
    //     //Set the print button to 'visible' again 
    //     //[Delete this line if you want it to stay hidden after printing]
    //     printButton.style.visibility = 'visible';
    //    // printButtonk.style.visibility = 'visible';
        
        
    // }
</script>

<script type="text/javascript">
    // function printpageK() {
    //     //Get the print button and put it into a variable
    //     var printButton = document.getElementById("pr");
    //     //var printButtonk = document.getElementById("prK");
    //     var kitchen = document.getElementsByClassName("kitchen");
    //     //Set the print button visibility to 'hidden' 
    //     for(var i = 0; i < kitchen.length; i++){
    //         kitchen[i].style.visibility = "hidden"; 
    //     }
    //     //printButton.style.visibility = 'hidden';
    //     //printButtonk.style.visibility = 'hidden';
        
    //     document.title = "";
    //     document.URL   = "";
        
    //     //Print the page content
    //     window.print()
    //     //Set the print button to 'visible' again 
    //     //[Delete this line if you want it to stay hidden after printing]
    //     printButton.style.visibility = 'visible';
    //    // printButtonk.style.visibility = 'visible';
    //     for(var i = 0; i < kitchen.length; i++){
    //         kitchen[i].style.visibility = "visible"; 
    //     }
        
    // }
</script>


<style>
.tableS { margin-left: 20px; margin-top:10px; font-family:Verdana, Geneva, sans-serif; }
    .tableS tr td  {  padding:2px; font-family:Verdana, Geneva, sans-serif; }
    .tableS tr td.noborder { border:none;  }

.removeborder {border:none !important; }
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
font-family:Verdana, Geneva, sans-serif;

    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        font-family:Verdana, Geneva, sans-serif;
    }
    .page {
     
       width: 12cm;
            height: auto; 
     
        margin: 10mm auto;
       
      
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

        font-weight: normal;
              font-size: 9px !important;
              font-family:Verdana, Geneva, sans-serif;
             
    }
    .font_size
    {
      font-size: 8em "tahoma";
      font-family:Verdana, Geneva, sans-serif;
    }
    .subpage {
        padding: 1cm;
        width: 15cm;
        height: 15.8cm;
        font-family:Verdana, Geneva, sans-serif;
       
    }
    
    .grandtotalFont { font-size:10em "tahoma"; }
    
    @page {
        size: auto;
        margin:0;
        margin-top: 0;
        font-family:Verdana, Geneva, sans-serif;
    }


 
 
    
    
    @media print {
        html, body {
            width: 10cm;
            height: auto; 
            font-size: 8px;   
           margin: 0 auto;  
           font-family:Verdana, Geneva, sans-serif;
       
        }
    


    table {
            -fs-table-paginate: paginate;
            font-family:Verdana, Geneva, sans-serif;
        }


        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            font-family:Verdana, Geneva, sans-serif;
        }
.removeborder {border:none; }


       .form-horizontal,label{
              font-weight: normal;
              font-size: 9px !important;
              font-family:Verdana, Geneva, sans-serif;
              
        }
        .testing {
             display: block;
             font-family:Verdana, Geneva, sans-serif;
           /* page-break-after: always !important;*/
        }
        .tableStyle {
            
            page-break-after: always !important;
            font-family:Verdana, Geneva, sans-serif;

        }
        .tableStyle:last-child {
     page-break-after: none;
     font-family:Verdana, Geneva, sans-serif;
}

.page table tr td  {   padding:2px; font-family:Verdana, Geneva, sans-serif; }
       .form-horizontal,label{
              font-weight: normal;
              font-size: 9px !important;
              font-family:Verdana, Geneva, sans-serif;
              
        }
        
        .grandtotalFont { font-size:10em "tahoma"; }

    }
</style>
