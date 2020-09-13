<?php
class OrdersModel extends CI_Model{

    public function getOrdersList($startDate,$endDate)
	{
		
        $contact       = $this->input->get('contact');
        $from          = $this->input->get('from');
        $to            = $this->input->get('to');
        $message       = $this->input->get('smsBody');
        $smsStatusCode = $this->input->get('smsStatusCode');
	
		$leaderSQL = "select * from (SELECT 
            tbl_customer_order.order_code as OrderCode,
            tbl_customer_order.delivery_date as DeliveryDate,
            tbl_customer_order.payment_status as PaymentStatus,
            client_info.name as ClientName,
            client_info.client_code as ClientCode,
            client_info.virtual_account_no as VirtualAccountNo,
            employee_info.name as EmployeeName
            FROM `tbl_customer_order`
            left join client_info on  tbl_customer_order.taker_id =client_info.id
            left join tbl_empolyees_relation on tbl_customer_order.taker_id = tbl_empolyees_relation.info_id
            left join employee_info on tbl_empolyees_relation.info_id = employee_info.id
            where tbl_customer_order.delivery_date >= '".$startDate."' and tbl_customer_order.delivery_date <= '".$endDate."'
            ) as myOderList";
//
       // $this->db->select($leaderSQL);
        $resource = $this->db->query($leaderSQL);
		// echo $this->db->last_query();
        // die();
        return $resource->result_array();
    }
}	
?>