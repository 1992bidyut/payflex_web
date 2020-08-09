<?php
class DashboardsModel extends CI_Model
{

    public function orderCounts($startingDate = null , $endingDate = null)
    {

        $myQueryString ="SELECT count(id) as number_of_order FROM tbl_customer_order 
         WHERE delivery_date between date('" . $startingDate . "') and date('". $endingDate ."')";
          
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

    public function paymentCounts($startingDate = null , $endingDate = null)
    {
        $myQueryString ="SELECT count(id) as number_of_payment FROM tbl_payment 
            WHERE payment_date_time between date('" . $startingDate . "') and date('". $endingDate ."')";
            
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