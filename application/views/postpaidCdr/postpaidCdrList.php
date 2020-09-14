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
                    <i class="fa fa-cogs"></i>Postpaid CDR List </div>
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
                        <th> User ID</th>
                        <th> Username </th>
                        <th> Message </th>
                        <th> Mask </th>
                        <th> Contact No. </th>
                        <th> Route </th>
                        <th> Schedule Time </th>
                        <th> Delivery Time </th>
                        <th> Execution Time </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach($postpaidCdrs as $postpaidCdr){
                    ?>

                        <tr class="odd gradeX">
                            <td> <?php echo $postpaidCdr['cd_user_id'];?> </td>
                            <td> <?php echo $postpaidCdr['username'];?> </td>
                            <td> <?php echo $postpaidCdr['message'];?> </td>
                            <td> <?php echo $postpaidCdr['smsMask'];?> </td>
                            <td> <?php echo $postpaidCdr['contact_text'];?> </td>
                            <td ><?php echo $postpaidCdr['routename'];?></td>
                            <td> <?php echo $postpaidCdr['schedule_time'];?> </td>
                            <td> <?php echo $postpaidCdr['send_time'];?> </td>
                            <td> <?php echo $postpaidCdr['execution_time'];?> </td>
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