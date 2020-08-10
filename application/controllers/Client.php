<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            return redirect('login');
        }

        $this->load->model('user_model');
        $this->load->config('infobuzzerConfig');

    }


    public function clientList()
    {
        $this->load->model('ClientModel');
        $client_array = $this->ClientModel->getAllClient();
        // echo "<pre>";
        // var_dump($userNewArray);
        // die();

        $coded_ids['getDSRs'] = $this->ClientModel->getAllDSR();
        $getDSRs = $this->ClientModel->getAllDSR();

        $datas['content'] = $this->load->view('client/clientShow',
            array(
                'allClient' => $client_array,
                'getDSRs' => $getDSRs
            ), true);
        $this->load->view('layouts/main_template', $datas);
    }


    public function createClient()
    {
        $this->load->model('ClientModel');
        $this->form_validation->set_rules('name', 'Distributor Name', 'required');
        $this->form_validation->set_rules('representative_name', 'Representative Name', 'required');
        $this->form_validation->set_rules('client_code', 'Client Code', 'required');
        $this->form_validation->set_rules('virtual_account_code', 'Virtual A/C no.', 'required');


        $client_array = $this->ClientModel->getAllClient();
        $coded_ids['getDSRs'] = $this->ClientModel->getAllDSR();

        // if($this->form_validation->run()==false){
        //     $coded_ids = array();
        //     // $coded_ids['getDSRs'] = $this->ClientModel->getAllDSR();
        //     // $getDSRs=$this->ClientModel->getAllDSR();

        //     // $datas['content'] = $this->load->view('client/clientShow.php',array('getDSRs'=>$getDSRs),true);
        //     // $this->load->view('layouts/main_template',$datas);

        //     $getDSRs=$this->ClientModel->getAllDSR();

        //     $datas['content'] = $this->load->view('client/clientShow',
        //         array(
        //             'allClient'=>$client_array,
        //             'getDSRs'=>$getDSRs
        //         ), true);
        //     $this->load->view( 'layouts/main_template',$datas);
        // }else
        {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['representative_name'] = $this->input->post('representative_name');
            $formArray['client_code'] = $this->input->post('client_code');
            $formArray['virtual_account_no'] = $this->input->post('virtual_account_no');

//            echo print_r($this->input->post());


            if ($this->input->post('is_user') == true) {

                $userArray = array();
                $userArray['username'] = $this->input->post('username');
                $userArray['password'] = sha1($this->input->post('passsword'));
                $userArray['user_type'] = 3;
                $userArray['created_time'] = date('Y-m-d');
                $this->ClientModel->createUserIfActive($userArray);
                $this->session->set_flashdata('success_on_user_client', 'User successfully created');
            }
            //client employee relation
            $ceRelation = array();
            $ceRelation['client_pairID'] = $this->input->post('assign_dsr');
            $explodedString = explode($ceRelation['client_pairID']);
            $ceRelation['handler_id']= end($explodedString);
            $this->ClientModel->insertClientPairAndHandlerID($ceRelation);
            $this->session->set_flashdata('success_clientPaid_handler_insertion', 'Client successfully created');


            //user id insertion into client_info from tbl_user
            $formArray['user_id'] = $this->ClientModal->createUserIfActive();
            $this->ClientModel->createClient($formArray);
            $this->session->set_flashdata('success', 'Client successfully created');
            redirect(base_url() . 'client/clientList');

            // $datas['content'] = $this->load->view('client/clientShow.php',array('getDSRs'=>$getDSRs),true);
            // $this->load->view('layouts/main_template',$datas);
        }
    }
}
