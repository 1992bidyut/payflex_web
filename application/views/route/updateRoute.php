
<div class="row">
    <div class="col-md-12">

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
                    Update Route
                </div>
            </div>
            <div class="portlet-body  grey-cararra">
                <form action="<?php echo base_url('route/routeUpdate');?>" method="post" id="" class="form-horizontal" role="form">

                    <input type="hidden" value="<?php echo $routs['id'];?>" name="id">

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Name </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo $routs['name'];?>" name="routeName" class="form-control" >
                        </div>
                        <?php echo form_error('routeName',"<p class='text-danger'>","</p>")?>
                    </div>

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Description </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo $routs['description'];?>" name="routeDescription" class="form-control" >
                        </div>
                        <?php echo form_error('routeDescription',"<p class='text-danger'>","</p>")?>
                    </div>

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Identity </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo $routs['identity'];?>" name="routeIdentity" class="form-control" >
                        </div>
                        <?php echo form_error('routeIdentity',"<p class='text-danger'>","</p>");?>
                    </div>



                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn blue">Update</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
