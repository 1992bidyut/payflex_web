<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SMSLog extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        if(empty($this->session->userdata('user_id'))){
            return redirect('login');
        }

        $this->load->model('SMSLogModel');
    }

    public function smsLogShow($id)
    {


        $smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();

//        echo'<pre />';
//        print_r($smsStatusArray);
//        die();

        $datas['content'] = $this->load->view('report/sms_log_view',array('smsStatuses'=>$smsStatusArray,'cd_uer_id'=>$id),true);
        $this->load->view( 'layouts/main_template',$datas);

    }

    public function smsSearch()
    {
        $values = $this->input->get();

        $num_rows_array = $this->SMSLogModel->searchSmsNumRows($this->input->get('userId'));

//        echo'<pre />';
//        print_r($num_rows_array);
//        die();

        $this->load->library('pagination');

        $config['base_url']         = base_url('SMSLog/smsSearch');
        $config['suffix']           = '?'.http_build_query($values);
        $config['total_rows']       = count($num_rows_array);
        $config['per_page']         = 50;
        $config['full_tag_open']    = "<ul class='pagination pull-right'>";
        $config['full_tag_close']   = "</ul> <div class='clearfix'></div> ";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li  class="active"> <a>';
        $config['cur_tag_close']    = '</a></li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';

        $config['next_link'] = 'Next &raquo;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);


        $smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();


        $limit = $config['per_page'];
        $offset = $this->uri->segment(3);

        $smsSearchResultArray = $this->SMSLogModel->searchSMS($this->input->get('userId'),$limit,$offset);
		
		// echo $this->db->last_query();
		// die;


        $datas['content'] = $this->load->view('report/sms_log_view',array(
            'smsArray'=>$smsSearchResultArray,
            'smsStatuses'=>$smsStatusArray,
            'links'=>$this->pagination->create_links(),
            'numRows'=>count($num_rows_array),
            'segment'=>$this->uri->segment(3),
            'cd_uer_id'=>$this->input->get('userId'),
			'getValues'=>$values

        ),true);
        $this->load->view( 'layouts/main_template',$datas);
    }


    // public function viewLogFile($id,$userId,$trxId)
    // {


        // $smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();


        // $MyFiletest = $id.'_'.$userId.'_'.$trxId.'.txt';

        // $MyFileRead = file_get_contents('E:/Worksop/logfiles/'.$MyFiletest);

        // $datas['content'] = $this->load->view('report/sms_log_view',array('smsStatuses'=>$smsStatusArray,'cd_uer_id'=>$userId,'MyFileRead'=>$MyFileRead),true);
        // $this->load->view( 'layouts/main_template',$datas);
        // print_r($MyFileRead);

    // }
	
	public function viewLogFile()
    {
		



        $smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();

        $date = $this->input->post('date');
        $id = $this->input->post('id');
        $userId = $this->input->post('userid');
        $trxId = $this->input->post('trxid'); 
		
		// $date = '2017-09-20';
        // $id = '323355';
        // $userId = '23';
        // $trxId = '002300000059c219ca374df';

//        echo'<pre />';
//        print_r($this->input->post());
//        die();

        

        $MyFiletest = $id.'_'.$userId.'_'.$trxId.'.txt';
		
		


        @$MyFileRead = file_get_contents('/home/ubuntu/InfobuzzerLog/'.$date.'/'.$MyFiletest);
		
		
        // $logFileData = unserialize($MyFileRead);
        $logFileData =json_encode($MyFileRead);

        if($logFileData)
        {
            echo $MyFileRead;
        }
        else
        {
            echo 'No Log File Found';
        }



    }
	
	public function smsResend(){
        
		// GETTING SMS STATUS CODE AND STATUS GROUP AS ARRAY
		
        $smsStatus = $this->SMSLogModel->getSmsStatusbyGroupId($this->input->post('smsStatusCode'));


        $post = array(
            'userId'=>$this->input->post('userId'),
            'contact'=>$this->input->post('contact'),
            'from'=>$this->input->post('from'),
            'to'=>$this->input->post('to'),
            'smsBody'=>$this->input->post('smsBody'),
            'smsStatusCode'=>$smsStatus
        );
		
		
		// SMS STATUS IS UPDATING AS 0 OR -7 TO RESEND
        
        $smsStatusArray = $this->SMSLogModel->updateAll($post);
        

        if($smsStatusArray)
        {
            $this->session->set_flashdata('success_msg','All SMS successfully resent!');
            redirect(base_url('SMSLog/smsLogShow/').$post['userId']);
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to resent');
            redirect(base_url('SMSLog/smsLogShow/').$post['userId']);
        }


    }



}

?>
