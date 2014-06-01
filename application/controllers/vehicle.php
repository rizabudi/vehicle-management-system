<?php

if (!defined('BASEPATH'))
    exit('No script no allowed');

class vehicle extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model(array('vehicle_model'));
    }

    function index() {
        $this->view();
    }

    function view() {
        $this->load->library('pagination');
        $this->page = "vehicle_view";

        /*
         * PAGINATION SETTING
         */

        $config['base_url'] = base_url() . $this->uri->segment(1) . "/view";
        $config['total_rows'] = $this->vehicle_model->get_count();
        $config['per_page'] = $this->config->item('number_per_page_paging');
        $config['uri_segment'] = 3;
        $offset = (!is_numeric($this->uri->segment(3)) || $this->uri->segment(3) < 1) ? 0 : $this->uri->segment(3);

        /*
         * DATA SETTING 
         */

        if ($this->input->get("search")) {
            $q = $this->input->get('q');
            $data['select'] = array('vehicle_name' => $q, 'vehicle_mileage' => $q, 'vehicle_phone' => $q);
            $config['total_rows'] = $this->vehicle_model->get_data_search_count($data['select']);
            $data['result'] = $this->vehicle_model->get_data_search_limit($offset, $config['per_page'], $data['select']);
        }
        else
            $data['result'] = $this->vehicle_model->get_data_all($offset, $config['per_page']);

        $this->pagination->initialize($config);

        /*
         * AJAX HANDLER
         */

        if ($this->input->get('token'))
            echo $this->load->view('content/vehicle_view', $data);
        else
            $this->load->view($this->container, $data);
    }
    
    function edit($id = 0) {
        $this->page = 'vehicle_edit';
        $data['id'] = $id;
        $cek        = $this->vehicle_model->get_by(array('vehicle_id'=>$id));
        
        $this->load->model(array('menu_model'));
        $data['menus'] = $this->menu_model->get_all();
        
        if(count($cek)>0) 
            $data['result'] = $cek;
        
        if($this->input->get('token')) 
            echo $this->load->view('content/vehicle_edit',$data);
        else
            $this->load->view($this->container,$data);
    }
    
    function add() {
        $this->page = "vehicle_add";
        
        $this->load->model(array('menu_model'));
        $data['menus'] = $this->menu_model->get_all();
        
        if($this->input->get('token')) 
            echo $this->load->view('content/vehicle_add',$data);
        else
            $this->load->view($this->container,$data);
        
    }
    
    function save() {
        if($this->input->post('token')){
            extract($this->input->post());
            $data['error'] = true;
            
            if($vehicle_name == "" || $vehicle_plate == "" )
                $data['message'] =  "<b>Warning!</b> <br>Complete your input data.";
            else {
                $this->vehicle_model->save(array(
                    'vehicle_name'          => $vehicle_name,
                    'vehicle_license_plate' => $vehicle_plate,
                    'vehicle_mileage'       => $vehicle_mileage,
                    'model_id'              => 0,
                    'vehicle_registration'  => $vehicle_register,
                    'vehicle_IMEI'          => 0,
                    'vehicle_phone'         => $vehicle_phone,
                    'vehicle_validation'    => "0000-00-00",
                    'vehicle_status'        => $vehicle_act,
                ));
                
                $data['error'] = false;
                $data['message'] =  "<b>Success!</b> <br>Data successfuly saved.";
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
            
            if($vehicle_name == "" || $vehicle_des == "")
                echo "<b>Warning!</b> <br>Complete your input data.";
            else {
                $this->vehicle_to_menu_model->delete_by(array('vehicle_id' => $id));
                
                $this->vehicle_model->update(array(
                    'vehicle_name'        => $vehicle_name,
                    'vehicle_description' => $vehicle_des,
                    'vehicle_active'      => $vehicle_act
                ),array('vehicle_id' => $id));
                
                for($i=0;$i<$countCheck;$i++) {
                    $id_menus = $checkbox[$i];

                    if($id_menus != "") {
                        $this->vehicle_to_menu_model->save(array(
                            'vehicle_id'   => $id,
                            'menu_id'   => $id_menus
                        ));
                    }
                }
                
                echo "<b>Success!</b> <br>Data successfuly saved.";
            }
        }
    }
    
    function delete($id=0) {
        if($this->input->post('token')){
            $this->vehicle_model->delete_by(array('vehicle_id' => $id));

            echo "<b>Success!</b> Data successfully deleted.";
        }
    }
    
    function delete_checked() {
        if($this->input->post('token')) {
            $checkbox         = isset($_POST['check']) ? $_POST['check'] : 0; 
            $countCheck       = count($checkbox);
            $n                = 0;
            $f                = 0;

            if($countCheck == 0) 
                    echo "<b>Error!</b> No selected item, please select your item if you want to delete !";
            else {
                for($i=0;$i<$countCheck;$i++) {
                    $del_id  =  $checkbox[$i];
                    try {
                        $this->vehicle_model->delete_by(array('vehicle_id' => $del_id));
                        $n++;
                    } catch(Exception $e) {
                        $f++;
                    }
                }

                if($n > 0)
                    echo "<b>Success</b> : Total ".$n." data success dan ".$f." can't delete !";
                else 
                    echo "<b>Fatal Error</b> : Data can't for delete. !";	

            }
        }
    }
}

?>
