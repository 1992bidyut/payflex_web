
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>ALL Client LIST SHOW </div>
                <div class="actions">
                    <a href="<?php echo base_url('user/createUser');?>" class="btn btn-default btn-sm">
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
                        <th> Name</th>
                        <th> Designation </th>
                        <th> Created Date </th>
                        <th>Clint Code</th>
                        <th>Status</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>

                   
                    <?php foreach($allClient as $client){ ?>
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                            <td> <?php echo $client['name'] ?> </td>
                            <td> <?php echo $client['client_type'] ?> </td>
                            <td> <?php echo $client['client_code'] ?> </td>
                            <td> <?php echo $client['client_code'] ?> </td>
                            <?php
                                if ($client['is_active']== '1'){  
                            ?>
                                <td><span class="badge badge-success" style="width: 100%;height: 22px;">Active</span>  </td>
                            <?php 
                                }else{
                            ?>
                                <td><span class="badge badge-danger" style="width: 100%;height: 22px;">InActive</span>  </td>
                            <?php 
                                }
                            ?>
                            <td >
                                <div class="clearfix">

                                    <a href="#" class="btn btn-sm yellow" style="margin-bottom: 5px;"> Edit
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a onclick="deleteData(<?php echo $client['id']?>)" href="#" data-toggle="tooltip" 
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
  function deleteData(id)
  {
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    },
    function(){
      $.ajax({
          echo : Hello,
          url: "<?php echo base_url('user/DeleteUser/') ?>",
          type: "post",
          data: {id:id},
          success:function(){
            swal('Data Deleted Successfully..', ' ', 'success');
            $("#delete"+id).fadeTo("slow", 0.7, function(){
              $(this).remove();
            })
          },
          error:function(){
            swal('Something Error Found..', 'error');
          }
      });
      
    });
  }
</script>