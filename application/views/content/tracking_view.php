<html>
    <head>
        <title>Maps Google</title>
    </head>
    <body>
        <div class="content col-sm-9 col-lg-10" style="padding: 0px;position: fixed;right: 0px;bottom: 0px;top:0px;">
            <div class="ext-container">
                <div class="col-sm-9 col-lg-10 ext-tabs-body ext-fixed-content">
                    <div class="col-md-12 ext-no-padding ext-no-padding-last">
                        <div class="ext-panel-header"><span class="glyphicon glyphicon-map-marker"></span> Tracking View<span class="ext ext-close"></span><span class="ext ext-maxsimize"></span></div>
                        <div class="ext-panel-body">
                            <div class="col-sm-3 input-group space pull-right no-border-radius" style="margin-top: 5px;margin-bottom: 5px;">
                                <input type="text" class="search ext-input input-sm pull-left no-border-radius" style="border-radius: 0px;" name="search" id="search" placeholder="Cari disini" value="<?php echo $this->input->get('q') ? $this->input->get('q') : ""; ?>" src="<?= base_url(); ?>vehicle/view">
                                <inpu class="search-btn input-group-addon btn btn-default"><span class="glyphicon glyphicon-repeat" style="margin-top: -3px;"></span></inpu>
                            </div>
                            <hr>
                            <div class="clearfix"></div>
                            <div id="map" style="height: 480px;border:1px solid #ebebeb;"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Setting -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/markermanager.js"></script>
        <script type="text/javascript">
            function initialize() {
                var locations = [
                    ['HINO X400', -7.4030341, 112.6674353],
                    ['HONDA 1200', -7.093789, 112.364281],
                    ['RX KINNG 23', -7.267169, 112.351235]
                ];
                var myLatLng = new google.maps.LatLng(-7.3281874, 109.90769, 7);

                if (navigator.geolocation) {
                    autoUpdate();
                    
                    navigator.geolocation.getCurrentPosition(function(position) {
                        map.setCenter(myLatLng);
                    });
                }
                else {
                    alert('W3C Geolocation API is not available');
                }

                // Initialize the Google Maps API v3
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                var count = 0;
                var marker = [];
                
                function autoUpdate() {
                    count += 0.0001;

                    navigator.geolocation.getCurrentPosition(function(position) {
                        var image      = '<?= base_url(); ?>assets/images/marker/nav-blue.png';
                        var infowindow = new google.maps.InfoWindow();
                        
                        for (i = 0; i < locations.length; i++) {  
                            var newPoint   = new google.maps.LatLng(locations[i][1] + count,locations[i][2]);
                            
                            if(marker[i]) 
                                marker[i].setPosition(newPoint);
                            else {    
                                marker[i] = new google.maps.Marker({
                                    position: newPoint,
                                    map: map,
                                    icon: image
                                });

                                google.maps.event.addListener(marker[i], 'click', (function(marker , i) {
                                    return function() {
                                        infowindow.setContent("Hello");
                                        infowindow.open(map, marker);
                                    };
                                })(marker[i] , i));
                            }
                        }
                    });
                    
                    setTimeout(autoUpdate, 1000);
                }
                
                function clearMarkers() {
                    setAllMap(null);
                }
            }

            google.maps.event.addDomListener(window, "load", initialize);
        </script>
        <?php
        if ($maps_load) {
            echo '<script type="text/javascript">
                        initialize();
                    </script>';
        }
        ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/ajax/inaframework/helper.js"></script>
    </body>
</html>


