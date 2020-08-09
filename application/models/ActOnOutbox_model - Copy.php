<?php

class ActOnOutbox_model extends CI_Model
{

	public function CheckOperator($operatorPrefix)
	{
		$this->db->from('operator');
		$this->db->where('identity', $operatorPrefix);
		$rslt = $this->db->get();
		if( $rslt->num_rows() > 0 )	
		{
			return $rslt->result_array();
		}
		else
		{
			return false;
		}
		
	}
	

	public function batchUpdate($dataArray)
	{
		if($this->db->update_batch('msg_outbox', $dataArray, 'id'))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	
	//Generate SMS cost by operator
	function getPriceByOperator($operator,$userid)
	{


		
		$this->db->select('	operator_user.*,
							operator.name as operator_name,
							operator.identity as operator_identity,
							operator_route.id as operator_route_id,
							operator_route.operator_id as operator_id,
							operator_route.route_id,
							operator_route.standard_price as standard_price');

		$this->db->from('operator_user');
		$this->db->join('operator_route', 'operator_route.id = operator_user.operator_route_id', 'left');
		$this->db->join('operator', 'operator.id = operator_route.operator_id', 'left');		
		$this->db->where('operator_user.user_id', $userid);
		$this->db->where('operator.identity', $operator);
		$this->db->where('operator_user.is_active', '1');
		
		$result = $this->db->get();


		if( $result->num_rows() > 0 )	
		{
			return $result->row();
		}
		else
		{
			return false;
		}
		
//		echo '<pre>'.$this->db->last_query().'</pre>';die;


	}
	
	
	

	public function deductCredit( $activeCreditId, $updateCredit)
	{
		// print_r($status);
		// die();
		if(!empty($activeCreditId))
		{

			$this->db->where('id',$activeCreditId);
			$this->db->update('credits',$updateCredit);
		}
		
		
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	

	public function getUsernameById($cd_user_id)
	{
		$this->db->from('cd_user')
			->select('*')
			->where('cd_user.id', $cd_user_id)
			->limit('1');
		
		$result = $this->db->get();
		
		// echo '<pre>'.$this->db->last_query().'</pre>';die;  	
		
		if( $result->num_rows() > 0 )	
		{
			return $result->row();
		}
		else
		{
			return false;
		}
	}
	
	

	public function checkCredit( $user_id, $amount )
	{
		
		$currentDatetime = DATE('Y-m-d');
		
		$this->db->from('credits')
			->select('credits.id,credits.sms_usage,credits.remaining_credit')
			->where('credits.accStatus', '1')
			->where('credits.cd_user_id', $user_id)
			->where('credits.end_date >=', $currentDatetime)
			->order_by('credits.id','desc')
			->limit('1');
		
		$result = $this->db->get();
		
		// echo '<pre>'.$this->db->last_query().'</pre>';die;  	
		
		if( $result->num_rows() > 0 )	
		{
			return $result->row();
		}
		else
		{
			return false;
		}
	}

	
	
	function smsCount($smsBody) 
	{
		
		// echo $smsBody;
		$smsBodyLen = strlen(utf8_decode($smsBody));
		// die;
		// if (mb_check_encoding($smsBody,"UTF-8"))
			
		if (strlen($smsBody) != strlen(utf8_decode($smsBody)))
		{	
			// echo strlen($smsBody);
			// echo $smsBodyLen = strlen(utf8_decode($smsBody));
			
			if($smsBodyLen > 70)
			{
				$mySMSCount = ceil( $smsBodyLen / 67 );
			}
			else
			{
				echo $mySMSCount = 1;
			}
		}
		else
		{							
			if($smsBodyLen > 160)
			{
				$mySMSCount = ceil( $smsBodyLen / 153);
			}
			else
			{
				$mySMSCount = 1;
			}
		}
			
	    
		return $mySMSCount; 	
	}
	
	
	
	public function fetchOutboxData($status, $limit)
	{
		$this->db->from('msg_outbox');
		$this->db->where('msg_status', $status);
		$this->db->limit($limit);
		$rslt = $this->db->get();
		// echo $this->db->last_query();
		// die;
		if( $rslt->num_rows() > 0 )	
		{
			return $rslt->result_array();
		}
		else
		{
			return false;
		}
		
	}
	
	
	

	
}

?>