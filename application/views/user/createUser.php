
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue ">

                <div class="portlet-title">
                    <div class="caption">
                        Create User
                    </div>
                </div>
                <div class="portlet-body  grey-cararra">
               <?php if($this->session->flashdata('msg')): ?>
                    <p><?php echo $this->session->flashdata('msg'); ?></p>
               <?php endif; ?>

                   <form action="<?php echo base_url('user/userStore');?>" method="post" id="create_group_form_id" class="form-horizontal" role="form">

                   
                        <div class="form-group">
                            <label  class="col-md-2 control-label">Full Name </label>
                            <div class="col-md-4">
                                <input type="text" value="<?php echo set_value('name')?>" name="name" class="form-control" id=""  placeholder="Full Name here">
                            </div>
                            <?php echo form_error('name',"<p class='text-danger'>","</p>")?>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Email </label>
                            <div class="col-md-4">
                                <input type="text" value="<?php echo set_value('email')?>" name="email" class="form-control" id="inputEmail1"  placeholder="Email here">
                            </div>
                            <?php echo form_error('email',"<p class='text-danger'>","</p>")?>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Contact Number</label>
                            <div class="col-md-4">
                                <input type="text" value="<?php echo set_value('contact')?>" name="contact" class="form-control" id=""  placeholder="Cell phone number...">
                            </div>
                            <?php echo form_error('contact',"<p class='text-danger'>","</p>");?>
                        </div>


                        <div class="form-group">
                            <label  class="col-md-2 control-label">Password </label>
                            <div class="col-md-4">
                                <input type="password"   name="password" class="form-control" id=""  placeholder="Password here">
                            </div>
                            <?php echo form_error('password',"<p class='text-danger'>","</p>");?>
                        </div>

                        <!-- <div class="form-group">
                            <label  class="col-md-2 control-label">Confirm Password </label>
                            <div class="col-md-4">
                                <input type="password"  name="confirmPassword" class="form-control" id=""   placeholder="Confirm Password here">
                            </div>
                            <?php echo form_error('confirmPassword',"<p class='text-danger'>","</p>")?>
                        </div> -->


                        <div class="form-group">
                            <label class="col-md-2 control-label">User Type</label>
                            <div class="col-md-4">
                                <select class="form-control" name="userRoleId">
                                    <option value="">Select User Type</option>

                                    <?php
                                    foreach($userTypes as $data){
                                    ?>

                                    <option value="<?php echo $data['id'];?>"><?php echo $data['type'];?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php echo form_error('userRoleId',"<p class='text-danger'>","</p>")?>
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
<script>

</script>