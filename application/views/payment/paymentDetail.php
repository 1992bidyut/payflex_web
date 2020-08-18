<!-- //TODO: complete the table -->


<div class="table-container">
    <!--    1st row-->
    <div class="header-container border" style="">

        <!--    first row-->
        <div style="float: left">
            <div class="logo" style="">
                <img src="https://d1yjjnpx0p53s8.cloudfront.net/styles/logo-thumbnail/s3/0008/1528/brand.gif?itok=RXwTVv65"
                     width="200px"
                     height="200px" class="img-responsive"
                     alt="">
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
            <table
                    border="1"
                    class="table table-bordered"
                    width="100%"
                    height="100%"
            >
                <tr>
                    <td>Distributor Name:</td>
                    <td>Alam Enterprise</td>
                </tr>
                <tr>
                    <td>Contact Person:</td>
                    <td>Md Shahin Fakir</td>
                </tr>
                <tr>
                    <td>Plant:</td>
                    <td>Taltola, Dhaka</td>
                </tr>
                <tr>
                    <td>Delivery Location:</td>
                    <td>Keranigonj, Dhaka</td>
                </tr>
                <tr>
                    <td>Mobile:</td>
                    <td>,01711233457</td>
                </tr>
            </table>
        </div>
        <div class="receiver-table">
            <table
                    border="1"
                    class="table table-bordered"
                    width="100%"
                    height="100%"
            >
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
                    <td><?php echo $paymentDetail['order_code'];?></td>
                </tr>
                <tr>
                    <td>Customer Code:</td>
                    <td>104749</td>
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
                <td>Sl.<br/>No.</td>
                <td>Item Description</td>
                <td>Product<br/>Code</td>
                <td>Unit</td>
                <td>Quantity</td>
                <td>Total Value</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">Total Order Value in Word:</td>
                <td>195,000.00</td>
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
            <tr>
                <td>1</td>
                <td>Check</td>
                <td>IBBL</td>
                <td>62050</td>
                <td>05.02.2020</td>
                <td>195,000.00</td>
            </tr>
            <tr>
                <td colspan="6">
                    <img
                            class="img-responsive"
                            src="https://www.nwcu.com/storage/app/media/Check-Image-Example.jpg"
                            alt="IMAGE"
                    />
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Payorder</td>
                <td>UBL</td>
                <td>1234</td>
                <td>05.02.2020</td>
                <td>195,000.00</td>
            </tr>
            <tr>
                <td colspan="6">
                    <img
                            class="img-responsive"
                            src="https://www.nwcu.com/storage/app/media/Check-Image-Example.jpg"
                            alt="IMAGE"
                    />
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-left">Total Order Value in Word:</td>
                <td>200,000.00</td>
            </tr>
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