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

        if (count($orderDetail)>0){
            $clientInfo=$this->ClientModel->getClient($orderDetail[0]['client_id']);
            $clientContact=$this->ClientModel->getClientsContact($orderDetail[0]['client_id']);
            $counter=0;
            foreach ($paymentDetail as $payment){
                $image_name=$this->Payment_Model->getImageName($payment['payment_id']);
                $paymentDetail[$counter]['image_name']=$image_name;
                $counter++;
            }

//             echo json_encode(array('paymentDetail' => $paymentDetail,
//            'orderDetail' => $orderDetail,
//            'clientInfo' => $clientInfo,
//            'clientContact'=>$clientContact));

            $datas['content'] = $this->load->view('payment/paymentDetail',
                array('paymentDetail' => $paymentDetail,
                    'orderDetail' => $orderDetail,
                    'clientInfo' => $clientInfo,
                    'clientContact'=>$clientContact), true);
            $this->load->view('layouts/main_template', $datas);
        }else{

            $this->load->model('LeaderBoardModel');

            $getDate=$this->getServerDate();

            $date = strtotime($getDate);
            $date = strtotime("-1 day", $date);
            $startDate=date("Y-m-d", $date);
            //set filter date in session
            $sessionData=$this->session->userdata();
            $sessionData['lead_from']=$startDate;//
            $sessionData['lead_to']=(string)$getDate;

            $this->session->set_userdata($sessionData);
            $leaderBoardData = $this->LeaderBoardModel->searchPaymentInfo($startDate,(string)$getDate);
            $productList=$this->LeaderBoardModel->getProductList();

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

    public function indentUpdate(){
        $id=$this->input->post('id');
        $indent_number = $this->input->post('indent_number');
        $this->load->model('OrdersModel');

        if ($this->OrdersModel->updateIndent($id,$indent_number,$this->getServerDate())){
            $this->session->set_flashdata('success_msg','Accepted successfully');
            redirect('LeaderBoard');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Not Accepted!');
            redirect('LeaderBoard');
        }
    }
    public function collectionUpdate(){
        $id=$this->input->post('id');
        $collection_number = $this->input->post('collection_number');
        $this->load->model('Payment_Model');

        if ($this->Payment_Model->updateCollection($id,$collection_number,$this->getServerDate())){
            $this->session->set_flashdata('success_msg','Accepted successfully');
            redirect('LeaderBoard');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Not Accepted!');
            redirect('LeaderBoard');
        }
    }

    public function replaceUpdate(){
        $id=$this->input->post('id');
        $replace_tag= $this->input->post('replace_tag');
        $this->load->model('Payment_Model');

        if ($this->Payment_Model->updateReplace($id,$replace_tag)){
            $this->session->set_flashdata('success_msg','Accepted successfully');
            redirect('LeaderBoard');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Not Accepted!');
            redirect('LeaderBoard');
        }
    }

    private function getServerDate(){
        $this->load->model('LeaderBoardModel');
        $getDate= date("Y-m-d H:m:s");
        $getDate = strtotime($getDate);
        $getDate = strtotime("-6 h", $getDate);
        return $getDate=date("Y-m-d", $getDate);
    }

}
