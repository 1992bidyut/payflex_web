
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
                    Create Postpaid CDR
                </div>
            </div>
            <div class="portlet-body  grey-cararra">
                <form action="<?php echo base_url('postpaidCdr/postpaidCdrStore');?>" method="post" id="" class="form-horizontal" role="form">

                    <div class="form-group">
                        <label class="col-md-2 control-label">User Name</label>
                        <div class="col-md-4">
                            <select class="form-control" name="user">
                                <option selected >[-- Select User --]</option>

                                <?php
                                foreach($users as $user){
                                ?>
                                    <option value="<?php echo $user['id'];?>"><?php echo $user['username'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php echo form_error('user',"<p class='text-danger'>","</p>");?>
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
