<?php   $rows = array();
		if(!empty($neword)){			
				$srno = 0; 
				foreach($neword as $ordno => $allord){
					$ord    = $allord[0]; 					
					$cols   = array();
					$srno   = ++$srno;
					$total  = count($allord);						 		
					$cols[] = $srno;
					if (user_access(463)) {
						$cols[] = "<a href = '".base_url('order/view/'.$ord->ord_no)."'>".$ord->ord_no."</a>";
					}else{
						$cols[] = $ord->ord_no;
					}
						$total = getOrderTotal($allord);
						$cols[]= $total;

						

					//$cols[] = (!empty($ord->product_name)) ? ucwords($ord->product_name)  : " ";					
					$qtyarr = $prdarr = $payarr = $dlvarr =  array();
					$totconfrm = 0;	
					$pending   = $totprice = $totqty = $disc = 0;				
					$totprice = $ord->price;
					$totqty   =  $ord->quantity;
					if(!empty($ord->quantity)){
						//$cols[]= $totqty;	
					}else{
						//$cols[]=  "";
					}
					
					$cols[] = $ord->customer;
					$paid = getPaidAmount($ord->id);	
						$cols[] = $paid;

						$balance = $total - $paid;

						$cols[] = $balance;
					
						
						$mode = "";
						
						$paysts  = "Pending";
						
						$paymode  =  " - ";
						$payprice = $balance =  0;
						$balance  = $totprice;
						if(!empty($pay[$ord->id])){							
							foreach($pay[$ord->id] as $ind => $py){
								
								$payprice  = $payprice  + $py->pay;
							}
							$balance = $totprice - $payprice;
						}else{
							$paymode = false;
						}
						
					
						$payment_act = $conf_act = $invoice_act = '';

						if (user_access(461)) {
							$conf_act  = '<a class="btn btn-xs btn-info" href="'.base_url("order/booking/".$ord->ord_no).'"><i class="fa fa-gavel" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Status</a>';
							$payment_act = '<a href="'.base_url("payment/add/".$ord->ord_no).'" class="btn btn-xs btn-primary"><i class="fa fa-cc" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Payment</a>';
						}

						$invoice_act	=	'<a class="btn btn-xs btn-default" href="'.base_url("order/invoice/".$ord->ord_no).'"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Invoice</a>';					


					$cols[] =  $conf_act.$invoice_act.$payment_act;
					$rows[] = $cols;
				}
				
		
		}
		$total = $this->order_model->orders(2);	
				$output = array(
						"draw" => @$_POST['draw'],
						"recordsTotal" 		=> $total,
						"recordsFiltered"   => $total,  
						"data" => $rows,
						);
			die(json_encode($output));
	/*function buttonwrap($arr, $total, $col, $title){
		
		$list = "";
		
		foreach($arr as $ind => $val){
			
			$list .= $val->$col."<br />";
		}
		$list = trim($list);
	  	'<button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-popover-color="default" data-placement="top" title="" data-content="'.$list.'" data-original-title="'.$title.'" aria-describedby="popover827091">'.$total.'+</button>';
		
		if($total > 1){
			return ' <a href = "#" class ="badge badge-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$list.'"> '.($total- 1).'+ </a>'; 
		}else{
			return "";
		}
											
	}
		*/