<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Item;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintBuffers\EscposPrintBuffer ;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use App\Sale;
use DB;
use Auth;

class PrintController extends Controller
{
    public function printInvoice(Request $request, $id="") { 
       

        $fonts = array(
            Printer::FONT_A,
            Printer::FONT_B,
            Printer::FONT_C
        );

        if(!$id) {
            $id = $request->input("id");
        }
        // $printers = DB::table("printers")->get();
        $ip = gethostbyname('supermercatidep.ddns.net');

        $printers = array();
        $printers[] = array(
            "id" => 1,
            "ip" => "$ip",
            "port" => 9101
        );
		
		
		 $printers[] = array(
		  "id" => 2,
            "ip" => "$ip",
            "port" => 9101
        );
		

        // $printers = json_decode(json_encode($printers));
        
        $sale = Sale::findOrFail($id);

        $table_name = DB::table("tables")->where("id" , $sale->table_id)->value("table_name");
        $room_id = DB::table("tables")->where("id" , $sale->table_id)->value("room_id");
        $waitress_name = "";
        try { 
            $waitress_name = DB::table("users")->where("id" , $sale->cashier_id)->value("name");
        } catch(\Exception $e) { 

        }
        
        $currency =  setting_by_key("currency");
        $title =  setting_by_key('title');
        $address =  setting_by_key('address');
        $phone =  setting_by_key('phone');
		$profile = CapabilityProfile::load("TM-T88IV");



        foreach($printers as $p) { 
		
		 $items = array();
            $notes = array();
            $product_ids = array();
            $sub_total = 0;
            foreach($sale->items as $item) { 
                $items[] = new item($item->product->size ,   $item->quantity  . " x  € " .   $item->price);
                $notes[] = !empty($item->note) ? $item->note : "";
				 $product_ids[] = $item->product_id;
                $sub_total += $item->price;
            }
			
		
		 $flag = 0; 
            $flag2 = 0; 
            foreach ($items as $key=>$item) {
                $category_id = DB::table("products")->where("id" , $product_ids[$key])->value("category_id");
				if($category_id > 0) {
					$printers_ids = DB::table("categories")->where("id" ,  $category_id)->value("printers");
					$printers_Array = json_decode($printers_ids);
					// print_r($printers_Array);
					if(in_array(1 , $printers_Array) OR $category_id == 0) { 
					   $flag = 1; 
					}
					
					if(in_array(2 , $printers_Array) OR $category_id == 0) { 
					   $flag2 = 1;
					   
					}
				}
				
			}
			
			if($flag == 0 and $flag2 == 0) $flag2 = 1;
				   
			if($p["id"] == 1 and $flag == 0)  continue;
				
			if($p["id"] == 2 and $flag2 == 0) continue;
			
			
            $connector = new NetworkPrintConnector($p["ip"], $p["port"]);
            $printer = new Printer($connector, $profile);
            
            // $id = $request->input("id");
           
           
            $subtotal = new item('Subtotale', number_format($sub_total));
            $tax = new item('Iva', number_format($sale->vat));
            $tax = new item('Sconto',  number_format($sale->discount));
            $total = new item('Totale', number_format($sub_total + $sale->vat - $sale->discount,2), true);
            $tableItem = "Tavolo n: " . $table_name;
            $room = "Sala: " . $room_id;
            $orderNumber = "Ordine #: " . $sale->id;
		
            /* Date is kept the same for testing */
            $date = date('d/m/Y H:i:s');

            /* Print top logo */
            // $printer->setJustification(Printer::JUSTIFY_CENTER);
            // $printer->graphics($logo);
            
            /* Name of shop */
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Bistrot Vergati Eventi\n");
            $printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text("$address\n");
			$printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text("Nocera Inferiore (SA) Tel 081 939802\n");
           
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);
            if(!empty($room_id)) { 
                $printer->text("$room\n");
            }

            if(!empty($table_name)) { 
                $printer->text("$tableItem\n");
            }
            if(!empty($orderNumber)) { 
                $printer->text("$orderNumber\n");
            }
            
         
            if(!empty($waitress_name)) { 
                $waitressItem = "Operatore: $waitress_name";
                $printer->text("$waitressItem\n");
            } 
            $printer->setEmphasis(false);
          
           
            $printer->feed();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            
            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->text("COMANDA AL TAVOLO\n");
            $printer->setEmphasis(false);
            
            /* Items */
            $buffer = new EscposPrintBuffer();
            $printer->setPrintBuffer($buffer);
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);
            // $printer->text(new item('', '$'));
            $printer->setEmphasis(false);
            foreach ($items as $key=> $item) {
                $printer->text($item);
                if(!empty($notes[$key])) { 
                    $printer->selectPrintMode(Printer::MODE_FONT_B);
                    $printer->text($notes[$key] . "\n");
                    $printer->selectPrintMode(Printer::MODE_FONT_A);
                }
               
                
            }
            $printer->setEmphasis(true);
            $printer->text($subtotal);
            $printer->setEmphasis(false);
            $printer->feed();
            
            // /* Tax and total */
            $printer->text($tax);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($total);
            $printer->selectPrintMode();
            
            /* Footer */
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Ritirare lo scontrino alla cassa\n");
			$printer->text("Grazie per averci preferito - \n$title\n");
            $printer->feed(2);
            $printer->text($date . "\n");
            
            /* Cut the receipt and open the cash drawer */
            $printer->cut();
            $printer->pulse();
            $printer->close();
            echo "Done";
        }    
    }

    public function printInvoiceKitchen(Request $request, $id="") { 
      
      
        
        // $printers = DB::table("printers")->get();
		
		
	 $currency =  setting_by_key("currency");
        $title =  setting_by_key('title');
        $address =  setting_by_key('address');
        $phone =  setting_by_key('phone');
		$profile = CapabilityProfile::load("TM-T88IV");
            if(!$id) {
                $id = $request->input("id");
            }

         

            // $id = $request->input("id");
            $table = DB::table("hold_order")->where("id", $id)->first();
            $cart = json_decode($table->cart , true);

            $table_name = DB::table("tables")->where("id" , $table->table_id)->value("table_name");
            $room_id = DB::table("tables")->where("id" , $table->table_id)->value("room_id");
            $waitress_name = Auth::user()->name;
            $tableItem = "Tavolo: " . $table_name;
            $room = "Sala: " . $room_id;
			$orderNumber = "Ordine #: " . $id;

            $items = array();
            $notes = array();
            $product_ids = array();
            $sub_total = $holdTotal= $currentTotal= 0;
            $newcart = array();
            foreach($cart as $k=>$c) {
                if($c['deleted'] == 1)
                {
                    $newcart[$k] = $c;
                    continue;
                }
                if(!isset($c['isprinted']) ) { 
                    $c['isprinted']="ok";
                    $newcart[$k] = $c;
                    // $newcart[$k]["print"] = "ok";
                    $items[] = new item($c["size"]  ,   $c["quantity"] . " x € " . $c["price"]);
                    $notes[] = !empty($c["note"]) ? $c["note"] : "";
                   
					 $product_ids[] = !empty($c["product_id"]) ? $c["product_id"] : "";
                     $currentTotal += $c["price"] * $c["quantity"];
                } else { 
                   $holdTotal += $c["price"] * $c["quantity"];
                    $newcart[$k] = $c;
                } 
                $sub_total += $c["price"] * $c["quantity"];
               
            }
       
			 DB::table("hold_order")->where("id", $id)->update(["cart" => json_encode($newcart)]);
           //  dd($currentTotal,$holdTotal,$sub_total);
            $holdTotalPrint = new item('Sospeso                         ',  number_format($holdTotal,2),true);
            $subtotal = new item('Corrente                        ',  number_format($currentTotal,2),true);
			 $total = new item('Totale', number_format($sub_total,2),true);
            // $tax = new item('Tax', number_format($sale->vat));
            // $total = new item('Total', number_format($sub_total + $sale->vat,2), true);
            /* Date is kept the same for testing */
            $date = date('d/m/Y H:i:s');

        $ip = gethostbyname('supermercatidep.ddns.net');

        $printers = array();
        $printers[] = array(
		     "id" => 1,
            "ip" => "$ip",
            "port" => 9101
        );
		
		
		 $printers[] = array(
		 "id" => 2,
            "ip" => "$ip",
            "port" => 9101
        );

		$profile = CapabilityProfile::load("TM-T88IV");

        foreach($printers as $p) { 
		
		    $flag = 0; 
            $flag2 = 0; 
            foreach ($items as $key=>$item) {
                $category_id = DB::table("products")->where("id" , $product_ids[$key])->value("category_id");
				if($category_id > 0) {
					$printers_ids = DB::table("categories")->where("id" ,  $category_id)->value("printers");
					$printers_Array = json_decode($printers_ids);
					// print_r($printers_Array);
					if(in_array(1 , $printers_Array) OR $category_id == 0) { 
					   $flag = 1; 
					}
					
					if(in_array(2 , $printers_Array) OR $category_id == 0) { 
					   $flag2 = 1;
					   
					}
				}
				
			}
			
			if($flag == 0 and $flag2 == 0) $flag2 = 1;
				   
			if($p["id"] == 1 and $flag == 0)  continue;
				
			if($p["id"] == 2 and $flag2 == 0) continue;
			
			
			
		
		
            $connector = new NetworkPrintConnector($p['ip'], $p["port"]);
            $printer = new Printer($connector, $profile);

            

            /* Print top logo */
            // $printer->setJustification(Printer::JUSTIFY_CENTER);
            // $printer->graphics($logo);
            
            /* Name of shop */
           $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Vergati\n");
            $printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text("$address\n");
			$printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text("Nocera Inferiore (SA) Tel 081 939802\n\n");
           


            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);
            if(!empty($room_id)) { 
                $printer->text("$room\n");
            }

            if(!empty($table_name)) { 
                $printer->text("$tableItem\n");
            }
            if(!empty($waitress_name)) { 
                $waitressItem = "Operatore: $waitress_name";
                $printer->text("$waitressItem\n");
            } 
			
			 if(!empty($orderNumber)) { 
                $printer->text("$orderNumber\n");
            }
		
            $printer->setEmphasis(false);
          

            $printer->feed();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->text("COMANDA AL TAVOLO\n");
            $printer->setEmphasis(false);
            
            /* Items */
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);

            $printer->setEmphasis(false);
            $printers_ids = "";
       
            foreach ($items as $key=>$item) {
                $category_id = DB::table("products")->where("id" , $product_ids[$key])->value("category_id");
                $printers_ids = DB::table("categories")->where("id" ,  $category_id)->value("printers");
                $printers_Array = json_decode($printers_ids);
				// print_r($printers_Array);
           
				
                   
                    $printer->text($item);
                    if(!empty($notes[$key])) { 
                        $printer->selectPrintMode(Printer::MODE_FONT_B);
                        $printer->text($notes[$key] . "\n");
                        $printer->selectPrintMode(Printer::MODE_FONT_A);
                    }
    
               
            }
			
            $printer->feed(1);
            $printer->setEmphasis(true);
            $printer->text($holdTotalPrint);
            $printer->text($subtotal);
            $printer->setEmphasis(false);
            // $printer->feed();
            
            // // /* Tax and total */
            // $printer->text($tax);
            $printer->feed(1);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($total);
            $printer->selectPrintMode();
            
            /* Footer */
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Ritirare lo scontrino alla cassa.\n");
			$printer->text("Grazie per averci preferito. \n");
            $printer->text("NON FISCALE\n");

            $printer->feed(2);
            $printer->text($date . "\n");
            
            /* Cut the receipt and open the cash drawer */
            $printer->cut();
            $printer->pulse();
            $printer->close();
            echo "Done"; 
        }    
    }

}
