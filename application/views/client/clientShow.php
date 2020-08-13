<div class="row">
    <div class="col-md-12" style="padding-top: 10px;">
        <?php
        $success = $this->session->userdata('success');
        if ($success != "") {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $success; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <?php
        $failure = $this->session->userdata('failure');
        if ($failure != "") {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $failure; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>ALL Client LIST SHOW
                </div>
                <div class="actions">
                    <a href="#<?php echo base_url('client/createClient'); ?>" data-toggle="modal"
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
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">New Client Registration</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Modal Body starts-->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if (!empty(form_error('name')) || !empty(form_error('representative_name')) || !empty(form_error('client_code')) || !empty(form_error('virtual_account_code')) || !empty(form_error('username')) || !empty(form_error('password')) || !empty(form_error('confirm_password'))) { ?>
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                     role="alert">
                                                    <strong><?php echo form_error('name') ?></strong><br>
                                                    <strong><?php echo form_error('representative_name') ?></strong><br>
                                                    <strong><?php echo form_error('client_code') ?></strong><br>
                                                    <strong><?php echo form_error('virtual_account_code') ?></strong><br>
                                                    <strong><?php echo form_error('username') ?></strong><br>
                                                    <strong><?php echo form_error('password') ?></strong><br>
                                                    <strong><?php echo form_error('confirm_password') ?></strong><br>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <form class='form' method='post'
                                          action='<?php echo base_url('client/createClient'); ?>'>
                                        <!--			Distributor name-->
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <label for="name" class="form-label">Distributor Name: </label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="name" id="client_name"
                                                           class="form-control "
                                                           placeholder="Organization /Name"
                                                           aria-describedby="helpId" width="auto"/>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <!--			Representative name-->
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-2">
                                                    <label for="representative_name" class="form-label">Representative
                                                        Name: </label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="representative_name"
                                                           id="client_representative_name" class="form-control "
                                                           placeholder="Representative Name"
                                                           aria-describedby="helpId"/>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <!--			Client and Virtual A/C-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-6">
                                                    <label for="client_code" class="form-label text-left">Client
                                                        Code: *</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="client_code" id="client_code"
                                                           class="form-control"
                                                           placeholder=""
                                                           aria-describedby="helpId"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-6">
                                                    <label for="virtual_account_no" class="form-label text-left">Virtual
                                                        A/C No: *</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="virtual_account_no" id=""
                                                           class="form-control"
                                                           placeholder=""
                                                           aria-describedby="helpId"/>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <!--			Assign DSR-->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="assign_dsr" class="col-form-label text-left">Assign DSR</label>
                                            </div>
                                            <div class="col-md-10">
                                                <select name="assign_dsr" class="form-control">
                                                    <!-- thete was an error -->
                                                    <option value="">Select DSR....</option>
                                                    <!-- <option value="t">2</option> -->

                                                    <?php foreach ($getDSRs as $getDSR) { ?>
                                                        <option value=<?php echo "\"" . $getDSR['coded_employeeId'] . "\""; ?>><?php echo $getDSR['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>Contact</h3>
                                            </div>
                                        </div>
                                        <!--			Contact value 1-->
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="contact_value_1" class="col-form-label">Contact
                                                    Value</label>
                                                <input type="text" name="contact_value_1" id="" class="form-control"
                                                       placeholder="Organization / Name"
                                                       aria-describedby="helpId"/>
                                            </div>
                                            <!--			Contact type 1-->
                                            <div class="form-group col-sm-6">
                                                <label for="contact_type_id_1" class="col-form-label">Contact
                                                    Type</label><br>
                                                <select name="contact_type_id_1" class="form-control col-sm-12">
                                                    <?php foreach ($contacts as $contact) { ?>
                                                        <option value=<?php echo "\"" . $contact['id'] . "\""; ?>>
                                                            <?php echo $contact['contact_type']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--			Contact value 2-->
                                            <div class="form-group col-sm-6">
                                                <label for="contact_value_2" class="col-form-label">Contact
                                                    Value</label>
                                                <input type="text" name="contact_value_2" id="" class="form-control"
                                                       placeholder="Organization /Name"
                                                       aria-describedby="helpId"/>
                                            </div>
                                            <!--			Contact type 2-->
                                            <div class="form-group col-sm-6">
                                                <label for="contact_type_2" class="col-form-label">Contact
                                                    Type</label><br>
                                                <select name="contact_type_id_2" class="form-control col-sm-12">
                                                    <?php foreach ($contacts as $contact) { ?>
                                                        <option value=<?php echo "\"" . $contact['id'] . "\""; ?>>
                                                            <?php echo $contact['contact_type']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-8 col-md-4 switch-field">
                                                <input type="radio" id="radio-one" name="is_active" value="1"
                                                       checked/>
                                                <label for="radio-one">Active</label>
                                                <input type="radio" id="radio-two" name="is_active" value="0"/>
                                                <label for="radio-two">Inactive</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-6 col-md-4">
                                                <p>Is this client user?<input type="checkbox" name="is_user" value="true" style="width: 30px; height: 30px;" id="is_user"
                                                                              onclick="enableCreateUser()"/></p>
                                            </div>
                                        </div>
                                        <div class="row" id="user_register">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="" for="username">Username:</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="text" name="username"
                                                               id="user_res" disabled/>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <label class="" for="password">Password:</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="password" name="password"
                                                               id="pass" disabled/>
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <label class="" for="confirm_password">Confirm
                                                                Password:</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control" type="password"
                                                                   name="confirm_password"
                                                                   id="confirm_pass" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- form submit -->
                                        <div class="modal-footer">
                                            <button type="cancel" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type='submit' class='btn btn-primary' id='submit'>+ Create
                                            </button>
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
                    </tr>
                    allClient

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

    $(document).ready(function () {
        $("#submitt").click(function () {
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

    function enableCreateUser() {
        if (document.getElementById("is_user").checked) {
            document.getElementById("user_res").disabled = false;
            document.getElementById("pass").disabled = false;
            document.getElementById("confirm_pass").disabled = false;
        }
        if (!document.getElementById("is_user").checked) {
            document.getElementById("user_res").disabled = true;
            document.getElementById("pass").disabled = true;
            document.getElementById("confirm_pass").disabled = true;
        }
    }
</script>