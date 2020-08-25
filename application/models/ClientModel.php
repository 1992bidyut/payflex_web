<?php

class ClientModel extends CI_Model
{
    //FOR LOGIN USER BY SANKER
    public function loginValid($username, $password)
    {

        $query = $this->db->where(['username' => $username, 'password' => $password])
            ->get('company_user');

        if ($query->num_rows() === 1) {
            $sqlReturn = $query->row_array();
        } else {
            $sqlReturn = false;
        }

        //    die($this->db->last_query());
        return $sqlReturn;
    }

    //FOR GETTING ALL USER BY SANKER
    //Modified by Mohsin
    public function getAllClient()
    {
        $this->db->select('
         client_info.id as client_id,        
         client_info.user_id, 
         client_info.catagory_id, 
         client_info.client_code, 
         client_info.name, 
         client_info.representative_name, 
         client_info.office_id,
         client_info.client_parent_id,
         client_info.created_date_time,
         client_info.latitude,
         client_info.longitude,
         client_info.is_active,
         client_info.virtual_account_no,
         client_catagory.id as client_catagory_id,
         client_catagory.client_type
         ')
            ->from('client_info')
            ->join('client_catagory', 'client_catagory.id = client_info.catagory_id', 'left');
        $result = $this->db->get();

        //echo $this->db->last_query();
        //die();

        return $result->result_array();
    }

    public function createClient($formArray)
    {
        $this->db->insert('client_info', $formArray);

        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }

    //fixed by Bidyut
    public function getAllDSR()
    {
        $this->db->select('employee_info.id,employee_info.name,tbl_empolyees_relation.coded_employeeId')
            ->from('tbl_empolyees_relation')
            ->join('employee_designation', 'employee_designation.id = tbl_empolyees_relation.designation', 'left')
            ->join('employee_info', 'employee_info.id = tbl_empolyees_relation.info_id', 'left')
            ->where('tbl_empolyees_relation.designation', 5);
        $result = $this->db->get();
        return $result->result_array();
    }

    //insert into client_employee_relation by Mohsin
    public function insertClientPairAndHandlerID($formArray)
    {
        $this->db->insert('tbl_client_employee_relation', $formArray);
    }

    //create user from client creation form by Mohsin
    public function createUserIfActive($userArray)
    {
        $this->db->insert('tbl_user', $userArray);
        // $info = $this->db->insert_id();
        // return $info;
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }

    public function createContacts($formArray)
    {
        $this->db->insert_batch('tbl_contact', $formArray);
    }

    public function getClientsContactType()
    {
        $this->db->select('tbl_contact_type.id,tbl_contact_type.contact_type') //right
            //        $this->db->select('tbl_contact_type.id', 'tbl_contact_type.contact_type')//syntax error
            ->from('tbl_contact_type')
            ->where('tbl_contact_type.user_type', 3);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function updateClient($client_id, $formArray)
    {
        $this->db->where('id', $client_id);
        $this->db->update('client_info', $formArray);
    }

    //get the client information
    public function getClient($client_id)
    {
        $this->db->select('
        client_info.id as client_id,        
        client_info.user_id, 
        client_info.catagory_id, 
        client_info.client_code, 
        client_info.name, 
        client_info.representative_name, 
        client_info.office_id,
        client_info.client_parent_id,
        client_info.created_date_time,
        client_info.latitude,
        client_info.longitude,
        client_info.is_active,
        client_info.virtual_account_no,
        tbl_client_employee_relation.id as client_employee_relation_id,
        tbl_client_employee_relation.client_id as client_employee_relation_client_id,
        tbl_client_employee_relation.client_pairID,
        tbl_client_employee_relation.handler_id,
        tbl_client_employee_relation.inserted_date_time,
        tbl_client_employee_relation.is_active as is_client_employee_relation_active
        ');
        $this->db->from('client_info');
        $this->db->join('tbl_client_employee_relation', 'client_info.id = tbl_client_employee_relation.client_id');
        $this->db->where('client_info.id', $client_id);
        return $client = $this->db->get()->row_array();
    }
    public function getClientsContact($client_id)
    {
        $this->db->select('tbl_contact.id as contact_id,
                            tbl_contact.contact_type_id as type_id,
                            tbl_contact_type.contact_type,
                            tbl_contact.contact_value
                            ');
        $this->db->from('tbl_contact');
        $this->db->join('tbl_contact_type', 'tbl_contact_type.id = tbl_contact.contact_type_id');
        $this->db->where('tbl_contact.owner_id', $client_id);
        $this->db->where('tbl_contact.owner_type', 3);
        return $client = $this->db->get()->result_array();
    }

    public function checkClientEmployeeRelation($client_id)
    {
        // TODO: check if client & handler exist
        $multipleWhere = ['tbl_client_employee_relation.client_id' => $client_id, 'tbl_client_employee_relation.is_active' => 1];
        $this->db->select('tbl_client_employee_relation.handler_id')
            ->from('tbl_client_employee_relation')
            // ->where('tbl_client_employee_relation.client_id' , $client_id);
            ->where($multipleWhere);
        $result = $this->db->get()->row_array();
        return $result;
    }
    public function updateDsr($client_id, $formArray)
    {
        $this->db->where('client_id', $client_id);
        $this->db->update('tbl_client_employee_relation', $formArray);
    }
    public function getContacts($client_id)
    {
        $multipleWhere = ['tbl_contact.owner_id' => $client_id, 'tbl_contact.owner_type' => 3];
        $this->db->select('tbl_contact.id as contact_id,
        tbl_contact.contact_type_id,              
        tbl_contact.contact_value,              
        tbl_contact.owner_id,              
        tbl_contact.owner_type,              
        tbl_contact_type.id as tbl_contact_type_id,              
        tbl_contact_type.contact_type,              
        tbl_contact_type.parent_id,              
        tbl_contact_type.user_type              
        ')
            ->from('tbl_contact')
            ->join('tbl_contact', 'tbl_contact.contact_type_id = tbl_contact_type.id', 'left')
            ->where($multipleWhere);
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function updateContacts($client_id, $data)
    {
        $multipleWhere = ['tbl_contact.owner_id' => $client_id, 'tbl_contact.owner_type' => '3'];
        $this->db->where($multipleWhere);
        //$this->db->update_batch('tbl_contact', $data, 'tbl_contact.owner_id');
        foreach ($data as $datas) {

               $this->db->update('tbl_contact', $datas);
        //   print_r($this->db->last_query());    
        }
        // die();
    }
    // public function getTotalContact($client_id){
    //     $this->db->select('tbl_contact.id,tbl_contact.client')
    //             ->from('tbl_contact');
    // }
}
