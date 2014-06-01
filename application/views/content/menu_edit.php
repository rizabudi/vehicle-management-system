        <div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
            <div class="ext-container">
                <?php
                    if(count($result) == 0) {
                        echo "";
                    }
                    else {
                        foreach($result as $res);
                ?>
                <form class="form-insert" name="form-insert" action="<?= base_url(); ?>menu/update/<?php echo $res->menu_id; ?>" method="post" data-target="<?= base_url(); ?>menu/">
                    <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
                        <div class="col-md-9 ext-no-padding ext-no-padding">
                            <div class="ext-panel-header">Edit Menu <span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                    <input value="<?php echo $res->menu_name; ?>" name="menu_name" style="width: 100%; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Nama Menu" required>
                                    
                                    <hr>
                                    <b>Parent Menu <br> </b>
                                    <span class="small-font">
                                        Pengaturan parent yang akan digunakan menu.
                                    </span>
                                    <br><br>
                                    Parent menu aktif : <b>
                                    <?php
                                        $find_menu = $this->menu_model->get_by(array('menu_id' => $res->menu_parent));
                                        
                                        if(count($find_menu) > 0) {
                                            foreach($find_menu as $fmenu)
                                                echo $fmenu->menu_name;
                                        }
                                        else 
                                            echo "Dijadikan Menu Parent";
                                    ?></b>
                                    <br><br>
                                    <select name="menu_parent" class="ext-input">
                                        <option value="0" <?= $res->menu_parent == 0 ? "selected" : ""; ?> >Jadikan Sebagai Parent Menu</option>
                                        <?php echo $parents; ?>
                                    </select>
                                    <hr>
                                    
                                    <textarea id="redactor" style="width: 100%; height: 200px;" name="menu_description" class="ext-input" placeholder="Tuliskan Deskripsi" required><?php echo $res->menu_description; ?></textarea>
                                    <div style="margin-top: 10px;" class="form-groupo">
                                        <input class="ext-button-success" type="submit" name="submit" value="Simpan">
                                    </div>
                                    <input type="hidden" name="token" value="<?= md5(date('Ymdhis')); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 ext-no-padding ext-no-padding-last">
                            <div class="ext-panel-header">Pengaturan Menu <span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                <b>Tampilkan Menu <br> </b>
                                <span class="small-font">
                                    Pengaturan untuk menampikan atau tidak menu yang dibuat.
                                </span>
                                <br><br>
                                <select name="menu_act" class="ext-input">
                                    <option value="1" <?php echo $res->menu_active == 1 ? "selected" : ""; ?> >Ditampilkan</option>
                                    <option value="0" <?php echo $res->menu_active == 0 ? "selected" : ""; ?> >Sembunyikan</option>
                                </select>
                                <hr>
                                
                                <b>Icon Menu <br> </b>
                                <span class="small-font">
                                    Pengaturan icon yang akan digunakan menu.
                                </span>
                                <br><br>
                                <input name="menu_icon" class="ext-input" placeholder="Class Name" value="<?php echo $res->menu_icon; ?>">
                                <hr>
                                
                                <b>Controller Menu <br> </b>
                                <span class="small-font">
                                    Pengaturan controller yang akan digunakan menu.
                                </span>
                                <br><br>
                                <input name="menu_controller" class="ext-input" placeholder="Controller : beranda" value="<?php echo $res->menu_controller; ?>">
                                
                                <hr>
                                <b>Link Menu <br> </b>
                                <span class="small-font">
                                    Pengaturan link yang akan digunakan menu.
                                </span>
                                <br><br>
                                <input name="menu_link" class="ext-input" placeholder="Link : all " value="<?php echo $res->menu_link; ?>">

                            </div>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                    </div>
                </form>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/js/redactor/redactor.min.js"></script>
        <script type="text/javascript">
            $(function() {			
               $('#redactor').redactor({ 
                   imageUpload : '<?= base_url()?>upload/image_resize',
                   fileUpload  : '<?= base_url()?>upload/file'
               });
            }); 
        </script>
        
        <!-- include every page -->
        <script src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>
       
       