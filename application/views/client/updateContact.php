<!--			Contact value 1-->
<div class="row">
    <div class="form-group col-sm-6">
        <label for="contact_value_1" class="col-form-label">Contact
            Value</label>
        <input type="text" name="contact_value_1" id="" value="<?php set_value('contact_value_1',) ?>" class="form-control" placeholder="Organization / Name" aria-describedby="helpId" />
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