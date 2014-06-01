<?php
    if(!defined('BASEPATH')) exit("No script allowed.");
    
    class login extends CI_Controller {
        function __construct() {
            parent::__construct();
            
            $this->load->model(array('login_model','user_model'));
        }
        
        function index() {
            $this->title = "Login";
            $this->page  = "login";
            
            $data['error'] = false;
            $is_submited   = $this->input->post();
            
            
            if($is_submited) {
                extract($this->input->post());
                
                if($username != "" && $password != "") {
                    $checkauth = $this->user_model->get_by(array('user_name' => $username , 'user_password' => md5($password)));
                    if($checkauth) {
                        foreach($checkauth as $user);

                        $data_session = array(
                            'vmsuser'  => $user->user_id,
                            'role_id'        => $user->role_id,
                            'status_log'     => true
                        );
                        $this->session->set_userdata($data_session);
                        redirect('beranda?last_id='.md5('Ymdhis'));
                    }
                    else {
                       $data['error']   = true;
                       $data['message'] = 'Username atau password yang anda gunakan salah, silakan cek kembali akun anda.';
                    }
                }
                else {
                    $data['error']   = true;
                    $data['message'] = 'Username atau password yang anda gunakan salah, silakan cek kembali akun anda.';
                }
            }            
            
            $this->load->view('content/login',$data);
        } 
    }
