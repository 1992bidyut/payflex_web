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
                <form action="<?php echo base_url('Report/smsReportByUser');?>" method="post" class="form-horizontal">

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

<div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Table </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Add </a>
                        <a href="javascript:;" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                        <thead>
                        <tr>
                            <th class="table-checkbox">
                                <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" />
                            </th>
                            <th> Full Name </th>
                            <th> Username </th>
                            <th> Status </th>
                            <th> Date </th>							
                            <th> Count </th>	
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if(isset($smsReportArray))
                        foreach($smsReportArray as $smsReport){
                        ?>

                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td> <?php echo $smsReport['full_name'];?> </td>
                                <td> <?php echo $smsReport['username'];?> </td>
								<td> <?php echo $smsReport['name'];?> </td>
                                <td> <?php echo $smsReport['date'];?> </td>
                                <td> <?php echo $smsReport['totalSms'];?> </td>
                            </tr>
                        <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>



<script>
    $(document).ready(function() { $("#e1").select2(); });
</script>







