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
        $paymentFrom=$this->input->post('paymentFrom');
        $paymentTo=$this->input->post('paymentTo');
        $leaderBoardData = $this->SearchModel->searchDateFilteredPaymentInfo($paymentFrom,$paymentTo);
        $dataArray = array('paymentInfoArray'=>$leaderBoardData);

        $datas['content'] = $this->load->view('leader/leader', $dataArray, true);
        $this->load->view( 'layouts/main_template',$datas);
    }

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
