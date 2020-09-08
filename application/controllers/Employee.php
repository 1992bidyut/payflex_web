<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller{

    function __construct() {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            return redirect('login');
        }

        $this->load->model('user_model');
        $this->load->config('infobuzzerConfig');

    }
    

   public function employeeList(){
        $this->load->model('EmployeeModel');
        $employee_array = $this->EmployeeModel->getAllEmployee();
        // echo "<pre>";
        // var_dump($userNewArray);
        // die();
        $datas['content'] = $this->load->view('employee/employeeShow', array('allEmployee'=>$employee_array), true);

        $this->load->view( 'layouts/main_template',$datas);

    }

	
}

?>
