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


	public function userList(){

        // // // $totalSent       = $this->user_model->totalSent();
        // // // $totalPending    = $this->user_model->totalPending();
        $user_array      = $this->user_model->getAllUser();



        // echo "<pre>";
        // var_dump($userNewArray);
        // die();
        $datas['content'] = $this->load->view('user/usersList', array('users'=>$user_array), true);

        $this->load->view( 'layouts/main_template',$datas);
    }


     public function createUser(){

        // $this->load->model('role_model');
        // $this->load->model('CountryCodeModel');
        // $countries = $this->CountryCodeModel->getAllCountry();


        // $roles_array = $this->role_model->getAllRole();

        // $datas['content'] = $this->load->view('user/createUser', array('roles'=>$roles_array,'countries'=>$countries), true);

        // $this->load->view( 'layouts/main_template',$datas);

        $this->load->model('User_model');
        $user_type = $this->User_model->getAllUserType();

        // print_r($user_type);
        // exit();



        $datas['content'] = $this->load->view('user/createUser',array('userTypes'=>$user_type),true);
        $this->load->view('layouts/main_template',$datas);

  
        
        

    }  

  public function getCountryCode($id){



        $this->load->model('CountryCodeModel');

        $countries = $this->CountryCodeModel->getCountryCodeByID($id);

        echo $countries['code'];

    }

public function userStore(){
        $this->load->model('User_model');
        $this->User_model->newUserStore();
        //return redirect()->back()->with('success','This Data is Used anywhere ! ');
        // return redirect('user/createUser')->with('success','This Data is Used anywhere ! ');
        $this->session->set_flashdata('msg', 'User Store Successfully ..! ');
        redirect('user/createUser');

    }






    public function userEdit($id){

        $userInfoArray = $this->user_model->getUserInfo($id);


        $datas['content'] = $this->load->view('user/updateUser', array('users'=>$userInfoArray), true);

        $this->load->view( 'layouts/main_template',$datas);
    }

    public function userUpdate(){

        $this->load->library('form_validation');
							
        if($this->form_validation->run('updateUser') == FALSE)
        {
            $this->session->set_flashdata('error_msg','Failed to update!');
            redirect(base_url('User/userEdit/').$_POST[cd_user_id]);
        }
        else
        {
            $id = $this->input->post('cd_user_id');
	if($this->input->post('password')!=NULL)
	{
            $posts = array(
		'email' => $this->input->post('email'),
                'password' => sha1($this->input->post('password'))
            );

            $updatedBooleanReturn = $this->user_model->updatePassword($id,$posts);

            $this->session->set_flashdata('success_msg','Password successfully updated');
            redirect('user/userList');
	}else{
		$posts = array('email' => $this->input->post('email'));
		$updatedBooleanReturn = $this->user_model->updatePassword($id,$posts);
				
		$this->session->set_flashdata('success_msg','Successfully updated');
		redirect('user/userList');
		}
		

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
