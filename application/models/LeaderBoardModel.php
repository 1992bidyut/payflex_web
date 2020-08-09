<?php
class LeaderBoardModel extends CI_Model{

    public function searchPaymentInfo()
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

		$leaderSQL = "select * from (Select  client_info.name as clientName,

employee_info.name as EmployeeName,

tbl_payment.order_code, 

tbl_customer_order.id as orderID,

tbl_payment.id as paymentID, tbl_payment_mode.methode_name,

tbl_financial_institution_list.bank_name,

 tbl_payment.reference_no,tbl_payment.payment_date_time, tbl_payment.amount, tbl_payment.action_flag, tbl_image.image_name, tbl_payment_image_relation.id as pirid, tbl_image.id,

combainedOrderDetails.ProductQuantityString

from tbl_payment

left join tbl_customer_order on tbl_customer_order.order_code = tbl_payment.order_code

left join client_info on tbl_customer_order.order_for_client_id = client_info.id


left join employee_info on employee_info.id = tbl_customer_order.taker_id


left join tbl_payment_mode on tbl_payment_mode.id =  tbl_payment.payment_mode_id


left join tbl_payment_image_relation on tbl_payment_image_relation.payment_id = tbl_payment.id

left join tbl_image on tbl_payment_image_relation.image_id = tbl_image.id


left join tbl_financial_institution_list on tbl_financial_institution_list.id = tbl_payment.financial_institution_id



left join (

    SELECT customer_order_id, GROUP_CONCAT(p_name,  '=', quantityes SEPARATOR ', ') as ProductQuantityString FROM 


(SELECT order_details.*, product_details.p_name FROM order_details

left join product_details on order_details.product_id = product_details.id ) as orderwithPName 

GROUP BY orderwithPName.customer_order_id) as combainedOrderDetails on combainedOrderDetails.

customer_order_id =tbl_customer_order.id) as myLeaderBoard
";
       // $this->db->select($leaderSQL);


        $resource = $this->db->query($leaderSQL);
		
		// echo $this->db->last_query();
        // die();


        return $resource->result_array();
    }
}	
?>