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
        $UserContacts['contacts'] = $this->ClientModel->getContactTypeId();
        $contacts = $this->ClientModel->getContactTypeId();
        $datas['content'] = $this->load->view('client/clientShow',
            array(
                'allClient' => $client_array,
                'getDSRs' => $getDSRs,
                'contacts'=>$contacts
            ), true);
        $this->load->view('layouts/main_template', $datas);
    }


    public function createClient()
    {
        $this->load->model('ClientModel');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Distributor Name', 'required');
        $this->form_validation->set_rules('representative_name', 'Representative Name', 'required');
        $this->form_validation->set_rules('client_code', 'Client Code', 'required');
        $this->form_validation->set_rules('virtual_account_code', 'Virtual A/C no.', 'required');


        // $client_array = $this->ClientModel->getAllClient();
        // $getDSRs=$this->ClientModel->getAllDSR();

        // if($this->form_validation->run()==false){    
        //     $this->session->set_flashdata('success', 'Client successfully created');
        //     echo "Info Not Validated!";
        //     echo validation_errors();
        //     // redirect(base_url() . 'client/clientList');
        // }else
        {
            // echo "Info validated!";
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['representative_name'] = $this->input->post('representative_name');
            $formArray['client_code'] = $this->input->post('client_code');
            $formArray['virtual_account_no'] = $this->input->post('virtual_account_no');

            // if ($this->input->post('is_user') == false) {
            //         echo "User not validated!";
            //         echo validation_errors();
            //     }else
            {
                // echo "User Validated!";
                $userArray = array();
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
                if ($this->form_validation->run() == true) {
                    $userArray['username'] = $this->input->post('username');
                    $userArray['password'] = sha1($this->input->post('passsword'));
                    $userArray['user_type'] = 3;
                    $userArray['created_time'] = date('Y-m-d');
                    $formArray['user_id'] = $this->ClientModel->createUserIfActive($userArray);
                }
            }

            $formArray['catagory_id'] = 1;
            $formArray['office_id'] = 0;
            $formArray['client_parent_id'] = 0;
            //user id insertion into client_info from tbl_user and get user_is for pari table
            $client_inserted_id = $this->ClientModel->createClient($formArray);

            //contact insertion
            $contactArray = array();
            $contactArray = [
                [
                    'contact_value' => $this->input->post('contact_value_1'),
                    'contact_type_id' => $this->input->post('contact_type_id_1')
                ],
                [
                    'contact_value' => $this->input->post('contact_value_2'),
                    'contact_type_id' => $this->input->post('contact_type_id_2')
                ]
            ];
            $this->ClientModel->createContacts($contactArray);
            //client employee relation = $ceRelation
            $ceRelation = array();
            $ceRelation['client_id'] = $client_inserted_id;
            $ceRelation['client_pairID'] = $this->input->post('assign_dsr');
            $explodedString = explode(".", $ceRelation['client_pairID']);
            $ceRelation['handler_id'] = end($explodedString);
            //$this->session->set_flashdata('success_clientPaid_handler_insertion', 'Client successfully created');
            $ceRelation['is_active'] = 1;
            $this->ClientModel->insertClientPairAndHandlerID($ceRelation);

            $this->session->set_flashdata('success', 'Client successfully created');
            // redirect(base_url() . 'client/clientList');
        }
    }
}
