<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'doctor_model',
            'department_model',
            'Modules_model',
            'User_model',
            'dash_model'
        ));

        
        if ($this->session->user_right != 1) {
            redirect('','refresh');
        }
    }
    public function index() {
        $data['page_title'] = display('doctor_list');
        $data['doctors'] = $this->doctor_model->read();
        $data['content'] = $this->load->view('doctor', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function update_formfields(){
     if($_POST){

        $id = $_POST['id'];
        $active = $_POST['active'];
        $proc = $_POST['proc'];
        // print_r($proc);
        $user_id = $this->session->userdata('com_id');
        // print_r($user_id);
        if($active==1){
         $status = 1;
        }
        if($active==0){
            $status = 0;
        }
        // print_r($status);exit();

        $proc1 = implode(',', $proc);
        $arr = array(
         'process_id'=>$proc1,   
         'status' => $status
        );
        // print_r($arr);
        $res = $this->User_model->update_inputfileds($arr,$id,$user_id);
        if($res){

        $this->session->set_flashdata('message', "Updated Successfuly");
        // redirect('customer/edit/'.$user_id);
        echo 1;

        }
        else{
            echo 0;
        }

       }

    }

    public function create() {

    
        $data['page_title'] = display('add_doctor');
        $this->form_validation->set_rules('firstname', display('first_name'), 'required|max_length[50]');
        $this->form_validation->set_rules('lastname', display('last_name'), 'required|max_length[50]');
        if ($this->input->post('user_id', true) == null) {
            $this->form_validation->set_rules('email', display('email'), 'required|max_length[50]|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5');
        }
        $this->form_validation->set_rules('a_name', display('customer_account_name'), 'max_length[50]');
        $this->form_validation->set_rules('a_account_number', display('customer_account_number'), 'max_length[50]');
        $this->form_validation->set_rules('a_ifsc', display('customer_ifsc'), 'max_length[50]');
        $this->form_validation->set_rules('a_branch', display('customer_account_branch'), 'max_length[150]');
        $this->form_validation->set_rules('a_companyname', display('customer_company_name'), 'max_length[100]');
        $this->form_validation->set_rules('a_companyaddress', display('Company_address'), 'max_length[250]');
        $this->form_validation->set_rules('modules', display('customer_services'));
        $this->form_validation->set_rules('phone', display('phone'), 'max_length[20]');
        $this->form_validation->set_rules('mobile', display('mobile'), 'required|max_length[20]');
        $this->form_validation->set_rules('blood_group', display('blood_group'), 'max_length[10]');
        $this->form_validation->set_rules('sex', display('sex'), 'required|max_length[10]');
        $this->form_validation->set_rules('date_of_birth', display('date_of_birth'), 'max_length[10]');
        $this->form_validation->set_rules('address', display('address'), 'required|max_length[255]');
        $this->form_validation->set_rules('status', display('status'), 'required');
        #-------------------------------#
        //picture upload
        $picture = $this->fileupload->do_upload(
                'assets/images/doctor/', 'picture'
        );
        // if picture is uploaded then resize the picture
        if ($picture !== false && $picture != null) {
            $this->fileupload->do_resize(
                    $picture, 293, 350
            );
        }
        //if picture is not uploaded
        if ($picture === false) {
            $this->session->set_flashdata('exception', display('invalid_picture'));
        }
        #-------------------------------# 
        if (!empty($this->input->post('modules'))) {
            $modules = implode(",", $this->input->post('modules'));
        } else {
            $modules = '';
        }
        //when create a user
        if ($this->input->post('user_id', true) == null) {
            $data['doctor'] = (object) $postData = [
                'user_id' => $this->input->post('user_id', true),
                'firstname' => $this->input->post('firstname', true),
                'lastname' => $this->input->post('lastname', true),
                'email' => $this->input->post('email', true),
                'password' => md5($this->input->post('password', true)),
                'user_role' => 2,
                'designation' => $this->input->post('designation', true),
                'department_id' => $this->input->post('department_id', true),
                'address' => $this->input->post('address', true),
                'phone' => $this->input->post('phone', true),
                'mobile' => $this->input->post('mobile', true),
                'short_biography' => $this->input->post('short_biography', true),
                'pictures' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
                'a_name' => $this->input->post('a_name', true),
                'a_account_number' => $this->input->post('a_account_number', true),
                'a_ifsc' => $this->input->post('a_ifsc', true),
                'a_branch' => $this->input->post('a_branch', true),
                'a_companyname' => $this->input->post('a_companyname', true),
                'a_companyaddress' => $this->input->post('a_companyaddress', true),
                'modules' => $modules,
                'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth', true) != null) ? $this->input->post('date_of_birth', true) : date('Y-m-d'))),
                'sex' => $this->input->post('sex', true),
                'blood_group' => $this->input->post('blood_group', true),
                'degree' => $this->input->post('degree', true),
                'created_by' => $this->session->userdata('user_id'),
                'create_date' => date('Y-m-d'),
                'status' => $this->input->post('status', true),
            ];
        } else { //update a user
            $data['doctor'] = (object) $postData = [
                'user_id' => $this->input->post('user_id', true),
                'firstname' => $this->input->post('firstname', true),
                'lastname' => $this->input->post('lastname', true),
                'designation' => $this->input->post('designation', true),
                'department_id' => $this->input->post('department_id', true),
                'address' => $this->input->post('address', true),
                'phone' => $this->input->post('phone', true),
                'mobile' => $this->input->post('mobile', true),
                'short_biography' => $this->input->post('short_biography', true),
                'pictures' => (!empty($picture) ? $picture : $this->input->post('old_picture')),
                'a_name' => $this->input->post('a_name', true),
                'a_account_number' => $this->input->post('a_account_number', true),
                'a_ifsc' => $this->input->post('a_ifsc', true),
                'a_branch' => $this->input->post('a_branch', true),
                'a_companyname' => $this->input->post('a_companyname', true),
                'a_companyaddress' => $this->input->post('a_companyaddress', true),
                'modules' => $modules,
                'date_of_birth' => date('Y-m-d', strtotime($this->input->post('date_of_birth', true))),
                'sex' => $this->input->post('sex', true),
                'blood_group' => $this->input->post('blood_group', true),
                'degree' => $this->input->post('degree', true),
                'created_by' => $this->session->userdata('user_id'),
                'create_date' => date('Y-m-d'),
                'status' => $this->input->post('status', true),
            ];
        }
        
        if($this->form_validation->run() === true) {
            if (empty($postData['user_id'])) {
                $companey_id    =   $this->doctor_model->create($postData);
                $companey_insert_id = $this->db->insert_id();
                $tbl_user_role = array(
                    'comp_id' => $companey_insert_id,
                    'user_role' => 'Admin',
                    'user_permissions' => '10,11,12,13,30,31,32,33,60,61,62,63,70,71,72,73,80,81,82,83,90,91,92,93,120,121,122,123,130,131,132,133,140,141,142,143',
                    'status' => '1');
                $user_right    =   $this->db->insert('tbl_user_role',$tbl_user_role);
                $right_insert_id = $this->db->insert_id();

                

                if ($companey_id) {
                    $post_data = $postData;
                    $post_data['companey_id'] = $companey_insert_id;
                    $post_data['user_permissions'] = $right_insert_id;                                        
                    $this->create_user($post_data);
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                if ($postData['user_id'] == $this->session->userdata('user_id')) {
                    $this->session->set_userdata([
                        'pictures' => $postData['picture'],
                        'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
                    ]);
                }
                redirect('customer/create');
            } else {
                if ($this->doctor_model->update($postData)) {
                    $id = $this->input->post('role_id');
                    $user_role = $this->input->post('user_type');
                    $permissions = $this->input->post('permissions');
                   

                   if(in_array(230, $permissions) || in_array(231, $permissions) || in_array(232, $permissions) || in_array(233, $permissions) || in_array(234, $permissions) || in_array(235, $permissions) || in_array(236, $permissions)){
                   		
                   		$this->db->where('comp_id',$this->input->post('user_id', true));
                   		$c_product	=	$this->db->get('tbl_product')->num_rows();
                   		
                   		if($c_product == 0){
	                   		$product_name = 'Demo Process';
						    $main_fun_name='';
						    $process_data = array(					        
						        'product_name'=>$product_name,
								'comp_id'=>$this->input->post('user_id', true),
						        'main_fun'=>$main_fun_name,
						        'status'=>1,
						        'added_by'  =>1,
						        'added_on'  =>date('d-m-Y')
						   );		
						   $this->load->model('dash_model');			   
						   $this->dash_model->add_product($process_data);

						   	$process_id	=	$this->db->insert_id();

						   	$this->db->where('user_permissions',$id);
						   	$this->db->update('tbl_admin',array('process'=>$process_id));

                   		}

					}


                    $permissions = implode(',', $permissions);
                    $data = array(
                        'user_role' => $user_role,
                        'user_permissions' => $permissions
                    );
                    $this->User_model->update_user_role($id, $data);



                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
                if ($postData['user_id'] == $this->session->userdata('user_id')) {
                    $this->session->set_userdata([
                        'pictures' => $postData['picture'],
                        'fullname' => $postData['firstname'] . ' ' . $postData['lastname']
                    ]);
                }
                redirect('customer/edit/' . $postData['user_id']);
            }
        } else {
            $data['department_list'] = $this->Modules_model->modules_list();
            $data['content'] = $this->load->view('company_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function create_user($post_data){
        /*echo "<pre>";
        print_r($post_data);
        echo "</pre>";
        exit();*/        
        
        $post_data    =   array(       
            'user_permissions'      => $post_data['user_permissions'],                                                  
            's_password'            => $post_data['password'],
            's_display_name'        => $post_data['firstname'],
            'last_name'             => $post_data['lastname'],
            'date_of_birth'         => $post_data['date_of_birth'],
            'joining_date'          => $post_data['create_date'],            
            'designation'           => $post_data['designation'],
            'employee_band'         => $post_data['blood_group'],
            'orgisation_name'       => $post_data['a_companyname'],            
            'companey_id'           => $post_data['companey_id'],
            's_user_email'          => $post_data['email'],           
            's_phoneno'             => $post_data['mobile'],
            'process'               => NULL
          );

        $this->db->insert('tbl_admin',$post_data);
    }

    public function profile($user_id = null) {
        if (!empty($_POST)) {
            if (!empty($this->input->post('rights'))) {
                $rights = implode(",", $this->input->post('rights'));
            } else {
                $rights = '';
            }
            $data['doctor'] = (object) $postData = [
                'user_id' => $user_id,
                'form_edit_rights' => $rights
            ];
            if ($this->doctor_model->update($postData)) {
                $this->session->set_flashdata('message', display('save_successfully'));
                redirect('customer/profile/' . $user_id);
            } else {
                $this->session->set_flashdata('exception', display('please_try_again'));
                redirect('customer/profile/' . $user_id);
            }
        } else {
            $data['page_title'] = display('doctor_profile');
            $data['id_userid'] = $user_id;
            $data['user'] = $this->doctor_model->read_by_id($user_id);
            $data['content'] = $this->load->view('customer_profile', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function edit($user_id = null) {
        $user_role = $this->session->userdata('user_role');
        if ($user_role == 1 && $this->session->userdata('user_id') == $user_id)
            $data['page_title'] = display('edit_profile');
        elseif ($user_role == 2)
            $data['page_title'] = display('edit_profile');
        else
        $data['page_title'] = display('edit_customer');
        $data['department_list'] = $this->Modules_model->modules_list();
        $data['doctor'] = $this->doctor_model->read_by_id($user_id);

        $this->db->select('user_permissions');
        $this->db->where('s_phoneno',$data['doctor']->mobile);
        $user_row    =   $this->db->get('tbl_admin')->result_array();

        $this->db->select('id,title');  
        $this->db->where('status',1);      
        $data['modules']    =   $this->db->get('all_modules')->result_array();

        if(count($user_row)>1){
            echo "Error: there are multiple mobile of this company";
            exit();
        }
        $this->load->model('User_model');
        
        /*echo $user_row[0]['user_permissions'];
        exit();*/
        
        

        $data['user_role'] = $this->User_model->get_user_role($user_row[0]['user_permissions']);
        $data['user_right_content'] = $this->load->view('company_right', $data, true);
        $data['content'] = $this->load->view('doctor_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete($user_id = null) {
        if ($this->doctor_model->delete($user_id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('customer');
    }    

    
}
