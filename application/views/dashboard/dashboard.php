<div class="row widget-row">
    
    
    <?php
    
        function addWtView( $wtID, $wtTitle, $wtSubTitle, $wtBGColor,$wtIcon,$wtHREF)
        {
            $myCIRef =& get_instance();
            $myCIRef->load->view('dashboard/widgetThumb', array( 'wtID'=>$wtID, 'wtTitle'=>$wtTitle, 'wtSubTitle'=>$wtSubTitle, 'wtBGColor'=>$wtBGColor,'wtIcon'=>$wtIcon,'wtHREF'=>$wtHREF));
        };
        //--------------------------------  TODAY'S Order count  -------------------------------->    
        addWtView("OrderCountBox","TODAY's Order","Count","#F8981C","icon-anchor","Dashboard/orderDetailsTable/");
//        $this->load->view('dashboard/widgetThumb', array( 'wtID'=>"OrderCountBox", 'wtTitle'=>"TODAY's Order", 'wtSubTitle'=>"Count", 'wtBGColor'=>"bg-yellow",'wtIcon'=>"icon-plus",'wtHREF'=>"Dashboard/orderDetailsTable/"));
        //--------------------------------  TODAY'S Payment Counts  -----------------------------his->
        addWtView("PaymentCountBox","TODAY'S Payment","Count","#0C4DA2","icon-trophy","Dashboard/orderDetailsTable/");
        //---------------- Payment Validated Count ---------------->>
        addWtView("PaymentValidatedCountBox","Today's Granted Payment","Granted","#4295D1","icon-check","Dashboard/orderDetailsTable/");
        //----------------------------Payment Amount Total---->>
        addWtView("PaymentAmountTotalBox","Today's Payment Amount","Total","#E30033","icon-wallet","Dashboard/orderDetailsTable/");
        //----------------------------Payment Target Amount---->>
        addWtView("PaymentTargetAmountBox","Today's Target Amount","Amount","#4C4D4F","icon-target","Dashboard/orderDetailsTable/");


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
        var today = new Date();
        startDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        endDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        urlQueryString = startDate+"/"+endDate;
        
        setValFromAjaxToDiv("#OrderCountBox", "dashboard/orderCounts/", urlQueryString );
		setValFromAjaxToDiv("#PaymentCountBox", "dashboard/paymentCounts/", urlQueryString );
		setValFromAjaxToDiv("#PaymentValidatedCountBox", "dashboard/validatedPaymentCounts/", urlQueryString );
		setValFromAjaxToDiv("#PaymentAmountTotalBox", "dashboard/todayPayment/", urlQueryString );
		setValFromAjaxToDiv("#PaymentTargetAmountBox", "dashboard/targetPayment/", urlQueryString );
    });
</script>
