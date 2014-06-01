<?php
    if(!defined('BASEPATH')) {
        exit("No script allowed");
    }

    class Login_Model extends MY_Model {
        function __construct() {
            parent::__construct();
        }
       
        function checkauth() {
            if($this->session->userdata('user_name')) {
                return true;
            }
            
            return false;
        } 
    }
