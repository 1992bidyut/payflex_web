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
<<<<<<< HEAD
            ->from('tbl_empolyees_relation')
            ->join('employee_designation', 'employee_designation.id = tbl_empolyees_relation.designation', 'left')
            ->join('employee_info', 'employee_info.id = tbl_empolyees_relation.info_id', 'left');
=======
            ->from('tbl_employees_relation')
            ->join('employee_designation', 'employee_designation.id = tbl_employees_relation.designation', 'left')
            ->join('employee_info', 'employee_info.id = tbl_employees_relation.info_id', 'left');
>>>>>>> 7cefb6806a2bd59ad2244b576ab6dcbdb242a622
        $result = $this->db->get();

//		echo $this->db->last_query();
//		die();

        return $result->result_array();
    }
}