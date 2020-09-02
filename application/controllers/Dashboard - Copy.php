<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

    function __construct() {
        parent::__construct();

		if(!$this->session->userdata('user_id')){
			return redirect('login');
		}
		$this->load->model('MsgOutboxModel');

    }

    function index(){

			$totalSuccessSms = $this->MsgOutboxModel->totalSuccessSms();

			$totalPendingSms = $this->MsgOutboxModel->totalPendingSms();

			$todaySuccessSms = $this->MsgOutboxModel->todaySuccessSms();

			$todayPendingSms = $this->MsgOutboxModel->todayPendingSms();


			$totalSmsStatus = array(
					'totalSuccessSms'	=> $totalSuccessSms,
					'totalPendingSms'	=> $totalPendingSms,
					'todaySuccessSms'	=> $todaySuccessSms,
					'todayPendingSms'	=> $todayPendingSms
			);

			$datas['content'] = $this->load->view('dashboard/dashboard', array('totalSmsStatus'=>$totalSmsStatus), true);

			$this->load->view( 'layouts/main_template',$datas);


	}
	


}

