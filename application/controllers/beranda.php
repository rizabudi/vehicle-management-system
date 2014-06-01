<?php

class beranda extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->title = "Beranda";
        $this->page  = "beranda";

        if ($this->input->get('token'))
            echo $this->load->view('content/beranda');
        else
            $this->load->view($this->container, $this->load_target . "/" . $this->page);
    }

    function view() {
        if ($this->input->get('token'))
            echo $this->load->view('content/beranda');
        else
            $this->load->view($this->container, $this->load_target . "/" . $this->page);
    }

}
