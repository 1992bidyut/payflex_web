
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










}