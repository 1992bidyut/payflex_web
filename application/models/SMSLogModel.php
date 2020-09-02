<?php
/**
 * Created by PhpStorm.
 * User: Sanker Saha
 * Date: 13-03-2017
 * Time: 11:36 PM
 */
class SMSLogModel extends CI_Model{

    public function getAllSmsStatus(){

        $smsStatus = $this->db->get('statuses');

        return $smsStatus->result_array();
    }

    public function getAllSmsStatusGroup(){

        $smsStatus = $this->db->get('statuses_group');

        return $smsStatus->result_array();
    }
	

    public function searchSmsNumRows($id){


        $contact       = $this->input->get('contact');
        $from          = $this->input->get('from');
        $to            = $this->input->get('to');
        $message       = $this->input->get('smsBody');
        $smsStatusCode = $this->input->get('smsStatusCode');


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


        $this->db->select(
            'msg_outbox.id,
             msg_outbox.contact_text,
             msg_outbox.message,
             msg_outbox.schedule_time,
             statuses.name as status_name,
             statuses.status_group_id,
             statuses_group.name as status_group_name')
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left');


        $resource = $this->db->get();

//        echo $this->db->last_query();
//        die();


        return $resource->result_array();
    }
	
	public function searchSMSCountGroupByDate(){

        $from          = $this->input->post('from');
        $to            = $this->input->post('to');
        $user          = $this->input->post('clientId');
        $smsStatusCode = $this->input->post('smsStatusCode');

        if($from !='' and $to !='')
        {

            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                ->where('schedule_time <=', $toScheduleDateAndTime);
        }

        if( $user !='' )
        {
            $this->db->where('cd_user_id',$user);
        }

        if($smsStatusCode !='')
        {
            $this->db->where('status_group_id',$smsStatusCode);
        }

        $this->db->select(
            "count('msg_outbox.msg_status') as value,           
             date(msg_outbox.schedule_time) as date")
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')            
			->group_by('date(msg_outbox.schedule_time)');

        $resource = $this->db->get();

        return $resource->result_array();

    }
	
	public function currentMonthSMSReport(){


            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';


            $firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
            $lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));

            $from = date("Y-m-d", $firstDayUTS);
            $to = date("Y-m-d", $lastDayUTS);



            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                ->where('schedule_time <=', $toScheduleDateAndTime);



        $this->db->select(
            "count('msg_outbox.msg_status') as value,
             date(msg_outbox.schedule_time) as date")
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
			->group_by('date(msg_outbox.schedule_time)');

        $resource = $this->db->get();
        return $resource->result_array();

    }

    public function searchSMS($id,$limit,$offset){


        $contact       = $this->input->get('contact');
        $from          = $this->input->get('from');
        $to            = $this->input->get('to');
        $message       = $this->input->get('smsBody');
        $smsStatusCode = $this->input->get('smsStatusCode');


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

        $this->db->select(
            'msg_outbox.id,
             msg_outbox.trx_id,
             msg_outbox.contact_text,
             msg_outbox.message,
             msg_outbox.schedule_time,
		     msg_outbox.send_time,
             msg_outbox.update_time,
             statuses.name as status_name,
             statuses.status_group_id,
             statuses_group.name as status_group_name')
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->limit($limit,$offset)
            ->order_by('schedule_time','desc');

        $resource = $this->db->get();


        return $resource->result_array();

    }
	
	//for admin panel report count

    public function searchSMSCount(){


        $from          = $this->input->post('from');
        $to            = $this->input->post('to');
        $user          = $this->input->post('clientId');
        $smsStatusCode = $this->input->post('smsStatusCode');

        if($from !='' and $to !='')
        {

            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                ->where('schedule_time <=', $toScheduleDateAndTime);
        }

        if( $user !='' )
        {
            $this->db->where('cd_user_id',$user);
        }

        if($smsStatusCode !='')
        {
            $this->db->where('status_group_id',$smsStatusCode);
        }

        $this->db->select(
            "msg_outbox.id,
             count('msg_outbox.msg_status') as totalSms,
             msg_outbox.msg_status,
             statuses.status_group_id,
             statuses_group.name as status_group_name")
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->group_by('statuses.status_group_id');

        $resource = $this->db->get();
		// echo $this->db->last_query();
		// die();
        return $resource->result_array();

    }
	
	// GETTING SMS STATUS AS ARRAY BY SMS GROUP ID
	
    public function getSmsStatusbyGroupId($id){
        $this->db->where('status_group_id',$id)
				 ->select('status_group_id,status_code');
        $resource = $this->db->get('statuses');
        return $resource->result_array();
    }
	
	public function updateAll($post){

        $id            = $post['userId'];
        $contact       = $post['contact'];
        $from          = $post['from'];
        $to            = $post['to'];
        $message       = $post['smsBody'];

		// echo "<pre/>";
		// print_r($post);
		// die;

        foreach($post['smsStatusCode'] as $status_code)
        {
            $statusCodeArray[] = $status_code['status_code'];

        }

        $this->db->where('cd_user_id',$id);
		$this->db->where('route_id != 0');

        if($from !='' and $to !='')
        {
            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                     ->where('schedule_time <=', $toScheduleDateAndTime);
        }

        if( $contact !='' )
        {
            $this->db->like('contact_text',$contact);
        }

        if( $message !='' )
        {
            $this->db->like('message',$message);
        }

		if($post['smsStatusCode'] != NULL)
		{
			if($status_code['status_code'] !='' && $status_code['status_group_id']>1)
			{
				$this->db->where_in('msg_status', $statusCodeArray);
				$this->db->set('msg_status','0');
			}
			if($status_code['status_code'] !='' && $status_code['status_group_id']==1)
			{
				$this->db->where_in('msg_status', $statusCodeArray);
				$this->db->set('msg_status','-7');
			}
		}
		else
		{
			$this->db->set('msg_status','0');
		}
			

        $resource = $this->db->update('msg_outbox');

        return $resource;

    }




    public function stopAllSelectedSms($sessionArray){

        $this->db->where('cd_user_id',$sessionArray['user_id'])
            ->where('msg_status<=','0')
            ->update('msg_outbox',array('msg_status'=>'-10'));

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }
    }




    public function currentMonthSMSReportGroupByUser(){


        $fromTime   = '00:00:00';
        $toTime     = '23:59:59';


        $firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
        $lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));

        $from = date("Y-m-d", $firstDayUTS);
        $to = date("Y-m-d", $lastDayUTS);


        $fromDateTimeString = strtotime($from.$fromTime);

        $toDateTimeString   = strtotime($to.$toTime);

        $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

        $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

        $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
            ->where('schedule_time <=', $toScheduleDateAndTime);



        $this->db->select(
            "msg_outbox.cd_user_id as userId,
             msg_outbox.msg_status,
             count('msg_outbox.msg_status') as value,           
             date(msg_outbox.schedule_time) as date")
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->group_by('msg_outbox.cd_user_id');

        $resource = $this->db->get();
        return $resource->result_array();

    }

    public function smsReportByUserAndStatus()
    {




        $from          = $this->input->post('from');
        $to            = $this->input->post('to');
        $user          = $this->input->post('clientId');
        $smsStatusCode = $this->input->post('smsStatusCode');


        if($from !='' and $to !='')
        {

            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                ->where('schedule_time <=', $toScheduleDateAndTime);
        }

        if( $user !='' )
        {
            $this->db->where('cd_user_id',$user);
        }

        if($smsStatusCode !='')
        {
            $this->db->where('status_group_id',$smsStatusCode);
        }

        $this->db->select(
            "msg_outbox.cd_user_id as userId,
             cd_user.username,
             contact_information.full_name,
             msg_outbox.msg_status,
             statuses.name,
             count('msg_outbox.msg_status') as totalSms,           
             date(msg_outbox.schedule_time) as date")

            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')            
            ->join('cd_user','msg_outbox.cd_user_id = cd_user.id','left')            
            ->join('contact_information','contact_information.cd_user_id = cd_user.id','left')            
            ->group_by('msg_outbox.cd_user_id')
            ->group_by('msg_outbox.msg_status');

        $resource = $this->db->get();

        return $resource->result_array();
    }


    public function searchSMSPaginationCount($from,$to,$user,$smsStatusCode)
    {

        // print_r($smsStatusCode);
        // die('------525');

        if($from !='' and $to !='')
        {

            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                ->where('schedule_time <=', $toScheduleDateAndTime);
        }

        if( $user !='' )
        {
            $this->db->where('cd_user_id',$user);
        }

        if($smsStatusCode !='')
        {
            $this->db->where('status_group_id',$smsStatusCode);
        }

        $this->db->select(
            "msg_outbox.id,
             count('msg_outbox.msg_status') as totalSms,
             msg_outbox.msg_status,
             statuses.status_group_id,
             statuses_group.name as status_group_name")
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->group_by('statuses.status_group_id');

        $resource = $this->db->get();
        // echo $this->db->last_query();
        // die();
        return $resource->result_array();

    }

    public function searchSMSCountWithPagination($from,$to,$user,$smsStatusCode,$segment)
    {
        
        if($from !='' and $to !='')
        {

            $fromTime   = '00:00:00';
            $toTime     = '23:59:59';

            $fromDateTimeString = strtotime($from.$fromTime);

            $toDateTimeString   = strtotime($to.$toTime);

            $fromScheduleDateAndTime    = date("Y-m-d H:i:s",$fromDateTimeString);

            $toScheduleDateAndTime      = date("Y-m-d H:i:s",$toDateTimeString);

            $this->db->where('schedule_time >=', $fromScheduleDateAndTime)
                ->where('schedule_time <=', $toScheduleDateAndTime);
        }

        if( $user !='' )
        {
            $this->db->where('cd_user_id',$user);
        }

        if($smsStatusCode !='')
        {
            $this->db->where('status_group_id',$smsStatusCode);
        }

        $this->db->select(
            "msg_outbox.contact_text,
             msg_outbox.message,
             msg_outbox.smsMask,
             msg_outbox.schedule_time,
             statuses_group.name as status_group_name")
            ->from('msg_outbox')
            ->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
            ->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
            ->limit(20,$segment);

        $resource = $this->db->get();
        return $resource->result_array();

    }

}

?>