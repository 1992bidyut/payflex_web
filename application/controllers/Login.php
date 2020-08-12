<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        if($this->session->userdata('user_id'))
        {
            return redirect('dashboard');
        }
        $this->load->view('user/loginPage');
    }

    public function login(){
        $this->load->library('form_validation');
        if($this->form_validation->run('login') == FALSE){
            $this->load->view('user/loginPage');
        }else{
            $username  = $this->input->post('username');
            $password   = sha1($this->input->post('password'));
            // echo "<pre>";
            // var_dump($username);
            // var_dump($password);
            // die();
            $user_array = $this->user_model->loginValid($username,$password);
            echo print_r($user_array);
//            if($user_array['user_type'] == 3 || $user_array['permission'] == 1 )
            if($user_array['user_type'] != 3){
                $this->session->set_userdata(
                    array(
                        'user_id'       => $user_array['id'],
                        'user_name'     => $user_array['username'],
                      //  'user_role_id'  => $user_array['role_id'],
                      //  'user_parent_id'=> $user_array['parent_id']
                    )
                );
                //$this->session->set_flashdata('success_msg','Login Success');
                return redirect('dashboard');
            } elseif($user_array['user_type'] == 3)
            {
                $this->session->set_flashdata('error_msg','Sorry! You are not authorize to login here!');
                $this->load->view('user/loginPage');
            }
            else{
                $this->session->set_flashdata('error_msg','User name or Password did not matched!');
                $this->load->view('user/loginPage');
            }
        }
    }
    public function logout(){
        // $this->session->unset_userdata();
        $this->session->sess_destroy();
        return redirect('login');
    }
}
