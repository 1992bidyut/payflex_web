<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
        $this->load->view('test/testView');
    }

    public function formValidation(){
        $this->load->helper(array('form', 'url'));//required
        $this->load->library('form_validation');//required

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('user_email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE)
        {
//            $this->load->view('test/testView');
            echo "Not Validated!";
        }
        else
        {
            echo "Form Validated!";
        }
    }
}
