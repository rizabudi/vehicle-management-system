<?php

if (!defined('BASEPATH'))
    exit('No script no allowed');

class tracking extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model(array('vehicle_model'));
    }

    function index() {
        $this->view();
    }

    function view() {
        $this->load->library('pagination');
        $this->page = "tracking_view";
        
        $data['maps_load'] = false;

        if ($this->input->get('token')) {
            $data['maps_load'] = true;
            echo $this->load->view('content/tracking_view',$data);
        }
        else
            $this->load->view($this->container,$data);
    }
    
}

?>
