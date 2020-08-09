
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
                    Create Route
                </div>
            </div>
            <div class="portlet-body  grey-cararra">
                <form action="<?php echo base_url('route/routeStore');?>" method="post" id="" class="form-horizontal" role="form">

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Name </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo set_value('routeName')?>" name="routeName" class="form-control" id=""  placeholder="Route Name here">
                        </div>
                        <?php echo form_error('routeName',"<p class='text-danger'>","</p>")?>
                    </div>

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Description </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo set_value('routeDescription')?>" name="routeDescription" class="form-control" id=""  placeholder="Route Description here">
                        </div>
                        <?php echo form_error('routeDescription',"<p class='text-danger'>","</p>")?>
                    </div>

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Identity </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo set_value('routeIdentity')?>" name="routeIdentity" class="form-control" id=""  placeholder="Route Identity here">
                        </div>
                        <?php echo form_error('routeIdentity',"<p class='text-danger'>","</p>");?>
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
