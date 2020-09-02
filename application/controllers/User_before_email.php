<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

    function __construct() {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            return redirect('login');
        }

        $this->load->model('user_model');
        $this->load->config('infobuzzerConfig');

    }


    public function userList()
    {

        $totalSent       = $this->user_model->totalSent();
        $totalPending    = $this->user_model->totalPending();
        $user_array      = $this->user_model->getAllUser();
        $userCreditArray = $this->user_model->getUserCreditInfo();





        foreach($user_array as $userArray)
        {
            $userArray['totalPending']=0;
            $userArray['totalSent']=0;
            $userArray['remaining_credit']=0;
            $userNewArray[$userArray['cd_user_id']] = $userArray;
        }



        foreach($userCreditArray as $userCredit)
        {
            $userNewArray[$userCredit['cd_user_id']] = array_merge($userNewArray[$userCredit['cd_user_id']], $userCredit);
        }

//        echo'<pre />';
//        print_r($userNewArray);
//        die();


        foreach($totalPending as $totalPendingDatam)
        {
            $userNewArray[$totalPendingDatam['cd_user_id']] = array_merge($userNewArray[$totalPendingDatam['cd_user_id']], $totalPendingDatam);
        }

//        echo'<pre />';
//        print_r($totalPending);
//        die();


        foreach($totalSent as $totalSentDatam)
        {
            $userNewArray[$totalSentDatam['cd_user_id']] = array_merge($userNewArray[$totalSentDatam['cd_user_id']], $totalSentDatam);
        }


        $datas['content'] = $this->load->view('user/usersList', array('users'=>$userNewArray), true);

        $this->load->view( 'layouts/main_template',$datas);
    }



    public function createUser(){

        $this->load->model('role_model');
        $this->load->model('CountryCodeModel');
        $countries = $this->CountryCodeModel->getAllCountry();


        $roles_array = $this->role_model->getAllRole();

        $datas['content'] = $this->load->view('user/createUser', array('roles'=>$roles_array,'countries'=>$countries), true);

        $this->load->view( 'layouts/main_template',$datas);

    }
    public function getCountryCode($id){



        $this->load->model('CountryCodeModel');

        $countries = $this->CountryCodeModel->getCountryCodeByID($id);

        echo $countries['code'];

    }

    public function userStore(){

        $this->load->library('form_validation');

        if($this->form_validation->run('userStoreRules') == FALSE)
        {

            $this->load->model('role_model');
            $roles_array = $this->role_model->getAllRole();
            $this->load->model('CountryCodeModel');
            $countries = $this->CountryCodeModel->getAllCountry();

            $datas['content'] = $this->load->view('user/createUser', array('roles'=>$roles_array,'countries'=>$countries), true);

            $this->load->view( 'layouts/main_template',$datas);
        }
        else
        {

            $posts = array(
                'username'      => $this->input->post('email'),
                'password'      => sha1($this->input->post('password')),
                'role_id'       => $this->input->post('userRoleId'),
                'countries_id'  => $this->input->post('countryID'),
                'parent_id'     => $this->config->item('parent_id')

            );


            $cd_user_id = $this->user_model->createUserStepOne($posts);

            if($cd_user_id){

                $forContactInformationTbl = array(
                    'cd_user_id'=> $cd_user_id,
                    'full_name' => $this->input->post('fullUserName'),
                    'is_parent' => $this->config->item('parent_id')
                );

                $contact_information_id = $this->user_model->createUserFinalStep($forContactInformationTbl);

                if($contact_information_id)
                {

                    $data_contact_info_email = array(
                        'contact_information_id' => $contact_information_id,
                        'contact_text' => $this->input->post('email'),
                        'contact_type_id' => '2'
                    );

                    $data_contact_info_mobile = array(
                        'contact_information_id' => $contact_information_id,
                        'contact_text' => $this->input->post('contact'),
                        'contact_type_id' => '1'
                    );

                    $this->db->insert('contact_info', $data_contact_info_mobile);
                    $this->db->insert('contact_info', $data_contact_info_email);

                    $this->session->set_flashdata('success_msg','User created successfully!');
                    redirect('user/createUser');

                    //FOR DEFAULT ROUTE
//                    $defaultRouteInfoArray = array(
//
//                        'user_id'           => $cd_user_id,
//                        'operator_route_id' => $this->config->item('operatorRouteID'),
//                        'operator_id'       => $this->config->item('operator_id'),
//                        'terrif'            => $this->config->item('standardPrice')
//                    );

//                    $this->load->model('OperatorRouteModel');

//                    $operator_user_id = $this->OperatorRouteModel->userRouteStore($defaultRouteInfoArray);

//                    if($operator_user_id)
//                    {
//                        $this->session->set_flashdata('success_msg','User created successfully!');
//                        redirect('user/createUser');
//                    }
//                    else
//                    {
//                        $this->session->set_flashdata('error_msg','Default route not set!');
//                        redirect('user/createUser');
//                    }

                }
                else
                {
                    $this->session->set_flashdata('error_msg','Failed to store contact_info');
                    redirect('user/createUser');
                }

            }
            else
            {
                $this->session->set_flashdata('error_msg','Failed to create User');
                redirect('user/createUser');
            }

        }


    }

    public function userEdit($id){

        $userInfoArray = $this->user_model->getUserInfo($id);


        $datas['content'] = $this->load->view('user/updateUser', array('users'=>$userInfoArray), true);

        $this->load->view( 'layouts/main_template',$datas);
    }

    public function userUpdate(){

        $this->load->library('form_validation');

        if($this->form_validation->run('updatePassword') == FALSE)
        {
            $this->session->set_flashdata('error_msg','Failed to update!');
            redirect(base_url('User/userEdit/').$_POST[cd_user_id]);
        }
        else
        {
            $id = $this->input->post('cd_user_id');
            $posts = array(
                'password' => sha1($this->input->post('password'))
            );

            $updatedBooleanReturn = $this->user_model->updatePassword($id,$posts);

            $this->session->set_flashdata('success_msg','Password successfully updated');
            redirect('user/userList');
        }

    }

    public function userDestroy($id){

        $posts = array(
            'status'=>'-1'
        );

        $inactiveBooleanReturn = $this->user_model->inactiveUser($id, $posts);

        if($inactiveBooleanReturn){
            $this->session->set_flashdata('success_msg','User inactive successfully');
            redirect('user/userList');
        }
        else
        {
            $this->session->set_flashdata('error_msg','User not inactive!');
            redirect('user/userList');
        }


    }

    public function userActive($id){

        $posts = array(
            'status'=>'1'
        );

        $activeBooleanReturn = $this->user_model->activeUser($id, $posts);

        if($activeBooleanReturn){
            $this->session->set_flashdata('success_msg','User active successfully');
            redirect('user/userList');
        }
        else
        {
            $this->session->set_flashdata('error_msg','User not active!');
            redirect('user/userList');
        }


    }

    public function clientCreditView($id){



    }


	
}

?>