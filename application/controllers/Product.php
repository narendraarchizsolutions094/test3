<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'Product_model',
        ));
    }

    function productlist() {
        if (user_role('60') == true) {
      
        }
        $data['title'] = display('product_list');
        $data['product_list'] = $this->Product_model->productlist();
        $data['content'] = $this->load->view('product/product_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    function get_region_byid() {
        $country_id = $this->input->post('country_id');
        $data['country'] = $this->location_model->get_region_byid($country_id);
        echo '<option value="" selected>Select</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->region_id . '">' . $r->region_name . '</option>';
        }
    }

    function get_state_byid() {
        $country_id = $this->input->post('country_id');
        $region_id = $this->input->post('region_id');
        $data['country'] = $this->location_model->get_state_byid($country_id, $region_id);
        echo '<option value="" selecte>Select</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->id . '">' . $r->state . '</option>';
        }
    }

    function get_city_byid() {
        $state_id = $this->input->post('state_id');
        $data['country'] = $this->location_model->get_city_byid($state_id);
        echo '<option value="" style="display:none">---Select City---</option>';
        foreach ($data['country'] as $r) {
            echo '<option value="' . $r->id . '">' . $r->city . '</option>';
        }
    }
    
    function get_product() {
        //slected_product_id
        $fellowid1 = $this->input->post('fellowid1');
        $product_id = $this->input->post('selected_product_id');
        echo '<option value="" style="display:none">---Select Product---</option>';
        $myFellowProducts = $this->User_model->myFellowProductIds($fellowid1);          
            $fellow_product_list = [];
            if(isset($myFellowProducts->product_id) && ($myFellowProducts->product_id !='')){
                $fellowProductIds = explode(',',$myFellowProducts->product_id);              
                $fellow_product_list = $this->Product_model->product_list_by_id($fellowProductIds);
                
            }
            foreach($fellow_product_list as $fellowObj){
                $selected = '';
                if(isset($product_id) && $product_id == $fellowObj->product_id){
                    $selected ="selected";
                }
                echo '<option '.$selected.' value="' . $fellowObj->product_id . '">' . $fellowObj->product_name . '</option>';   
            }
    }
    
    public function add_product() {
        $data['title'] = display('add_product');
        $data['product'] = '';       
        $this->form_validation->set_rules('product_name', display('product_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('country_id', display('country_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('region_id', display('region_name'), 'required|max_length[50]');        
        $this->form_validation->set_rules('state_id', display('state_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('city_id', display('city_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('block_id', display('block_name'), 'required|max_length[50]');
        $data['product'] = (object) $postData = [
            'product_id' => $this->input->post('product_id', true),
            'dise_code' => $this->input->post('dise_code', true),
            'product_name' => $this->input->post('product_name', true),
            'contact_name' => $this->input->post('contact_name', true),
            'contact_number' => $this->input->post('contact_number', true),
            'address' => $this->input->post('address', true),
            'block_id' => $this->input->post('block_id', true),
            'city_id' => $this->input->post('city_id', true),
            'state_id' => $this->input->post('state_id', true),
            'country_id' => $this->input->post('country_id', true),
            'region_id' => $this->input->post('region_id', true),
            'status' => $this->input->post('status', true),
            'created_by' => $this->session->userdata('user_id'),
            'updated_by' => $this->session->userdata('user_id'),
            'created_date' => date('Y-m-d'),
            'updated_date' => date('Y-m-d'),
            'ipaddress' => $_SERVER['REMOTE_ADDR']
        ];
        
        if ($this->form_validation->run() === true) {
            if (empty($this->input->post('product_id'))) {
                if (user_role('20') == true) {}
                if ($this->Product_model->insertRow($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }                
            } else {
                if (user_role('21') == true) {}
                if ($this->Product_model->updateRow($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('product/productlist');
        } else {
            $data['country'] = $this->location_model->country();
            $data['region_list'] = $this->location_model->region_list();
            $data['state_list'] = $this->location_model->state_list();
            $data['city_list'] = $this->location_model->city_list();
            $data['block_list'] = $this->location_model->block_list();
            $data['partial'] = 'product/product_form';
            $this->load->view('layout/main_wrapper', $data);
        }
    }
   
    public function edit_product($product_id = null) {
        if (user_role('21') == true) {}
        $data['title'] = display('update_product');
        $data['product'] = $this->Product_model->readRow($product_id);  
        $data['city_list'] = $this->location_model->city_list();
        $data['state_list'] = $this->location_model->state_list();
        $data['country'] = $this->location_model->country();
        $data['region_list'] = $this->location_model->region_list();
        $data['block_list'] = $this->location_model->block_list();
        $data['partial'] = 'product/product_form';
        $this->load->view('layout/main_wrapper', $data);
    } 
    public function contact_master($product_id = null) {
        if (user_role('21') == true) {}
        $data['title'] = display('contact_master');
        $data['partial'] = 'product/subject_from';
        $this->load->view('layout/main_wrapper', $data);
    }
}