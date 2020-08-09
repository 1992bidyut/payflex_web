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
                    <label  class="col-md-4 control-label">Client Name </label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('routeName')?>" name="name" class="form-control" id=""  placeholder="Distributor Name Here">
                    </div>
                    <?php echo form_error('routeName',"<p class='text-danger'>","</p>")?>
                </div>

                
                <div class="form-group">
                    <label  class="col-md-4 control-label">Plant </label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('distributorPlant')?>" name="distributorPlant" class="form-control" id=""  placeholder="Distributor Plant here">
                    </div>
                    <?php echo form_error('distributorPlant',"<p class='text-danger'>","</p>");?>
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
                    <label  class="col-md-4 control-label">Officer </label>
                    <div class="col-md-8">
                        <input type="text" value="<?php echo set_value('Officer')?>" name="Officer" class="form-control" id=""  placeholder="Distributor's Officer here">
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