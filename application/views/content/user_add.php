        <div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
            <div class="ext-container">
                <form class="form-insert" name="form-insert" action="<?= base_url(); ?>user/save" method="post" data-target="<?= base_url(); ?>user/">
                    <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
                        <div class="col-md-9 ext-no-padding ext-no-padding">
                            <div class="ext-panel-header">Add Data User<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                <label class="ext-label">Username : </label><input name="usr_name" style="width: 30%; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Username" required>
                                <br>
                                <label class="ext-label">Password : </label><input name="usr_pass" style="width: 30%; margin-bottom: 10px;" type="password" class="ext-input" placeholder="Password" required>
                                <br>
                                <label class="ext-label">Password Confirm : </label>
                                <input type="password" name="usr_cpass" style="width: 30%; margin-left: -3px;" class="ext-input" required placeholder="Confirm Password" >
                                <br><br>
                                <label class="ext-label">Full Name : </label><input name="usr_full_name" style="width: 30%; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Full Name" required>
                                <br>
                                <label class="ext-label">User Phone : </label>
                                <input name="usr_phone" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" type="text" class="ext-input" placeholder="Phone" required>
                                <br>
                                <label class="ext-label">Email : </label>
                                <input name="usr_email" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" type="email" class="ext-input" placeholder="Email" required>
                                <br>
                                <label class="ext-label"></label>
                                <textarea name="usr_des" class="ext-input" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" placeholder="Description"></textarea>
                                
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
                                    <option value="1">Active</option>
                                    <option value="0">Nonactive</option>
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
                                                echo '<option value="'.$role->role_id.'">'.$role->role_name.'</option>';
                                            }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        
        <script src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>
        
       
       