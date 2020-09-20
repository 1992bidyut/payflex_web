<?php
class OrdersModel extends CI_Model{

    public function getOrdersList($startDate,$endDate)
	{
		
        $contact       = $this->input->get('contact');
        $from          = $this->input->get('from');
        $to            = $this->input->get('to');
        $message       = $this->input->get('smsBody');
        $smsStatusCode = $this->input->get('smsStatusCode');
	
		$leaderSQL = "
            select * from (
                SELECT 
                
                client_info.client_code as ClientCode,
                client_info.name as ClientName,
                label2.`name` AS manager,
			    label3.`name` AS officer,
                label4.name as dsr,
                
                tbl_customer_order.id as orderId,
                tbl_customer_order.order_code as OrderCode,
                tbl_customer_order.delivery_date as DeliveryDate,
                tbl_customer_order.payment_status as PaymentStatus,
                tbl_customer_order.indent_no,
                tbl_customer_order.total_costs,
                
                
                client_info.virtual_account_no as VirtualAccountNo,
                employee_info.name as EmployeeName,
                combainedOrderDetails.ProductQuantityString as ProductQuantityString
                
                FROM `tbl_customer_order`
                
                left join client_info on tbl_customer_order.order_for_client_id = client_info.id
                left join tbl_client_employee_relation on tbl_client_employee_relation.client_id = client_info.id
				
                left join employee_info as label4 on label4.id = tbl_client_employee_relation.handler_id
			    LEFT JOIN tbl_empolyees_relation as label4_relation ON label4.id=label4_relation.info_id

			    LEFT JOIN tbl_empolyees_relation as label3_relation on label4_relation.parent_id=label3_relation.id
			    LEFT JOIN employee_info AS label3 ON label3_relation.info_id=label3.id
			
			    LEFT JOIN tbl_empolyees_relation as label2_relation on label3_relation.parent_id=label2_relation.id
			    LEFT JOIN employee_info AS label2 ON label2_relation.info_id=label2.id
			
                left join tbl_empolyees_relation on tbl_customer_order.taker_id = tbl_empolyees_relation.info_id
                left join employee_info on tbl_empolyees_relation.info_id = employee_info.id
                LEFT JOIN 
                (
                    SELECT 
                    customer_order_id, 
                    GROUP_CONCAT(product_code,  '=', quantityes SEPARATOR '; ') as ProductQuantityString 
                    FROM (
                        SELECT 
                        order_details.*, 
                        product_details.product_code 
                        FROM order_details
                        left join product_details on order_details.product_id = product_details.id
                        WHERE order_type='2'
                    ) as orderwithPName 
                    GROUP BY orderwithPName.customer_order_id
                ) as combainedOrderDetails ON combainedOrderDetails.customer_order_id=tbl_customer_order.id
                where tbl_customer_order.delivery_date >= '".$startDate."' and tbl_customer_order.delivery_date <= '".$endDate."'
            ) as myOderList
            ORDER BY myOderList.DeliveryDate DESC";
//
       // $this->db->select($leaderSQL);
        $resource = $this->db->query($leaderSQL);
		// echo $this->db->last_query();
        // die();
        return $resource->result_array();
    }

    public function updateIndent($orderId,$indentNumber,$date){
        $this->db->where('tbl_customer_order.id', $orderId);
        $data['indent_date']=$date;
        $data['indent_no']=$indentNumber;
        $data['indent_flag']=1;
        if ($this->db->update('tbl_customer_order', $data)) {
            return true;
        }
        else {
            return false;
        }
    }
}	
?>