
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

        <div class="portlet box blue ">

            <div class="portlet-title">
                <div class="caption">
                    Create Operator
                </div>
            </div>
            <div class="portlet-body  grey-cararra">
                <form action="<?php echo base_url('operator/operatorStore');?>" method="post" id="" class="form-horizontal" role="form">

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Name </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo set_value('operatorName')?>" name="operatorName" class="form-control" id=""  placeholder="Operator Name here">
                        </div>
                        <?php echo form_error('operatorName',"<p class='text-danger'>","</p>")?>
                    </div>

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Description </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo set_value('operatorDescription')?>" name="operatorDescription" class="form-control" id=""  placeholder="Operator Description here">
                        </div>
                        <?php echo form_error('operatorDescription',"<p class='text-danger'>","</p>")?>
                    </div>

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Identity </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo set_value('operatorIdentity')?>" name="operatorIdentity" class="form-control" id=""  placeholder="Operator Identity here">
                        </div>
                        <?php echo form_error('operatorIdentity',"<p class='text-danger'>","</p>");?>
                    </div>



                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn blue">Submit</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
