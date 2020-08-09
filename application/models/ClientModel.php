<?php

class ClientModel extends CI_Model
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



	//FOR GETTING ALL USER BY SANKER
	public function getAllClient(){
        $this->db->select('*')
                 ->from('client_info')
                 ->join('client_catagory','client_catagory.id = client_info.catagory_id','left');
        $result = $this->db->get();

//		echo $this->db->last_query();
//		die();

    return $result->result_array();
}

	


















































}


?>
