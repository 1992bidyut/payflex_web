
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
                        Change Password
                    </div>
                </div>
                <div class="portlet-body  grey-cararra">
                    <form action="<?php echo base_url('user/userUpdate');?>" method="post" id="create_group_form_id" class="form-horizontal" role="form">

                        <div class="form-group">
                            <label  class="col-md-2 control-label">User Name </label>
                            <div class="col-md-4">
                                <input type="text"  class="form-control" disabled value="<?php echo $users['username']; ?>">
                                <input type="hidden" name="cd_user_id"  value="<?php echo $users['id']; ?>">

                            </div>
                        </div>
			
			<div class="form-group">
                            <label  class="col-md-2 control-label">Email </label>
                            <div class="col-md-4">
                                <input type="email" name="email" class="form-control" value="<?php echo $users['email']; ?>">
                            </div>
                            <?php echo form_error('email',"<p class='text-danger'>","</p>");?>
                        </div>
				
                        <div class="form-group">
                            <label  class="col-md-2 control-label">Password </label>
                            <div class="col-md-4">
                                <input type="password"   name="password" class="form-control">
                            </div>
                            <?php echo form_error('password',"<p class='text-danger'>","</p>");?>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Confirm Password </label>
                            <div class="col-md-4">
                                <input type="password"  name="confirmPassword" class="form-control">
                            </div>
                            <?php echo form_error('confirmPassword',"<p class='text-danger'>","</p>")?>
                        </div>


                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn blue">Submit</button>
                            </div>
                        </div>


                    </form>

                    <script>

                        $(document).ready(function() {



//                            $("#create_group_form_id").validate({
//                                rules:{
//                                    fullUserName:{
//                                        required: true,
//                                        minlength: 3
//                                    }
//                                    group_desc:{
//                                        required: true,
//                                        minlength: 10
//                                    }
//                                },
//                                messages:{
//                                    fullUserName:{
//                                        required: "We need your email address to contact you",
//                                        minlength: jQuery.validator.format("At least {0} characters required!")
//                                    }
//                                    group_desc:{
//                                        required: "We need your email address to contact you",
//                                        minlength: jQuery.validator.format("At least {0} characters required!")
//                                    }
//                                }
//                            });
//
//                            setTimeout(function() {
//                                $("#successMessage").hide('blind', {}, 500)
//                            }, 5000);
//
//                            setTimeout(function() {
//                                $("#failedMessage").hide('blind', {}, 500)
//                            }, 5000);



                            $("#countrySelectDivID").on("change",function(){

                                var countryCode = $("#countryCodeID").val();

                                $.ajax({

                                    url:'<?php echo base_url('User/getCountryCode/')?>'+countryCode,
                                    typ:'GET',
                                    success:function(success){
                                        $("#countryCode").val(success);
                                    },
                                    error: function(){
                                        alert("fail from error:")
                                    }

                                });
                            });

                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
