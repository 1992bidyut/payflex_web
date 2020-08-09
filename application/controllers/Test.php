<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
		//print_r($this->session->userdata('lastTextFileName'));
		// echo sys_get_temp_dir();
		echo phpinfo();
    }
}
