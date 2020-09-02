<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ExcelFiles extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            return redirect('login');
        }

    }

    public function downloadSampleExcel(){

        $this->load->helper('download');

        $data = file_get_contents(base_url()."downloads/jhoroExcel2SMS_v3.1.xls");
        $name = 'jhoroExcel2SMS_v3.1.xls';

        force_download($name, $data);

    }
	
	public function downloadSampleTextFile(){

        $this->load->helper('download');

        $data = file_get_contents(base_url("downloads/Infobuzzer3V1.txt"));
        $name = 'Infobuzzer3V1.txt';

        force_download($name, $data);

    }


}