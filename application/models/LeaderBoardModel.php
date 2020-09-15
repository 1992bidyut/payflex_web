<?php
class LeaderBoardModel extends CI_Model{

    public function searchPaymentInfo($fromDate,$todate)
	{
        $contact       = $this->input->get('contact');
        $from          = $this->input->get('from');
        $to            = $this->input->get('to');
        $message       = $this->input->get('smsBody');
        $smsStatusCode = $this->input->get('smsStatusCode');

		/*
        if($contact=='' and $from =='' and $to =='' and $message =='' and $smsStatusCode =='')
        {
            $this->db->like('entryDate', date('Y-m-d'),'after')
                ->where('cd_user_id',$id);
        }
        if($from !='' and $to !='')
        {
            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);
            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                ->where('schedule_time <=', $toScheduleDateAndTime)
                ->where('cd_user_id',$id);
        }

        if( $contact !='' )
        {
            $this->db->like('contact_text',$contact)
                ->where('cd_user_id',$id);
        }

        if( $message !='' )
        {
            $this->db->like('message',$message)
                ->where('cd_user_id',$id);
        }

        if($smsStatusCode !='')
        {
            $this->db->where('status_group_id',$smsStatusCode);
            $this->db->where('cd_user_id',$id);
        }
		*/

        $leaderSQL= "
        select * from (Select  
			client_info.id as clientId,
			client_info.client_code,
			client_info.name as clientName,
			label2.`name` AS manager,
			label3.`name` AS officer,
            label4.name as dsr,

            tbl_customer_order.id as orderID,

            tbl_payment.order_code, 
            tbl_payment.id as paymentID,
			tbl_payment.reference_no,
			tbl_payment.payment_date_time, 
			tbl_payment.submitted_date,
			tbl_payment.amount,
			tbl_payment.action_flag, 
			tbl_payment.indent_no,
			tbl_payment.collection_no,

			tbl_payment_image_relation.id as pirid, 
			tbl_image.id,
			tbl_image.image_name, 
			tbl_payment_mode.methode_name,
            tbl_financial_institution_list.bank_name,

            combainedOrderDetails.ProductQuantityString

            from tbl_payment
				
            left join tbl_customer_order on tbl_customer_order.order_code = tbl_payment.order_code
            left join client_info on tbl_customer_order.order_for_client_id = client_info.id
				
            left join employee_info as label4 on label4.id = tbl_customer_order.taker_id
			LEFT JOIN tbl_empolyees_relation as label4_relation ON label4.id=label4_relation.info_id

			LEFT JOIN tbl_empolyees_relation as label3_relation on label4_relation.parent_id=label3_relation.id
			LEFT JOIN employee_info AS label3 ON label3_relation.info_id=label3.id
			
			LEFT JOIN tbl_empolyees_relation as label2_relation on label3_relation.parent_id=label2_relation.id
			LEFT JOIN employee_info AS label2 ON label2_relation.info_id=label2.id

            left join tbl_payment_mode on tbl_payment_mode.id =  tbl_payment.payment_mode_id
            left join tbl_payment_image_relation on tbl_payment_image_relation.payment_id = tbl_payment.id
            left join tbl_image on tbl_payment_image_relation.image_id = tbl_image.id
            left join tbl_financial_institution_list on tbl_financial_institution_list.id = tbl_payment.financial_institution_id
            left join (
                SELECT customer_order_id, GROUP_CONCAT(product_code,  '=', quantityes SEPARATOR '; ') as ProductQuantityString FROM 
            (SELECT order_details.*, product_details.product_code FROM order_details
            left join product_details on order_details.product_id = product_details.id WHERE order_type='2') as orderwithPName 
            GROUP BY orderwithPName.customer_order_id) as combainedOrderDetails on combainedOrderDetails.
            customer_order_id =tbl_customer_order.id
            WHERE tbl_payment.submitted_date>= '".$fromDate
            ." 00:00:00' and tbl_payment.submitted_date <= '".$todate." 23:59:59') as myLeaderBoard 
            ORDER BY myLeaderBoard.submitted_date DESC";

       // $this->db->select($leaderSQL);
        $resource = $this->db->query($leaderSQL);
		// echo $this->db->last_query();
        // die();
        return $resource->result_array();
    }

//    public function getFinancierExportData($date){
//        $reportSQL= "SELECT
//            client_info.client_code,
//            client_info.name,
//            tbl_financial_institution_list.id,
//            tbl_financial_institution_list.bank_name,
//            tbl_payment_mode.id,
//            tbl_payment_mode.methode_name,
//            tbl_payment.amount,
//            tbl_payment.submitted_date
//            FROM tbl_payment
//            LEFT JOIN tbl_financial_institution_list ON tbl_financial_institution_list.id=tbl_payment.financial_institution_id
//            LEFT JOIN tbl_payment_mode ON tbl_payment_mode.id=tbl_payment.payment_mode_id
//            LEFT JOIN tbl_customer_order ON tbl_customer_order.order_code=tbl_payment.order_code
//            LEFT JOIN client_info ON client_info.id=tbl_customer_order.order_for_client_id
//
//            WHERE tbl_payment.submitted_date>='".$date." 00:00:00'";
//
//        $resource = $this->db->query($reportSQL);
//        // echo $this->db->last_query();
//        // die();
//        return $resource->result_array();
//
//    }
}


//		$leaderSQL = "select * from (Select  client_info.id as client_id,
//        client_info.name as clientName,
//        employee_info.name as EmployeeName,
//        tbl_payment.order_code,
//        tbl_customer_order.id as orderID,
//        tbl_payment.id as paymentID, tbl_payment_mode.methode_name,
//        tbl_financial_institution_list.bank_name,
//         tbl_payment.reference_no,tbl_payment.payment_date_time, tbl_payment.amount, tbl_payment.action_flag, tbl_image.image_name, tbl_payment_image_relation.id as pirid, tbl_image.id,
//        combainedOrderDetails.ProductQuantityString
//        from tbl_payment
//        left join tbl_customer_order on tbl_customer_order.order_code = tbl_payment.order_code
//        left join client_info on tbl_customer_order.order_for_client_id = client_info.id
//        left join employee_info on employee_info.id = tbl_customer_order.taker_id
//        left join tbl_payment_mode on tbl_payment_mode.id =  tbl_payment.payment_mode_id
//        left join tbl_payment_image_relation on tbl_payment_image_relation.payment_id = tbl_payment.id
//        left join tbl_image on tbl_payment_image_relation.image_id = tbl_image.id
//        left join tbl_financial_institution_list on tbl_financial_institution_list.id = tbl_payment.financial_institution_id
//        left join (
//            SELECT customer_order_id, GROUP_CONCAT(p_name,  '=', quantityes SEPARATOR ', ') as ProductQuantityString FROM
//        (SELECT order_details.*, product_details.p_name FROM order_details
//        left join product_details on order_details.product_id = product_details.id ) as orderwithPName
//        GROUP BY orderwithPName.customer_order_id) as combainedOrderDetails on combainedOrderDetails.
//        customer_order_id =tbl_customer_order.id) as myLeaderBoard
//        ";
?>