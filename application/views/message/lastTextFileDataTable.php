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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i> <?php if(!empty($this->session->userdata('lastTextFileOwnerUser'))) echo 'SMS of &nbsp'.$this->session->userdata('lastTextFileOwnerUser');
                        else{echo 'All SMS';}?> </div>
                    <div class="actions">
                        <a href="<?php echo base_url('SendSMS/smsTextStoreConfirm');?>" class="btn green-haze btn-sm">
                            <i class="icon-envelope"></i> Confirm All SMS ( <?php echo $numRows; ?>  )
                        </a>

                        <a href="#basic" data-toggle="modal"  class="btn red btn-sm">
                            <i class="fa fa-trash"></i>
                            Delete
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form id="table-form">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                        <thead>
                        <tr>
                            <th class="table-checkbox">
                                <input type="checkbox" class="group-checkable"  value="" data-set="#sample_3 .checkboxes" />
                            </th>

                            <th> Contact </th>
                            <th> Message </th>
                            <th> Schedule Time </th>
                            <th> Mask</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        if(isset($SMSArray))
                        {
                        foreach($SMSArray as $sms)
                        {
                            ?>

                            <tr>
                                <th class="table-checkbox">
                                    <input type="checkbox" class="group-checkable" name="checkboxes[]" value="<?php echo $sms['id'];?>" data-set="#sample_3 .checkboxes" />
                                </th>

                                <td> <?php echo $sms['contact_text']; ?> </td>
                                <td> <?php echo $sms['message']; ?> </td>
                                <td> <?php echo $sms['schedule_time']; ?> </td>
                                <td> <?php echo $sms['smsMask']; ?> </td>
<!--                                <td>-->
<!--                                    <div class="clearfix">-->
<!--                                        <a href="#"  data-rid="--><?php //echo  $sms['id']; ?><!--" class="btn btn-sm red delete" style="margin-bottom: 5px;"> Delete-->
<!--                                            <i class="fa fa-trash"></i>-->
<!--                                        </a>-->
<!---->
<!--                                    </div>-->
<!--                                </td>-->
                            </tr>

                        <?php
                        }

                        }
                        ?>


                        </tbody>
                    </table>
                        <div class="dataTables_info" id="" role="status" aria-live="polite">Showing <?php echo $segment+1; ?> of <?php echo $numRows; ?> records</div>
                        <?php echo $links; ?>
                    </form>
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


            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('#action-btn').click(function(e){
                var table = $("#sample_3").dataTable();
                var id = [];
                $("input:checked", table.fnGetNodes()).each(function(i){

                    console.log($(this).val());

                    id.push($(this).val());

                });

                $.ajax({
                    type    : "POST",
                    url     : "<?php echo base_url('SendSMS/ajax_delete'); ?>",
                    data    : {id: id},
                    success : function (response) {
//                        console.log(response);
                        location.reload();
                    },
                    error : function(error){
                        console.log(error);
                    }
                });

                e.preventDefault();

                });

        });
    </script>








