<div class="row">
    <div class="col-md-12" style="padding-top: 10px;">
        <?php $success = $this->session->userdata('success');
        if ($success != "") { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><?php echo $failure; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <?php if (
                    !empty(form_error('name'))
                    || !empty(form_error('representative_name'))
                    || !empty(form_error('client_code'))
                    || !empty(form_error('virtual_account_no'))
                    || !empty(form_error('username'))
                    || !empty(form_error('password'))
                    || !empty(form_error('confirm_password'))
                ) { ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <strong><?php echo form_error('name') ?></strong><br>
                        <strong><?php echo form_error('representative_name') ?></strong><br>
                        <strong><?php echo form_error('client_code') ?></strong><br>
                        <strong><?php echo form_error('virtual_account_no') ?></strong><br>
                        <strong><?php echo form_error('username') ?></strong><br>
                        <strong><?php echo form_error('password') ?></strong><br>
                        <strong><?php echo form_error('confirm_password') ?></strong><br>

                    </div>
                <?php } ?>
            </div>
        </div>

        <form class='form' method='post' action='<?php echo base_url('client/createClient'); ?>'>
            <!--			Distributor name-->
            <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="name" class="form-label">Distributor Name: </label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="name" id="client_name" class="form-control " placeholder="Organization /Name" aria-describedby="helpId" width="auto" />
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
                        <input type="text" name="representative_name" id="client_representative_name" class="form-control " placeholder="Representative Name" aria-describedby="helpId" />
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
                        <input type="text" name="client_code" id="client_code" class="form-control" placeholder="" aria-describedby="helpId" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <label for="virtual_account_no" class="form-label text-left">Virtual
                            A/C No: *</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="virtual_account_no" id="" class="form-control" placeholder="" aria-describedby="helpId" />
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
                    <input type="text" name="contact_value_1" id="" class="form-control" placeholder="Organization / Name" aria-describedby="helpId" />
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
                    <input type="text" name="contact_value_2" id="" class="form-control" placeholder="Organization /Name" aria-describedby="helpId" />
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
                    <input type="radio" id="radio-one" name="is_active" value="1" checked />
                    <label for="radio-one">Active</label>
                    <input type="radio" id="radio-two" name="is_active" value="0" />
                    <label for="radio-two">Inactive</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-6 col-md-4">
                    <p>Is this client user?<input type="checkbox" name="is_user" value="true" style="width: 30px; height: 30px;" id="is_user" onclick="enableCreateUser()" /></p>
                </div>
            </div>
            <div class="row" id="user_register">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="" for="username">Username:</label>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="username" id="user_res" disabled />
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6">
                            <label class="" for="password">Password:</label>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password" id="pass" disabled />
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
                                <input class="form-control" type="password" name="confirm_password" id="confirm_pass" disabled />
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