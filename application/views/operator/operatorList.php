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
                    <i class="fa fa-cogs"></i>Operator List </div>
                <div class="actions">
                    <a href="<?php echo base_url('operator/operatorCreate');?>" class="btn btn-default btn-sm">
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
                        <th> SN </th>
                        <th> Operator Name </th>
                        <th> Operator Description </th>
                        <th> Operator Identity </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach($operators as $operator){
                    ?>

                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                            <td> <?php echo $operator['id'];?> </td>
                            <td> <?php echo $operator['name'];?> </td>
                            <td> <?php echo $operator['description'];?> </td>
                            <td> <?php echo $operator['identity'];?> </td>
                            <td >
                                <div class="clearfix">

                                    <a href="<?php echo base_url('operator/operatorEdit/').$operator['id'];?>" class="btn btn-sm yellow" style="margin-bottom: 5px;"> Edit
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="<?php echo base_url('operator/operatorDestroy/').$operator['id'];?>" onclick="return confirm('Are you sure you want to delete');" class="btn btn-sm red" style="margin-bottom: 5px;"> Delete
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </div>
                            </td>
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