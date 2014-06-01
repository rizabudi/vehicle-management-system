<div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
    <div class="ext-container">
        <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
            <div class="col-md-12 ext-no-padding ext-no-padding-last">
                <div class="ext-panel-header">Vehicle Data<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                <div class="ext-panel-body">
                    <form name="formview" class="selected-delete" action="<?php echo base_url(); ?>vehicle/delete_checked" method="post" data-target="<?php echo current_url(); ?>">
                        <div style="margin-bottom: 10px;font-size: 11px;">

                            <a href="<?= base_url(); ?>vehicle/add" target="add" style="margin-top: 5px;" class="add-form ext-button-margin ext-button-success" title="Tambah Baru">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add New
                            </a>
                            <button type="submit" class="ext-button-danger" title="hapus" style="margin-top: 5px; padding: 6px 10px 6px 10px;">
                                <span class="glyphicon glyphicon-trash"></span>
                                Delete selected item
                            </button>

                            <div class="col-sm-3 input-group space pull-right no-border-radius" style="margin-top: 5px;margin-bottom: 5px;">
                                <input type="text" class="search ext-input input-sm pull-left no-border-radius" style="border-radius: 0px;" name="search" id="search" placeholder="Cari disini" value="<?php echo $this->input->get('q') ? $this->input->get('q') : ""; ?>" src="<?= base_url(); ?>vehicle/view">
                                <inpu class="search-btn input-group-addon btn btn-default"><span class="glyphicon glyphicon-repeat" style="margin-top: -3px;"></span></inpu>
                            </div>

                        </div>
                        <div class="table-responsive" style="width: 100%;">
                            <table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable2" style="font-size: 12px; width: 100%;">

                                <thead>
                                    <tr>
                                        <th class="head0" align="center"><input type="checkbox" class="checkall" value="0" onclick="checked_role(2);" /></th>
                                        <th class="head1">No</th>
                                        <th class="head0">Vehicle Name</th>
                                        <th class="head1">Registration Plate</th>
                                        <th class="head0">Vehicle Phone</th>
                                        <th class="head1">Option</th>
                                    </tr>
                                </thead>
                                <?php
                                if (count($result) > 0) {
                                    ?>
                                    <tbody>
                                        <?php
                                        $n = 0;
                                        foreach ($result as $res) {
                                            ?>
                                            <tr>
                                                <td class="head0" align="center"><input type="checkbox" name="check[]" value="<?php echo $res->vehicle_id; ?>" id="check[<?php echo $n; ?>]" /></td>
                                                <td class="head1" ><?php echo $n + 1; ?></td>
                                                <td class="head0" ><?php echo $res->vehicle_name; ?></td>
                                                <td class="head1" ><?php echo $res->vehicle_license_plate; ?></td>
                                                <td class="head0" ><?php echo $res->vehicle_phone; ?></td>
                                                <td class="head1" style="min-width: 13%;">    
                                                    <a href="<?php echo base_url(); ?>vehicle/edit/<?php echo $res->vehicle_id . "?source_id=" . md5('Ymdhis'); ?>" target="" class="edit-form ext-button-margin ext-button-success" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <a href="<?php echo base_url(); ?>vehicle/delete/<?php echo $res->vehicle_id . "?source_id=" . md5('Ymdhis'); ?>" media="<?php echo current_url(); ?>" target="" class="delete-form ext-button-danger" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $n++;
                                        }
                                        ?>
                                    </tbody>
                                    <?php
                                } else {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" style="padding: 0px;"><div class="alert message-warning" style="margin: 0px;"> Cannot find data.</div></td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                                
                            </table>
                        </div>
                    </form>
                    <?php echo $this->pagination->create_links(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>

