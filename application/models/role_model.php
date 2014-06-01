<?php

class role_model extends MY_Model {
    function __construct() {
        parent::__construct('tb_role');
        
        $this->set_primary_key('role_id');
    }
    
    function get_data_all($limit,$offset) {
        $this->get_order("DESC");
        $this->set_limit($limit,$offset);
        
        return $this->get_all();
    }
    
    function get_data_search_count($data) {
        $this->set_like_search($data);
        
        return count($this->get_all());
    }
            
    function get_data_search_limit($limit,$offset,$data) {
        $this->get_order("DESC");
        $this->set_limit($limit,$offset);
        $this->set_like_search($data);
        
        return $this->get_all();
    }
}
