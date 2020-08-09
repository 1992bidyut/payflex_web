<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller{

    function __construct() {
        parent::__construct();

		if(empty($this->session->userdata('user_id'))){
			return redirect('login');
		}
		$this->load->model('MsgOutboxModel');
		$this->load->model('User_model');
		$this->load->model('SMSLogModel');
		$this->load->model('credit_model');

    }

    function index()
	{

		$users = $this->User_model->getAllUserData();
		$smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();
		
		$searchResultArrayForGraph = $this->SMSLogModel->currentMonthSMSReport();


		$datas['content'] = $this->load->view('report/dashboardReport', array('users'=>$users,'smsStatusArray'=>$smsStatusArray, 'searchResultArrayForGraph' => $searchResultArrayForGraph), true);

		$this->load->view( 'layouts/main_template',$datas);
	}


	public function reportSearch()
	{
		$from 		   = $this->input->post('from');
		$to			   = $this->input->post('to');
		$user          = $this->input->post('clientId');
		$smsStatusCode = $this->input->post('smsStatusCode');

		$newdata = array(
				'fromForSmsSearch'		=> $from,
				'toIdForSmsSearch'		=> $to,
				'userIdForSmsSearch'	=> $user,
				'smsStatusCode'			=> $smsStatusCode

		);

		$this->session->set_userdata($newdata);


		$users = $this->User_model->getAllUserData();
		$smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();


		$searchResultArray = $this->SMSLogModel->searchSMSCount();
		
		$searchResultArrayForGraph = $this->SMSLogModel->searchSMSCountGroupByDate();


		$datas['content'] = $this->load->view('report/dashboardReport', array('users'=>$users,'smsStatusArray'=>$smsStatusArray,'searchResultArray'=>$searchResultArray, 'searchResultArrayForGraph'=>$searchResultArrayForGraph), true);

		$this->load->view( 'layouts/main_template',$datas);
	}

	public function creditReport()
	{


		$users = $this->User_model->getAllUserData();

		$user          = $this->input->post('clientId');

		$newdata = array(
				'userIdForSmsSearch'	=> $user

		);

		$this->session->set_userdata($newdata);

		$creditHistoryArray = $this->credit_model->getCreditsGroupByDate();


		$datas['content'] = $this->load->view('report/creditReport', array('users'=>$users, 'creditHistoryArray'=>$creditHistoryArray), true);

		$this->load->view( 'layouts/main_template',$datas);
	}

	public function smsReportByUserView()
	{
		$users 			= $this->User_model->getAllUserData();
		$smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();


		$datas['content'] = $this->load->view('report/smsReportUserBased', array('users'=>$users,'smsStatusArray'=>$smsStatusArray), true);

		$this->load->view( 'layouts/main_template',$datas);

	}

	public function smsReportByUser()
	{


		$users 			= $this->User_model->getAllUserData();
		$smsStatusArray = $this->SMSLogModel->getAllSmsStatusGroup();




		$smsReportArray = $this->SMSLogModel->smsReportByUserAndStatus();


		$datas['content'] = $this->load->view('report/smsReportUserBased', array('users'=>$users,'smsStatusArray'=>$smsStatusArray,'smsReportArray'=>$smsReportArray), true);
		$this->load->view( 'layouts/main_template',$datas);


	}


	public function reportSearchWithPagination($status_group_name)
	{
		$status_group_name = urldecode($status_group_name);
		$from = $this->session->userdata('fromForSmsSearch');
        $to = $this->session->userdata('toIdForSmsSearch');
        $user = $this->session->userdata('userIdForSmsSearch');
        // $smsStatusCode = $this->session->userdata('smsStatusCode');

        if($status_group_name == 'Success')
        {
        	$smsStatusCode = 1;
        }
        elseif ($status_group_name == 'Pending')
        {
        	$smsStatusCode = 2;
        }
        elseif ($status_group_name == 'Failed')
        {
        	$smsStatusCode = 3;
        }
        elseif ($status_group_name == 'Waiting For Approval')
        {
        	$smsStatusCode = 4;
        }
        else
        {
        	$smsStatusCode = 5;
        }


        $numRowsArray = $this->SMSLogModel->searchSMSPaginationCount($from,$to,$user,$smsStatusCode);

		foreach ($numRowsArray as $RowsArray) {

			if($RowsArray['status_group_name'] == $status_group_name)
	        {
	        	$numRows = $RowsArray['totalSms'];
	        }
	        break;

		}


		$this->load->library('pagination');

		$segment = $this->uri->segment(4);
		$config['base_url']         = base_url('Report/reportSearchWithPagination/').$status_group_name;
		$config['total_rows']       = $numRows;
		$config['per_page']         = 20;
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

		$searchResultArray = $this->SMSLogModel->searchSMSCountWithPagination($from,$to,$user,$smsStatusCode,$segment);

		$datas['content'] = $this->load->view('report/smsDetailesReport', array(
		'searchResultArray'=>$searchResultArray,
		'links'=>$this->pagination->create_links(),
		'numRows'=>$numRows,
		'segment'=>$segment
		), true);

		$this->load->view( 'layouts/main_template',$datas);

	}

	public function leader(){
		$datas['content'] = $this->load->view('leader/leader', array(), true);
		$this->load->view( 'layouts/main_template',$datas);
	}




}

