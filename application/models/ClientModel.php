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
    public function getAllClient()
    {
        $this->db->select('*')
            ->from('client_info')
            ->join('client_catagory', 'client_catagory.id = client_info.catagory_id', 'left');
        $result = $this->db->get();

        //        echo $this->db->last_query();
        //        die();

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
        $this->db->select('*');
        $this->db->from('client_info');
        $this->db->join('tbl_client_employee_relation','client_info.id = tbl_client_employee_relation.client_id');
        $this->db->where('client_info.id', $client_id);
        return $client = $this->db->get()->row_array();
    }
    public function getClientsContact($client_id){
        $this->db->select('tbl_contact.id as contact_id,
                            tbl_contact.contact_type_id as type_id,
                            tbl_contact_type.contact_type,
                            tbl_contact.contact_value
                            ');
        $this->db->from('tbl_contact');
        $this->db->join('tbl_contact_type','tbl_contact_type.id = tbl_contact.contact_type_id');
        $this->db->where('tbl_contact.owner_id', $client_id);
        $this->db->where('tbl_contact.owner_type', 3);
        return $client = $this->db->get()->result_array();
    }

}
