<?php

if (!defined('BASEPATH'))
    exit('No script no allowed');

class user extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model(array('user_model','role_model'));
    }

    function index() {
        $this->view();
    }

    function view() {
        $this->load->library('pagination');
        $this->page = "user_view";

        /*
         * PAGINATION SETTING
         */

        $config['base_url'] = base_url() . $this->uri->segment(1) . "/view";
        $config['total_rows'] = $this->user_model->get_count();
        $config['per_page'] = $this->config->item('number_per_page_paging');
        $config['uri_segment'] = 3;
        $offset = (!is_numeric($this->uri->segment(3)) || $this->uri->segment(3) < 1) ? 0 : $this->uri->segment(3);

        /*
         * DATA SETTING 
         */

        if ($this->input->get("search")) {
            $q = $this->input->get('q');
            $data['select'] = array('tb_user.user_full_name' => $q, 'tb_user.user_email' => $q, 'tb_user.user_description' => $q, 'tb_role.role_name' => $q);
            $config['total_rows'] = $this->user_model->get_data_search_count($data['select']);
            $data['result'] = $this->user_model->get_data_search_limit($offset, $config['per_page'], $data['select']);
        }
        else
            $data['result'] = $this->user_model->get_data_all($offset, $config['per_page']);

        $this->pagination->initialize($config);

        /*
         * AJAX HANDLER
         */

        if ($this->input->get('token'))
            echo $this->load->view('content/user_view', $data);
        else
            $this->load->view($this->container, $data);
    }
    
    function edit($id = 0) {
        $this->page = 'user_edit';
        $data['id'] = $id;
        $cek        = $this->user_model->get_by(array('user_id'=>$id));
        $data['roles'] = $this->role_model->get_all();
        
        if(count($cek)>0) 
            $data['result'] = $cek;
        
        if($this->input->get('token')) 
            echo $this->load->view('content/user_edit',$data);
        else
            $this->load->view($this->container,$data);
    }
    
    function add() {
        $this->page = "user_add";
        
        $data['roles'] = $this->role_model->get_all();
        
        if($this->input->get('token')) 
            echo $this->load->view('content/user_add',$data);
        else
            $this->load->view($this->container,$data);
    }
    
    function save() {
        if($this->input->post('token')){
            extract($this->input->post());
            $data['error'] = true;
            
            $find_username = $this->user_model->get_by(array('user_name' => $usr_name));
            
            if($usr_name == "" || $usr_pass == "" || $usr_cpass == "" || $usr_full_name == "" || $usr_phone == "" || $usr_email == "")
                $data['message'] =  "<b>Warning!</b> Complete your onput data.<br>.";
            else if($usr_role == "0") 
                $data['message'] =  "<b>Warning!</b> <br>Choose your role user.";
            else if($usr_cpass != $usr_pass)
                $data['message'] =  "<b>Warning!</b> <br>Your confirm password is not valid.";
            else if(count($find_username) > 0)
                $data['message'] =  "<b>Warning!</b> <br>Username is already active, please use the unique username.";
            else {
                $this->user_model->save(array(
                    'role_id'          => $usr_role,
                    'user_name'        => $usr_name,
                    'user_password'    => md5($usr_cpass),
                    'user_full_name'   => $usr_full_name,
                    'user_telp'        => $usr_phone,
                    'user_email'       => $usr_email,
                    'user_description' => $usr_des,
                    'user_active'      => $usr_act
                ));
                
                $data['error'] = false;
                $data['message'] =  "<b>Success!</b> <br>Data successfully saved.";
            }
            
            echo json_encode($data);
        }
    }
    
    function update ($id=0){
        if($this->input->post('token')){
            extract($this->input->post());
            $data['error'] = true;
            $id            = !is_numeric($id) ? 0 : $id;
            
            $find_username = $this->user_model->get_by(array('user_name' => $usr_name , 'user_id <> ' => $id));
            
            if($usr_name == "" || $usr_full_name == "" || $usr_phone == "" || $usr_email == "")
                $data['message'] =  "<b>Warning!</b> Complete your onput data.<br>.";
            else if($usr_role == "0") 
                $data['message'] =  "<b>Warning!</b> <br>Choose your role user.";
            else if(count($find_username) > 0)
                $data['message'] =  "<b>Warning!</b> <br>Username is already active, please use the unique username.";
            else {
                if($usr_pass != "" && $usr_cpass != "") {
                    if($usr_cpass != $usr_pass)
                        $data['message'] =  "<b>Warning!</b> <br>Your confirm password is not valid.";
                    else {
                        $this->user_model->update(array(
                        'role_id'          => $usr_role,
                        'user_name'        => $usr_name,
                        'user_password'    => md5($usr_cpass),
                        'user_full_name'   => $usr_full_name,
                        'user_telp'        => $usr_phone,
                        'user_email'       => $usr_email,
                        'user_description' => $usr_des,
                        'user_active'      => $usr_act
                    ),array('user_id' => $id));

                    $data['error'] = false;
                    $data['message'] =  "<b>Success!</b> <br>Data successfully saved.";
                    }
                }
                else {
                    $this->user_model->update(array(
                    'role_id'          => $usr_role,
                    'user_name'        => $usr_name,
                    'user_full_name'   => $usr_full_name,
                    'user_telp'        => $usr_phone,
                    'user_email'       => $usr_email,
                    'user_description' => $usr_des,
                    'user_active'      => $usr_act
                ),array('user_id' => $id));
                
                $data['error'] = false;
                $data['message'] =  "<b>Success!</b> <br>Data successfully saved.";
                }
            }
            
            echo json_encode($data);
        }    
    }
    
    function delete($id=0) {
        if($this->input->post('token')){
            $find_user = $this->user_model->get_by(array('user_id' => $id));
            if(count($find_user) > 0) 
                echo '<b>Peringatan!</b> Data tidak bisa dihapus, user ini masih digunakan user lain.!';
            else {
                $this->user_to_menu_model->delete_by(array('user_id' => $id));
                $this->user_model->delete_by(array('user_id' => $id));
                
                echo "<b>Success!</b> Data berhasil dihapus!";
            }
        }
    }
    
    function delete_checked() {
        if($this->input->post('token')) {
            $checkbox         = isset($_POST['check']) ? $_POST['check'] : 0; 
            $countCheck       = count($checkbox);
            $n                = 0;
            $f                = 0;

            if($countCheck == 0) 
                    echo "<b>Error!</b> Tidak ada dosen yang ingin anda hapus , slilahkan pilih dosen !";
            else {
                for($i=0;$i<$countCheck;$i++) {
                    $del_id  =  $checkbox[$i];
                    try {
                        $find_user = $this->user_model->get_by(array('user_id' => $del_id));
                        if(count($find_user) > 0) 
                            $f++;
                        else {
                            $this->user_to_menu_model->delete_by(array('user_id' => $del_id));
                            $this->user_model->delete_by(array('user_id' => $del_id));
                            
                            $n++;
                        }
                    } catch(Exception $e) {
                        $f++;
                    }
                }

                if($n > 0)
                    echo "<b>Success</b> : Total ".$n." data telah dihapus dan ".$f." tidak bisa dihapus !";
                else 
                    echo "<b>Fatal Error</b> : Data tidak bisa dihapus !";	

            }
        }
    }
}

?>
