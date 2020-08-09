<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Controller{

    function __construct() {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            return redirect('login');
        }

        $this->load->model('user_model');
        $this->load->config('infobuzzerConfig');

    }
    

    public function clientList(){
        $this->load->model('ClientModel');
        $client_array = $this->ClientModel->getAllClient();
        // echo "<pre>";
        // var_dump($userNewArray);
        // die();
        $datas['content'] = $this->load->view('client/clientShow', array('allClient'=>$client_array), true);
        $this->load->view( 'layouts/main_template',$datas);

    }


    public function createClient(){
        $datas['content'] = $this->load->view('client/create.php',array(),true);
        $this->load->view('layouts/main_template',$datas);
    }


	
}

?>
