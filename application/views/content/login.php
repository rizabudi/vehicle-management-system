<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/icon/favicons.png">

        <title>Login | Vehicle Management System</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/ext-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/gray-themes.css" rel="stylesheet">
    </head>

    <body>
        <div class="ext-container" style="padding: 75px 0 0 0;">
            <form name="loginForm" method="post" action="<?= base_url(); ?>login" >
                <div class="modal-login">
                    <?php
                        if ($error)
                            echo '<div class="form-bottom-border message-warning">' . $message . '</div>';
                    ?>
                    <div class="header-login">
                        <b>Administrator Login</b>
                        <br>
                        Login to access your system.
                    </div>
                    <div style="padding: 15px;">
                        <p><input name="username" type="text" class="text-input"  placeholder="Username" ></p> 
                        <p><input type="password" name="password" class="text-input" placeholder="Password" ></p>  

                        <button type="submit" name="submit" class="but-succes right">Sign In</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="modal_delete" aria-hidden="true">
        </div>

        <!-- Ajax Modal -->
        <div id="ajax-loader" class="ajax-loader"></div>
        <div id="ajax-modal" class="ajax-modal">
        </div>
        <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>
