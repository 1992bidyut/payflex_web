<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Credit extends CI_Controller{

    function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('user_id')){
            return redirect('login');
        }
        $this->load->model('user_model');
        $this->load->model('credit_model');
    }

    public function addCredit(){


        $new_remaining_credit = $this->input->post('newCredit') + $this->input->post('remainingCredit');
		
		$date = $this->input->post('startDate');
        $time = $this->input->post('scheduleTime');
        $scheduleDateAndTime = strtotime($date.$time);
        $scheduleDateAndTime = date("Y-m-d H:i:s",$scheduleDateAndTime);

        $formData = array(

            'cd_user_id'		=> $this->input->post('cdUserId'),
            'sms_credit'		=> $this->input->post('newCredit'),
            'start_date'		=> $scheduleDateAndTime,
            'end_date'			=> $this->input->post('endDate'),
            'sms_usage'			=> 0,
            'remaining_credit'	=> $new_remaining_credit,
            'accStatus'			=> 1
        );


        $creditID = $this->input->post('creditsID');

        $affected_rows = $this->credit_model->updateCreditaccStatus($creditID);

        if($affected_rows)
        {
            $insert_id = $this->credit_model->insertNewCredit($formData);

            if($insert_id)
            {
                echo 1;

                $this->session->set_flashdata('success_msg','Credit added successfully');

            }else
            {
                echo 0;

            }

        }
        elseif($affected_rows == 'updated')
        {

            $insert_id = $this->credit_model->insertNewCredit($formData);

            if($insert_id)
            {
                echo 1;

                $this->session->set_flashdata('success_msg','Credit added successfully');

            }else
            {
                echo 0;

            }

        }
        else{
            echo 0;
        }


    }


    public function clientCreditView($id){


        $creditArray = $this->credit_model->getCredits($id);
		$userName = $this->user_model->getUserInfo($id);

        $datas['content'] = $this->load->view('credit/creditView',array('credits'=>$creditArray,'userinfo'=>$userName),true);
        $this->load->view( 'layouts/main_template',$datas);
    }



}