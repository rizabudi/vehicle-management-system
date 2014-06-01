        <div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
            <div class="ext-container">
                <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
                    <div class="col-md-12 ext-no-padding ext-no-padding-last">
                        <div class="ext-panel-header">Menu<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                        <div class="ext-panel-body">
                            <form name="formview" class="selected-delete" action="<?php echo base_url(); ?>menu/delete_checked" method="post" data-target="<?php echo current_url(); ?>">
                            <div style="margin-bottom: 10px;font-size: 11px;">
                                <a href="<?= base_url(); ?>menu/add" target="add" style="margin-top: 5px;" class="add-form ext-button-margin ext-button-success" title="Tambah Baru">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    Tambah
                                </a>
                                <button type="submit" class="ext-button-danger" title="hapus" style="margin-top: 5px; padding: 6px 10px 6px 10px;">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Hapus Terpilih
                                </button>
                           
                            
                            </div>
                            <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" border="0" class="stdtable" id="dyntable2" style="font-size: 12px;">
                                
                                <thead>
                                    <tr>
                                        <th class="head0"><span class="center"><input type="checkbox" class="checkall" value="0" onclick="checked_role(1);"  /></span></th>
                                        <th class="head1">No</th>
                                        <th class="head0">Nama Menu</th>
                                        <th class="head1">Deskripsi Menu</th>
                                        <th class="head0">Menu Order</th>
                                        <th class="head1">Menu Active</th>
                                        <th class="head0">Pilihan</th>
                                    </tr>
                                </thead>
                                <?php
                                    if($this->menu_data != "") 
                                        echo "<tbody>". $this->menu_data . "</tbody>";
                                    else {
                                ?>
                                <tbody>
                                    <tr>
                                        <td colspan="7" style="padding: 0px;"><div class="alert alert-warning" style="margin: 0px;"> Data tidak ditemukan.</div></td>
                                    </tr>
                                </tbody>
                                <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th class="head0"><span class="center"><input type="checkbox" /></span></th>
                                        <th class="head1">No</th>
                                        <th class="head0">Nama Menu</th>
                                        <th class="head1">Deskripsi Menu</th>
                                        <th class="head0">Menu Order</th>
                                        <th class="head1">Menu Active</th>
                                        <th class="head0">Pilihan</th>
                                    </tr>
                                </tfoot>
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
        
