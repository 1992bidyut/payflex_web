<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller{

    function __construct() {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            return redirect('login');
        }

        $this->load->model('user_model');
        $this->load->config('infobuzzerConfig');

    }

    public function paymentCollection(){
        $datas['content'] = $this->load->view('payment/paymentCollection', array(), true);
        $this->load->view('layouts/main_template',$datas);
    }


	
}

?>
