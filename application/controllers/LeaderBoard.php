<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LeaderBoard extends CI_Controller{
    function __construct() {
        parent::__construct();
		if(empty($this->session->userdata('user_id'))){
			return redirect('login');
		}
		$this->load->model('LeaderBoardModel');
    }
    
    public function index()
	{
		$leaderBoardData = $this->LeaderBoardModel->searchPaymentInfo();
		//var_dump($leaderBoardData);
		$dataArray = array('paymentInfoArray'=>$leaderBoardData);
		$datas['content'] = $this->load->view('leader/leader', $dataArray, true);
		$this->load->view( 'layouts/main_template',$datas);
	}

	public function exportFinanceData(){
//        $getDate="2020-08-12";
        $getDate= date("Y-m-d");
//        echo $getDate;
        $rawData = $this->LeaderBoardModel->getFinancierExportData((string)$getDate);
//        echo print_r($rawData);
        $exportedData=array();
        for ($count=0; $count<count($rawData); $count++){
            $temp=array();
            $temp['INDENT DATE']="";
            $temp['CODE']=$rawData[$count]['client_code'];
            $temp['DISTRIBUTOR NAME']=$rawData[$count]['name'];
            $temp['BANK DETAILS']=$rawData[$count]['bank_name']."-".$rawData[$count]['methode_name'];
            $temp['']=$rawData[$count]['bank_name']."-".$rawData[$count]['methode_name']
            ."/".$rawData[$count]['submitted_date']."/".$rawData[$count]['client_code']."/".$rawData[$count]['amount'];
            $temp['AMOUNT']=$rawData[$count]['amount'];
            $temp['PAYMENT DATE']=$rawData[$count]['submitted_date'];
            $exportedData[$count]=$temp;
//            echo print_r($temp)."</br>";
        }
        $this->load->library('export_excel');
        $this->export_excel->exportData($exportedData);
    }
}
?>