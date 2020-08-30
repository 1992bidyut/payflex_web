<!-- //TODO: complete the table -->


<div class="table-container">
    <!--    1st row-->
    <div class="header-container border">
        <?php //echo print_r($paymentDetail)
        ?>
        <!--    first row-->
        <div style="float: left">
            <div class="logo">
                <img src="https://d1yjjnpx0p53s8.cloudfront.net/styles/logo-thumbnail/s3/0008/1528/brand.gif?itok=RXwTVv65" width="200px" height="200px" class="img-responsive" alt="">
            </div>
            <div class="header-address">
                <h3 class="text-center">Premier LP Gas LTD.</h3>
                <p class="text-center">
                    The Glass House, Level-2, Plot No.- 02, Block-SE (B)
                </p>
                <p class="text-center">Gulshan 01, Dhaka 1212, Bangladesh</p>
                <p class="text-center">
                    Tel: (880) 2 9841936 & 38; Fax: +88-02-9858677
                </p>
            </div>
        </div>
    </div>

    <!--    2nd row-->
    <br>
    <div class="distributor-receiver-table">
        <div class="distributor-table">
            <table border="1" class="table table-bordered" width="100%" height="100%">
                <tr>
                    <td>Distributor Name:</td>
                    <td><?php echo $clientInfo['name'] ?></td>
                </tr>
                <tr>
                    <td>Contact Person:</td>
                    <td><?php if ($clientInfo['representative_name'] != null) {
                            echo $clientInfo['representative_name'];
                        } else {
                            echo "";
                        } ?></td>
                </tr>
                <tr>
                    <td>Plant:</td>
                    <td><?php echo $orderDetail[0]['plant'] ?></td>
                </tr>
                <tr>
                    <td>Delivery Location:</td>
                    <td>
                        <?php
                        foreach ($clientContact as $contact) {
                            if ($contact['type_id'] == 4) {
                                echo $contact['contact_value'];
                            } else {
                                echo "";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Mobile:</td>
                    <td>
                        <?php
                        foreach ($clientContact as $contact) {
                            if ($contact['type_id'] == 1) {
                                echo $contact['contact_value'];
                            } else {
                                echo "";
                            }
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="receiver-table">
            <table border="1" class="table table-bordered" width="100%" height="100%">
                <tr>
                    <td>Recieved Date:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Serial No.</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Order No:</td>
                    <td><?php echo $orderDetail[0]['order_code']; ?></td>
                </tr>
                <tr>
                    <td>Customer Code:</td>
                    <td><?php echo $clientInfo['client_code']; ?></td>
                </tr>
                <tr>
                    <td>Collection Doc Ref:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Other Ref & Amount:</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

    <!--    3rd row-->
    <br>
    <div class="order-detail">
        <table border="1" class="table table-bordered" width="100%" height="100%">
            <thead>
                <tr>
                    <td colspan="6">
                        <h4>Order Details:</h4>
                    </td>
                </tr>
                <tr>
                    <td>Sl.<br />No.</td>
                    <td>Item Description</td>
                    <td>Product<br />Code</td>
                    <td>Unit</td>
                    <td>Quantity</td>
                    <td>Total Value</td>
                </tr>
            </thead>
            <tbody>

                <?php
                $detailCount = 1;
                $totalAmount = 0;
                foreach ($orderDetail as $detail) {
                    echo "<tr><td>" . $detailCount . "</td>";
                    echo "<td>" . $detail['p_name'] . "</td>";
                    echo "<td>" . $detail['product_code'] . "</td>";
                    echo "<td>" . $detail['p_wholesalePrice'] . "</td>";
                    echo "<td>" . $detail['quantityes'] . "</td>";
                    echo "<td>" . $detail['ordered_amount'] . "</td></tr>";
                    $totalAmount += $detail['ordered_amount'];
                    $detailCount++;
                }
                ?>

                <tr>
                    <td colspan="5" class="text-right">Total Order Value in Word:</td>
                    <td><?php echo $totalAmount; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!--    4th row-->
    <br>
    <div class="payment-info">
        <table border="1" class="table table-bordered" width="100%" height="100%">
            <thead>
                <tr>
                    <td>Sl. No.</td>
                    <td>Mode</td>
                    <td>Name of Bank</td>
                    <td>Reference No.</td>
                    <td>Date</td>
                    <td>Amount</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $paymentCount = 1;
                foreach ($paymentDetail as $payment) {
                    echo "<tr><td>" . $paymentCount . "</td>";
                    echo "<td>" . $payment['payment_mode_id'] . "</td>";
                    echo "<td>" . $payment['financial_institution_id'] . "</td>";
                    echo "<td>" . $payment['reference_no'] . "</td>";
                    echo "<td>" . $payment['payment_date_time'] . "</td>";
                    echo "<td>" . $payment['amount'] . "</td></tr>";
                    $paymentCount++;
                    $imagePath = "";
                    if (!empty($payment['image_name'])) {
                        $localImgageBasePath = "http://localhost/payflex/asset/images/";
                        $localImgageBasePath2 = "http://localhost/asset/images/";
                        $remorteImageBasePath = "http://demo.onuserver.com/payFlex/asset/images/";
                        $imageName = $payment['image_name'];
                        $imagePath = $localImgageBasePath . $clientInfo['client_id'] . "/";
                        $imagePath .= $imageName;
                    } ?>
                    <tr>
                        <td colspan="6">
                            <!--                    <img class="img-responsive" alt="IMAGE" height="20%"-->
                            <img alt="IMAGE" id="paymentProof" height="150px" src="<?php echo $imagePath; ?>" />
                        </td>
                    </tr>
                <?php   }
                ?>

            </tbody>
        </table>
    </div>

    <!--    5th row-->
    <br>
    <div class="distributor-signature-stamp">
        <table border="1" class="table table-bordered" width="100%" height="100%">
            <thead>
                <tr>
                    <td>Distributor Signature & Stamp</td>
                    <td>For PLPG Use Only</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2"></td>
                    <td>Indent No.</td>
                </tr>

                <tr>
                    <td class="text-left" rowspan="2"></td>
                </tr>
                <tr></tr>
                <tr>
                    <td class="text-left">Date:</td>
                    <td class="text-left">Date:</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="distributor-signature-stamp">
    <a id="" onclick="print()"
       class="btn btn-sm green-dark " style="margin-bottom: 5px; width: 100%;"> Print
        <i class="fa fa-check"></i>
    </a>
</div>
<script>
    var x = document.getElementById("paymentProof").width;
    var y = document.getElementById("paymentProof").height;

    if (y > x) {
        var img = document.getElementById('paymentProof');
        img.style.transform = 'rotate(90deg)';
    }
</script>