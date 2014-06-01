        <div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
            <div class="ext-container">
                <?php
                    if(count($result) < 0) 
                        echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Data tidak ditemukan !</div>';
                    else {
                        foreach($result as $res);
                ?>
                <form class="form-insert" name="form-insert" action="<?= base_url(); ?>user/update/<?php echo $res->user_id; ?>" method="post" data-target="<?= base_url(); ?>user/">
                    <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
                        <div class="col-md-9 ext-no-padding ext-no-padding">
                            <div class="ext-panel-header">Add Data User<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                <label class="ext-label">Username : </label><input value="<?php echo $res->user_name; ?>" name="usr_name" style="width: 30%; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Username" required>
                                <br>
                                <label class="ext-label">Password : </label><input name="usr_pass" style="width: 30%; margin-bottom: 10px;" type="password" class="ext-input" placeholder="Password">
                                <br>
                                <label class="ext-label">Password Confirm : </label>
                                <input type="password" name="usr_cpass" style="width: 30%; margin-left: -3px;" class="ext-input" placeholder="Confirm Password" >
                                <br><br>
                                <label class="ext-label"> </label>
                                <b>NB : </b> If you want to change your password please complete the password and confirm password.
                                <br><br>
                                <label class="ext-label">Full Name : </label><input value="<?php echo $res->user_full_name; ?>" name="usr_full_name" style="width: 30%; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Full Name" required>
                                <br>
                                <label class="ext-label">User Phone : </label>
                                <input value="<?php echo $res->user_telp; ?>" name="usr_phone" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" type="text" class="ext-input" placeholder="Phone" required>
                                <br>
                                <label class="ext-label">Email : </label>
                                <input value="<?php echo $res->user_email; ?>" name="usr_email" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" type="email" class="ext-input" placeholder="Email" required>
                                <br>
                                <label class="ext-label"></label>
                                <textarea name="usr_des" class="ext-input" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" placeholder="Description"><?php echo $res->user_description; ?></textarea>
                                
                                <div class="clearfix"></div>
                                <div style="margin-top: 10px;" class="form-group">
                                    <label class="ext-label">&nbsp;</label>
                                    <input class="ext-button-success" type="submit" name="submit" value="Simpan">
                                </div>
                                <input type="hidden" name="token" value="<?= md5(date('Ymdhis')); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 ext-no-padding ext-no-padding-last">
                            <div class="ext-panel-header">User Setting <span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                <b>Active User <br> </b>
                                <span class="small-font">
                                    Setting your user. active or not active
                                </span>
                                <br><br>
                                <select name="usr_act" class="ext-input">
                                    <option value="1" <?php echo 1 == $res->user_active ? "selected" : ""; ?> >Active</option>
                                    <option value="0" <?php echo 0 == $res->user_active ? "selected" : ""; ?> >Nonactive</option>
                                </select>
                                
                                <br><br>
                                <b>Role User <br> </b>
                                <span class="small-font">
                                    Setting role user.
                                </span>
                                <br><br>
                                <select name="usr_role" class="ext-input">
                                    <option value="0">Choose Role User</option>
                                    <?php
                                        if(count($roles) > 0)
                                            foreach($roles as $role) {
                                                $selected = $res->role_id == $role->role_id ? "selected" : "";
                                                echo '<option value="'.$role->role_id.'" '.$selected.'>'.$role->role_name.'</option>';
                                            }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
        
        <script src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>
        
       
       