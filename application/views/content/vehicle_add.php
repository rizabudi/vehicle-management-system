        <div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
            <div class="ext-container">
                <form class="form-insert" name="form-insert" action="<?= base_url(); ?>vehicle/save" method="post" data-target="<?= base_url(); ?>vehicle/">
                    <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
                        <div class="col-md-9 ext-no-padding ext-no-padding">
                            <div class="ext-panel-header">Add Data Vehicle<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                <label class="ext-label">Name Vehicle : </label>
                                <input name="vehicle_name" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" type="text" class="ext-input" placeholder="Vehicle Name" required>
                                <br>
                                <label class="ext-label">Plate License : </label><input name="vehicle_plate" style="width: 30%; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Vehicle Plate" required>
                                <br>
                                <label class="ext-label">Mile Age : </label><input name="vehicle_mileage" style="width: 120px; margin-bottom: 10px;" type="text" class="ext-input" placeholder="Mile Age" required>
                                <br>
                                <label class="ext-label">Registration Date : </label>
                                <input type="text" name="vehicle_register" style="width: 120px; margin-left: -3px;" class="ext-input dpicker" placeholder="0000-00-00" value="<?= date('Y-m-d'); ?>" readonly required >
                                <br><br>
                                <label class="ext-label">Vehicle Phone : </label>
                                <input name="vehicle_phone" style="width: 30%; margin-bottom: 10px; margin-left: -3px;" type="text" class="ext-input" placeholder="Vehicle Phone" required>
                                
                                <div class="clearfix"></div>
                                <div style="margin-top: 10px;" class="form-group">
                                    <label class="ext-label">&nbsp;</label>
                                    <input class="ext-button-success" type="submit" name="submit" value="Simpan">
                                </div>
                                <input type="hidden" name="token" value="<?= md5(date('Ymdhis')); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 ext-no-padding ext-no-padding-last">
                            <div class="ext-panel-header">Vehicle Setting <span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                            <div class="ext-panel-body">
                                <b>Active Vehicle <br> </b>
                                <span class="small-font">
                                    Setting your vehicle. active or not active
                                </span>
                                <br><br>
                                <select name="vehicle_act" class="ext-input">
                                    <option value="1">Active</option>
                                    <option value="0">Nonactive</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        
        <!-- include every page -->
        <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            $('.dpicker').datepicker({
                format    : 'yyyy-mm-dd'
            });
        </script>
        <script src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>
        
       
       