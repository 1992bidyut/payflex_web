<div class="row" id="'+'contact_id_'+counter+'">
    <div class="form-group col-sm-6"><label for="'+'contact_value_id_'+counter+'" class="col-form-label">Contact Value</label><input type="text" name="'+'contact_value_id_'+counter+'" id="" class="form-control" placeholder="Organization / Name" aria-describedby="helpId" /></div>
    <div class="form-group col-sm-5"><label for="'+'contact_type_id_'+counter+'" class="col-form-label">Contact Type</label><br><select name="'+'contact_type_id_'+counter+'" class="form-control col-sm-12"><?php foreach ($contacts as $contact) { ?><option value=<?php echo "\"" . $contact['id'] . "\""; ?>><?php echo $contact['contact_type']; ?></option><?php } ?></select></div>
    <div class="col-md-1 inputGroupContainer x"><span class="remove-btn input-group-addon "><i class="glyphicon glyphicon-remove rmvButton" data-target="#'+'contact_id_'+counter+'"></i></span></div>
</div>