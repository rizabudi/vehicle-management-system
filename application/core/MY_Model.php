<?php
    /*
     * Model by Vizzca Indra Pratama
     */

    class MY_Model extends CI_Model {
        protected $_db_name = "himit";
        protected $_table   = "";
        protected $_primary_key = "id";
        protected $_status_join = false;
        
        function __construct($table_name = "") {
            parent::__construct();
            
            $CI =& get_instance();
            $CI->load->database();

            $this->_db_name   = $CI->db->database;
            $this->_table     = $table_name;
        }
        
        function get($primary_key) {
            return $this->db->get_by($this->_primary_key,$primary_key)->result_object();
        }
        
        function get_all() {
            return $this->db->get($this->_table)->result_object();
        }
        
        function get_by() {
            $where = func_get_args();
            
            $this->set_where($where);
            return $this->db->get($this->_table)->result_object();            
        }
        
        function get_select_all($select) {
            $this->db->select($select);
            return $this->db->get($this->_table)->result_object();
        }
        
        function get_count() {
            return count($this->db->get($this->_table)->result_object());
        }

        public function get_next_id() {
            return (int) $this->db->select('AUTO_INCREMENT')
                ->from('information_schema.TABLES')
                ->where('TABLE_NAME', $this->_table)
                ->where('TABLE_SCHEMA', $this->db->database)->get()->row()->AUTO_INCREMENT;
        }
                
        function save(array $data) {
            $this->db->insert($this->_table,$data);
	}
        
        function update(array $data, array $where = null){
            $this->db->update($this->_table,$data,$where);
	}
        
        function update_by() {
            $args = func_get_args();
            $data = array_pop($args);
            
            $this->set_where($args);
            $result = $this->db->set($data)->update($this->_table);
            
            if (!$result) {
                return false;
            }

            return $result;
        }
                
        function delete($id) {
            $this->db->delete_by($this->_primary_key,$id);  
	}
        
        function delete_by() {
            $where = func_get_args();
            $this->set_where($where);
            
            $this->db->delete($this->_table);
        }
        
        function get_order($order="ASC") {
            $this->db->order_by($this->_primary_key, $order);
        }
                
        function get_query($sql) {
            return $this->db->query($sql)->result_object();
        }
        
        function set_join($data) {
            if(count($data) > 0) {
                foreach($data as $join => $val) {
                    $this->db->join($join,$val);
                }
                
                $this->_status_join = true;
            }
        }
        
        /*
         * function helper
         */
        
        function set_table($table) {
            $this->_table = $table;
        }
                        
        function set_primary_key($key) {
            $this->_primary_key = $key;
        }
        
        function set_like_search($params) {
            $this->db->where(array($this->_primary_key." <> " => 0));
            $this->db->or_like($params);
        }

        public function set_where($params) {
            if (count($params) == 1) {
                $this->db->where($params[0]);
            }
            else if(count($params) == 2) {
                $this->db->where($params[0], $params[1]);
            }
            else if(count($params) == 3) {
                $this->db->where($params[0], $params[1], $params[2]);
            }
            else {
                $this->db->where($params);
            }
        }
        
        protected function set_limit($offset,$value) {
            $this->db->limit ($value, $offset);
        }
                       
        function get_table_scheme() {
            $sql = "SELECT `COLUMN_NAME` 
                    FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                    WHERE `TABLE_SCHEMA`='$this->_db_name' 
                        AND `TABLE_NAME`='$this->_table'";
            
            return $this->get_query($sql);
        }
    }