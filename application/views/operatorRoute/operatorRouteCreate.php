
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
                    Create Operator Route
                </div>
            </div>
            <div class="portlet-body  grey-cararra">
                <form action="<?php echo base_url('operatorRoute/operatorRouteStore');?>" method="post" id="" class="form-horizontal" role="form">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Operator Name</label>
                        <div class="col-md-4">
                            <select class="form-control" name="operatorID">
                                <option selected >[-- Select Operator --]</option>

                                <?php
                                foreach($operators as $operator){
                                ?>
                                    <option value="<?php echo $operator['id'];?>"><?php echo $operator['name'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php echo form_error('operatorID',"<p class='text-danger'>","</p>");?>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Route Name</label>
                        <div class="col-md-4">
                            <select class="form-control" name="routeID">
                                <option selected >[-- Select Route --]</option>

                                <?php
                                foreach($routes as $route){
                                ?>
                                    <option value="<?php echo $route['id'];?>"><?php echo $route['name'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php echo form_error('routeID',"<p class='text-danger'>","</p>");?>
                    </div>

                    <div class="form-group">
                        <label  class="col-md-2 control-label">Price </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo set_value('standardPrice')?>" name="standardPrice" class="form-control" id=""  placeholder="Standard price here">
                        </div>
                        <?php echo form_error('standardPrice',"<p class='text-danger'>","</p>");?>
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
