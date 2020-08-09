<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LeaderBoard extends CI_Controller{
    
    
    function __construct() {
        parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			return redirect('login');
		}
		$this->load->model('LeaderBoardModel');

    }
    
    public function index()
	{
		$leaderBoardData = $this->LeaderBoardModel->searchPaymentInfo();
		

		//var_dump($leaderBoardData);
			
		$dataArray = array('paymentInfoArray'=>$leaderBoardData);
		$datas['content'] = $this->load->view('leader/leader', $dataArray, true);
		$this->load->view( 'layouts/main_template',$datas);
	}
}
?>