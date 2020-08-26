<div class="row">
    <div class="col-md-12" style="padding-top: 10px;">
        <?php
        $success = $this->session->userdata('success');
        if ($success != "") { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $success; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
        <?php
        $failure = $this->session->userdata('failure');
        if ($failure != "") { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $failure; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    </div>
</div>
<!-- validation error messsage -->
<div class="row">
    <div class="col-md-12">
        <?php if (
            !empty(form_error('name'))
            || !empty(form_error('representative_name'))
            || !empty(form_error('client_code'))
            || !empty(form_error('virtual_account_no'))
        ) { ?>
            <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert"> -->
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <strong><?php echo form_error('name') ?></strong><br />
                <strong><?php echo form_error('representative_name') ?></strong><br />
                <strong><?php echo form_error('client_code') ?></strong><br />
                <strong><?php echo form_error('virtual_account_no') ?></strong><br />
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
                        <input type="text" name="name" id="client_name" class="form-control" placeholder="Organization /Name" value="<?php echo set_value('name', $client_info['name']); ?>" aria-describedby="helpId" width="auto" />
                    </div>
                </div>
            </div>
            <br />
            <!--			Representative name-->
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2">
                        <label for="representative_name" class="form-label">Representative Name:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="representative_name" id="client_representative_name" class="form-control" placeholder="Representative Name" value="<?php echo set_value('representative_name', $client_info['representative_name']); ?>" aria-describedby="helpId" />
                    </div>
                </div>
            </div>
            <br />
            <!--			Client and Virtual A/C-->
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <label for="client_code" class="form-label text-left">Client Code:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="client_code" id="client_code" class="form-control" placeholder="Client Code" value="<?php echo set_value('client_code', $client_info['client_code']); ?>" aria-describedby="helpId" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <label for="virtual_account_no" class="form-label text-left">Virtual A/C No:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="virtual_account_no" id="" class="form-control" placeholder="Virtual A/C no." value="<?php echo set_value('virtual_account_no', $client_info['virtual_account_no']); ?>" aria-describedby="helpId" />
                    </div>
                </div>
            </div>
            <br>
            <!--			Assign DSR-->
            <div class="row">
                <div class="col-md-2">
                    <label for="assign_dsr" class="col-form-label text-left">Assign
                        DSR</label>
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
                </div>

            </div>
            <br>
            <!-- TODO: need to use for loop to make fields -->
            <div id="addMultiContact">
                <?php //echo print_r($contacts_info); 
                ?>
                <?php for ($i = 0; $i <= $total_contact - 1; $i++) { ?>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="hidden" id="contact_counter" name="contact_counter" value="<?php echo ($total_contact-1); ?>">
                            <label for="<?php echo "contact_value_" . $i; ?>" class="col-form-label">Contact Value</label>
                            <input type="text" name="<?php echo "contact_value_" . $i; ?>" value="<?php print_r($contacts_info[$i]['contact_value']); ?>" id="" class="form-control" placeholder="Contact Value" aria-describedby="helpId" />
                        </div>
                        <!--			Contact type 1-->
                        <div class="form-group col-sm-6">
                            <label for="<?php echo "contact_type_id_" . $i; ?>" class="col-form-label">Contact Type</label>
                            <br>
                            <select id="<?php echo "contact_type_id_" . $i; ?>" name="<?php echo "contact_type_id_" . $i; ?>" class="form-control col-sm-12">
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
            <!-- is active -->
            <div class="row">
                <div class="col-md-offset-8 col-md-4 switch-field">
                    <input type="radio" id="radio-one" name="is_active" value="1" <?php if ($client_info['is_active'] == 1) {
                                                                                        echo "checked";
                                                                                    } ?> />
                    <label for="radio-one">Active</label>
                    <input type="radio" id="radio-two" name="is_active" value="0" <?php if ($client_info['is_active'] == 0) {
                                                                                        echo "checked";
                                                                                    } ?> />
                    <label for="radio-two">Inactive</label>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">
                Update
            </button>
        </form>
    </div>
</div>

<script>
    let element = document.getElementById("assignDsr");
    element.value = "<?php echo $client_info['client_pairID']; ?>";
    var total_counter = "<?php echo $total_contact; ?>";
    var contact_info = <?php echo json_encode($contacts_info); ?>;
    // for (var i = 0; i <= total_counter - 1; i++) {
    //     let element = document.getElementById("contact_type_id_" + i);
    //     element.value = "<?php //echo $contacts_info[<script>document.writeln(i);</script>]['type_id'] 
                            ?>";
    // }
    for (var i = 0; i <= total_counter - 1; i++) {
        let element = document.getElementById("contact_type_id_" + i);
        console.log(contact_info[i].type_id);
        element.value = contact_info[i].type_id;
    }
</script>