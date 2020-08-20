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
        <form action="<?php echo base_url('client/updateClient/' . $client['id']); ?>" method="POST">
            <!--			Distributor name-->
            <div class="row">
                <div class="form-group">
                    <div class="col-md-2">
                        <label for="name" class="form-label">Distributor Name:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="name" id="client_name" value="" class="form-control" placeholder="Organization /Name" value="<?php echo set_value('name', $client['name']); ?>" aria-describedby="helpId" width="auto" />
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
                        <input type="text" name="representative_name" value="" id="client_representative_name" class="form-control" placeholder="Representative Name" value="<?php echo set_value('representative_name', $client['representative_name']); ?>" aria-describedby="helpId" />
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
                        <input type="text" name="client_code" id="client_code" value="" class="form-control" placeholder="Client Code" value="<?php echo set_value('client_code', $client['client_code']); ?>" aria-describedby="helpId" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-6">
                        <label for="virtual_account_no" class="form-label text-left">Virtual A/C No:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="virtual_account_no" id="" value="" class="form-control" placeholder="Virtual A/C no." value="<?php echo set_value('virtual_account_no', $client['virtual_account_no']); ?>" aria-describedby="helpId" />
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">
                Update
            </button>
        </form>
    </div>
</div>