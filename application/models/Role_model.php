<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends CI_Model
{
	
	public function get_all_role()
	{
		$this->db->order_by( 'role_name' );
		$this->db->where("role_name != 'superadmin'");
		return $this->db->get("role_name");
	}

	//FOR GETTING ALL ROLE BY SANKER
	public function getAllRole(){

	$resource = $this->db->get('role_name');

		if($resource->num_rows() > 0){
			return $resource->result_array();
		}else{
			return false;
		}
	}
	
	
	public function delete_role( $id )
	{
		$role_id = (int) $id;
		$this->db->delete('role_name', array('role_id' => $role_id) );
		$this->db->delete('role_access', array('role_id' => $role_id) );
	}
	
	
	public function create_role( $data = array() )
	{
		$this->db->where('role_name', $data['role_name']);
		$rslt = $this->db->get('role_name');		
		if( $rslt->num_rows() != 0 ) 
			return false;		
		
		$this->db->insert('role_name', $data);
		return true;
	}
	
	public function get_all_role_category() 
	{
		$this->db->order_by('role_cat_name');
		return $this->db->get("role_category");
	}
	
	public function delete_role_category( $category_id )
	{
		$category_id = (int) $category_id;
		$this->db->delete('role_category', array('role_cat_id' => $category_id ) );		
		$this->db->delete('role_access_name', array( 'role_cat_id' => $category_id ) );
		
	}
	
	public function create_role_category( $data = array( ) )
	{
		$rslt = $this->db->get_where('role_category', array( 'role_cat_name' => $data['role_cat_name'] ) );
		if( $rslt->num_rows() != 0 ) return false;
		
		$this->db->insert( 'role_category', $data);
		
		return true;			
	}
	
	public function get_all_access_names()
	{
		
		$this->db->join('role_category', 'role_category.role_cat_id = role_access_name.role_cat_id');
		$this->db->order_by( 'role_cat_name');
		$this->db->order_by( 'role_perm_text');		
		return $this->db->get('role_access_name');
	}
	
	
	public function get_all_permission()
	{
		$rslt = $this->db->get('role_access');
		
		if( $rslt->num_rows() > 0 ) 
			return $rslt->result_array();
		
		return array();
	}
	
	public function change_permission( $perm_array = array() )
	{
		$rslt = $this->db->get('role_access');
		$existing_access = array();
		
		if( $rslt->num_rows() > 0 )
		{
			foreach( $rslt->result() as $access )
			{
				/* If not in post data then delete it */
				if( in_array( 'perm_' . $access->role_id . '_' . $access->role_perm_id, $perm_array ) == false )
					$this->db->delete('role_access', array( 'role_id' => (int)$access->role_id, 
									'role_perm_id' => (int) $access->role_perm_id) );
					
			}
			
			$existing_access = $rslt->result_array();
		}
		
		foreach( $perm_array as $key => $new_perm )
		{
			list( $null, $role_id, $role_perm_id) = explode('_', trim( $new_perm) );
			if( in_array( array('role_id' => $role_id, 'role_perm_id' => $role_perm_id ), $existing_access ) == false )
			{
				$data = array(
						'role_id' => $role_id,
						'role_perm_id' => $role_perm_id,
					);
				$this->db->insert('role_access', $data);
			}
		}
		
		
		
	}
	

	public function delete_permission( $perm_array = array() ) 
	{
		foreach( $perm_array as $key => $perm )
		{
			list( $empty, $perm_id) = explode( '_', trim($perm));
			
			$this->db->delete( 'role_access_name', array( 'role_perm_id' => (int) $perm_id ));
			$this->db->delete( 'role_access', array( 'role_perm_id' => (int) $perm_id ));
			
		}
	}
	
	public function create_role_access( $data = array() )
	{
		$rslt = $this->db->get_where('role_access_name', array('role_perm_text' => $data['role_perm_text']) );
		if( $rslt->num_rows() > 0 ) return false;
		
		$this->db->insert( 'role_access_name', $data);
		return true;
		
	}
	
}

?>
