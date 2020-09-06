<div class="row">
    <div class="col-md-12" style="padding-top: 10px;">
        <?php
        $success = $this->session->userdata('success');
        if ($success != "") {
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
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
            <div class="alert alert-warning alert-dismissible" role="alert">

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
        <form action="<?php echo base_url('client/updateClient/' . $client_info['client_id']); ?>" method="POST">
            <!--			Distributor name-->
            <div class="row">
                <input type="hidden" name="client_id" value="<?php echo $client_info['client_id']; ?>">
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="name" class="form-label">Distributor Name:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="name" id="client_name" class="form-control"
                               placeholder="Organization /Name"
                               value="<?php echo set_value('name', $client_info['name']); ?>" aria-describedby="helpId"
                               width="auto"/>
                        <strong style="color: red"><?php echo form_error('name') ?></strong>
                    </div>
                </div>
            </div>
            <br/>


            <!--			Representative name-->
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2">
                        <label for="representative_name" class="form-label">Representative Name:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="representative_name" id="client_representative_name"
                               class="form-control" placeholder="Representative Name"
                               value="<?php echo set_value('representative_name', $client_info['representative_name']); ?>"
                               aria-describedby="helpId"/>
                        <strong style="color: red"><?php echo form_error('representative_name') ?></strong>
                    </div>
                </div>
            </div>
            <br/>


            <!--			Client and Virtual A/C-->
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <label for="client_code" class="form-label text-left">Client Code:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="client_code" id="client_code" class="form-control"
                               placeholder="Client Code"
                               value="<?php echo set_value('client_code', $client_info['client_code']); ?>"
                               aria-describedby="helpId"/>
                        <strong style="color: red"><?php echo form_error('client_code') ?></strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <label for="virtual_account_no" class="form-label text-left">Virtual A/C No:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="virtual_account_no" id="" class="form-control"
                               placeholder="Virtual A/C no."
                               value="<?php echo set_value('virtual_account_no', $client_info['virtual_account_no']); ?>"
                               aria-describedby="helpId"/>
                        <strong style="color: red"><?php echo form_error('virtual_account_no') ?></strong>
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
                    <select name="assign_dsr" id="assignDsr" class="form-control" value="">
                        <!-- thete was an error -->
                        <option value="">Select DSR....</option>
                        <!-- <option value="t">2</option> -->

                        <?php foreach ($getDSRs as $getDSR) { ?>
                            <option value=<?php echo "\"" . $getDSR['coded_employeeId'] . "\""; ?>><?php echo $getDSR['name']; ?></option>
                        <?php } ?>
                    </select>
                    <strong style="color: red"><?php echo form_error('assign_dsr') ?></strong>
                </div>

            </div>
            <br>


            <!--contact secion-->
            <div id="addMultiContact">
                <input type="hidden" id="contact_counter" name="contact_counter"
                       value="<?php if ($total_contact == 0) {
                           echo "";
                       } else {
                           echo($total_contact - 1);
                       } ?>">
                <?php //print_r($total_contact); ?>
                <?php //print_r($contacts_info[1]['contact_value']); ?>
                <input type="hidden" id="update_contact_counter" name="update_contact_counter" value="">
                <div class="row">
                    <div class="form-group col-sm-6">

                        <label for="contact_value_0" class="col-form-label">Contact Value</label>
                        <input type="text" name="contact_value_0" id="contact_value_0"
                               value="<?php if (!empty($contacts_info)) {
                                   echo set_value('contact_value_0', $contacts_info[0]['contact_value']);
                               } else {
                                   echo "";
                               } ?>" class="form-control" placeholder="Contact Value" aria-describedby="helpId"/>
                        <strong style="color: red"><?php echo form_error('contact_value_0') ?></strong>
                        <input type="hidden" name="contact_id_0"
                               value="<?php if (empty($contacts_info)) {
                                   echo "";
                               } else {
                                   print_r($contacts_info[0]['contact_id']);
                               } ?>">
                    </div>
                    <!--			Contact type 1-->
                    <div class="form-group col-sm-6">
                        <label for="contact_type_id_0" class="col-form-label">Contact Type</label><br>
                        <select name="contact_type_id_0" id="contact_type_id_0" class="form-control col-sm-12">
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
                        <label for="contact_value_1" class="col-form-label">Contact Value</label>
                        <input type="text" name="contact_value_1" id="contact_value_1"
                               value="<?php if (!empty($contacts_info)) {
                                   echo set_value('contact_value_1', $contacts_info[1]['contact_value']);
                               } else {
                                   echo "";
                               } ?>" class="form-control" placeholder="Contact Value" aria-describedby="helpId"/>
                        <strong style="color: red"><?php echo form_error('contact_value_1') ?></strong>
                        <input type="hidden" name="contact_id_1"
                               value="<?php if (empty($contacts_info)) {
                                   echo "";
                               } else {
                                   print_r($contacts_info[1]['contact_id']);
                               } ?>">
                    </div>
                    <!--			Contact type 2-->
                    <div class="form-group col-sm-6">
                        <label for="contact_type_id_1" class="col-form-label">Contact Type</label><br>
                        <select name="contact_type_id_1" id="contact_type_id_1" class="form-control col-sm-12">
                            <?php foreach ($contacts as $contact) { ?>
                                <option value=<?php echo "\"" . $contact['id'] . "\""; ?>>
                                    <?php echo $contact['contact_type']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php for ($i = 2; $i <= $total_contact - 1; $i++) { ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="<?php echo "contact_value_" . $i; ?>" class="col-form-label">Contact
                                Value</label>
                            <input type="text" name="<?php echo "contact_value_" . $i; ?>"
                                   value="<?php
                                   //print_r($contacts_info[$i]['contact_value']);
                                   echo set_value('contact_value_' . $i, $contacts_info[$i]['contact_value']);
                                   ?>" id=""
                                   class="form-control" placeholder="Contact Value" aria-describedby="helpId"/>
                            <strong style="color: red"><?php echo form_error('contact_value_' . $i) ?></strong>
                            <input type="hidden" name="<?php echo "contact_id_" . $i; ?>"
                                   value="<?php print_r($contacts_info[$i]['contact_id']); ?>">
                        </div>
                        <!--			Contact type-->
                        <div class="form-group col-sm-6">
                            <label for="<?php echo "contact_type_id_" . $i; ?>" class="col-form-label">Contact
                                Type</label>
                            <br>
                            <select id="<?php echo "contact_type_id_" . $i; ?>"
                                    name="<?php echo "contact_type_id_" . $i; ?>" class="form-control col-sm-12">
                                <?php foreach ($contacts as $contact) { ?>
                                    <option value=<?php echo "\"" . $contact['id'] . "\""; ?>>
                                        <?php echo $contact['contact_type']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <br>
            <div class="row text-right">
                <?php if ($total_contact == 0) { ?>
                    <div class="col-md-offset-10 col-md-2 plusButton border"
                         style="border:1px solid black; cursor:pointer;">
                        <span class="input-group-addon" style="border: none;">
                            <i class="glyphicon glyphicon-plus"></i>Another
                        </span>
                    </div>
                <?php } else { ?>
                    <div class="col-md-offset-9 col-md-3 text-right">
                        <a href="#" class="btn btn-lg btn-primary" data-toggle="modal"
                           data-target="#AddNewContactModal">Add New Contact</a>
                        &nbsp;
                        <a href="#" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#DeleteContactModal">Delete
                            Contact</a>
                    </div>
                <?php } ?>
            </div>
            <br>
            <div class="row">
                <div class="col-md-offset-9 col-md-3 text-right">
                    <a href="#" class="btn btn-lg btn-primary" data-toggle="modal"
                       data-target="#userUpdateModal">Edit User credential</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-offset-9 col-md-3 text-right">
                    <a href="#" class="btn btn-lg btn-primary" data-toggle="modal"
                       data-target="#passwordChangeModal">Change User Password</a>
                </div>
            </div>
            <br>
            <!-- is active -->
            <div class="row">
                <div class="col-md-offset-8 col-md-4 switch-field">
                    <input type="radio" id="radio-one" name="is_active"
                           value="1" <?php if ($client_info['is_active'] == 1) {
                        echo "checked";
                    } ?> />
                    <label for="radio-one">Active</label>
                    <input type="radio" id="radio-two" name="is_active"
                           value="0" <?php if ($client_info['is_active'] == 0) {
                        echo "checked";
                    } ?> />
                    <label for="radio-two">Inactive</label>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">
                Update
            </button>
        </form>


        <!--        add new contacts form-->
        <div class="modal fade" id="AddNewContactModal" tabindex="-1" role="dialog" aria-labelledby="AddNewContactModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Create Contact</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('client/addContacts'); ?>"
                              method="POST">
                            <div class="AddNewMultiContact" id="AddNewMultiContact">
                                <input type="hidden" id="new_contact_counter" name="new_contact_counter" value="">
                                <input type="hidden" name="client_id" value="<?php echo $client_info['client_id']; ?>">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="new_contact_value_0" class="col-form-label">Contact Value</label>
                                        <input type="text" name="new_contact_value_0" id="new_contact_value_0"
                                               value="" class="form-control" placeholder="Contact Value"
                                               aria-describedby="helpId"/>
                                        <strong style="color: red"><?php echo form_error('contact_value_0') ?></strong>
                                    </div>
                                    <!--			Contact type 1-->
                                    <div class="form-group col-sm-6">
                                        <label for="new_contact_type_id_0" class="col-form-label">Contact
                                            Type</label><br>
                                        <select name="new_contact_type_id_0" id="contact_type_id_0"
                                                class="form-control col-sm-12">
                                            <?php foreach ($contacts as $contact) { ?>
                                                <option value=<?php echo "\"" . $contact['id'] . "\""; ?>>
                                                    <?php echo $contact['contact_type']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-offset-10 col-md-2 newplusButton border"
                                     style="border:1px solid black; cursor:pointer;">
                                    <span class="input-group-addon" style="border: none;">
                                        <i class="glyphicon glyphicon-plus"></i>Another
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Contact</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!--        Delete contact-->
        <div class="modal fade" id="DeleteContactModal" tabindex="-1" role="dialog" aria-labelledby="DeleteContactModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Delete contact from the list</h4>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-danger">Deleted contact cannot be retrieved! <?php if ($total_contact <= 2) {
                                echo "You can't not delete if you have 2 contacts left!";
                            } ?></h3>
                        <table width="100%" class="table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Contact Value</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i <= $total_contact - 1; $i++) { ?>

                                <?php if ($total_contact <= 2) { ?>
                                    <?php //echo $total_contact; ?>
                                    <tr>
                                        <td><?php echo $contacts_info[$i]['contact_value']; ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <?php //echo $total_contact; ?>
                                    <tr>
                                        <td><?php echo $contacts_info[$i]['contact_value']; ?></td>
                                        <td class="text-center"><a
                                                    href="<?php echo base_url('client/deleteContact/' . $contacts_info[$i]['contact_id'] . '/' . $client_info['client_id']); ?>"
                                                    class="btn btn-danger">Delete</a></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--        //TODO: write update form for users-->
        <!--        user info update form-->
        <div class="modal fade" id="userUpdateModal" tabindex="-1" role="dialog" aria-labelledby="userUpdateModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <?php if ($ClientUserInfo["username"] != "") { ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Update Username</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('/client/updateEmail/' . $ClientUserInfo['tbl_user_id']); ?>"
                              method="post">
                            <div class="form-group">
                                <input type="hidden" name="user_id"
                                       value="<?php echo $ClientUserInfo['tbl_user_id']; ?>">
                                <input type="hidden" name="client_id"
                                       value="<?php echo $client_info['client_id']; ?>">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="username"
                                       value="<?php echo set_value('username', $ClientUserInfo['username']); ?>"
                                       aria-describedby="emailHelp" placeholder=""/>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update Email</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                        <?php } else { ?>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title" id="myModalLabel">Create New User</h3>
                        </div>
                        <div class="modal-body">
                            <h4>This client does not have an user account. You can create an user account for this
                                client.</h4>
                            <form action="<?php echo base_url('client/createNewUser') ?>" method="post">
                                <div class="row" id="user_register">
                                    <input type="hidden" name="client_id"
                                           value="<?php echo $client_info['client_id']; ?>">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="" for="user_res">Username:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" name="username" id="user_res"/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label class="" for="pass">Password:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="password" name="password" id="pass"/>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="" for="confirm_pass">Confirm
                                                        Password:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="password" name="confirm_password"
                                                           id="confirm_pass"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--        User password form modal-->
        <div class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog" aria-labelledby="passwordChangeModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <?php if ($ClientUserInfo["username"] != "") { ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Change User Password</h4>
                    </div>
                    <form action="<?php echo base_url('client/changePassword/'.$ClientUserInfo['tbl_user_id']) ?>" method="post">
                        <input type="hidden" name="user_id"
                               value="<?php echo $ClientUserInfo['tbl_user_id']; ?>">
                        <input type="hidden" name="client_id"
                               value="<?php echo $client_info['client_id']; ?>">
                        <div class="modal-body">
<!--                            <div class="form-group">-->
<!--                                <label for="oldPassword">Old Password</label>-->
<!--                                <input type="text" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">-->
<!--                            </div>-->
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="text" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="confirmNewPassword">Confirm New Password</label>
                                <input type="text" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Change password</button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>


    </div>

    <script>
        let element = document.getElementById("assignDsr");
        element.value = "<?php echo $client_info['client_pairID']; ?>";
        var total_counter = "<?php echo $total_contact; ?>";
        var contact_info = <?php echo json_encode($contacts_info); ?>;
        // for (var i = 0; i <= total_counter - 1; i++) {
        //     let element = document.getElementById("contact_type_id_" + i);
        //     element.value = "<?php //echo $contacts_info[<script>document.writeln(i);</script>]['type_id']; ?>";
        // }
        for (var i = 0; i <= total_counter - 1; i++) {
            let element = document.getElementById("contact_type_id_" + i);
            //console.log(contact_info[i].type_id);
            element.value = contact_info[i].type_id;
        }

        var counter = 1;
        $(function () {

            var plus = $(".plusButton");
            var del = $(".rmvButton");
            var selector = $("#addMultiContact");

            plus.click(function () {
                counter++;
                selector.append('<div class="row" id="' + 'contact_id_' + counter + '"><div class="form-group col-sm-6"><label for="' + 'contact_value_' + counter + '" class="col-form-label">Contact Value</label><input type="text" name="' + 'contact_value_' + counter + '" id="" class="form-control" placeholder="Contact Value" aria-describedby="helpId" /></div><div class="form-group col-sm-5"><label for="' + 'contact_type_id_' + counter + '" class="col-form-label">Contact Type</label><br><select name="' + 'contact_type_id_' + counter + '" class="form-control col-sm-11"><?php foreach ($contacts as $contact) { ?><option value=<?php echo "\"" . $contact['id'] . "\""; ?>><?php echo $contact['contact_type']; ?></option><?php } ?></select></div><br><div class="col-md-1 x" style="margin-top:9px;"><span class="remove-btn input-group-addon "><i class="glyphicon glyphicon-remove rmvButton" data-target="#' + 'contact_id_' + counter + '"></i></span></div></div>');
                //$("#update_contact_counter").val(counter);
                $("#contact_counter").val(counter);
            });

            selector.on("click", ".rmvButton", function () {

                var item_id = $(this).data("target");
                if (counter > 1) {
                    $(item_id).remove();
                    counter--;
                    // $("#update_contact_counter").val(counter);
                    $("#contact_counter").val(counter);
                }
            });
        });
        // end

        //add button 2
        var newcounter = 0;
        $(function () {

            var plus = $(".newplusButton");
            var del = $(".rmvButton");
            var selector = $("#AddNewMultiContact");

            plus.click(function () {
                newcounter++;
                selector.append('<div class="row" id="' + 'contact_id_' + newcounter + '"><div class="form-group col-sm-6"><label for="' + 'new_contact_value_' + newcounter + '" class="col-form-label">Contact Value</label><input type="text" name="' + 'new_contact_value_' + newcounter + '" id="" class="form-control" placeholder="Contact Value" aria-describedby="helpId" /></div><div class="form-group col-sm-5"><label for="' + 'new_contact_type_id_' + newcounter + '" class="col-form-label">Contact Type</label><br><select name="' + 'new_contact_type_id_' + newcounter + '" class="form-control col-sm-11"><?php foreach ($contacts as $contact) { ?><option value=<?php echo "\"" . $contact['id'] . "\""; ?>><?php echo $contact['contact_type']; ?></option><?php } ?></select></div><br><div class="col-md-1 x" style="margin-top:9px;"><span class="remove-btn input-group-addon "><i class="glyphicon glyphicon-remove rmvButton" data-target="#' + 'contact_id_' + newcounter + '"></i></span></div></div>');
                //$("#update_contact_counter").val(counter);
                $("#new_contact_counter").val(newcounter);
            });

            selector.on("click", ".rmvButton", function () {

                var item_id = $(this).data("target");
                if (newcounter > 0) {
                    $(item_id).remove();
                    newcounter--;
                    // $("#update_contact_counter").val(counter);
                    $("#new_contact_counter").val(newcounter);
                }
            });
        });
        // end
    </script>