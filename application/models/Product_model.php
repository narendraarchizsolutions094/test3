<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    private $table = "tbl_product";

    public function insertRow($data = []) {
        return $this->db->insert($this->table, $data);
    }
    
    public function updateRow($data = []) {

        return $this->db->where('product_id', $data['product_id'])
                        ->update($this->table, $data);
    }
    
    public function readRow($product_id = null) {
        return $this->db->select("*")
                        ->from($this->table)
                        ->where('product_id', $product_id)
                        ->get()
                        ->row();
    }

    public function productlist() {
        return $this->db->select("*")
                        ->from("tbl_product_country")						->where("comp_id", $this->session->userdata('companey_id'))
                        ->get()
                        ->result();
    }		public function productdetlist() {        return $this->db->select("tbl_proddetails.*,tbl_product_country.*,tbl_product_country.id as sb_id")					->from("tbl_product_country")					->join("tbl_proddetails", "tbl_proddetails.prodid = tbl_product_country.id", "LEFT")					->where("tbl_product_country.comp_id", $this->session->userdata('companey_id'))					->where("tbl_proddetails.id IS NOT NULL")					->order_by("tbl_product_country.id DESC")					->get()					->result();    }	public function productdet($prodno) {        return $this->db->select("tbl_product_country.*,tbl_proddetails.*,tbl_product_country.id as sb_id")					->from("tbl_product_country")					->join("tbl_proddetails", "tbl_proddetails.prodid = tbl_product_country.id", "LEFT")					->where("tbl_product_country.comp_id", $this->session->userdata('companey_id'))					->where("tbl_product_country.id", $prodno)					->where("tbl_proddetails.id IS NOT NULL")					->order_by("tbl_product_country.id DESC")					->get()					->row();    }
    
    public function all_block($city_id) {
        return $this->db->select('*')->from('tbl_school')->where('city_id', $city_id)->get()->result();
    }
    
    public function findRows($product_id) {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('product_id', $product_id)
                        ->get()
                        ->result();
    }
    
    public function school_list_by_id($sIdArr){
        return $this->db->select('sch.*,sch.product_id,sch.school_name,sch.address,sch.contact_name,sch.contact_number,sch.dise_code,sch.created_date,sch.updated_date,tbl_block.block,city.city,state.state')
                        ->from('tbl_school as sch')                        
                        ->join('state', 'state.id = sch.state_id')
                        ->join('city', 'city.id = sch.city_id')
                        ->join('tbl_block', 'tbl_block.block_id = sch.block_id')
                        ->where_in('product_id',$sIdArr)
                        ->order_by('dise_code', "asc")
                        ->get()
                        ->result();
    } 
    
    public function school_contact_list_by_id($product_id){        
        return $this->db->select("*")
                        ->from("tbl_school_contact")
                        ->where('product_id',$product_id)
                        ->order_by('product_id', "desc")
                        ->get()
                        ->result();
        
    }		public function getStock(){          	    return $this->db->select("stk.*,prd.product_name,detl.*")->where("prd.comp_id", $this->session->userdata('companey_id'))->order_by("stk.id DESC")  	                                            ->from("stock stk")  	                                            ->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT")												->join("tbl_proddetails detl", "detl.prodid = prd.sb_id", "LEFT")												->get()->result();	  } 	  	  public function getstockwithDate($sdate = '',$edate = '')	  {		  $this->db->select("stk.*,prd.product_name,wrh.name");		  $this->db->from('stock stk');		  $this->db->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT");		  $this->db->join("tbl_warehouse wrh", "wrh.id = stk.warehouse", "LEFT");		  $this->db->where("prd.comp_id", $this->session->userdata('companey_id'));		  if(!empty($sdate) or !empty($edate)) {			$this->db->where("added_date BETWEEN '$sdate' AND '$edate'");		  }		  return $this->db->get()->result();	  }     public function getStockById($stkid){          	    return $this->db->select("stk.*,prd.product_name")->where("prd.comp_id", $this->session->userdata('companey_id'))->order_by("stk.id DESC")				->where("stk.id", $stkid)       				->from("stock stk")				->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT")				->get()->row();     }   		public function getWarehouse(){			return $this->db->select("*")->where("comp_id", $this->session->userdata('companey_id'))->get("tbl_warehouse")->result();			}		public function getSupplier(){				return $this->db->select("*")->where("company", $this->session->userdata('companey_id'))->where("role",  4)->get("users")->result();			}	public function getProduct(){	    	    	    return $this->db->select("*")->where("comp_id", $this->session->userdata('companey_id'))->get("tbl_product")->result();	    	}	public function getProductById($prd){	    	    	    return $this->db->select("*")->where("id", $prd)->where("comp_id", $this->session->userdata('companey_id'))->get("tbl_product")->result();	    	}		public function showQuantityDetail($productid,$limit='',$start='')	{		$this->db->select('to.ord_no,op.quantity,usr.fname,usr.lname');		$this->db->from('order_prdct op');		$this->db->join('tbl_order to','to.id = op.ord_id','left');		$this->db->join('users usr','usr.id = to.cus_id','left');		$this->db->where('op.product',$productid);		if($limit !="")		{		  $this->db->limit($limit,$start);			}		return $this->db->get()->result();	}		public function stock($act = "1"){				$flrcol  = "prd.product_name,stk.price,stk.quantity";		if($act == 1) {			$this->db->select("stk.*,prd.sb_id as pid,prd.product_name");		}		if(isset($_GET["action"])){						$filtr = $this->input->get("action");						if($filtr == "created_today"){								$this->db->where("added_date", date("Y-m-d"));			}			if($filtr == "updated_today"){								$this->db->where("last_update", date("Y-m-d"));			}		}		$this->db->where("stk.company", $this->session->userdata('companey_id'));		$this->colfilter($flrcol);		$this->db->order_by("stk.id DESC");		$this->db->from("stock stk");		$this->db->join("tbl_product prd", "prd.sb_id = stk.product", "LEFT");				if($act == 1) {			$this->limit();				return $this->db->get()->result();		}else{			return $this->db->count_all_results();		}	}		 public function limit(){		 		 if(isset($_POST["length"])) {				 $this->db->limit($_POST['length'], $_POST['start']);				 }else{			 $this->db->limit(30, 0);				 }		 } 	 	 public function colfilter($flrcol){		  				if(!empty($_POST['search']['value'])) 			{				 $likeqry = " ( ";							 $val = $_POST['search']['value'];								 				 foreach($flrcol as $ind => $col){					 					 $likeqry .= $col." LIKE '%$val%' OR ";				 }				 $likeqry = trim($likeqry, "OR ");				$likeqry .= ") ";					$this->db->where($likeqry);								}		  	  }	  	  	  public function order_by($ordcol){		  				if(isset($_POST['order'])) 			{				$ordpost = $_POST['order']['0']['column']; 								if(!empty($ordcol[$ordpost])){					$this->db->order_by($ordcol[$ordpost], $_POST['order']['0']['dir']);				}								}else{				//$this->db->order_by("")			} 	  }	
}
