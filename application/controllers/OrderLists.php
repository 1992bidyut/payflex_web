<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OrderLists extends CI_Controller{
    
    
    function __construct() {
        parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			return redirect('login');
		}
		$this->load->model('OrdersModel');
        $this->load->model('ProductModel');
    }
    
    public function index()
	{

	    $getDate= $this->getServerDate();

        $date = strtotime($getDate);
        $date = strtotime("-1 day", $date);
        $startDate=date("Y-m-d", $date);

        $sessionData=$this->session->userdata();
        $sessionData['order_from']=$startDate;
        $sessionData['order_to']=$getDate;
        $this->session->set_userdata($sessionData);

//        echo $startDate;
	    $leaderBoardData = $this->OrdersModel->getOrdersList($startDate,$getDate);
        $productList=$this->ProductModel->getProductList();//

		//var_dump($leaderBoardData);
			
		$dataArray = array('paymentInfoArray'=>$leaderBoardData,'productList'=>$productList);
		$datas['content'] = $this->load->view('orders/orderlistview', $dataArray, true);
		$this->load->view( 'layouts/main_template',$datas);
	}
    private function getServerDate(){
        $getDate= date("Y-m-d H:m:s");
        $getDate = strtotime($getDate);
        $getDate = strtotime("-0 h", $getDate);
        return $getDate=date("Y-m-d", $getDate);
    }

    public function indentUpdate(){
        $id=$this->input->post('id');
        $indent_number = $this->input->post('indent_number');
        $this->load->model('OrdersModel');

        if ($this->OrdersModel->updateIndent($id,$indent_number,$this->getServerDate())){
            $this->session->set_flashdata('success_msg','Accepted successfully');
            redirect('OrderLists');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Not Accepted!');
            redirect('OrderLists');
        }
    }
    public function editUpdate(){
        $id=$this->input->post('id');
        $flag= $this->input->post('flag');
        $this->load->model('OrdersModel');

        if ($this->OrdersModel->updateEdit($id,$flag)){
            $this->session->set_flashdata('success_msg','Accepted successfully');
            redirect('LeaderBoard');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Not Accepted!');
            redirect('LeaderBoard');
        }
    }
}
?>