<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Client extends CI_Controller
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

    public function clientList()
    {
        $this->load->model('ClientModel');
        $client_array = $this->ClientModel->getAllClient();
        // echo "<pre>";
        // var_dump($userNewArray);
        // die();

        $coded_ids['getDSRs'] = $this->ClientModel->getAllDSR();
        $getDSRs = $this->ClientModel->getAllDSR();
        $UserContacts['contacts'] = $this->ClientModel->getClientsContactType();
        $contactsType = $this->ClientModel->getClientsContactType();
        //        echo print_r($contactsType);
        $datas['content'] = $this->load->view(
            'client/clientShow',
            array(
                'allClient' => $client_array,
                'getDSRs' => $getDSRs,
                'contacts' => $contactsType,
            ),
            true
        );
        $this->load->view('layouts/main_template', $datas);
    }

    public function createClient()
    {
        $operation = 'insert';
        $this->load->model('ClientModel');

        $this->load->helper(array('form', 'url')); //required
        $this->load->library('form_validation'); //required

        $this->form_validation->set_rules('name', 'Distributor Name:', 'required');
        $this->form_validation->set_rules('representative_name', 'Representative Name:', 'required');
        $this->form_validation->set_rules('client_code', 'Client Code:', 'required');
        $this->form_validation->set_rules('virtual_account_no', 'Virtual A/C No:', 'required');
        $this->form_validation->set_rules('assign_dsr', 'Assign DSR', 'required');

        $client_array = $this->ClientModel->getAllClient();
        $getDSRs = $this->ClientModel->getAllDSR();
        $UserContacts['contacts'] = $this->ClientModel->getClientsContactType();
        $contactsType = $this->ClientModel->getClientsContactType();

        if ($this->form_validation->run() == false) {
            $datas['content'] = $this->load->view(
                'client/clientShow',
                array(
                    'operation' => $operation,
                    'allClient' => $client_array,
                    'getDSRs' => $getDSRs,
                    'contacts' => $contactsType,
                ),
                true
            );
            $this->load->view('layouts/main_template', $datas);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['representative_name'] = $this->input->post('representative_name');
            $formArray['client_code'] = $this->input->post('client_code');
            $formArray['virtual_account_no'] = $this->input->post('virtual_account_no');

            if ($this->input->post('is_user') == false) {
                echo "User not validated!";
                echo validation_errors();
            } else {
                // echo "User Validated!";
                $userArray = array();
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
                // if ($this->input->post('is_user') == true) {
                if ($this->form_validation->run() == true) {
                    $userArray['username'] = $this->input->post('username');
                    $userArray['password'] = sha1($this->input->post('passsword'));
                    $userArray['user_type'] = 3;
                    $userArray['created_time'] = date('Y-m-d');
                    $formArray['user_id'] = $this->ClientModel->createUserIfActive($userArray);
                }

                //}
            }

            $formArray['catagory_id'] = 1;
            $formArray['office_id'] = 0;
            $formArray['client_parent_id'] = 0;
            $formArray['created_date_time'] = date('Y-m-d');
            $formArray['is_active'] = $this->input->post('is_active');
            //user id insertion into client_info from tbl_user and get user_is for pari table
            //if ($this->form_validation->run('createClient') == true) {
            $client_inserted_id = $this->ClientModel->createClient($formArray);
            //}

            //contact insertion
            $contactArray = array();
            $contactArray = [
                [
                    'contact_value' => $this->input->post('contact_value_1'),
                    'contact_type_id' => $this->input->post('contact_type_id_1'),
                    'owner_id' => $client_inserted_id,
                    'owner_type' => 3,
                ],
                [
                    'contact_value' => $this->input->post('contact_value_2'),
                    'contact_type_id' => $this->input->post('contact_type_id_2'),
                    'owner_id' => $client_inserted_id,
                    'owner_type' => 3,
                ],
            ];
            //if ($this->form_validation->run('contactValue') == TRUE) {
            $this->ClientModel->createContacts($contactArray);
            //}
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
            redirect(base_url() . 'client/clientList');
        }
    }



    //TODO: "create update function" - Mohsin
    public function updateClient($client_id)
    {
        $operation = 'update';
        $this->load->model('ClientModel');

        $this->load->helper(array('form', 'url')); //required
        $this->load->library('form_validation'); //required

        $client_info = $this->ClientModel->getClient($client_id);

        $this->form_validation->set_rules('name', 'Distributor Name:', 'required');
        $this->form_validation->set_rules('representative_name', 'Representative Name:', 'required');
        $this->form_validation->set_rules('client_code', 'Client Code:', 'required');
        $this->form_validation->set_rules('virtual_account_no', 'Virtual A/C No:', 'required');

        $client_array = $this->ClientModel->getAllClient();
        $getDSRs = $this->ClientModel->getAllDSR();
        $UserContacts['contacts'] = $this->ClientModel->getClientsContactType();
        $contactsType = $this->ClientModel->getClientsContactType();
        if ($this->form_validation->run() == false) {

            $datas['content'] = $this->load->view(
                'client/clientShow',
                array(
                    'operation' => $operation,
                    'client_info' => $client_info,
                    'allClient' => $client_array,
                    'getDSRs' => $getDSRs,
                    'contacts' => $contactsType,
                ),
                true
            );
            $this->load->view('layouts/main_template', $datas);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['representative_name'] = $this->input->post('representative_name');
            $formArray['client_code'] = $this->input->post('client_code');
            $formArray['virtual_account_no'] = $this->input->post('virtual_account_no');

            $this->ClientModel->updateClient($client_id, $formArray);
            $this->session->set_flashdata('success', 'Client successfully updated.');
            redirect(base_url() . 'client/clientList');
        }
    }

    //    public function createClient2()
    //    {
    //
    //        $this->load->model('ClientModel');
    //        $this->load->library('form_validation');
    //        $this->form_validation->set_rules('name', 'Distributor Name', 'required');
    //        $this->form_validation->set_rules('representative_name', 'Representative Name', 'required');
    //        $this->form_validation->set_rules('client_code', 'Client Code', 'required');
    //        $this->form_validation->set_rules('virtual_account_code', 'Virtual A/C no.', 'required');
    //        $this->form_validation->set_rules('username', 'Username', 'required');
    //        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
    //        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
    //
    //        // echo "Info validated!";
    //        $formArray = array();
    //        $formArray['name'] = $this->input->post('name');
    //        $formArray['representative_name'] = $this->input->post('representative_name');
    //        $formArray['client_code'] = $this->input->post('client_code');
    //        $formArray['virtual_account_no'] = $this->input->post('virtual_account_no');
    //
    //        $client_array = $this->ClientModel->getAllClient();
    //        // $coded_ids['getDSRs'] = $this->ClientModel->getAllDSR();
    //        $getDSRs = $this->ClientModel->getAllDSR();
    //        // $UserContacts['contacts'] = $this->ClientModel->getClientsContactType();
    //        $contactsType = $this->ClientModel->getClientsContactType();
    //        //        echo print_r($contactsType);
    //
    //        //  if ($this->input->post('is_user') == true) {
    //        if ($this->form_validation->run() == false) {
    //            $datas['content'] = $this->load->view('client/createClient',
    //                array(
    //                    'allClient' => $client_array,
    //                    'getDSRs' => $getDSRs,
    //                    'contacts' => $contactsType,
    //                ), true);
    //            $this->load->view('layouts/main_template', $datas);
    //        } else {
    //            $formArray['catagory_id'] = 1;
    //            $formArray['office_id'] = 0;
    //            $formArray['client_parent_id'] = 0;
    //            $formArray['is_active'] = $this->input->post('is_active');
    //            //user id insertion into client_info from tbl_user and get user_is for pari table
    //            //if ($this->form_validation->run('createClient') == true) {
    //            $client_inserted_id = $this->ClientModel->createClient($formArray);
    //
    //            //client employee relation = $ceRelation
    //            $ceRelation = array();
    //            $ceRelation['client_id'] = $client_inserted_id;
    //            $ceRelation['client_pairID'] = $this->input->post('assign_dsr');
    //            $explodedString = explode(".", $ceRelation['client_pairID']);
    //            $ceRelation['handler_id'] = end($explodedString);
    //            $ceRelation['is_active'] = 1;
    //            $this->ClientModel->insertClientPairAndHandlerID($ceRelation);
    //
    //            $userArray = array();
    //
    //            if ($this->form_validation->run() == true) {
    //                $userArray['username'] = $this->input->post('username');
    //                $userArray['password'] = sha1($this->input->post('passsword'));
    //                $userArray['user_type'] = 3;
    //                $userArray['created_time'] = date('Y-m-d');
    //                $formArray['user_id'] = $this->ClientModel->createUserIfActive($userArray);
    //            }
    //            //contact insertion
    //            $contactArray = array();
    //            $contactArray = [
    //                [
    //                    'contact_value' => $this->input->post('contact_value_1'),
    //                    'contact_type_id' => $this->input->post('contact_type_id_1'),
    //                    'owner_id' => $client_inserted_id,
    //                    'owner_type' => 3,
    //                ],
    //                [
    //                    'contact_value' => $this->input->post('contact_value_2'),
    //                    'contact_type_id' => $this->input->post('contact_type_id_2'),
    //                    'owner_id' => $client_inserted_id,
    //                    'owner_type' => 3,
    //                ],
    //            ];
    //            if ($this->form_validation->run('contactValue') == true) {
    //                $this->ClientModel->createContacts($contactArray);
    //            }
    //
    //
    //            $this->session->set_flashdata('success', 'Client successfully created');
    //            redirect(base_url() . 'client/clientList');
    //        }
    //    }
}
