<?php
    class menu_model extends MY_Model {
        function __construct() {
            parent::__construct("tb_menu");
            
            $this->set_primary_key('menu_id');
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
        
        function get_menu_by_role_id($roleid) {
            $this->db->select("*");
            $this->db->from("tb_menu");
            $this->db->join("roletomenu", "tb_menu.menu_id = roletomenu.menu_id");
            $this->db->where("roletomenu.role_id = $roleid");
                        
            return $this->db->get()->result_object();
        }
        
        function get_tree_data_menu_modal($parent) {
            $this->db->select("*");
            $this->db->from("tb_menu");
            $this->db->where(array('menu_parent' => $parent));
                        
            return $this->db->get()->result_object();
        }
        
        function get_tree_menu_modal($parent,$roleid=0) {
            $this->db->select("*");
            $this->db->from("tb_menu");
            $this->db->join("roletomenu", "tb_menu.menu_id = roletomenu.menu_id");
            $this->db->where("roletomenu.role_id = $roleid and tb_menu.menu_parent = 0 order by tb_menu.menu_order asc");
                        
            return $this->db->get()->result_object();
        }
                
        function get_tree_menu_model($id) {
            $this->db->select("*");
            $this->db->from("tb_menu");
            $this->db->where("menu_parent = $id order by menu_order asc");
                        
            return $this->db->get()->result_object();
        }
        
        function checkrole($roleid,$menuid) {
            $this->db->from('roletomenu');
            $this->db->where(array('role_id' => $roleid,'menu_id' => $menuid));
            
            $result = $this->db->get()->result_object();
            
            if(count($result) > 0) 
                return true;
            
            return false;
        }
    }
