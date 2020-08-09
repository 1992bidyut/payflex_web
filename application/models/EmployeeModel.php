<?php

class EmployeeModel extends CI_Model
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
    public function getAllEmployee()
    {
        $this->db->select('*')
            ->from('employees')
            ->join('employee_designation', 'employee_designation.id = employees.designation', 'left')
            ->join('employee_info', 'employee_info.id = employees.info_id', 'left');
        $result = $this->db->get();

//		echo $this->db->last_query();
//		die();

        return $result->result_array();
    }
}