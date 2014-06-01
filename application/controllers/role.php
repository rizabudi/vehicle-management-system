<?php

if (!defined('BASEPATH'))
    exit('No script no allowed');

class role extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model(array('role_model','role_to_menu_model','user_model'));
    }

    function index() {
        $this->view();
    }

    function view() {
        $this->load->library('pagination');
        $this->page = "role_view";

        /*
         * PAGINATION SETTING
         */

        $config['base_url'] = base_url() . $this->uri->segment(1) . "/view";
        $config['total_rows'] = $this->role_model->get_count();
        $config['per_page']   = $this->config->item('number_per_page_paging');
        $config['uri_segment'] = 3;
        $offset = (!is_numeric($this->uri->segment(3)) || $this->uri->segment(3) < 1) ? 0 : $this->uri->segment(3);

        /*
         * DATA SETTING 
         */

        if ($this->input->get("search")) {
            $q = $this->input->get('q');
            $data['select'] = array('role_name' => $q, 'role_description' => $q);
            $config['total_rows'] = $this->role_model->get_data_search_count($data['select']);
            $data['result'] = $this->role_model->get_data_search_limit($offset, $config['per_page'], $data['select']);
        }
        else
            $data['result'] = $this->role_model->get_data_all($offset, $config['per_page']);

        $this->pagination->initialize($config);

        /*
         * AJAX HANDLER
         */

        if ($this->input->get('token'))
            echo $this->load->view('content/role_view', $data);
        else
            $this->load->view($this->container, $data);
    }
    
    function edit($id = 0) {
        $this->page = 'role_edit';
        $data['id'] = $id;
        $cek        = $this->role_model->get_by(array('role_id'=>$id));
        
        $this->load->model(array('menu_model'));
        $data['menus'] = $this->menu_model->get_all();
        
        if(count($cek)>0) 
            $data['result'] = $cek;
        
        if($this->input->get('token')) 
            echo $this->load->view('content/role_edit',$data);
        else
            $this->load->view($this->container,$data);
    }
    
    function add() {
        $this->page = "role_add";
        
        $this->load->model(array('menu_model'));
        $data['menus'] = $this->menu_model->get_all();
        
        if($this->input->get('token')) 
            echo $this->load->view('content/role_add',$data);
        else
            $this->load->view($this->container,$data);
        
    }
    
    function save() {
        if($this->input->post('token')){
            extract($this->input->post());
            
            $data['error'] = true;
            
            $checkbox    = isset($_POST['acc'])?$_POST['acc'] : 0; 
            $countCheck  = count($checkbox);
            
            if($role_name == "" || $role_des == "")
                $data['message'] = "<b>Warning!</b> <br>Complete your unput data.";
            else {
                $id_role = $this->role_model->get_next_id();
                
                $this->role_model->save(array(
                    'role_name'        => $role_name,
                    'role_description' => $role_des,
                    'role_active'      => $role_act
                ));
                
                for($i=0;$i<$countCheck;$i++) {
                    $id_menus = $checkbox[$i];

                    if($id_menus != "") {
                        $this->role_to_menu_model->save(array(
                            'role_id'   => $id_role,
                            'menu_id'   => $id_menus
                        ));
                    }
                }
                
                $data['error'] = false;
                $data['message'] = "<b>Success!</b> <br>Data successfuly saved.";
            }
            
            echo json_encode($data);
        }
    }
    
    function update ($id=0){
        if($this->input->post('token')){
            extract($this->input->post());
            
            $id          = !is_numeric($id) ? 0 : $id;
            $checkbox    = isset($_POST['acc'])?$_POST['acc'] : 0; 
            $countCheck  = count($checkbox);
            
            if($role_name == "" || $role_des == "")
                $data['message'] = "<b>Warning!</b> <br>Complete your input data.";
            else {
                $this->role_to_menu_model->delete_by(array('role_id' => $id));
                
                $this->role_model->update(array(
                    'role_name'        => $role_name,
                    'role_description' => $role_des,
                    'role_active'      => $role_act
                ),array('role_id' => $id));
                
                for($i=0;$i<$countCheck;$i++) {
                    $id_menus = $checkbox[$i];

                    if($id_menus != "") {
                        $this->role_to_menu_model->save(array(
                            'role_id'   => $id,
                            'menu_id'   => $id_menus
                        ));
                    }
                }
                
                $data['error'] = false;
                $data['message'] = "<b>Success!</b> <br>Data successfuly saved";
            }
            echo json_encode($data);
        }
    }
    
    function delete($id=0) {
        if($this->input->post('token')){
            $find_user = $this->user_model->get_by(array('role_id' => $id));
            if(count($find_user) > 0) 
                echo '<b>Peringatan!</b> Data cant be deleted, the role is already use in some user.!';
            else {
                $this->role_to_menu_model->delete_by(array('role_id' => $id));
                $this->role_model->delete_by(array('role_id' => $id));
                
                echo "<b>Success!</b> Data successfuly deleted!";
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
                    echo "<b>Error!</b> Please select your item!";
            else {
                for($i=0;$i<$countCheck;$i++) {
                    $del_id  =  $checkbox[$i];
                    try {
                        $find_user = $this->user_model->get_by(array('role_id' => $del_id));
                        if(count($find_user) > 0) 
                            $f++;
                        else {
                            $this->role_to_menu_model->delete_by(array('role_id' => $del_id));
                            $this->role_model->delete_by(array('role_id' => $del_id));
                            
                            $n++;
                        }
                    } catch(Exception $e) {
                        $f++;
                    }
                }

                if($n > 0)
                    echo "<b>Success</b> : Total ".$n." data deleted dan ".$f." cant be deleted!";
                else 
                    echo "<b>Fatal Error</b> : Cant delete data !";	

            }
        }
    }
}

?>
