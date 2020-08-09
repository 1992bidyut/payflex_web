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
                    <i class="fa fa-cogs"></i>Mask Request List
                </div>
            </div>
            <div class="portlet-body">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" />
                        </th>
                        <th><center> User Id </center></th>
                        <th><center> User Name </center></th>
                        <th><center> Mask Name </center></th>
                        <th><center> Status </center></th>
                        <th><center> Download </center></th>
                        <th><center> Delete </center></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach($userMaskInfo as $maskdata){
                    ?>

                        <tr class="odd gradeX">
                            <td><center><input type="checkbox" class="checkboxes" value="1" /></center></td>
                            <td><center> <?php echo $maskdata['cd_user_id'];?> </center></td>
                            <td><center> <?php echo $maskdata['email'];?> </center></td>
                            <td><center> <?php echo $maskdata['mask_name'];?> </center></td>
                            <td><center> <?php 
                                    if ($maskdata['status'] == 0) {
                                        echo "Pending";
                                    }elseif($maskdata['status'] == 1){
                                        echo "Done";
                                    }

                                 ?> 
                            </center></td>

                            <td><center>
                                    <a href="<?php echo base_url('Mask/userMaskEdit/').$maskdata['id'];?>" 
                                     class="btn btn-sm yellow" style="margin-bottom: 5px;" > Download
                                        <i class="fa fa-download"></i>
                                    </a>
                            </center></td>

                            <td><center>
                                    <a href="<?php echo base_url('Mask/maskInfoDestroy/').$maskdata['id'];?>" onclick="return confirm('Are you sure you want to delete');" class="btn btn-sm red" style="margin-bottom: 5px;"> Delete
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </div>
                            </center></td>
                        </tr>
                    <?php
                    }
                    ?>

                    </tbody>
                </table>
                <script type="text/javascript">

                $(document).ready(function () {
                  $('#dtBasicExample').DataTable({
                    "pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
                  });
                  $('.dataTables_length').addClass('bs-select');
                });
                
                </script>




            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
