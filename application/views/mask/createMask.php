

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
                        Create Mask
                    </div>
                </div>
                <div class="portlet-body  grey-cararra">
                    <form action="<?php echo base_url('mask/maskStore');?>"   method="post" class="form-horizontal" role="form">

                        <div class="form-group">
                            <label  class="col-md-2 control-label">Mask </label>
                            <div class="col-md-4">
                                <input type="text" value="<?php echo set_value('mask')?>" name="mask" class="form-control" id=""  placeholder="Mask">
                            </div>
                            <?php echo form_error('mask',"<p class='text-danger'>","</p>")?>
                        </div>

                        <input type="hidden" value="<?php echo @$cd_user_id;?>" name="cd_user_id" class="form-control" id=""  placeholder="Mask">


                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" class="btn blue">Submit</button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Mask List </div>
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
                            <th> Mask </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
//                        echo'<pre />';
//                        print_r($masks);
//                        die();
                        foreach($masks as $mask){
                            ?>

                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td> <?php echo $mask['mask_text'];?> </td>
                                <td >
                                    <div class="clearfix">

                                        <a href="#" class="btn btn-sm yellow" style="margin-bottom: 5px;"> Edit
                                            <i class="fa fa-edit"></i>
                                        </a>


                                        <a href="<?php echo site_url('mask/maskDestroy/').$mask['id'].'/'.$mask['cd_user_id'];?>"
                                           class="btn btn-sm red"
                                           onclick="return confirm('Are you sure you want to delete');"> Delete
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <?php
                                        if($mask['is_default'] != 1)
                                        {
                                            ?>
                                            <a href="<?php echo site_url('mask/maskUpdate/').$mask['id'].'/'.$mask['cd_user_id'];?>"
                                               class="btn btn-sm green"
                                               onclick="return confirm('Are you sure you want to set this mask as default');"> Set Default
                                                <i class="fa fa-tags"></i>
                                            </a>

                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <a href="" class="btn btn-sm default disabled"> Set Default
                                                <i class="fa fa-tags"></i>
                                            </a>
                                        <?php
                                        }
                                        ?>
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
<!--
<script>   //no need to specify the language

//    $(function() {
//        $('#createMaskFormId').submit(function(e){
//
//            e.preventDefault();
//            var $form = $(this);
//
//
//            $.ajax({
//
//                url:'<?php //echo base_url('mask/maskStore');?>//',
//                type: 'POST',
//                data: $('#createMaskFormId').serialize(),
//
//                success: function(returnData){
//                    // alert(returnData);
//                    // console.log(returnData);
//                    if(returnData)
//                    {
//                        alert('Mask added Successfully!');
//                        location.reload();
//
//                    }
//                    else
//                    {
//                        alert('Failed');
//
//                    }
//
//                },
//                error: function(){
//                    alert("fail from error:")
//                }
//            });
//        });
//
//    });


</script>
    --->