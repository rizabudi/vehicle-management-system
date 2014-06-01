<?php

class User_model extends MY_Model {

    function __construct() {
        parent::__construct("tb_user");

        $this->set_primary_key('user_id');
    }

    function login($username, $password) {
        $data_login = array(
            'user_name' => $username,
            'user_password' => md5($password)
        );

        return $this->get_by($data_login);
    }

    function get_data_all($limit, $offset) {
        $this->get_order("DESC");
        $this->set_join(array('tb_role' => "$this->_table.role_id = tb_role.role_id"));
        $this->set_limit($limit, $offset);

        return $this->get_all();
    }

    function get_data_search_count($data) {
        $this->set_join(array('tb_role' => "$this->_table.role_id = tb_role.role_id"));
        $this->set_like_search($data);

        return count($this->get_all());
    }

    function get_data_search_limit($limit, $offset, $data) {
        $this->get_order("DESC");
        $this->set_limit($limit, $offset);
        $this->set_join(array('tb_role' => "$this->_table.role_id = tb_role.role_id"));
        $this->set_like_search($data);

        return $this->get_all();
    }

}
