<div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading"><?php echo $wtTitle; ?></h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon <?php echo $wtBGColor ." ".$wtIcon;?>"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle"><?php echo $wtSubTitle; ?></span>
                    <a href="<?php echo base_url($wtHREF);?>">
                    <span class="widget-thumb-body-stat" id="<?php echo $wtID; ?>" >
                        <img src="<?php echo base_url('assets/images/loading-count.gif') ;?>">
                    </span>
                    </a>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>