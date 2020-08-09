<?php 
class cdr_model extends CI_Model{
	
	function insert_cdr($data)
	{
		$this->db->insert('postpaid_cdr',$data);

        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }
		
	}
	
    public function getAllUser(){
        $resource = $this->db->get('cd_user');
        return $resource->result_array();

    }
	
	public function postpaidCdrShow(){

        $this->db->select('postpaid_cdr.*, cd_user.username, route.name as routename')
                 ->from('postpaid_cdr')
                 ->join('cd_user','postpaid_cdr.cd_user_id = cd_user.id')
                 ->join('route','postpaid_cdr.route_id = route.id')
                 ->order_by('id', 'asc');

        $resource = $this->db->get();


        if($resource){
            return $resource->result_array();
        }else{
            return false;
        }

    }

}