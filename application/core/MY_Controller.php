<?php
    class MY_Controller extends CI_Controller {
       public $module       = "";  
       public $load_target  = "container";  
       public $container    = "content";  
       public $module_value = "";  
       
       public function __construct() {
            parent::__construct();
            
            /* Konfigurasi Model
             * load Model
             */
            $this->load->model('menu_model');
            
            /*
             * checkauth() apakah user login atau belum.
             */
            $this->module       = $this->uri->segment(1);
            $this->module_value = $this->uri->segment(2);
            $this->load_target  = "content";
            $this->container    = "container";
            $this->title        = "Beranda";
            $this->page         = "beranda";
            $this->menu_active  = $this->uri->segment(1) != "" ? $this->uri->segment(1) : "beranda";
            
            /*
             * Setting sidebar administrator
             */
            
            $roleid = 0;
            if($this->checkauth()) {
                $roleid = $this->session->userdata('role_id');
            }
            
            $this->module_admin = $this->uri->segment(1);
            $this->login        = $this->checkauth();
            $this->menus        = $this->menu_model->get_menu_by_role_id($roleid);
            $this->datas        = $this->get_tree_model();
            
            $find = false;
            foreach($this->menus as $menu) {
                if(strtolower($menu->menu_alias) == strtolower($this->module_admin)) {
                    $find = true;
                }
            }
            
            if($find == false && $this->module_admin != "login" && $this->module_admin != "beranda") {
                if($this->input->get('token')) {
                    echo $this->load->view('content_admin/beranda');
                }
                else
                    redirect('login');
            }
        }
        
        function get_tree_model() {
            $data = '';
            $roleid = 0;
            if($this->checkauth()) {
                $roleid = $this->session->userdata('role_id');
            }
            
            $menus = $this->menu_model->get_tree_menu_modal(0,$roleid);
            if($menus) {
                foreach($menus as $menu) {
                    if($menu->menu_type) {
                        $data .= '<li class="parent" style="background: #157fcc;">
                                    <a href="#">
                                      <span class="'.$menu->menu_icon.'"></span> '.$menu->menu_name.' <span class="ext ext-cog"></span>
                                    </a>
                                    <ul class="nav nav-second-level">';
                        
                        $data .= $this->get_tree_models($menu->menu_id);
                        $data .= '  </ul>
                                </li>';
                    }
                    else {
                        $data .= '<li class="child"><a href="/'.$menu->menu_controller.'/'.$menu->menu_link.'" title="'.$menu->menu_description.'" target="'.$menu->menu_controller.'"><span class="glyphicon glyphicon-home"></span>  '.$menu->menu_name.'</a></li>';
                        $data .= $this->get_tree_models($menu->menu_id);
                    }
                }
            }
            
            return $data;
        }
        
        function get_tree_models($id) {
            $data = '';
            $roleid = 0;
            if($this->checkauth()) {
                $roleid = $this->session->userdata('role_id');
            }
            
            $result = $this->menu_model->get_tree_menu_model($id);
            if($result) {
                foreach($result as $menu) {
                    if($this->menu_model->checkrole($roleid,$menu->menu_id)) 
                        $data .= '<li class="child"><a href="'.base_url().$menu->menu_controller.'/'.$menu->menu_link.'" title="'.$menu->menu_description.'" target="'.$menu->menu_controller.'"><span class="'.$menu->menu_icon.'"></span>  '.$menu->menu_name.'</a></li>';
                    
                    $data .= $this->get_tree_models($menu->menu_id);
                }
            }
            
            return $data;
	}

        private function checkauth() {
            if(!$this->session->userdata('vmsuser')) {
                return false;
            }
            return true;
        }
        
        private function checkauth_redirect() {
            if(!$this->session->userdata('vmsuser')) 
                redirect('/login');
        }

        private function logout() {
            $this->session->sess_destroy();
        }
        
        function is_submited() {
            if($this->input->post())
                return TRUE;
            
            return false;
        }
    }
