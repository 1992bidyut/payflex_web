<div class="row widget-row">
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">TOTAL SUCCESSFUL</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php  echo $totalSmsStatus['totalSuccessSms'];?>">
                        <?php  echo $totalSmsStatus['totalSuccessSms'];?>
                    </span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">TOTAL PENDING</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php  echo $totalSmsStatus['totalPendingSms'];?>">
                        <?php  echo $totalSmsStatus['totalPendingSms'];?>
                    </span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">TODAY'S SUCCESSFUL</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php  echo $totalSmsStatus['todaySuccessSms'];?>">
                        <?php  echo $totalSmsStatus['todaySuccessSms'];?>
                    </span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">TODAY'S PENDING</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php  echo $totalSmsStatus['todayPendingSms'];?>">
                        <?php  echo $totalSmsStatus['todayPendingSms'];?>
                    </span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
</div>
