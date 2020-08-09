<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>ALL Client LIST SHOW
                </div>
                <div class="actions">
                    <a href="#<?php echo base_url('client/createClient');?>" data-toggle="modal"
                       data-target="#createNewClient" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i> Create New Client </a>

                    <a href="<?php echo base_url('user/createUser'); ?>" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i> Add </a>
                    <a href="javascript:;" class="btn btn-default btn-sm">
                        <i class="fa fa-print"></i> Print </a>
                </div>
            </div>

            <div class="modal fade" id="createNewClient" tabindex="-1" role="dialog" aria-labelledby="largeModal"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Large Modal</h4>
                        </div> -->
                        <div class="modal-body">
                            <!-- Modal Body starts-->
                            <div class="row">
                                <div class="col-md-12 border" style="border-color: grey;">
                                    <form class='form' method='post' action='<?php echo base_url('client/createClient'); ?>' >
                                        <div class="row">
                                            <h1 class="border" style="border-color: grey; ">New Client Registration</h1>
                                        </div>
                                        <!--			Distributor name-->
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Distributor Name: </label>
                                            <input type="text" name="name" id="client_name" class="form-control col-md-10"
                                                   style="width:80%;" placeholder="Organization /Name"
                                                   aria-describedby="helpId"/>
                                        </div>
                                        <!--			Representative name-->
                                        <div class="form-group row">
                                            <label for="representative_name" class="col-sm-4 col-form-label">Representative Name: </label>
                                            <input type="text" name="representative_name" id="client_representative_name" class="form-control col-md-12"
                                                   style="width:40%;" placeholder="Representative Name"
                                                   aria-describedby="helpId"/>

                                        </div>
                                        <!--			Client and Virtual A/C-->
                                        <div class="form-group row">
                                            <label for="client_code" class="col-md-2 col-form-label">Client Code</label>
                                            <input type="text" name="client_code" id="client_code" class="form-control col-md-3"
                                                   style="width:25%;" placeholder=""
                                                   aria-describedby="helpId"/><span>*</span>
                                            <label for="virtual_account_no" class="col-md-2 col-form-label">Virtual A/C No</label>
                                            <input type="text" name="virtual_account_no" id="" class="form-control col-md-3"
                                                   style="width:25%;" placeholder=""
                                                   aria-describedby="helpId"/><span>*</span>
                                        </div>
                                        <!--			Assign DSR-->
                                        <div class="form-group row">
                                            <label for="" class="col-md-2 col-form-label">Assign DSR</label>
                                            <select name="assign_dsr" class="form-control col-sm-10">
                                                <!-- thete was an error -->
                                                <option value="">Select DSR....</option>
                                                <!-- <option value="t">2</option> -->

                                                <?php foreach($getDSRs as $getDSR){?>
                                                <option value=<?php echo "\"".$getDSR['coded_employeeId'] ."\"";?>><?php echo $getDSR['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="row border"
                                             style="padding-right: 2px !important;border-color: grey; padding-left: 2px !important; margin-bottom: 2px;">
                                            <h3>Contact</h3>
                                        </div>
                                        <!--			Contact value 1-->
                                        <div class="row border" style="border-color: #808080; margin-bottom: 2px;">
                                            <div class="form-group col-sm-6">
                                                <label for="" class="col-form-label">Contact Value</label>
                                                <input type="text" name="" id="" class="form-control"
                                                       placeholder="Organization /Name"
                                                       aria-describedby="helpId"/>
                                            </div>
                                            <!--			Contact value 2-->
                                            <div class="form-group col-sm-6">
                                                <label for="" class="col-form-label">Contact Type</label><br>
                                                <select name="" class="form-control col-sm-12">
                                                    <option value="">Phone</option>
                                                    <option value="">Email</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row border" style="border-color: grey">

                                            <!--			Contact value 2-->
                                            <div class="form-group col-sm-6">
                                                <label for="" class="col-form-label">Contact Value</label>
                                                <input type="text" name="" id="" class="form-control"
                                                       placeholder="Organization /Name"
                                                       aria-describedby="helpId"/>
                                            </div>
                                            <!--			Contact value 2-->
                                            <div class="form-group col-sm-6">
                                                <label for="" class="col-form-label">Contact Type</label><br>
                                                <select name="" class="form-control col-sm-12">
                                                    <option value="">Phone</option>
                                                    <option value="">Email</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-8 col-md-4switch-field">
                                                <input type="radio" id="radio-one" name="activeStatus" value="yes"
                                                       checked/>
                                                <label for="radio-one">Active</label>
                                                <input type="radio" id="radio-two" name="activeStatus" value="no"/>
                                                <label for="radio-two">Inactive</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>Is this client user</p><input type="checkbox" name="is_user" id="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6"><label class=""
                                                                             for="username">Username:</label></div>
                                                <div class="col-md-6"><input class="form-control" type="text"
                                                                             name="username" id=""></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6"><label class=""
                                                                             for="password">Password:</label></div>
                                                <div class="col-md-6"><input class="form-control" type="password"
                                                                             name="password" id=""></div>
                                            </div>
                                        </div>
                                        <!-- form submitt -->
                                        <div class="modal-footer">
                                            <button type="cancel" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type='submit' class='btn btn-primary' id='submit'>+ Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--Modal body ends-->
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column"
                       id="sample_3">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
                        </th>
                        <th> Name</th>
                        <th> Designation</th>
                        <th> Created Date</th>
                        <th> Clint Code</th>
                        <th> Status</th>
                        <th> Action</th>
                    </tr>allClient

                    </thead>
                    <tbody>


                    <?php foreach ($allClient as $client) { ?>
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="1"/></td>
                            <td> <?php echo $client['name'] ?> </td>
                            <td> <?php echo $client['client_type'] ?> </td>
                            <td> <?php echo $client['client_code'] ?> </td>
                            <td> <?php echo $client['client_code'] ?> </td>
                            <?php
                            if ($client['is_active'] == '1') {
                                ?>
                                <td><span class="badge badge-success" style="width: 100%;height: 22px;">Active</span>
                                </td>
                                <?php
                            } else {
                                ?>
                                <td><span class="badge badge-danger" style="width: 100%;height: 22px;">InActive</span>
                                </td>
                                <?php
                            }
                            ?>
                            <td>
                                <div class="clearfix">

                                    <a href="#" class="btn btn-sm yellow" style="margin-bottom: 5px;"> Edit
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a onclick="deleteData(<?php echo $client['id'] ?>)" href="#" data-toggle="tooltip"
                                       data-placement="bottom" title="Hapus Mahasiswa" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> Delete</a>

                                </div>
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteData(id) {
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            },
            function () {
                $.ajax({
                    echo: Hello,
                    url: "<?php echo base_url('user/DeleteUser/') ?>",
                    type: "post",
                    data: {id: id},
                    success: function () {
                        swal('Data Deleted Successfully..', ' ', 'success');
                        $("#delete" + id).fadeTo("slow", 0.7, function () {
                            $(this).remove();
                        })
                    },
                    error: function () {
                        swal('Something Error Found..', 'error');
                    }
                });

            });
    }

    $(document).ready(function(){
    $("#submitt").click(function(){
      var name = $("#client_name").val();
      // var url = base_url + '/index.php/home/redeeming_form_value';
      console.alert("test");
        // $.ajax({
        //   type : 'POST',
        //   dataType: 'json',
        //   url : url,
        //   data :'myvalue='+test,
        //   success: function(data){
        //      msg= eval(data);
        //      amount= msg.amount;
        //      alert(amount);
        //      }
        //   });
        });
    });

</script>