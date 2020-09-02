
<div class="row">
    <div class="col-md-12">

        <?php
        if($this->session->flashdata('success_msg')){
            ?>
            <div class="alert alert-success alert-dismissable" id="successMessage">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg');?>
            </div>

            <?php
        }
        ?>
        <?php
        if($this->session->flashdata('error_msg')){
            ?>
            <div class="alert alert-danger alert-dismissable" id="failedMessage">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error_msg');?>
            </div>

            <?php
        }
        ?>

<div class="portlet box blue ">

<?php
	 $myCIRef =& get_instance();
     $myCIRef->load->view('orders/oder_filter'); 
?>

</div>

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Order Lists </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm">
                        <i class="fa fa-download"></i> Export/Download </a>
                </div>
            </div>
            <div class="portlet-body">
			<form id="table-form">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" />
                        </th>
                        <th> OrderCode </th>
                        <th> DeliveryDate </th>
                        <th> PaymentStatus </th>
                        <th> ClientName </th>
                        <th> ClientCode </th>
                        <th> VirtualAccountNo </th>
                        <th> EmployeeName </th>
						<th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($paymentInfoArray>0): ?>
                    <?php
					
                        foreach($paymentInfoArray as $data){
                    ?>
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                            <td> <?php echo $data['OrderCode'] ?>  </td>
							<td> <?php echo $data['DeliveryDate'] ?>  </td>
							<td> <?php echo $data['PaymentStatus'] ?>  </td>
                            <td> <?php echo $data['ClientName'] ?>  </td>
							<td> <?php echo $data['ClientCode'] ?>  </td>
							<td> <?php echo $data['VirtualAccountNo'] ?>  </td>
							<td> <?php echo $data['EmployeeName'] ?>  </td>
							
							
							<!-- ----------------------- the action buttons for payments -----------------  -->
                            <td >
                                <div class="clearfix">

                                    <a href="#" class="btn btn-sm yellow" style="margin-bottom: 5px; width: 100%;"> Indent
                                        <i class="fa fa-edit"></i>
                                    </a>
									
									<a href="#" class="btn btn-sm green" style="margin-bottom: 5px;   width: 100%;"> Print
                                        <i class="fa fa-print"></i>
                                    </a>

                                    <a href="#" onclick="return confirm('Are you sure you want to Grant the payment');" class="btn btn-sm red" style="margin-bottom: 5px; width: 100%;"> Notify
                                        <i class="fa fa-envelope"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>

                    <?php  else: ?>
                        <!-- <h1>Hello </h1> -->
                    <?php endif ?>

                    </tbody>
                </table>
            </div>
        </div>




  <!-- END EXAMPLE TABLE PORTLET-->
        </form>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#action-btn').click(function(e){
            var table = $("#sample_3").dataTable();
            var id = [];
            $("input:checked", table.fnGetNodes()).each(function(i){

                console.log($(this).val());

                id.push($(this).val());

            });

            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url('SMSLog/ajax_delete'); ?>",
                data    : {id: id},
                success : function (response) {
//                        console.log(response);
                    location.reload();
                },
                error : function(error){
                    console.log(error);
                }
            });

            e.preventDefault();

        });


    });

</script>