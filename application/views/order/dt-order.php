<?php   $rows = array();
		if(!empty($neword)){
			
				$srno = 0; 
			
				foreach($neword as $ordno => $allord){
					
					$ord    = $allord[0]; 
					
					
					$cols   = array();
					$srno   = ++$srno;
					$total  = count($allord);
					$image  = (!empty($ord->main_img)) ? base_url($ord->main_img)  : base_url("assets/images/profile/33.png"); 
					
					$cols[] = $srno;
					$cols[] = "<a href = '".base_url('order/view/'.$ord->ord_no)."'>".$ord->ord_no."</a>";
				
					//buttonwrap($arr, $total, $col)
					$cols[] = (!empty($ord->product_name)) ? ucwords($ord->product_name)  : " ";
					//$cols[] = (!empty($ord->quantity)) ? $ord->	quantity : " ";
					
					$qtyarr = $prdarr = $payarr = $dlvarr =  array();
					$totconfrm = 0;	
					$pending   = $totprice = $totqty = 0;
				/*	foreach($allord as $ind => $oprd){
						
						if(!empty($dlv[$oprd->id])){
							
							foreach($dlv[$oprd->id] as $ind => $dl){
								
								$totconfrm = $totconfrm + $dl->delv_qty;
							}
							$pending = $ord->quantity - $totconfrm;	
						}else{
							$pending  = $pending + $oprd->quantity;
						}
						$totprice = $totprice + $oprd->price;
						$totqty   = $totqty   +  $oprd->quantity;
					} */
					$totprice = $ord->price;
					$totqty   =  $ord->quantity;
					//$pending = $totqty - $totconfrm;
					if(!empty($ord->quantity)){
					
						
						$cols[]= $totqty;	
				
						
					}else{
						$cols[]=  " ";
					}
					
					if(!empty($ord->total_price)){
						
						$cols[] = 'Discount : '.$ord->offer.' Total : '.$ord->price;
						
						
						
					}else{
						$cols[] = " "; 	
					}
					/*	if($ord->pay_mode == 1){
							$mode = "Online";	
						}else if($ord->pay_mode == 2){
							$mode =  "Account Transfer";	
						}else if($ord->pay_mode == 3){
							$mode =  "By Check";	
						}else if($ord->pay_mode == 4){
							$mode =  "By Cash";	
						}else{
							$mode = $ord->pay_mode;
						} */
						
						$mode = "";
						
						/*
						if($ord->pay_status == 1){
							$paysts = "Pending";
						}else{
							$paysts = "Complete";
						} */
						$paysts  = "Pending";
						
						$paymode  =  " - ";
						$payprice = $balance =  0;
						$balance  = $totprice;
						if(!empty($pay[$ord->id])){
							
							foreach($pay[$ord->id] as $ind => $py){
								
							
									
								if($py->pay_mode == 1){
									$paymode = "Online";	
								}else if($py->pay_mode == 2){
									$paymode = "Cash";
								}else if($py->pay_mode == 3){
									
									$paymode = "DD/Check";
									
								}else if($py->pay_mode == 4){
									
									$paymode =  "Account Transfer";	
								}else{
									$paymode =  $py->pay_mode;
								} 
								if($py->status == 1){
									
									$paysts = "Complete";
									
								}else if($py->status == 2){
									
									$paysts = "waiting";
								}else{
									$paysts =  $py->status;
								}
								
								$payprice  = $payprice  + $py->pay;
							}
							
							$balance = $totprice - $payprice;
						}else{
							$paymode = false;
						}
						
						if(!empty($paymode)) {
						$cols[]  =	'<span class = "badge badge-info">Mode : '.$paymode.'</span><br /><span class = "badge badge-warning">
										Status : '.$paysts.'</span>';
						}else {
						$cols[]  =		" - ";
						}
						$cols[]  =	(!empty($payprice)) ? $payprice : "  - ";
					
						$cols[]  =	(!empty($balance)) ? $balance : " ";
					
					$cols[] = (!empty($ord->conf_delv) and $ord->conf_delv != "0000-00-00") ?  date("d, M Y", strtotime($ord->conf_delv)).' Next :'.$ord->pend_delv.''	 :  " - ";
					$cols[] = (!empty($ord->order_date )) ?  date("d, M Y", strtotime($ord->order_date))  : " - ";
					
					if($ord->status  == 1 ){
						$cols[] = "Request";
					}else if($ord->status  == 2 ){
						$cols[] =  "Waiting";
					}else if($ord->status  == 3 ){
						$cols[] =  "Half Confirm";
					}else if($ord->status  == 4 ){
						$cols[] =  "Full Confirm";
					}else if($ord->status  == 5 ){
						$cols[] =  "Reject";
					}else{
						$cols[] = $ord->status; 
					} 
					
				
						$view  = '<a class="btn btn-xs btn-info" href="'.base_url("order/booking/".$ord->ord_no).'"><i class="fa fa-gavel" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Confirm</a><a class="btn btn-xs btn-default" href="'.base_url("order/invoice/".$ord->ord_no).'"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Invoice</a>';
					
					
					$cols[] =  $view.'<a href="'.base_url("payment/add/".$ord->ord_no).'" class="btn btn-xs btn-primary"><i class="fa fa-cc" data-toggle="tooltip" title="" data-original-title="Edit"></i>  Payment</a>';

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