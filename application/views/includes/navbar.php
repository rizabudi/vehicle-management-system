    <nav class="navbar navbar-default navbar-fixed-top navbar-ent" role="navigation" style="">
        <div class="navbar-header">
            <button id="navigation" type="button" class="navbar-toggle" data-toggle="collapse"  onclick="getToggle();" style="background: #f8f8f8;" data-target=".sidebar-collapse">
                <span class="sr-only" style="background: #f8f8f8;">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style= "color: #fff;"> </a>
        </div>
        <ul class="sidebar-collapse nav navbar-top-links navbar-right">
            <li class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #000;background: #ededed;">
                    <span class="fa glyphicon glyphicon-cog fa-fw"></span>  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><strong>Welcome,</strong> entung@gmail.com</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <img src="<?php echo base_url(); ?>assets/images/profile/default/default.jpg" class="ent-pp-large">
                        <div class="ent-label">
                            <a href="#" class="btn btn-success" style="margin: 5px 15px 5px 0px; font-size: 11px;">Edit Profil</a>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>