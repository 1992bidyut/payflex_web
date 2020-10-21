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
        $getDate= $this->getServerDate();

        $date = strtotime($getDate);
        $date = strtotime("-1 day", $date);
        $startDate=date("Y-m-d", $date);
        //set filter date in session
        $sessionData=$this->session->userdata();
        $sessionData['fin_from']=$startDate;
        $sessionData['fin_to']=(string)$getDate;
        $this->session->set_userdata($sessionData);

        $financeData = $this->Payment_Model->getFinancierExportData($startDate,(string)$getDate);
//        echo print_r($financeData);
        $dataArray = array('financeData'=>$financeData,);
        $datas['content'] = $this->load->view('finance/finance_report', $dataArray, true);
        $this->load->view( 'layouts/main_template',$datas);
        //
    }

    public function exportFinanceData(){
        $sessionNewData=$this->session->userdata();
        $toDate=$sessionNewData['fin_to'];
        $fromDate=$sessionNewData['fin_from'];
        $rawData = $this->Payment_Model->getFinancierExportData($fromDate,$toDate);
//        echo print_r($rawData);
        $exportedData=array();
        for ($count=0; $count<count($rawData); $count++){
            $temp=array();
            if ($rawData[$count]['indent_no']!=null){
                $temp['INDENT NO.']=$rawData[$count]['indent_no'];
            }else{
                $temp['INDENT NO.']="";
            }
            if ($rawData[$count]['indent_date']!=null){
                $temp['INDENT DATE']=$rawData[$count]['indent_date'];
            }else{
                $temp['INDENT DATE']="";
            }
            $temp['CODE']=$rawData[$count]['client_code'];
            $temp['DISTRIBUTOR NAME']=$rawData[$count]['name'];
            if ($rawData[$count]['methode_id']!=2){
                $temp['BANK DETAILS']=$rawData[$count]['bank_name']."-".$rawData[$count]['reference_no'];
            }else{
                $temp['BANK DETAILS']=$rawData[$count]['methode_name'];
            }

            if ($rawData[$count]['methode_id']!=2){
                $temp['']=$rawData[$count]['bank_name']."-".$rawData[$count]['reference_no']
                    ."/".$rawData[$count]['payment_date_time']."/".$rawData[$count]['client_code']."/".$rawData[$count]['amount'];
            }else{
                $temp['']=$rawData[$count]['methode_name']
                    ."/".$rawData[$count]['payment_date_time']."/".$rawData[$count]['client_code']."/".$rawData[$count]['amount'];
            }

            $temp['AMOUNT']=$rawData[$count]['amount'];
            $temp['PAYMENT DATE']=$rawData[$count]['payment_date_time'];
            if ($rawData[$count]['collection_no']!=null){
                $temp['COLLECTION NO.']=$rawData[$count]['collection_no'];
            }else{
                $temp['COLLECTION NO.']="";
            }
            $temp['VIRTUAL ACCOUNT NO.']=$rawData[$count]['virtual_account_no'];
            $exportedData[$count]=$temp;
//            echo print_r($temp)."</br>";
        }

        $this->load->library('export_excel');
        $this->export_excel->exportData($exportedData,"finance_report".$toDate.$fromDate);
    }

    private function getServerDate(){
        $this->load->model('LeaderBoardModel');
        $getDate= date("Y-m-d H:m:s");
        $getDate = strtotime($getDate);
        $getDate = strtotime("-0 h", $getDate);
        return $getDate=date("Y-m-d", $getDate);
    }
}
?>