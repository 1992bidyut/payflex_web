<?php
class DashboardsModel extends CI_Model
{

    public function orderCounts($startingDate, $endingDate)
    {
        $myQueryString ="SELECT count(id) as number_of_order FROM tbl_customer_order 
         WHERE delivery_date >='" . $startingDate . "' and delivery_date <='". $endingDate ."'";

         //die ($myQueryString); 
        if( empty($startingDate) || empty($endingDate))
        {
            return 0;
        }
        $sqlQeury = $this->db->query($myQueryString);
//        $sqlQeury = $this->db->get('number_of_order');
        $sqlReturn = $sqlQeury->result();
        //var_dump($sqlReturn);
        
        if($sqlQeury->num_rows() > 0)
        {
        	return $sqlReturn[0]->number_of_order;
        }
        else
        {
        	return 0;
        }
        
    }

    public function paymentCounts($startingDate , $endingDate)
    {
        $myQueryString ="SELECT count(id) as number_of_payment FROM tbl_payment 
            WHERE submitted_date  >='" . $startingDate . " 00:00:00' and submitted_date  <='". $endingDate ." 23:59:59'";
            
        if( empty($startingDate) || empty($endingDate))
        {
            return 0;
        }

        $sqlQeury = $this->db->query($myQueryString);
//        $sqlQeury = $this->db->get('number_of_order');

        $sqlReturn = $sqlQeury->result();

        //var_dump($sqlReturn);
        
        if($sqlQeury->num_rows() > 0)
        {
        	return $sqlReturn[0]->number_of_payment;
        }
        else
        {
        	return 0;
        }

    }
    public function validePaymentCounts($startingDate,$endingDate){
        $myQueryString ="SELECT count(id) as number_of_payment FROM tbl_payment 
            WHERE submitted_date  >='" . $startingDate . " 00:00:00' and submitted_date  <='". $endingDate ." 23:59:59'and action_flag !=0";

        if( empty($startingDate) || empty($endingDate))
        {
            return 0;
        }

        $sqlQeury = $this->db->query($myQueryString);
//        $sqlQeury = $this->db->get('number_of_order');

        $sqlReturn = $sqlQeury->result();

        //var_dump($sqlReturn);

        if($sqlQeury->num_rows() > 0)
        {
            return $sqlReturn[0]->number_of_payment;
        }
        else
        {
            return 0;
        }
    }

    public function todayTargetPayment($startingDate,$endingDate){
        $myQueryString ="SELECT SUM(ordered_amount) as today_terget_payment FROM order_details 
            WHERE delevary_date  >='" . $startingDate . "' and delevary_date  <='". $endingDate ."' and order_type = '2'";

        if( empty($startingDate) || empty($endingDate))
        {
            return 0;
        }

        $sqlQeury = $this->db->query($myQueryString);
//        $sqlQeury = $this->db->get('number_of_order');

        $sqlReturn = $sqlQeury->result();

        //var_dump($sqlReturn);

        if($sqlQeury->num_rows() > 0)
        {
            return $sqlReturn[0]->today_terget_payment;
        }
        else
        {
            return 0;
        }
    }

    public function todayTotalPayment($startingDate,$endingDate){

        $myQueryString ="SELECT SUM(amount) as today_payment_payment FROM tbl_payment
            WHERE submitted_date  >='" . $startingDate . " 00:00:00' and submitted_date  <='". $endingDate ." 23:59:59'";

        if( empty($startingDate) || empty($endingDate))
        {
            return 0;
        }

        $sqlQeury = $this->db->query($myQueryString);
//        $sqlQeury = $this->db->get('number_of_order');

        $sqlReturn = $sqlQeury->result();

        //var_dump($sqlReturn);

        if($sqlQeury->num_rows() > 0)
        {
            return $sqlReturn[0]->today_payment_payment;
        }
        else
        {
            return 0;
        }
    }




    ////////////////////////////////////////old code
    public function todaySuccessSms(){

        $this->db->where('msg_status',2)
                 ->like('schedule_time',date('Y-m-d'),'after')
                 ->select('msg_status');
        $resource = $this->db->get('msg_outbox');

        return $resource->num_rows();

    }


    public function todayPendingSms(){

        $this->db->where('msg_status',0)
                 ->like('schedule_time',date('Y-m-d'),'after')
                 ->select('msg_status');
        $resource = $this->db->get('msg_outbox');

        return $resource->num_rows();
    }


	
	public function totalPendingSmsCount(){

        $this->db->select('msg_outbox.*,statuses.status_code,statuses.status_group_id,statuses_group.name as status_group_name')
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->where('status_group_id',2);
        return $resource = $this->db->count_all_results();


    }
	
	public function todaySuccessSmsCount(){

        $this->db->select('msg_outbox.*,statuses.status_code,statuses.status_group_id,statuses_group.name as status_group_name')
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->where('status_group_id',1)
            ->like('schedule_time',date('Y-m-d'),'after');

        return $resource = $this->db->count_all_results();


    }
	
	public function todayPendingSmsCount(){

        $this->db->select('msg_outbox.*,statuses.status_code,statuses.status_group_id,statuses_group.name as status_group_name')
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->where('status_group_id',2)
            ->like('schedule_time',date('Y-m-d'),'after');
        return $resource = $this->db->count_all_results();

    }
	
	public function todaySubmittedSmsCount(){

        $this->db->select('msg_outbox.*,statuses.status_code,statuses.status_group_id,statuses_group.name as status_group_name')
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->where('status_group_id',5)
            ->like('schedule_time',date('Y-m-d'),'after');
        return $resource = $this->db->count_all_results();

    }







}