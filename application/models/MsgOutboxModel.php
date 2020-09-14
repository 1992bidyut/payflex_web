
<?php

/**
 * Created by PhpStorm.
 * User: Sanker Saha
 * Date: 04-03-2017
 * Time: 10:38 PM
 */
class MsgOutboxModel extends CI_Model
{
    public function getAllNotFinalizedExcelSmsNumRows($sessionArray){
        $this->db->where('msg_status','-10');
        $this->db->where('sms_batch_id',@$sessionArray['lastExcelFileName']);
        $this->db->where('cd_user_id',$sessionArray['excelOnerId']);
        $resource = $this->db->get('msg_outbox');

        return $resource->num_rows();
    }

    public function getAllNotFinalizedExcelSms($sessionArray,$segment){

        $this->db->where('msg_status','-10');
        $this->db->where('sms_batch_id',@$sessionArray['lastExcelFileName']);
        $this->db->where('cd_user_id',$sessionArray['excelOnerId']);
        $this->db->select('*');
        $this->db->limit(10);
        $resource = $this->db->get('msg_outbox');

        return $resource->result_array();


    }

    public function confirmExcelSms($sessionArray){

        $this->db->where('cd_user_id',$sessionArray['excelOnerId'])
                 ->where('sms_batch_id',$sessionArray['lastExcelFileName'])
                 ->where('msg_status','-10')
                 ->update('msg_outbox',array('msg_status'=>'-7'));

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }
    }
	
	    public function getAllNotFinalizedTextSmsNumRows($sessionArray){
        $this->db->where('msg_status','-10');
        $this->db->where('sms_batch_id',@$sessionArray['lastTextFileName']);
        $this->db->where('cd_user_id',$sessionArray['textOnerId']);
        $resource = $this->db->get('msg_outbox');

        return $resource->num_rows();
    }

    public function getAllNotFinalizedTextSms($sessionArray,$segment){

        $this->db->where('msg_status','-10');
        $this->db->where('sms_batch_id',@$sessionArray['lastTextFileName']);
        $this->db->where('cd_user_id',$sessionArray['textOnerId']);
        $this->db->select('*');
        $this->db->limit(10);
        $resource = $this->db->get('msg_outbox');

        return $resource->result_array();


    }

    public function confirmTextSms($sessionArray){

        $this->db->where('cd_user_id',$sessionArray['textOnerId'])
            ->where('sms_batch_id',$sessionArray['lastTextFileName'])
            ->where('msg_status','-10')
            ->update('msg_outbox',array('msg_status'=>'-7'));

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }
    }

    public function totalSuccessSms(){

        $this->db->where('msg_status',2)
                 ->select('msg_status');
        $resource = $this->db->get('msg_outbox');

        return $resource->num_rows();

    }

    public function totalPendingSms(){

        $this->db->where('msg_status',0)
                 ->select('msg_status');
        $resource = $this->db->get('msg_outbox');

        return $resource->num_rows();

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


	public function totalSuccessSmsCount(){

        $this->db->select('msg_outbox.*,statuses.status_code,statuses.status_group_id,statuses_group.name as status_group_name')
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->where('status_group_id',1);
        return $resource = $this->db->count_all_results();
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