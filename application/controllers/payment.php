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

    public function paymentdetail($order_code)
    {
        $this->load->model('Payment_Model');
        $paymentDetail = $this->Payment_Model->getpaymentdetail($order_code);
        $orderDetail = $this->Payment_Model->getOrderDetail($order_code);
        echo print_r($orderDetail);
//
//        $datas['content'] = $this->load->view('payment/paymentDetail',
//            array('paymentDetail' => $paymentDetail,
//                'orderDetail' => $orderDetail), true);
//        $this->load->view('layouts/main_template', $datas);
    }

}
