<div class="row">
    <div class="col-md-12">

        <?php
        if ($this->session->flashdata('success_msg')) {
            ?>
            <div class="alert alert-success alert-dismissable" id="successMessage">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg'); ?>
            </div>

            <?php
        }
        ?>
        <?php
        if ($this->session->flashdata('error_msg')) {
            ?>
            <div class="alert alert-danger alert-dismissable" id="failedMessage">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error_msg'); ?>
            </div>

            <?php
        }
        ?>

        <div class="portlet box blue ">

            <?php
            $myCIRef =& get_instance();
            $myCIRef->load->view('leader/leader_filter');
            ?>
            <div w3-include-html="leader_filter.php"></div>

        </div>

        <div class="portlet box" style="background-color: #F8981C">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Leaderboard (Payment)
                </div>
                <div class="actions">
                    <a href="<?php echo base_url('LeaderBoard/exportLeaderBoardData') ?>"
                       class="btn btn-default btn-sm">
                        <i class="fa fa-download"></i> Export/Download </a>
                </div>
            </div>
            <div class="portlet-body">
                <form id="table-form">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sample_4">
                        <thead>
                        <tr>
                            <th class="table-checkbox">
                                <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
                            </th>
                            <th> Client Code</th>
                            <th> Distributor Name</th>
                            <th> Manager</th>
                            <th> Officer</th>
                            <th> DSR</th>
                            <th> Product</th>
                            <th> Quantity</th>
                            <th> Order No.</th>
                            <th> Order Date</th>
                            <th> PaymentID</th>
                            <th> Payment Mode</th>
                            <th> Bank name</th>
                            <th> Reference no</th>
                            <th> Payment date</th>
                            <th> Submitted date time</th>
                            <th> Amount</th>
                            <th> Indent No</th>
                            <th> Indent Remark</th>
                            <th> Collection No</th>
                            <th> Collection Remark</th>
                            <th> Image/Attachment</th>
                            <th> Replace</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($paymentInfoArray > 0): ?>
                            <?php
                            foreach ($paymentInfoArray as $data) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><input type="checkbox" class="checkboxes" value="1"/></td>
                                    <td> <?php echo $data['client_code'] ?>  </td>
                                    <td> <?php echo $data['clientName'] ?>  </td>
                                    <td> <?php echo $data['manager'] ?>  </td>
                                    <td> <?php echo $data['officer'] ?>  </td>
                                    <td> <?php echo $data['dsr'] ?>  </td>

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
                                    <td> <?php echo $data['order_code'] ?>  </td>
                                    <td> <?php echo $data['delivery_date'] ?>  </td>
                                    <td> <?php echo $data['paymentID'] ?>  </td>
                                    <td> <?php echo $data['methode_name'] ?>  </td>
                                    <td> <?php echo $data['bank_name'] ?>  </td>
                                    <td> <?php echo $data['reference_no'] ?>  </td>
                                    <td> <?php echo $data['payment_date_time'] ?>  </td>
                                    <td> <?php echo $data['submitted_date'] ?>  </td>
                                    <td> <?php echo $data['amount'] ?>  </td>
                                    <td> <?php
                                        if ($data['indent_no']!=null){
                                            echo $data['indent_no'];
                                        } else{
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                    <td> <?php echo $data['indent_remark'] ?>  </td>
                                    <td> <?php
                                        if ($data['collection_no']!=null){
                                            echo $data['collection_no'];
                                        } else{
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                    <td> <?php echo $data['collection_remark'] ?>  </td>
                                    <td>
                                        <?php //echo $data['image_name']
                                        if (!empty($data['image_name'])) {
                                            $localImgageBasePath = "http://localhost/payflex/asset/images/";
                                            $remorteImageBasePath = "http://demo.onuserver.com/payFlex/asset/images/payment/";
                                            $liveImageBasePath = "https://payflex.onukit.com/total/asset/images/payment/";

                                            $imageName = $data['image_name'];
                                            $imagePath = $remorteImageBasePath . $data['clientId'] . "/";
                                            $imagePath .= $imageName;
                                            echo '<img style="width: 100%; hight:10px;" src="' . $imagePath . '" alt="' . $imageName . '">';
                                        } else {
                                            echo "No image Attached";
                                        }
                                        ?>  </td>

                                    <!--                                    replace tag-->
                                    <td> <?php
                                        if ($data['replace_tag']!=null){
                                            echo $data['replace_tag'];
                                        } else{
                                            echo "";
                                        }
                                        ?>
                                    </td>

                                    <!-- ----------------------- the action buttons for payments -----------------  -->
                                    <td>
                                        <div class="clearfix">

                                            <a id="<?php echo "indent" . $data['orderID'] ?>"
                                               onclick="indentInput(<?php echo $data['orderID'] ?>)"
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

                                            <a id="<?php echo "collection" . $data['paymentID'] ?>"
                                               onclick="collectionInput(<?php echo $data['paymentID'] ?>)"
                                               class="btn btn-sm <?php if ($data['collection_no'] != null) {
                                                   echo "green-dark";
                                               } else {
                                                   echo "blue";
                                               } ?>" style="margin-bottom: 5px; width: 100%;" >
                                                <?php if ($data['collection_no'] != null) {
                                                    echo "Edit Collection";
                                                } else {
                                                    echo "Collection";
                                                } ?>
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a id="<?php echo "replace" . $data['paymentID'] ?>"
                                               onclick="replaceInput(<?php echo $data['paymentID'] ?>,<?php echo $data['isEditable'] ?>)"
                                               class="btn btn-sm <?php if ($data['isEditable'] != 0) {
                                                   echo "red";
                                               } else {
                                                   echo "green-dark";
                                               } ?>" style="margin-bottom: 5px; width: 100%;" >
                                                <?php if ($data['isEditable'] == 0) {echo "Allow Edit";}else{echo "Disallow Edit";}?>
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="<?php echo base_url('Payment/paymentdetail/' . $data['order_code']) ?>"
                                               target="_blank" class="btn btn-sm green"
                                               style="margin-bottom: 5px;   width: 100%;"> Print
                                                <i class="fa fa-print"></i>
                                            </a>

                                            <a id="<?php echo "accepted" . $data['paymentID'] ?>"
                                               onclick="acceptPayment(<?php echo $data['paymentID'] ?>)"
                                               class="btn btn-sm <?php if ($data['action_flag'] == 1 || $data['action_flag'] == 2 || $data['action_flag'] == 3) {
                                                   echo "green-dark";
                                               } else {
                                                   echo "red";
                                               } ?>" style="margin-bottom: 5px; width: 100%;"> Grant/Accept
                                                <i class="fa fa-check"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        <?php else: ?>
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
    //    Accept payment

    document.getElementsByName('sample_3_length').value = "-1";

    function acceptPayment(id) {
        console.log("Accept Click! " + id);
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

    function replaceInput(id,flag) {
            console.log(id);
            var setFlag;
            if (flag==0){
                setFlag=1
            }else {
                setFlag=0;
            }
            $.ajax({
                url: "<?php echo base_url('payment/replaceUpdate') ?>",
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
    function collectionInput(id) {
        var collectionNo = prompt("Please type the collection number:", "");
        if (collectionNo == null || collectionNo == "") {
            console.log("no input");
        } else {
            console.log(id);
            console.log(collectionNo);
            $.ajax({
                url: "<?php echo base_url('payment/collectionUpdate') ?>",
                type: "POST",
                data: {id: id,collection_number: collectionNo},
                success: function (response) {
                    console.log("AJAX Success Called!");
                    $("#collection" + id).fadeTo("slow", 0.3, function () {
                        $(this).css('background-color', 'green-dark');
                    })
                },
                error: function () {
                    console.log("AJAX error Called!");
                }
            });
        }
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

</script>
