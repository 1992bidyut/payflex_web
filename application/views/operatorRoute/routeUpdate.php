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
                    <i class="fa fa-cogs"></i>Create Route </div>
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
                        <th> User </th>
                        <th> Operator </th>
                        <th> Route </th>
                        <th> Standard Price </th>
                        <th> Given Price </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <form action="" method="post" class="form-horizontal" role="form">
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                            <td>  </td>
                            <td>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="">
                                        <select class="form-control" name="operatorID">
                                            <option  value="">GPCMP</option>
                                            <option  value="">SANKER SAHA</option>
                                            <option  value="">THIS IS TEST LOL</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>  </td>
                            <td>
                                <div class="form-group">
                                    <div class="">
                                        <input type="text" value="" name="standardPrice" class="form-control">
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="clearfix">

                                    <a href="#" class="btn btn-sm green"> Update
                                        <i class="fa fa-map-signs"></i>
                                    </a>
                                    <a href="" class="btn btn-sm purple"> Cancle
                                        <i class="fa fa-tags"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </form>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>