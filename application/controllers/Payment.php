<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            return redirect('login');
        }
        $this->load->model('user_model');
        $this->load->config('infobuzzerConfig');
    }

    public function paymentCollection()
    {
        $datas['content'] = $this->load->view('payment/paymentCollection', array(), true);
        $this->load->view('layouts/main_template', $datas);
    }
//
    public function paymentdetail($order_code)
    {
        $this->load->model('Payment_Model');
        $this->load->model('ClientModel');
        $paymentDetail = $this->Payment_Model->getpaymentdetail($order_code);
        $orderDetail = $this->Payment_Model->getOrderDetail($order_code);

//        if (count($paymentDetail)>0 && count($orderDetail)>0){
        if (count($orderDetail)>0){
            $clientInfo=$this->ClientModel->getClient($orderDetail[0]['client_id']);
            $clientContact=$this->ClientModel->getClientsContact($orderDetail[0]['client_id']);

             echo json_encode(array('paymentDetail' => $paymentDetail,
            'orderDetail' => $orderDetail,
            'clientInfo' => $clientInfo,
            'clientContact'=>$clientContact));

//            $datas['content'] = $this->load->view('payment/paymentDetail',
//                array('paymentDetail' => $paymentDetail,
//                    'orderDetail' => $orderDetail,
//                    'clientInfo' => $clientInfo,
//                    'clientContact'=>$clientContact), true);
//            $this->load->view('layouts/main_template', $datas);
        }else{
            $this->load->model('LeaderBoardModel');
            $leaderBoardData = $this->LeaderBoardModel->searchPaymentInfo();
            $productList=$this->LeaderBoardModel->getProductList();
            //var_dump($leaderBoardData);

            $dataArray = array('paymentInfoArray'=>$leaderBoardData,'productList'=>$productList);
            $datas['content'] = $this->load->view('leader/leader', $dataArray, true);
            $this->load->view( 'layouts/main_template',$datas);
        }

    }

    public function paymentAccept(){
        $id=$this->input->post('id');
        $this->load->model('Payment_Model');

        if ($this->Payment_Model->updatePaymentAccept($id)){
           $this->session->set_flashdata('success_msg','Accepted successfully');
            redirect('LeaderBoard');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Not Accepted!');
            redirect('LeaderBoard');
        }
    }

    public function indent(){
        $id=$this->input->post('id');
        $this->load->model('Payment_Model');

        if ($this->Payment_Model->updateIndent($id)){
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
