<?php

/**
 * Created by PhpStorm.
 * User: Sanker Saha
 * Date: 04-03-2017
 * Time: 10:38 PM
 */
class SendSMSModel extends CI_Model
{
    public function smsStore($SMSArray){

        $this->db->insert_batch('msg_outbox',$SMSArray);
        return $this->db->affected_rows();

//        $this->db->insert('msg_outbox', $posts);
//        if ($this->db->insert_id())
//        {
//            return $this->db->insert_id();
//        }
//        else
//        {
//            return false;
//        }
    }

    public function smsStoreFromExcel($SMSArray){

        $this->db->insert_batch('msg_outbox',$SMSArray);
        return $this->db->affected_rows();

//        $this->db->insert('msg_outbox', $posts);
//        if ($this->db->insert_id())
//        {
//            return $this->db->insert_id();
//        }
//        else
//        {
//            return false;
//        }
    }

}