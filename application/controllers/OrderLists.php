<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OrderLists extends CI_Controller{
    
    
    function __construct() {
        parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			return redirect('login');
		}
		$this->load->model('OrdersModel');

    }
    
    public function index()
	{
		$leaderBoardData = $this->OrdersModel->getOrdersList();
		

		//var_dump($leaderBoardData);
			
		$dataArray = array('paymentInfoArray'=>$leaderBoardData);
		$datas['content'] = $this->load->view('orders/orderlistview', $dataArray, true);
		$this->load->view( 'layouts/main_template',$datas);
	}
}
?>