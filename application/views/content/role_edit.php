        <div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
            <div class="ext-container">
                <?php
                    if(count($result) < 0) 
                        echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Data tidak ditemukan !</div>';
                    else {
                        foreach($result as $res);
                ?>
                <form class="form-insert" name="form-insert" action="<?= base_url(); ?>role/update/<?= $res->role_id; ?>" method="post" data-target="<?= base_url(); ?>role/">
                    <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
                        <div class="col-md-9 ext-no-padding ext-no-padding">
                            <div class="ext-panel-header">Tambah Role <span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                    <input value="<?= $res->role_name; ?>" name="role_name" style="width: 100%; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Nama Role" required>
                                    <textarea id="redactor" style="width: 100%; height: 200px;" name="role_des" class="ext-input" placeholder="Tuliskan Deskripsi" required><?= $res->role_description; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 ext-no-padding ext-no-padding-last">
                            <div class="ext-panel-header">Pengaturan Role <span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                <b>Tampilkan Role <br> </b>
                                <span class="small-font">
                                    Pengaturan untuk menampikan atau tidak Role yang dibuat.
                                </span>
                                <br><br>
                                <select name="role_act" class="ext-input">
                                    <option value="1" <?= $res->role_active == 1 ? "selected" : ""; ?>>Aktif</option>
                                    <option value="0" <?= $res->role_active == 0 ? "selected" : ""; ?>>Nonaktif</option>
                                </select>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-9 ext-no-padding ext-no-padding" style="margin-top: 10px;">
                            <div class="ext-panel-header">Privilage Menu <span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                    <?php
                                        if(count($menus) > 0) {
                                            $i = 0;
                                            foreach($menus as $menu) {
                                                $find_role = $this->role_to_menu_model->get_by(array('role_id' => $res->role_id, 'menu_id' => $menu->menu_id));
                                                $checked   = count($find_role) > 0 ? "checked" : "";
                                                
                                                echo '<div style="float: left; min-width: 300px;padding: 5px;"><input type="checkbox" name="acc[]" id="acc['.$i.']" value="'.$menu->menu_id.'" '.$checked.' /> '.$menu->menu_name.' </div>';
                                            
                                                $i++;
                                            }
                                        }
                                        else {
                                            echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> <b>Peringatan!</b> Tidak ada menu yang tersedia.</div>';
                                        }
                                        
                                    ?>
                                    
                                    <div class="clearfix"></div>
                                    <div style="margin-top: 10px;" class="form-groupo">
                                        <input class="ext-button-success" type="submit" name="submit" value="Simpan">
                                    </div>
                                    <input type="hidden" name="token" value="<?= md5(date('Ymdhis')); ?>">
                            </div>
                        </div>
                    </div>
                    
                </form>
                <?php } ?>
            </div>
        </div>
        
        <!-- include every page -->
        <script src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>
       
       