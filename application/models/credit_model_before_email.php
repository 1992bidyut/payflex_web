<?php

class Credit_model extends CI_Model
{

// UPDATING OLD CREDIT STATUS by Sanker
    public function updateCreditaccStatus($creditId)
    {
        $this->db->set('accStatus', '0')
            ->where('id', $creditId)
            ->update('credits');

        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 'updated';
        }
    }

// INSET NEW CREDIT by Sanker

    public function insertNewCredit($formData)
    {

        $this->db->insert('credits', $formData);
//		echo $this->db->last_query();
//		die();

        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }

    }

    public function getCredits($id){
        $this->db->where('cd_user_id',$id)
                 ->select('sms_credit,sms_usage,remaining_credit,start_date,end_date,accStatus')
                 ->order_by('start_date','DESC');
        $resource = $this->db->get('credits');

        return $resource->result_array();
    }

    public function getCreditsGroupByDate()
    {
        $from	= $this->input->post('from');
        $to		= $this->input->post('to');
        $user	= $this->input->post('clientId');


        if($from !='' and $to !='')
        {

            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromStartDateAdnTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toStartDateAdnTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('start_date >=', $fromStartDateAdnTime)
                ->where('start_date <=', $toStartDateAdnTime);
        }

        if( $user !='' )
        {
            $this->db->where('cd_user_id',$user);
        }

        $this->db->select(
            'date(credits.start_date) as date,credits.sms_credit as income,credits.sms_usage as expenses')
            ->from('credits')
            ->join('cd_user','credits.cd_user_id = cd_user.id','left')
            ->group_by('credits.start_date')->order_by('credits.start_date', 'desc');

        $resource = $this->db->get();
        return $resource->result_array();

    }

}
