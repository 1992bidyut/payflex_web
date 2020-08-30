<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FinanceReport extends CI_Controller{
    function __construct() {
        parent::__construct();
        if(empty($this->session->userdata('user_id'))){
            return redirect('login');
        }
        $this->load->model('Payment_Model');
    }

    public function index()
    {
        $getDate= date("Y-m-d");
        //set filter date in session
        $sessionData=$this->session->userdata();
        $sessionData['fin_from']=(string)$getDate;
        $sessionData['fin_to']=(string)$getDate;
        $this->session->set_userdata($sessionData);

        $financeData = $this->Payment_Model->getFinancierExportData((string)$getDate,(string)$getDate);
//        echo print_r($financeData);
        $dataArray = array('financeData'=>$financeData,);
        $datas['content'] = $this->load->view('finance/finance_report', $dataArray, true);
        $this->load->view( 'layouts/main_template',$datas);
        //
    }

    public function exportFinanceData(){
//        $getDate="2020-08-12";
        $sessionNewData=$this->session->userdata();
        $toDate=$sessionNewData['fin_to'];
        $fromDate=$sessionNewData['fin_from'];

        $getDate= date("Y-m-d");
//        echo $getDate;
        $rawData = $this->Payment_Model->getFinancierExportData($fromDate,$toDate);
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
        $this->export_excel->exportData($exportedData,"finance_report".$toDate.$fromDate);
    }
}
?>