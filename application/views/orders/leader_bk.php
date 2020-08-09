
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

<div class="portlet-title">
    <div class="caption">
        Search/Filter Option(<?php echo @date('Y-M-d'); ?>)
    </div>

</div>
<div class="portlet-body  grey-cararra">
    <form action="<?php echo base_url('search/searchData');?>" method="post" id="" class="form-horizontal" role="form">

        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label  class="col-md-4 control-label">Distributor Name </label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('routeName')?>" name="name" class="form-control" id=""  placeholder="Distributor Name Here">
                    </div>
                    <?php echo form_error('routeName',"<p class='text-danger'>","</p>")?>
                </div>

                <div class="form-group">
                    <label  class="col-md-4 control-label">Distributor Zone </label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('descriptionZone')?>" name="distributorZone" class="form-control" id=""  placeholder="Distributor Zone here">
                    </div>
                    <?php echo form_error('routeDescription',"<p class='text-danger'>","</p>")?>
                </div>

                <div class="form-group">
                    <label  class="col-md-4 control-label">Distributor Plant </label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('distributorPlant')?>" name="distributorPlant" class="form-control" id=""  placeholder="Distributor Plant here">
                    </div>
                    <?php echo form_error('distributorPlant',"<p class='text-danger'>","</p>");?>
                </div>

                <div class="form-group">
                    <label  class="col-md-4 control-label">Distributor Bank</label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('distributorBank')?>" name="distributorBank" class="form-control" id=""  placeholder="Distributor Bank here">
                    </div>
                    <?php echo form_error('routeIdentity',"<p class='text-danger'>","</p>");?>
                </div>
            </div>

            <!-- end col-md-6 -->

            <div class="col-md-7">
                <div class="form-group">
                    <label  class="col-md-4 control-label">Order(Date Range) </label>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                <label  class="col-md-4 control-label">From </label>
                                    <div class="col-md-8">
                                        <input type="date" value="<?php echo set_value('orderFrom')?>" name="orderFrom" class="form-control" id="">
                                        </>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                <label  class="col-md-4 control-label">To </label>
                                    <div class="col-md-8">
                                        <input type="date" value="<?php echo set_value('orderTo')?>" name="orderTo" class="form-control" id="">
                                        </>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <?php echo form_error('routeName',"<p class='text-danger'>","</p>")?>
                </div>

                <div class="form-group">
                    <label  class="col-md-4 control-label">Payment(Date Range) </label>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                <label  class="col-md-4 control-label">From </label>
                                    <div class="col-md-8">
                                        <input type="date" value="<?php echo set_value('paymentFrom')?>" name="paymentFrom" class="form-control" id="">
                                        </>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                <label  class="col-md-4 control-label">To </label>
                                    <div class="col-md-8">
                                        <input type="date" value="<?php echo set_value('paymentTo')?>" name="paymentTo" class="form-control" id="">
                                        </>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <?php echo form_error('routeName',"<p class='text-danger'>","</p>")?>
                </div>

                <div class="form-group">
                    <label  class="col-md-4 control-label">Manager </label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('manager')?>" name="manager" class="form-control" id=""  placeholder="Distributor Manager here">
                    </div>
                    <?php echo form_error('routeIdentity',"<p class='text-danger'>","</p>");?>
                </div>
            </div>
        </div>



        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button type="submit" class="btn blue">Search</button>
            </div>
        </div>

    </form>

</div>

</div>

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Leaderboard (Payment) </div>
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
                        <th> clientName </th>
                        <th> EmployeeName </th>
                        <th> Order Code </th>
                        <th> orderID </th>
                        <th> paymentID </th>
                        <th> methode_name </th>
                        <th> bank_name </th>
						<th> reference_no </th>
						<th> payment_date_time </th>
						<th> amount </th>
						<th> action_flag </th>
						<th> image_name </th>
						<th> pirid </th>
						<th> ProductQuantityString </th>
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
                            <td> <?php echo $data['clientName'] ?>  </td>
							<td> <?php echo $data['EmployeeName'] ?>  </td>
							<td> <?php echo $data['order_code'] ?>  </td>
                            <td> <?php echo $data['orderID'] ?>  </td>
							<td> <?php echo $data['paymentID'] ?>  </td>
							<td> <?php echo $data['methode_name'] ?>  </td>
							<td> <?php echo $data['bank_name'] ?>  </td>
							<td> <?php echo $data['reference_no'] ?>  </td>
							<td> <?php echo $data['payment_date_time'] ?>  </td>
							<td> <?php echo $data['amount'] ?>  </td>
							<td> <?php echo $data['action_flag'] ?>  </td>
							<td> 
							<?php //echo $data['image_name'] 
								if(!empty($data['image_name']))
								{
									$imageName =$data['image_name'];
									$imagePath = 'https://demo.onuserver.com/payFlex/asset/images/abir.client@total.com/';
									$imagePath .= $imageName;
									echo '<img style="width: 100%; hight:10px;" src="'.$imagePath.'" alt="'.$imageName.'">';
								}
								else
								{
									echo "No image Attached";
								}
							
							
							?>  </td>
							<td> <?php echo $data['pirid'] ?>  </td>
							<td> <?php echo $data['ProductQuantityString'] ?>  </td>
							
							<!-- ----------------------- the action buttons for payments -----------------  -->
                            <td >
                                <div class="clearfix">

                                    <a href="#" class="btn btn-sm yellow" style="margin-bottom: 5px; width: 100%;"> Indent
                                        <i class="fa fa-edit"></i>
                                    </a>
									
									<a href="#" class="btn btn-sm green" style="margin-bottom: 5px;   width: 100%;"> Print
                                        <i class="fa fa-print"></i>
                                    </a>

                                    <a href="#" onclick="return confirm('Are you sure you want to Grant the payment');" class="btn btn-sm red" style="margin-bottom: 5px; width: 100%;"> Grant/Accept
                                        <i class="fa fa-check"></i>
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