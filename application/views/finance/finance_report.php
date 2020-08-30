
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
     $myCIRef->load->view('finance/finance_filter');
?>
<div w3-include-html="leader_filter.php"></div>

</div>

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Finance Report </div>
                <div class="actions">
                    <a href="<?php echo base_url('FinanceReport/exportFinanceData')?>" class="btn btn-default btn-sm">
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
                        <th> INDENT DATE </th>
                        <th> CODE </th>
                        <th> DISTRIBUTOR NAME </th>
                        <th> BANK DETAILS </th>
                        <th>  </th>
                        <th> AMOUNT </th>
                        <th> PAYMENT DATE </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($financeData>0): ?>
                    <?php
                        foreach($financeData as $data){
                    ?>
                        <tr class="odd gradeX">
                            <td><input type="checkbox" class="checkboxes" value="1" /></td>
                            <td> <?php if ($data['indent_date']!=null){echo $data['indent_date'];}else{echo "";} ?>  </td>
                            <td> <?php echo $data['client_code'] ?>  </td>
                            <td> <?php echo $data['name'] ?>  </td>
                            <td> <?php echo $data['bank_name']."-".$data['methode_name']?>  </td>
							<td> <?php echo $data['bank_name']."-".$data['methode_name']
                                    ."/".$data['submitted_date']."/".$data['client_code']."/".$data['amount'];
                                $temp['AMOUNT']=$data['amount'] ?>  </td>
                            <td> <?php echo $data['amount'] ?>  </td>
							<td> <?php echo $data['submitted_date'] ?>  </td>

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
//    Accept payment
    function acceptPayment(id) {
        console.log("Accept Click! "+id);
        $.ajax({
            url: "<?php echo base_url('payment/paymentAccept') ?>",
            type: "POST",
            data: {id: id},
            success: function (response) {
                console.log("AJAX Success Called!");
                $("#accepted" + id).fadeTo("slow", 0.3, function () {
                    $(this).css('background-color', 'green-dark');
                })
            },
            error: function () {
                console.log("AJAX error Called!");
            }
        });
    }

function indent(id) {
    console.log("Indent Click! "+id);
    $.ajax({
        url: "<?php echo base_url('payment/indent') ?>",
        type: "POST",
        data: {id: id},
        success: function (response) {
            console.log("AJAX Success Called!");
            $("#indent" + id).fadeTo("slow", 0.3, function () {
                $(this).css('background-color', 'green-dark');
            })
        },
        error: function () {
            console.log("AJAX error Called!");
        }
    });
}

//    $(document).ready(function () {
//
//        $('#action-btn').click(function(e){
//            var table = $("#sample_3").dataTable();
//            var id = [];
//            $("input:checked", table.fnGetNodes()).each(function(i){
//
//                console.log($(this).val());
//
//                id.push($(this).val());
//
//            });
//
//            $.ajax({
//                type    : "POST",
//                url     : "<?php //echo base_url('SMSLog/ajax_delete'); ?>//",
//                data    : {id: id},
//                success : function (response) {
////                        console.log(response);
//                    location.reload();
//                },
//                error : function(error){
//                    console.log(error);
//                }
//            });
//
//            e.preventDefault();
//
//        });
//
//
//    });

</script>