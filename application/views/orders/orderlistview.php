
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
<!--                <div class="actions">-->
<!--                    <a href="javascript:;" class="btn btn-default btn-sm">-->
<!--                        <i class="fa fa-download"></i> Export/Download </a>-->
<!--                </div>-->
            </div>
            <div class="portlet-body">
            <form id="table-form">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" />
                        </th>
                        <th> Client Code </th>
                        <th> Distributor Name </th>
                        <th> Manager</th>
                        <th> Officer</th>
                        <th> DSR</th>
                        <th> Order No.</th>
                        <th> Order Date </th>
                        <th> Plant </th>
                        <th> Product </th>
                        <th> Quantity </th>
                        <th> Order Amount </th>
                        <th> Is Paid </th>
                        <th> Indent no </th>
                        <th> Indent Remark </th>
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
                            <td> <?php echo $data['ClientCode'] ?>  </td>
                            <td> <?php echo $data['ClientName'] ?>  </td>
                            <td> <?php echo $data['manager'] ?>  </td>
                            <td> <?php echo $data['officer'] ?>  </td>
                            <td> <?php echo $data['dsr'] ?>  </td>
                            <td> <?php echo $data['OrderCode'] ?>  </td>
                            <td> <?php echo $data['DeliveryDate'] ?>  </td>
                            <td> <?php
                                if ($data['plantName']!=null){
                                    echo $data['plantName'];
                                } else{
                                    echo "";
                                }
                                ?>
                            </td>

                            <td><?php foreach ($productList as $product) {
                                    echo "" . $product['product_code'] . "</br>";
                                } ?></td>

                            <td><?php
                                $explodeValue1 = explode(";", $data['ProductQuantityString']);
                                foreach ($productList as $product) {
                                    $order = 0;
                                    for ($i = 0; $i < count($explodeValue1); $i++) {
                                        $explodeValue2 = explode("=", $explodeValue1[$i]);
                                        if ($product['product_code'] == $explodeValue2[0]) {
                                            $order = $explodeValue2[1];
                                        }
                                    }
                                    echo "" . $order . " </br>";
                                }
                                ?></td>
                            <td> <?php echo $data['total_costs'] ?>  </td>

                            <td style="background: <?php if ($data['PaymentStatus'] ==0) {
                                echo "yellow";
                            } else {
                                echo "#00d95a";
                            } ?>" > <?php if($data['PaymentStatus']==0){echo 'NO';}else{echo 'YES';} ?>  </td>


                            <td> <?php
                                if ($data['indent_no']!=null){
                                    echo $data['indent_no'];
                                } else{
                                    echo "";
                                }
                                ?>
                            </td>
                            <td> <?php echo $data['indent_remark'] ?>  </td>
                            <!-- ----------------------- the action buttons for payments -----------------  -->
                            <td >
                                <div class="clearfix">

                                    <a id="<?php echo "indent" . $data['orderId'] ?>"
                                       onclick="indentInput(<?php echo $data['orderId'] ?>)"
                                       class="btn btn-sm <?php if ($data['indent_no'] !=null) {
                                           echo "green-dark";
                                       } else {
                                           echo "yellow";
                                       } ?>" style="margin-bottom: 5px; width: 100%;" >
                                        <?php if ($data['indent_no'] !=null) {
                                            echo "Edit Indent";
                                        } else {
                                            echo "Indent";
                                        } ?>
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a id="<?php echo "replace" . $data['orderId'] ?>"
                                       onclick="enableEdit(<?php echo $data['orderId'] ?>,<?php echo $data['isEditable'] ?>)"
                                       class="btn btn-sm <?php if ($data['isEditable'] != 0) {
                                           echo "red";
                                       } else {
                                           echo "green-dark";
                                       } ?>" style="margin-bottom: 5px; width: 100%;" >
                                        <?php if ($data['isEditable'] == 0) {echo "Allow Edit";}else{echo "Disallow Edit";}?>
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
<!--                                    <a href="#" class="btn btn-sm green" style="margin-bottom: 5px;   width: 100%;"> Print-->
<!--                                        <i class="fa fa-print"></i>-->
<!--                                    </a>-->
<!--                                    <a href="#" onclick="return confirm('Are you sure you want to Grant the payment');" class="btn btn-sm red" style="margin-bottom: 5px; width: 100%;"> Notify-->
<!--                                        <i class="fa fa-envelope"></i>-->
<!--                                    </a>-->
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
<div class="scroll-buttons">
    <button id="slideLeft" class="btn" type="button"> ⬅️Scroll left</button>
    <button id="slideRight" class="btn" type="button">Scroll right ➡️</button>
</div>
<script type="text/javascript">

    function indentInput(id) {
        var indentNo = prompt("Please type the indent number:", "");
        if (indentNo == null || indentNo == "") {
            console.log("no input");
        } else {
            console.log(id);
            console.log(indentNo);
            $.ajax({
                url: "<?php echo base_url('OrderLists/indentUpdate') ?>",
                type: "POST",
                data: {id: id,indent_number: indentNo},
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
    }

    function enableEdit(id,flag) {
        console.log(id);
        var setFlag;
        if (flag==0){
            setFlag=1
        }else {
            setFlag=0;
        }
        $.ajax({
            url: "<?php echo base_url('OrderLists/editUpdate') ?>",
            type: "POST",
            data: {id: id,flag: setFlag},
            success: function (response) {
                console.log("AJAX Success Called!");
                $("#replace" + id).fadeTo("slow", 0.3, function () {
                    $(this).css('background-color', 'green-dark');
                })
            },
            error: function () {
                console.log("AJAX error Called!");
            }
        });
    }

    $('#slideRight').click(function (e) {
        e.preventDefault();
        $('.table-scrollable').animate({
            scrollLeft: "+=200px"
        }, "fast");
    });

    $('#slideLeft').click(function (e) {
        e.preventDefault();
        $('.table-scrollable').animate({
            scrollLeft: "-=200px"
        }, "fast");
    });

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