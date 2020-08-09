<?php

class User_model extends CI_Model
{
	//FOR LOGIN USER BY SANKER
	public function loginValid($username,$password){

		$query = $this->db->where(['username'=>$username,'password'=>$password])
				->get('tbl_user');

		if($query->num_rows() === 1 )
		{
			$sqlReturn = $query->row_array();
		}else{
			$sqlReturn = false;
		}
		
	//	die($this->db->last_query());
		return $sqlReturn;
	}



	//FOR GETTING ALL USER BY SANKER
	public function getAllUser(){
			$this->db->select('*')
					 ->from('tbl_user')
					 ->join('tbl_user_type','tbl_user_type.id = tbl_user.user_type','left');
			$result = $this->db->get();

//		echo $this->db->last_query();
//		die();

		return $result->result_array();
	}

	public function getAllUserData()
	{
		$result = $this->db->get('cd_user');
		return $result->result_array();
	}
	//FOR GETTING ALL USER BY SANKER
	public function getUserCreditInfo(){
			$this->db->select('cd_user.id as cd_user_id,
							   cd_user.username,
							   cd_user.role_id,
							   role_name.role_name,
							   credits.id as creditsID,
							   credits.remaining_credit,
							   credits.accStatus')
					 ->from('cd_user')
					 ->join('credits','credits.cd_user_id = cd_user.id','left')
					 ->join('role_name','cd_user.role_id = role_name.role_id','left')
					 ->where('credits.accStatus',1);
			$result = $this->db->get();

//		echo $this->db->last_query();
//		die();
			return $result->result_array();


	}

	public function create_group($posts){

		$this->db->insert('categories',$posts);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	//FOR CREATING USER STEP ONE OF TWO BY SANKER
	public function createUserStepOne($posts){
		$this->db->insert('cd_user',$posts);

		if($this->db->insert_id())
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}

	}

	//FOR CREATING USER FINAL STEP BY SANKER
	public function createUserFinalStep($forContactInformationTbl){

		$this->db->insert('contact_information',$forContactInformationTbl);

		if($this->db->insert_id())
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}

	}

	public function totalSent(){

		$this->db->select('cd_user_id,COUNT(msg_status) AS totalSent')
				->group_by('cd_user_id')
				->from('msg_outbox')
				->where('msg_status','2');
		$sent = $this->db->get()->result_array();



		return $sent;

	}


	// public function totalPending(){
		// $status = array('-10','-7','-6','-4','-3','-1','0');

		// $this->db->select('cd_user_id,COUNT(msg_status) AS totalPending')
				// ->group_by('cd_user_id')
				// ->from('msg_outbox')
				// ->where_in('msg_status', $status);
		// $pending = $this->db->get()->result_array();

		// return $pending;

	// }
	public function totalPending(){

		$this->db->select(
				'msg_outbox.cd_user_id,COUNT(msg_status) AS totalPending')
				->group_by('cd_user_id')
				->from('msg_outbox')
				->join('statuses','msg_outbox.msg_status = statuses.status_code','left')
				->join('statuses_group','statuses.status_group_id = statuses_group.id','left')
				->where('status_group_id',2);
		$resource = $this->db->get();
		return $resource->result_array();

	}

	







	public function newUserStore(){
		$data=array();
		$data['name'] = $this->input->post('name',true);
		
		$data['username'] = $this->input->post('email',true);
		$data['email'] = $this->input->post('email',true);
		$data['contact'] = $this->input->post('contact',true);
		$data['username'] = $this->input->post('email',true);
		$data['password'] = $this->input->post('password',true);
		$this->db->insert('tbl_user',$data);
	}














	public function get_user_info( $user_id )
	{
		$this->db->from('cd_user');
		$this->db->where('id', $user_id);
		$this->db->join('role_name', 'cd_user.role_id = role_name.role_id', 'left');
		$rslt = $this->db->get();
		
		if( $rslt->num_rows() > 0 )	return $rslt->row();
		return false;
	}

	public function getUserInfo($userId){
		$this->db->where('id',$userId)
			     ->select('id,username');
		$resource  = $this->db->get('cd_user');
		if($resource->num_rows() == 1)
		{
			return $resource->row_array();
		}else
		{
			return false;
		}
	}

	public function updatePassword($id,$posts){

		$this->db->where('id',$id);
		$this->db->update('cd_user',$posts);

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function inactiveUser($id,$posts){

		$this->db->where('id',$id)
				 ->update('cd_user',$posts);

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function activeUser($id,$posts){

		$this->db->where('id',$id)
				 ->update('cd_user',$posts);

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_my_users()
	{
		$user_id = current_user();
		
		$this->db->from('cd_user');
		$this->db->where('parent_id', $user_id);
		$rslt = $this->db->get();
		
		if( $rslt->num_rows() > 0 )	return $rslt->result_array();
		return false;
	}
	
	public function get_user_by_username( $username )
	{
		$this->db->from('cd_user');
		$this->db->where('username', $username);
		$rslt = $this->db->get();
		
		if( $rslt->num_rows() > 0 )	return $rslt->row();
		return false;
	}
	
	function csv($userid)
	{
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        
		$this->db->select('contact_information.full_name,contact_info.contact_text');
				$this->db->from('contact_information');
				$this->db->join('contact_info' ,'contact_information.id = contact_info.contact_information_id AND contact_type_id=1');
				$this->db->where_in('contact_info.contact_type_id', '1');
				$this->db->where_in('contact_information.cd_user_id',$userid);
				$this->db->group_by('contact_info.id');
				 $query = $this->db->get(); 
				
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('CSV_Report.csv', $data);
}

	public function get_user_info_mask( $user_id )
	{
		$this->db->from('cd_user');
		$this->db->select('cd_user.id as id,cd_user.*,mask.id as mask_id,mask.mask_text as mask_text,mask.cd_user_id as cd_user_id,mask.is_acive as is_acive,mask.is_default as is_default,mask.is_approved as is_approved');	
		$this->db->where('cd_user.id', $user_id);
		
		$this->db->join('mask', 'mask.cd_user_id= cd_user.id', 'inner');
		$rslt = $this->db->get()->result();
		
		return $rslt;
	}
	

	public function get_user_default_mask( $user_id )
	{
		$this->db->from('cd_user');
		$this->db->select('cd_user.id as id,cd_user.*,mask.id as mask_id,mask.mask_text as mask_text,mask.cd_user_id as cd_user_id,mask.is_acive as is_acive,mask.is_default as is_default,mask.is_approved as is_approved');	
		$this->db->where('cd_user.id', $user_id);
		$this->db->where('mask.is_default', 1);
		
		$this->db->join('mask', 'mask.cd_user_id= cd_user.id', 'inner');
		$rslt = $this->db->get()->row();
		
		return $rslt;
	}
	
	
	public function getCreditByUserName($userName='')
	{
		$myCreditSQL='SELECT tblBal.*, (sC-sU) AS sBalance FROM 
		(
		SELECT cd_user.username, SUM( credits.sms_credit ) AS sC, SUM( credits.sms_usage ) AS sU 
		FROM credits
		LEFT JOIN cd_user ON credits.cd_user_id=cd_user.id
		WHERE cd_user.username ="'.$userName.'" 
		AND credits.cd_user_id!=1
		GROUP BY credits.cd_user_id, cd_user.username
		ORDER BY cd_user.username
		) AS tblBal
		ORDER BY sBalance ASC ';
		$rslt = $this->db->query($myCreditSQL);
		if($rslt->num_rows()>0)
		{
		
			return $row = $rslt->row_array(); ;//$rslt->result();
		}
	}
	
	
	public function get_current_user_info( )
	{
		$user_id = current_user();
			
		$this->db->from('cd_user');
		$this->db->where('cd_user.id', $user_id);
		$this->db->where('contact_information.is_parent',1);
		
		$this->db->join('contact_information', 'cd_user.id = contact_information.cd_user_id', 'left');
		//$this->db->join('contact_info', 'contact_information.id = contact_info.contact_information_id', 'left');
		$rslt = $this->db->get();
		
		return $rslt;
	}
	
	public function get_all_user()
	{
		$query = "SELECT * FROM (`cd_user`) LEFT JOIN `role_name` ON `cd_user`.`role_id` = `role_name`.`role_id` WHERE `role_name`.`role_id` != 1 ";
		
		return $this->db->query($query)->result_array();
	}
	
	public function auto_search_user($userId = '')
	{
		// print_r($userId);
		// die;
		//print_r($_POST['user']);
		$query = "SELECT * FROM (`cd_user`) LEFT JOIN `role_name` ON `cd_user`.`role_id` = `role_name`.`role_id` WHERE `cd_user`.`id` IN ('$userId') AND `role_name`.`role_id` != 1 ";
	
		return $this->db->query($query)->result_array();
		
	}
	
	public function search_user()
	{	$asd=$_POST['user'];
		//print_r($_POST['user']);
		$query = "SELECT * FROM (`cd_user`) LEFT JOIN `role_name` ON `cd_user`.`role_id` = `role_name`.`role_id` WHERE `cd_user`.`username` IN ('$asd') AND `role_name`.`role_id` != 1 ";
		foreach($_POST['user'] as $row )
		{
		 $query .= " OR `cd_user`.`username` LIKE '%$row%'";
		}		
	
		return $this->db->query($query)->result_array();
		
	}

	public function searchUser($search){

		$this->db->select("id,username,role_id,parent_id");
		$whereCondition = array('username' => $search);
		$this->db->where($whereCondition);
		$this->db->from('cd_user');
		$query = $this->db->get();
		return $query->result();

	}
	
	public function delete_user( $user_id )
	{
		if( $user_id == 1 )
		{
			return;
		}
		$this->db->delete('cd_user', array('id' => (int) $user_id ));
		//$this->db->delete('rel_program_user', array('cd_user_id' => (int) $user_id ));
	}
	
	
	public function program_permission()
	{
		$this->db->order_by('permission');
		$this->db->from('tbl_program_permission');
		$rslt = $this->db->get();
		
		$sel = array();
		foreach( $rslt->result() as $row )
			$sel[ $row->id ] = $row->permission;
		return $sel;
	}
	
	
	public function set_program_permission( $in_data)
	{
		$this->db->insert('rel_program_user', $in_data);
	}
	
	public function get_user_program_permission( $user_id )
	{
		
		$this->db->select('rel_program_user.*, tbl_program.name, tbl_program_permission.permission');
		
		$this->db->from('rel_program_user');
		$this->db->join('cd_user', 'cd_user.id = cd_user_id');		
		$this->db->join('tbl_program', 'tbl_program.id = tbl_program_id');
		$this->db->join('tbl_program_permission', 'tbl_program_permission.id = tbl_program_permission_id');
		
		$this->db->where('cd_user.id', $user_id);
		
		$this->db->order_by('name');
		$this->db->order_by('permission');
		
		return $this->db->get();
	}
	
	public function delete_program_permission( $id )
	{
		$this->db->where('id', $id);
		$this->db->delete('rel_program_user');
	}





    public function insertNewCredit($creditData)
    {

        $this->db->insert('credits', $creditData);
//		echo $this->db->last_query();
//		die();

        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }

    }



    function addMask($maskData){

        $this->db->insert('mask',$maskData);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }



    function addRoute1($routeOperatorData1){

        $this->db->insert('operator_user',$routeOperatorData1);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }


    function addRoute2($routeOperatorData2){

        $this->db->insert('operator_user',$routeOperatorData2);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }

    function addRoute3($routeOperatorData3){

        $this->db->insert('operator_user',$routeOperatorData3);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }


    function addRoute4($routeOperatorData4){

        $this->db->insert('operator_user',$routeOperatorData4);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }


    function addRoute5($routeOperatorData5){

        $this->db->insert('operator_user',$routeOperatorData5);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }


    function addRoute6($routeOperatorData6){

        $this->db->insert('operator_user',$routeOperatorData6);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }

    function addRoute7($routeOperatorData7){

        $this->db->insert('operator_user',$routeOperatorData7);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }


    function addRoute8($routeOperatorData8){

        $this->db->insert('operator_user',$routeOperatorData8);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }

	public function getAllUserType(){
		$resource = $this->db->get('tbl_user_type');

		if($resource->num_rows() > 0){
			return $resource->result_array();
		}else{
			return false;
		}
	}


	

}


?>
