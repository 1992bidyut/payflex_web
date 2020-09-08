
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>SHOW ALL USER </div>
                    <div class="actions">
                        <a href="<?php echo site_url('user/createUser');?>" class="btn btn-default btn-sm">
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
                            <th> User Name </th>
                            <th> Create Time </th>
                            <th> User Type </th>
                            <!---<th> SMS Status</th>-->
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach($users as $user){
                        ?>

                            <tr class="odd gradeX">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td> <?php echo $user['username'];?> </td>
                                <td><?php echo $user['created_time'];?></td>
								<td> <?php echo $user['type'];?> </td>
                                <td >
                                    <div class="clearfix">

                                        <a href="#" class="btn btn-sm yellow" style="margin-bottom: 5px;"> Edit
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- <a href="#" onclick="deleteData(<?php echo $user['id']?>)" class="btn btn-sm red" style="margin-bottom: 5px;"> Delete
                                            <i class="fa fa-trash"></i>
                                        </a> -->
                                        <a onclick="deleteData(<?php echo $user['id']?>)" href="#" data-toggle="tooltip" 
                                        data-placement="bottom" title="Hapus Mahasiswa" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> Delete</a>
                                       

                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
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




if(Session::has('success'))
    <script type="text/javascript">
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
        })
    </script>
endif

if(Session::has('error'))
    <script type="text/javascript">
        swal({
            type: 'error',
            title: '{{Session::get("error")}}',
            showConfirmButton: true
        })
    </script>
endif