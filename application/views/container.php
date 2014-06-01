<!DOCTYPE>
<html>
<head>
    <?php 
        $this->load->view('includes/head');
    ?>
</head>
<body>
<div class="row" style="margin: 0px;">
    <?php 
        $this->load->view('includes/navbar');
        $this->load->view('includes/sidebar');
        echo '<div id="ent-content">';
        $this->load->view('content/'.$this->page);
        echo '</div>';
        $this->load->view('includes/script')
    ?>
</div>
    
<!-- Modal -->
<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
</div>

<!-- Ajax Modal -->
<div id="ajax-loader" class="ajax-loader"></div>
<div id="ajax-modal" class="ajax-modal">
</div>
</body>
</html>