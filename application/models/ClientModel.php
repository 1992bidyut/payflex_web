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

        //	die($this->db->last_query());
        return $sqlReturn;
    }


    //FOR GETTING ALL USER BY SANKER
    public function getAllClient()
    {
        $this->db->select('*')
            ->from('client_info')
            ->join('client_catagory', 'client_catagory.id = client_info.catagory_id', 'left');
        $result = $this->db->get();

//		echo $this->db->last_query();
//		die();

        return $result->result_array();
    }

    public function createClient($formArray)
    {
        $this->db->insert('client_info', $formArray);

    }

//    public function getDSR(){
//        $this->db->select('employees.id','employees.name', 'employee_info.coded_employeeId')
//            ->from('employee_info')
//            ->join('employees','employee_info.id=employees.info_id','left')
//            ->where("employee.designation",'5');
//        $result = $this->db->get();
//
//        return $result->result_array();
//    }
    //fixed by Bidyut
    public function getAllDSR()
    {
        $this->db->select('employee_info.id,employee_info.name,employees.coded_employeeId')
            ->from('employees')
            ->join('employee_designation', 'employee_designation.id = employees.designation', 'left')
            ->join('employee_info', 'employee_info.id = employees.info_id', 'left')
            ->where('employees.designation', 5);
        $result = $this->db->get();

        return $result->result_array();
    }

    //insert into client_employee_relation by Mohsin
    public function insertClientPairAndHandlerID($formArray){
        $this->db->insert('tbl_client_employee_relation',$formArray);
    }
    //create user from client creation form by Mohsin
    public function createUserIfActive($userArray){
        $this->db->insert('tbl_user',$userArray);
        $info = $this->db->insert_id();
        return $info;
    }

}


?>
