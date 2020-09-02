<style>
    
    .widget-thumb-wrap{cursor: pointer;}
</style>
<div class="row widget-row">

    <?php
    if($this->session->flashdata('success_msg')){
        ?>
        <div class="alert alert-success alert-dismissable" id="successMessage">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg');?>
        </div>

        <?php
    }
    ?>
    <?php
    if($this->session->flashdata('error_msg')){
        ?>
        <div class="alert alert-danger alert-dismissable" id="failedMessage">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Error!</strong> <?php echo $this->session->flashdata('error_msg');?>
        </div>

        <?php
    }
    ?>



    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">TOTAL SUCCESSFUL</h4>
            <div id='totalSuccessSmsId_view' class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
					<span class="widget-thumb-body-stat" id="totalSuccessSmsId" >
                    <!--    <img src="<?php echo base_url('assets/images/loading-count.gif') ;?>"> -->
					  <div id="wait1" style="display:none;"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ;?>"/></div>
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
            <div id='totalPendingSmsId_view' class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" id="totalPendingSmsId">
                      <!--  <img src="<?php echo base_url('assets/images/loading-count.gif') ;?>"> -->
					  <div id="wait2" style="display:none;"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ;?>"/></div>
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
            <div id='todaySuccessSmsId_view' class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" id="todaySuccessSmsId">
                     <!--   <img src="<?php echo base_url('assets/images/loading-count.gif') ;?>"> -->
					  <div id="wait3" style="display:none;"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ;?>"/></div>
                    </span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3" style="height:170px;">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">TODAY'S PENDING</h4>
            <div id='todayPendingSmsId_view' class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" id="todayPendingSmsId" >
                      <!--  <img src="<?php echo base_url('assets/images/loading-count.gif') ;?>"> -->
					  <div id="wait4" style="display:none;"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ;?>"/></div>
                    </span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
	
	<div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">TODAY'S Submitted</h4>
            <div id='todaySubmittedSmsId_view' class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-envelope"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">SMS</span>
                    <span class="widget-thumb-body-stat" id="todaySubmittedSmsId" >
                     <!--   <img src="<?php echo base_url('assets/images/loading-count.gif') ;?>"> -->
					  <div id="wait5" style="display:none;"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ;?>"/></div>
                    </span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
</div>



<script>
    $( document ).ready(function()
    {
         $( "#totalSuccessSmsId_view" ).click(function()
        {
			$("#wait1").css("display", "block");
            $.ajax('<?php echo base_url()."dashboard/totalSuccessSmsCount/";?>', {
                success: function(data) {
					$("#wait1").css("display", "none");
                    $("#totalSuccessSmsId").html(data);
                },
                error: function() {

                }
            });
		

        });

         
        $("#totalPendingSmsId_view").click(function()
        {
			$("#wait2").css("display", "block");
            $.ajax('<?php echo base_url()."dashboard/totalPendingSmsCount/";?>', {
                success: function(data) {

                    $("#totalPendingSmsId").html(data);
					$("#wait2").css("display", "none");
                },
                error: function() {

                }
            });
        });


        
         $("#todaySuccessSmsId_view").click(function()
        {
			$("#wait3").css("display", "block");
            $.ajax('<?php echo base_url()."dashboard/todaySuccessSmsCount/";?>', {
                success: function(data) {

                    $("#todaySuccessSmsId").html(data);
					$("#wait3").css("display", "none");
                },
                error: function() {

                }
            });
         });

         
        $("#todayPendingSmsId_view").click(function()
        {
			$("#wait4").css("display", "block");
            $.ajax('<?php echo base_url()."dashboard/todayPendingSmsCount/";?>', {
                success: function(data) {

                    $("#todayPendingSmsId").html(data);
					$("#wait4").css("display", "none");
                },
                error: function() {

                }
            });
        });
        

		$("#todaySubmittedSmsId_view").click(function()
        {
			$("#wait5").css("display", "block");
    		$.ajax('<?php echo base_url()."dashboard/todaySubmittedSmsCount/";?>', {
                success: function(data) {

                    $("#todaySubmittedSmsId").html(data);
					$("#wait5").css("display", "none");
                },
                error: function() {

                }
            });
         });


    });
</script>
