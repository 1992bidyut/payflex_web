<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller{

    function __construct() {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            return redirect('login');
        }
        $this->load->model('user_model');
        $this->load->config('infobuzzerConfig');
    }
    
    public function searchData(){
        $this->load->model('SearchModel');
        $this->load->model('LeaderBoardModel');
        $paymentFrom=$this->input->post('paymentFrom');
        $paymentTo=$this->input->post('paymentTo');

        $sessionData=$this->session->userdata();
        $sessionData['lead_from']=$paymentFrom;
        $sessionData['lead_to']=$paymentTo;
        $this->session->set_userdata($sessionData);

        $leaderBoardData = $this->SearchModel->searchDateFilteredPaymentInfo($paymentFrom,$paymentTo);
        $productList=$this->LeaderBoardModel->getProductList();
        $dataArray = array('paymentInfoArray'=>$leaderBoardData,'productList'=>$productList);

        $datas['content'] = $this->load->view('leader/leader', $dataArray, true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function searchFinanceReport(){
        $this->load->model('SearchModel');
        $this->load->model('Payment_Model');

        $paymentFrom=$this->input->post('paymentFrom');
        $paymentTo=$this->input->post('paymentTo');

        //set filter date in session
        $sessionData=$this->session->userdata();
        $sessionData['fin_from']=$paymentFrom;
        $sessionData['fin_to']=$paymentTo;
        $this->session->set_userdata($sessionData);

        $financeData = $this->Payment_Model->getFinancierExportData($paymentFrom,$paymentTo);
        $dataArray = array('financeData'=>$financeData,);
        $datas['content'] = $this->load->view('finance/finance_report', $dataArray, true);
        $this->load->view( 'layouts/main_template',$datas);
    }//

    public function showData(){
        $this->load->model('SearchModel');
        $client_array = $this->SearchModel->getAllData();
        // echo "<pre>";
        // var_dump($client_array);
        // die();
        $data['content'] = $this->load->view('search/todayOrder', array('todayOrder'=>$client_array), true);
        $this->load->view( 'layouts/main_template',$data);

    }
}

?>
