<div class="row widget-row">
    
    
    <?php
    
        function addWtView( $wtID, $wtTitle, $wtSubTitle, $wtBGColor,$wtIcon,$wtHREF)
        {
            $myCIRef =& get_instance();
            $myCIRef->load->view('dashboard/widgetThumb', array( 'wtID'=>$wtID, 'wtTitle'=>$wtTitle, 'wtSubTitle'=>$wtSubTitle, 'wtBGColor'=>$wtBGColor,'wtIcon'=>$wtIcon,'wtHREF'=>$wtHREF));
        };
        //--------------------------------  TODAY'S Order count  -------------------------------->    
        addWtView("OrderCountBox","TODAY's Order","Count","bg-yellow","icon-anchor","Dashboard/orderDetailsTable/");
//        $this->load->view('dashboard/widgetThumb', array( 'wtID'=>"OrderCountBox", 'wtTitle'=>"TODAY's Order", 'wtSubTitle'=>"Count", 'wtBGColor'=>"bg-yellow",'wtIcon'=>"icon-plus",'wtHREF'=>"Dashboard/orderDetailsTable/"));
        //--------------------------------  TODAY'S Payment Counts  -----------------------------his->
        addWtView("PaymentCountBox","TODAY'S Payment","Count","bg-blue","icon-trophy","Dashboard/orderDetailsTable/");
        //---------------- Payment Validated Count ---------------->>
        addWtView("PaymentValidatedCountBox","Today's Payment","Validated","bg-green","icon-check","Dashboard/orderDetailsTable/");
        //----------------------------Payment Amount Total---->>
        addWtView("PaymentAmountTotalBox","Today's Payment","Total","bg-blue","icon-wallet","Dashboard/orderDetailsTable/");
        //----------------------------Payment Target Amount---->>
        addWtView("PaymentTargetAmountBox","Today's Target","Amount","bg-red","icon-target","Dashboard/orderDetailsTable/");
        

    ?>

<script>

    function setValFromAjaxToDiv(theDivName, controllerToBeCalled, urlQueryString)
    {
        ourBaseURL = '<?php echo base_url();?>';
        urlToBeCalled  = ourBaseURL + controllerToBeCalled + urlQueryString;
        
        $.ajax(urlToBeCalled , {
            success: function(data) {
                $(theDivName).html(data);
            },
            error: function() {

            }
        });    
    }
    
    $( document ).ready(function()
    {

        startDate = "2020-05-02";
        endDate = "2020-07-30";
        urlQueryString = startDate+"/"+endDate;
        
        setValFromAjaxToDiv("#OrderCountBox", "dashboard/orderCounts/", urlQueryString );
		setValFromAjaxToDiv("#PaymentCountBox", "dashboard/paymentCounts/", urlQueryString );
		setValFromAjaxToDiv("#PaymentValidatedCountBox", "dashboard/validatedPaymentCounts/", urlQueryString );
		setValFromAjaxToDiv("#PaymentAmountTotalBox", "dashboard/paymentCounts/", urlQueryString );
		setValFromAjaxToDiv("#PaymentTargetAmountBox", "dashboard/paymentCounts/", urlQueryString );
    });
</script>
