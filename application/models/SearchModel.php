<?php

class SearchModel extends CI_Model
{
	//FOR LOGIN USER BY SANKER
	public function loginValid($username,$password){

		$query = $this->db->where(['username'=>$username,'password'=>$password])
				->get('company_user');

		if($query->num_rows() === 1 )
		{
			$sqlReturn = $query->row_array();
		}else{
			$sqlReturn = false;
		}
		
	//	die($this->db->last_query());
		return $sqlReturn;
    }
    
    public function search($key){
        $this->db->like('name',$key);
		$query=$this->db->get('client_info');
        return $query->result();
	}
	

	public function getAllData(){
		$this->db->select("client_info.name as clientName,

		employee_info.name as EmployeeName,
		
		tbl_payment.order_code, 
		
		tbl_customer_order.id as orderID,
		
		tbl_payment.id as paymentID, tbl_payment_mode.methode_name,
		
		tbl_financial_institution_list.bank_name,
		
		 tbl_payment.reference_no,tbl_payment.payment_date_time, tbl_payment.amount, tbl_payment.amount, tbl_image.image_name, tbl_payment_image_relation.id as pirid, tbl_image.id,
		
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
		
		customer_order_id =tbl_customer_order.id");
			$result = $this->db->get();

		// echo $this->db->last_query();
		// die();
			return $result->result_array();
	}

	public function searchDateFilteredPaymentInfo($from,$to)
	{
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
                SELECT customer_order_id, GROUP_CONCAT(p_name,  '=', quantityes SEPARATOR ', ') as ProductQuantityString FROM 
            (SELECT order_details.*, product_details.p_name FROM order_details
            left join product_details on order_details.product_id = product_details.id ) as orderwithPName 
            GROUP BY orderwithPName.customer_order_id) as combainedOrderDetails on combainedOrderDetails.
            customer_order_id =tbl_customer_order.id
            WHERE tbl_payment.submitted_date>= '".$from
			." 00:00:00' and tbl_payment.submitted_date <= '".$to." 23:59:59') as myLeaderBoard 
			ORDER BY myLeaderBoard.submitted_date DESC";

		// $this->db->select($leaderSQL);
		$resource = $this->db->query($leaderSQL);
		// echo $this->db->last_query();
		// die();
		return $resource->result_array();
	}
}


?>
