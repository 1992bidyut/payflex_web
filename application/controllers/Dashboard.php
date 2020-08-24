<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

    function __construct() {
        parent::__construct();

		if(!$this->session->userdata('user_id')){
			return redirect('login');
		}
		$this->load->model('MsgOutboxModel');
		$this->load->model('MaskModel');

        $this->load->model('DashboardsModel');

    }

    function index(){

		//	$totalMaskRequest = $this->MaskModel->getTotalMaskRequestCount();
			$totalMaskRequest = 0;
		    $this->session->set_userdata('currentMaskRequest',$totalMaskRequest);
			$datas['content'] = $this->load->view('dashboard/dashboard', array('currentMaskRequest'=>$totalMaskRequest), true);
			$this->load->view( 'layouts/main_template',$datas);

	}


    function redirectMaskRequestView(){
			$totalMaskRequest = $this->MaskModel->getTotalMaskRequestCount();
		    $this->session->set_userdata('currentMaskRequest',$totalMaskRequest);
			$datas['content'] = $this->load->view('dashboard/dashboard', array('currentMaskRequest'=>$totalMaskRequest), true);
			$this->load->view( 'layouts/main_template',$datas);
			redirect('Mask/userMaskInfoShow');
	}
	
	
	public function totalSuccessSmsCount()
	{
		$totalSuccessSms = $this->MsgOutboxModel->totalSuccessSmsCount();

		echo $totalSuccessSms;
	}

	public function totalPendingSmsCount()
	{
		$totalPendingSms = $this->MsgOutboxModel->totalPendingSmsCount();

		echo $totalPendingSms;
	}

	public function todaySuccessSmsCount()
	{
		$todaySuccessSms = $this->MsgOutboxModel->todaySuccessSmsCount();

		echo $todaySuccessSms;
	}

	public function todayPendingSmsCount()
	{
		$todayPendingSms = $this->MsgOutboxModel->todayPendingSmsCount();

		echo $todayPendingSms;
	}
	
	
	
	public function orderCounts($startingDate = null , $endingDate = null )
	{


        if(empty($startingDate))
        {
            //$startingDate = "20200602";    
            $startingDate = date('Y-m-d');    
        }
        if(empty($startingDate))
        {
            //$endingDate = "20200607";
            $endingDate = date('Y-m-d');    
        }
        
        $theOderCounts	 = $this->DashboardsModel->orderCounts($startingDate, $endingDate);
		echo $theOderCounts;

	}
	
	public function paymentCounts($startingDate = null , $endingDate = null )
	{
        $thePaymentCounts	 = $this->DashboardsModel->paymentCounts($startingDate, $endingDate);
		echo $thePaymentCounts;
	}
	
	public function validatedPaymentCounts($startingDate = null , $endingDate = null )
	{
        $thePaymentCounts	 = $this->DashboardsModel->validePaymentCounts($startingDate, $endingDate);
		echo $thePaymentCounts;
	}

    public function targetPayment($startingDate = null , $endingDate = null )
    {
        $thePaymentCounts	 = $this->DashboardsModel->todayTargetPayment($startingDate, $endingDate);
        echo $thePaymentCounts;
    }
	


}

