<style>
    .dataTables_paginate.paging_bootstrap_number,
    #sample_3_info{
        display: none;
    }
</style>

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
                    SMS Filter
                </div>
            </div>
            <div class="portlet-body grey-cararra">
                <form role="form" action="<?php echo base_url('SMSLog/smsSearch/');?>" method="get">

                    <input type="hidden" value="<?php echo $cd_uer_id ;?>" name="userId" >

                    <div class="form-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="control-label">Mobile Number :</label>
                                <input type="text" value="<?php echo set_value('contact')?>" name="contact" class="form-control input-large" id="" placeholder="Enter phone number">

                                <?php echo form_error('contact',"<p class='text-danger'>","</p>")?>
                            </div>

                            <div class="form-group">
                                <label class="">SMS Status :</label>
                                <select class="form-control input-large" name="smsStatusCode">
                                    <option value="">[== Search By Status==]</option>
                                    <?php
                                    foreach($smsStatuses as $smsStatus)
                                    {
                                    ?>
                                        <option value="<?php echo $smsStatus['id'];?>"><?php echo $smsStatus['name'];?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="control-label">SMS Body (Key Word) :</label>
                                <div>
                                    <textarea class="form-control input-large" name="smsBody" rows="3"><?php echo set_value('smsBody')?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Date Range or Send Date</label>
                                <div class="input-group input-large date-picker input-daterange"
                                     data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                    <input type="text" value="<?php echo set_value('from')?>" class="form-control" name="from">
                                    <span class="input-group-addon"> to </span>
                                    <input type="text" value="<?php echo set_value('to')?>" class="form-control" name="to">
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn blue">Search</button>
                        <a href="<?php echo base_url('SMSLog/smsLogShow');?>"  class="btn btn-danger">Reset</a>

                    </div>
                </form>
                <script>
                    jQuery(document).ready(function () {
                        App.initAjax();
                    });
                </script>
            </div>

        </div>
    </div>
</div>

    <div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <form action="<?php echo base_url('SMSLog/smsResend');?>" method="post">
            <input type="hidden" name="userId" value="<?php  echo @$getValues['userId'];?>">
            <input type="hidden" name="contact" value="<?php echo @$getValues['contact'];?>">
            <input type="hidden" name="from" value="<?php echo @$getValues['from'];?>">
            <input type="hidden" name="to" value="<?php echo @$getValues['to'];?>">
            <input type="hidden" name="smsBody" value="<?php echo @$getValues['smsBody'];?>">
            <input type="hidden" name="smsStatusCode" value="<?php echo @$getValues['smsStatusCode'];?>">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Table </div>

                    <div class="actions">
					
						<?php if (!empty($numRows)){?>

                            <button type="submit"  class="btn green-haze btn-sm">
                                <i class="icon-envelope"></i> Resend All ( <?php echo @$numRows; ?> )
                            </button>

                        <?php } ; ?>
						
                    </div>
                </div>
                <!-- MODAL FOR DELETE BUTTON -->
                <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="color: #000000;">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Confirmation</h4>
                            </div>
                            <div class="modal-body" style="color: #000000;">
                                Are you sure to delete ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">No</button>
                                <a href="#" id="action-btn" class="btn red btn-sm">
                                    <i class="fa fa-trash"></i>
                                    Yes
                                </a>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- END DELETE MODAL -->
                <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                            <thead>
                            <tr>
                                <th class="table-checkbox">
                                    <input type="checkbox" class="group-checkable"  value="" data-set="#sample_3 .checkboxes" />
                                </th>

                                <th> Contact </th>
                                <th> Message </th>
                                <th> Scheduled Time </th>
								<th> Request Time </th>
                                <th> Delivery Time </th>
                                <th> Status</th>
                                <th class="col-xs-3"> SMS Log</th>
                                <th> Actions</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php

                            if(isset($smsArray))

                                foreach($smsArray as $sms)
                                {
									
									 
                                    ?>

                                    <tr>
                                        <td class="checkbox">
                                            <input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $sms['id'];?>" data-set="#sample_3 .checkboxes" />
                                        </td>

                                        <td> <?php echo $sms['contact_text'];?> </td>
                                        <td> <?php echo $sms['message'];?> </td>
                                        <td> <?php echo $sms['schedule_time'];?> </td>
										<td> <?php echo $sms['send_time'];?> </td>
                                        <td> <?php echo $sms['update_time'];?> </td>
                                        <td> <?php echo $sms['status_group_name'];?></td>
                                        <td>
										
										<!-- data-href="<?php //echo $this->config->item('userDefinedURL');?>" --->
											<?php
											$timeString = strtotime($sms['send_time']);
											$date =  date('Y-m-d',$timeString);
											?>
											<a
                                                
						
												
												data-href="<?php echo base_url('SMSLog/viewLogFile')?>"
												
												
												
                                                data-date='<?php echo $date;?>'
                                                data-smsid='<?php echo $sms['id'];?>'
                                                data-userid='<?php echo $cd_uer_id;?>'
                                                data-trxid='<?php echo $sms['trx_id'];?>'
                                                class="btn btn-sm blue logButtonId">
                                                <i class="fa fa-file-o"></i>
                                                Log button
                                            </a>
                                        </td>
                                        <td> <a href="javascript:;" class="btn btn-sm blue">
                                                <i class="fa fa-file-o"></i> Resend </a>
                                        </td>

                                    </tr>

                                    <?php
                                }
                            ?>


                            </tbody>
                        </table>

                        <div class="dataTables_info" id="" role="status" aria-live="polite">Showing <?php echo @$segment+1; ?> of <?php echo @$numRows; ?> records</div>
                        <?php echo @$links; ?>


                </div>

            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </form>
    </div>
</div>



<!---------------------------------------- ALL MODAL STARTING ------------------------------------------------------>

<!-- ADD CREDIT MODAL STARTING -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Log Data</h4>
            </div>
            <div class="modal-body" style="width: 100%; overflow; scroll; word-wrap: break-word;">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--                <button type="submit" class="btn btn-success" id="addCreditModalBtn">Add Credit</button>-->
            </div>

        </div>
    </div>
</div>
<!-- ADD CREDIT MODAL ENDING -->

<script type="text/javascript">

    $(document).ready(function () {


        $('table .logButtonId').click(function(e){


            var url = $(this).data('href');
            var date = $(this).data('date');
            var smsId = $(this).data('smsid');
            var userId = $(this).data('userid');
            var trxId = $(this).data('trxid');
			
			
            $.ajax({
                type    : "POST",
                url     : url,
                
                data    : {date: date, id: smsId,  userid: userId, trxid: trxId},
				
				

                success : function (response) {

                        $('#myModal').modal('show');

                    $('#myModal .modal-body').html(response);
						// console.log(response);
                       // alert(response);

                },
                error : function(error){
                    // console.log(error);
					// alert(error);
                }
				
            });



        });


    });

</script>
