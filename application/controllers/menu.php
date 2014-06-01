<?php
if(!defined('BASEPATH')) exit("No script allowed.");

class menu extends MY_Controller {
    protected $counter = 1;
    
    function __construct() {
        parent::__construct();
        
        $this->load->model(array('menu_model','role_to_menu_model'));
        $this->load->helper(array('image'));
    }
    
    function index() {
        $this->view();
    }
    
    function view() {
        $this->load->library('pagination');
        $this->page = "menu_view";
        
        /*
         * PAGINATION SETTING
         */
        
        $config['base_url']    = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)."/view";
        $config['total_rows']  = $this->menu_model->get_count();
        $config['per_page']    = $this->config->item('number_per_page_paging');
        $config['uri_segment'] = 4;
        $offset                = (!is_numeric($this->uri->segment(4)) || $this->uri->segment(4) < 1) ? 0 : $this->uri->segment(4);
        
        /*
         * DATA SETTING 
         */
        
        if($this->input->get("search")) {
            $q                    = $this->input->get('q');
            $data['select']       = array('menu_name' => $q, 'menu_description' => $q);
            $config['total_rows'] = $this->menu_model->get_data_search_count($data['select']);
            $data['result']       = $this->menu_model->get_data_search_limit($offset,$config['per_page'], $data['select']);
        }
        else {
            //$data['result']  = $this->menu_model->get_data_all($offset,$config['per_page']);
            $this->menu_data = $this->get_tree_menu();
        }
        
        $this->pagination->initialize($config); 
        
        /*
         * AJAX HANDLER
         */
        
        if($this->input->get('token')) 
            echo $this->load->view('content/menu_view');
        else
            $this->load->view($this->container);
    }
  
    function add() {
        $this->page = "menu_add";
        
        $data['parents'] = $this->parent_menu();
        
        if($this->input->get('token')) 
            echo $this->load->view('content/menu_add',$data);
        else
            $this->load->view($this->container,$data);
        
    }
    
    function edit($id = 0) {
        $this->page = 'menu_edit';
        $data['id'] = $id;
        $cek        = $this->menu_model->get_by(array('menu_id'=>$id));
        
        $data['parents'] = $this->parent_menu();
        if(count($cek)>0) 
            $data['result'] = $cek;
        
        if($this->input->get('token')) 
            echo $this->load->view('content/menu_edit',$data);
        else
            $this->load->view($this->container,$data);
    }
    
    function save() {
        if($this->input->post('token')){
            extract($this->input->post());
            $data['error'] = true;
            
            if($menu_name == "" || $menu_description == "")
                $data['message'] =  "<b>Warning!</b> <br>Complete your input data.";
            else {
                $find_orders = $this->menu_model->get_by(array('menu_parent' => $menu_parent));
                $menu_order = 1;
                $menu_level = 1;
                $menu_type  = 0;
                
                if(count($find_orders) > 0) {
                    foreach($find_orders as $forder) {
                        $menu_order = $menu_order > $forder->menu_order ? $menu_order : $forder->menu_order + 1;
                        $menu_level = $forder->menu_level;
                        $menu_type  = $forder->menu_type;
                    }
                }
                
                $find_level = $this->menu_model->get_by(array('menu_id' => $menu_parent));
                if(count($find_level) > 0) {
                    foreach($find_level as $flevel);
                    $menu_level = $flevel->menu_level + 1;
                }
                else 
                    $menu_level = 1;
                
                
                if($menu_parent == 0) 
                    $menu_type = 1;
                
                $this->menu_model->save(array(
                    'menu_name' => $menu_name,
                    'menu_description' => $menu_description,
                    'menu_alias' => strtolower(str_replace(" ", "_", $menu_name)),
                    'menu_icon' => $menu_icon,
                    'menu_controller' => $menu_controller,
                    'menu_link' => $menu_link,
                    'menu_order' => $menu_order,
                    'menu_level' => $menu_level,
                    'menu_parent' => $menu_parent,
                    'menu_type' => $menu_type,
                    'menu_active' => $menu_act
                ));
                
                $data['error'] = false;
                $data['message'] = "<b>Success!</b> <br>Data successfuly saved.";
            }
            
            echo json_encode($data);
        }
    }
    
    function update ($id=0){
        if($this->input->post('token')){
            extract($this->input->post());
            $data['error'] = true;
            $id            = !is_numeric($id) ? 0 : $id;
            
            if($menu_name == "" || $menu_description == "")
                $data['message'] = "<b>Warning!</b> <br>Masukan minimal nama dan deskripsi menu.";
            else {
                $find_orders = $this->menu_model->get_by(array('menu_parent' => $menu_parent));
                $menu_order = 1;
                $menu_level = 1;
                $menu_type  = 0;
                
                if(count($find_orders) > 0) {
                    foreach($find_orders as $forder) {
                        $menu_order = $menu_order > $forder->menu_order ? $menu_order : $forder->menu_order + 1;
                        $menu_level = $forder->menu_level;
                        $menu_type  = $forder->menu_type;
                    }
                }
                
                $find_level = $this->menu_model->get_by(array('menu_id' => $menu_parent));
                if(count($find_level) > 0) {
                    foreach($find_level as $flevel);
                    $menu_level = $flevel->menu_level + 1;
                }
                else 
                    $menu_level = 1;
                
                
                if($menu_parent == 0) 
                    $menu_type = 1;
                
                $this->menu_model->update(array(
                    'menu_name' => $menu_name,
                    'menu_description' => $menu_description,
                    'menu_alias' => strtolower(str_replace(" ", "_", $menu_name)),
                    'menu_icon' => $menu_icon,
                    'menu_controller' => $menu_controller,
                    'menu_link' => $menu_link,
                    'menu_level' => $menu_level,
                    'menu_parent' => $menu_parent,
                    'menu_type' => $menu_type,
                    'menu_active' => $menu_act
                ),array('menu_id' => $id));
                
                $data['error'] = false;
                $data['message'] = "<b>Success!</b> <br>Data successfuly deleted.";
            }
            
            echo json_encode($data);
        }
    }
    
    function valid_delete($menu_id) {
        $find_delete = $this->role_to_menu_model->get_by(array('menu_id' => $menu_id));
        $find_child  = $this->menu_model->get_by(array('menu_parent' => $menu_id));
                
        if(count($find_delete) > 0 || count($find_child) > 0) 
            return false;
        
        return true;
    }
            
    function delete($id=0) {
        if($this->input->post('token')){
            if($this->valid_delete($id)) {
                $this->menu_model->delete_by(array('menu_id' => $id));
                echo "<b>Success!</b> Data successfuly deleted!";
            }
            else 
                echo "<b>Success!</b> Can't delete all data , cause the menu already use in some role user.";
        }
    }
    
    function delete_checked() {
        if($this->input->post('token')) {
            $checkbox         = isset($_POST['check']) ? $_POST['check'] : 0; 
            $countCheck       = count($checkbox);
            $n                = 0;
            $f                = 0;

            if($countCheck == 0) 
                    echo "<b>Error!</b> Please choose menu !";
            else {
                for($i=0;$i<$countCheck;$i++) {
                    $del_id  =  $checkbox[$i];
                    try {
                        if($this->valid_delete($del_id)) {
                            $this->menu_model->delete_by(array('menu_id' => $del_id));
                            $n++;
                        }
                        else 
                            $f++;
                    } catch(Exception $e) {
                        $f++;
                    }
                }

                if($n > 0)
                    echo "<b>Success</b> : Total ".$n." data deleted dan ".$f." can't be delete ! ".$del_id;
                else 
                    echo "<b>Fatal Error</b> : Can't delete data !";	

            }
        }
    }
    
    function get_tree_menu() {
        $this->counter = 1;
        $data_menus    = '';
        $active = "";
        $menus  = $this->menu_model->get_tree_data_menu_modal(0);
        
        if($menus) {
            foreach($menus as $res) {
                if($res->menu_active == 1) 
                    $active = "<span class='label label-success'>Aktif</span>";
                else 
                    $active = "<span class='label label-danger'>Tidak Aktif</span>";
                
                $level = "";
                for($i=1;$i<=count($res->menu_level);$i++) {
                    $level .= "- ";
                }
                
                $data_menus .= '<tr>
                            <td class="head0" align="center" width="5"><input type="checkbox" name="check[]" value=".'.$res->menu_id.'" id="check['.$this->counter.']" /></td>
                            <td class="head1" >'.$this->counter++ .'</td>
                            <td class="head0" ><div class="tree-master left">'.$res->menu_name.'</div></td>
                            <td class="head1" >'.$res->menu_description.'</td>
                            <td class="head0 "align="center">'.$res->menu_order.'</td>
                            <td class="head1">'.$active.'</td>
                            <td class="head0" >    
                                <a href="'. base_url() .'menu/edit/'. $res->menu_id .'?source_id='.md5('Ymdhis').'" target="" class="edit-form ext-button-margin ext-button-success" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="'. base_url() .'menu/delete/'.$res->menu_id.'?source_id='.md5('Ymdhis').'" media="'.current_url().'" target="" class="delete-form ext-button-danger" title="Hapus"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                          </tr>';
                
                $data_menus .= $this->get_tree_menu_rek($res->menu_id);
            }
        }

        return $data_menus;
    }

    function get_tree_menu_rek($id) {
        $data_menus   = '';
        $result = $this->menu_model->get_tree_data_menu_modal($id);
        
        if($result) {
            foreach($result as $res) {
                if($res->menu_active == 1) 
                    $active = "<span class='label label-success'>Aktif</span>";
                else 
                    $active = "<span class='label label-danger'>Tidak Aktif</span>";
                
                $level = 0;
                for($i=1;$i<$res->menu_level;$i++) {
                    $level += 30;
                }
                
                $data_menus .= '<tr>
                            <td class="head0" align="center" width="5"><input type="checkbox" name="check[]" value="'.$res->menu_id.'" id="check['.$this->counter.']" /></td>
                            <td class="head1" >'.$this->counter++ .'</td>
                            <td class="head0" ><div class="tree-master left" style="margin-left:'.$level.'px">'.$res->menu_name.'</div></td>
                            <td class="head1" >'.$res->menu_description.'</td>
                            <td align="center" class="head0">'.$res->menu_order.'</td>
                            <td class="head1">'.$active.'</td>
                            <td class="head0" style="min-width: 13%;" >    
                                <a href="'. base_url() .'menu/edit/'. $res->menu_id .'?source_id='.md5('Ymdhis').'" target="" class="btn edit-form ext-button-margin ext-button-success" title="Edit"><span class="glyphicon glyphicon-pencil"></span> </a>
                                <a href="'. base_url() .'menu/delete/'.$res->menu_id.'?source_id='.md5('Ymdhis').'" media="'.current_url().'" target="" class="delete-form ext-button-danger" title="Hapus"><span class="glyphicon glyphicon-trash"></span> </a>
                            </td>
                          </tr>';
                
                $data_menus .= $this->get_tree_menu_rek($res->menu_id);
            }
        }
        
        return $data_menus;
    }
    
    function parent_menu($id=0) {
        $this->counter = 1;
        $data_menus    = "";
        $menus         = $this->menu_model->get_tree_data_menu_modal($id);
        
        if($menus) {
            foreach($menus as $res) {
                $level = "";
                for($i=1;$i<$res->menu_level;$i++) {
                    $level .= "- ";
                }
                
                $data_menus .= "<option value='$res->menu_id'>$level $res->menu_name</option>";
                $data_menus .= $this->parent_menu($res->menu_id);
            }
        }

        return $data_menus;
    }
}
