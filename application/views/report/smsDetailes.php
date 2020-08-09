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
                    Table
                </div>
<!--                <div class="actions">-->
<!--                    <a href="javascript:;" class="btn btn-default btn-sm">-->
<!--                        <i class="fa fa-plus"></i> Add </a>-->
<!--                    <a href="javascript:;" class="btn btn-default btn-sm">-->
<!--                        <i class="fa fa-print"></i> Print </a>-->
<!--                </div>-->
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" />
                        </th>
                        <th> SN </th>
                        <th> Contact </th>
                        <th> Message </th>
                        <th> Mask </th>
                        <th> Schedule Time </th>
                        <th> Status </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $i=1;
                    foreach($smsdetailsArray as $sms){
                    ?>
                    <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" value="1" /></td>
                        <td><?php echo $i ; ?></td>
                        <td><?php echo $sms['contact_text']; ?></td>
                        <td><?php echo $sms['message']; ?></td>
                        <td><?php echo $sms['smsMask']; ?></td>
                        <td><?php echo $sms['schedule_time']; ?></td>
                        <td><?php echo $sms['status_group_name']; ?></td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>

                    </tbody>
                </table>
                <div class="dataTables_info" id="" role="status" aria-live="polite">Showing <?php echo @$segment+1; ?> of <?php echo @$numRows; ?> records</div>
                <?php echo @$links; ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>






