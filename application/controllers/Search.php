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
        $key = $this->input->post('name');
        $results = $this->SearchModel->search($key);
       // $this->load->view('leader/leader',$data);
        $data['content'] = $this->load->view('leader/leader', array('result'=>$results), true);
        $this->load->view( 'layouts/main_template',$data);
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
