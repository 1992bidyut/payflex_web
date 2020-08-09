
<div class="row">
    <div class="col-md-12">

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
                <form action="<?php echo base_url('Report/creditReport');?>" method="post" class="form-horizontal">

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
                            <select class="form-control input-large" name="clientId">
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
					<i class="fa fa-gift"></i>Report From <?php echo $from; ?> To <?php echo $to;?></div>
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

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>



<!-- Styles -->
<style>
#chartdiv {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}
</style>														


<script>
var chart = AmCharts.makeChart("chartdiv", {
	"type": "serial",
     "theme": "light",
	"categoryField": "date",
	"rotate": true,
	"startDuration": 1,
	"categoryAxis": {
		"gridPosition": "start",
		"position": "left"
	},
	"trendLines": [],
	"graphs": [
		{
			"balloonText": "Credit Sold:[[value]]",
			"fillAlphas": 0.8,
			"id": "AmGraph-1",
			"lineAlpha": 0.2,
			"title": "Credit Sold",
			"type": "column",
			"valueField": "income"
		},
		{
			"balloonText": "Credit Purchased:[[value]]",
			"fillAlphas": 0.8,
			"id": "AmGraph-2",
			"lineAlpha": 0.2,
			"title": "Credit Purchased",
			"type": "column",
			"valueField": "expenses"
		}
	],
	"guides": [],
	"valueAxes": [
		{
			"id": "ValueAxis-1",
			"position": "top",
			"axisAlpha": 0
		}
	],
	"allLabels": [],
	"balloon": {},
	"titles": [],
	"dataProvider": 
	
	<?php echo json_encode($creditHistoryArray); ?>,
    "export": {
    	"enabled": true
     }

});
</script>








