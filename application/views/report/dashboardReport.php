






<div class="row">
    <div class="col-md-12">

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


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    SMS Filter </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form action="<?php echo base_url('Report/reportSearch');?>" method="post" class="form-horizontal">

                    <div class="form-body">
                        <div class="form-group">
                            <label class=" col-md-3 control-label">Date Range</label>
                            <div class=" col-md-4 input-group input-large date-picker input-daterange"
                                 data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                <input type="text" value="<?php echo set_value('from')?>" class="form-control" name="from">
                                <span class="input-group-addon"> to </span>
                                <input type="text" value="<?php echo set_value('to')?>" class="form-control" name="to">
                            </div>
                            <!-- /input-group -->
                        </div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Client :</label>
                            <select class="form-control input-large" id="e1" name="clientId">
                                <option value="">[== Search By Client==]</option>
                                <?php
                                foreach($users as $user)
                                {
                                    if($user['id'] == $_SESSION['userIdForSmsSearch'])
                                    {
                                    ?>

                                        <option value="<?php echo $user['id']; ?>" selected> <?php echo $user['username']; ?> </option>

                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                                <?php
                                    }

                                }
                                ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label class="col-md-3 control-label">SMS Status :</label>
                            <select class="form-control input-large" name="smsStatusCode">
                                <option value="">[== Search By Status==]</option>
                                <?php
                                foreach($smsStatusArray as $smsStatus)
                                {


                                    if($smsStatus['id'] == $_SESSION['smsStatusCode'])
                                    {
                                        ?>

                                        <option value="<?php echo $smsStatus['id']; ?>" selected> <?php echo $smsStatus['name']; ?> </option>

                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="<?php echo $smsStatus['id']; ?>"><?php echo $smsStatus['name']; ?></option>
                                        <?php
                                    }


                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

<div class="row widget-row">

<?php

	if(isset($searchResultArray)) {
		echo '<div class="row">
		<div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Portlet </div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
						<a href="" class="fullscreen" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload" data-original-title="" title=""> </a>
					</div>
				</div>
				
					
			</div>
		<!-- END Portlet PORTLET-->
		</div>
		</div>';
		
    foreach($searchResultArray as $searchResult)
    {
		
        ?>

        <div class="col-md-3">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading"><?php echo $searchResult['status_group_name'] ;?> </h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-green icon-envelope"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">SMS</span>
                        <a href="<?php echo base_url('Report/reportSearchWithPagination/').$searchResult['status_group_name'];?>">
                                <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $searchResult['totalSms'] ;?>"><?php echo $searchResult['totalSms'];?></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>

    <?php
		
    }
	}
?>


</div>

<?php
$firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
$lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));

$from = date("d-M-Y", $firstDayUTS);
$to = date("d-M-Y", $lastDayUTS);
?>
<!-- HTML -->
<div class="row">
	<div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Report From <?php echo $from; ?> To <?php echo $to;?> </div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
					<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
					<a href="" class="fullscreen" data-original-title="" title=""> </a>
					<a href="javascript:;" class="reload" data-original-title="" title=""> </a>
				</div>
			</div>
			<div class="portlet-body"> 
				<div id="chartdiv">
				</div>
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
</div>



<!-- Styles -->
<style>
#chartdiv {
	width	: 100%;
	height	: 500px;

}
										
</style>

<!-- Resources -->
<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script> -->

<script src="<?php echo base_url('assets/js/amcharts.js');?>"></script>
<script src="<?php echo base_url('assets/js/serial.js');?>"></script>
<script src="<?php echo base_url('assets/js/export.min.js');?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/export.css');?>" type="text/css" media="all" />
<script src="<?php echo base_url('assets/js/light.js');?>"></script>


<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
	"marginTop": 50,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "value",
        "balloonText": "<span style='font-size:14px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":1,
        "cursorColor":"#258cbb",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2,
        "valueZoomable":true
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    },
    "dataProvider": <?php echo json_encode($searchResultArrayForGraph); ?>

	
});

chart.addListener("rendered", zoomChart);

zoomChart();

function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}
</script>

<script>
    $(document).ready(function() { $("#e1").select2(); });
</script>







