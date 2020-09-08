<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SendSMS extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            return redirect('login');
        }
        $this->load->model('MaskModel');
        $this->load->model('SendSMSModel');
        $this->load->model('MsgOutboxModel');

    }

    //FRO GENERATING UNIQUE NUMBER USING MICRO SECOND
    public function udate()
    {
        $m = explode(' ',microtime());
        list($totalSeconds, $extraMilliseconds) = array($m[1], (int)round($m[0]*1000,3));
        return date("YmdHis", $totalSeconds) . sprintf('%03d',$extraMilliseconds) ;
    }


    public function smsStore($id){



        $this->load->model('user_model');

        $userArray = $this->user_model->getUserInfo($id);

        $this->session->set_userdata('panelSMSOwnerId',$userArray['id']);
        $this->session->set_userdata('panelSMSOwnerName',$userArray['username']);

        $this->load->helper('string'); //FOR GENERATING RANDOM NUMBER

        $this->load->library('form_validation');

        if($this->form_validation->run('sendSMSFromPanel') == FALSE)
        {

            $this->session->set_flashdata('error_msg','Failed to send SMS From panel!');
            redirect(base_url('SendSMS/sendSMSByExcel/').$this->session->userdata('panelSMSOwnerId'));
        }
        else
        {
            if(isset($_POST['scheduleDate']) && isset($_POST['scheduleTime'])) {
                $date = $this->input->post('scheduleDate');
                $time = $this->input->post('scheduleTime');
                $scheduleDateAndTime = strtotime($date.$time);
                $scheduleDateAndTime = date("Y-m-d H:i:s",$scheduleDateAndTime);
            }
            else
            {
                $scheduleDateAndTime = date("Y-m-d H:i:s");
            }


            $posts = array(
                'contact_text'  => explode(',',$this->input->post('contact'))
            );


            $i=0;
            foreach($posts['contact_text']  as $smsData){

                $SMSArray[$i]['cd_user_id']     = $this->session->userdata('panelSMSOwnerId');
                $SMSArray[$i]['sent_by_parent'] = $this->session->userdata('user_id');
				usleep(1);// for unique trx_id
                $SMSArray[$i]['trx_id']         = $this->session->userdata('user_id').'_'.uniqid();
                $SMSArray[$i]['contact_text']   = $smsData;
                $SMSArray[$i]['smsMask']        = $this->input->post('mask');
                $SMSArray[$i]['message']        = $this->input->post('message');
                $SMSArray[$i]['msg_status']     = '-7';
                $SMSArray[$i]['schedule_time']  = $scheduleDateAndTime;

                $i++;

            }

            $msgOutboxID = $this->SendSMSModel->smsStore($SMSArray);

            if($msgOutboxID)
            {
                $this->session->set_flashdata('success_msg','SMS Submitted successfully!');
                redirect(base_url('SendSMS/sendSMSByExcel/').$this->session->userdata('panelSMSOwnerId'));


            }
            else
            {
                $this->session->set_flashdata('error_msg','Failed to send SMS');
                redirect(base_url('SendSMS/sendSMSByExcel/').$this->session->userdata('panelSMSOwnerId'));


            }

        }


    }


    public function sendSMSByExcel($id)
    {

        $this->load->model('user_model');
        $userArray = $this->user_model->getUserInfo($id);

        $maskArray = $this->MaskModel->maskList($id);


        $datas['content'] = $this->load->view('message/excelForm',array('userArray'=>$userArray,'maskArray'=>$maskArray),true);

        $this->load->view( 'layouts/main_template',$datas);
    }



    public function smsExcelStore(){

            $this->load->helper('file');

            $userName = $this->input->post('userName');
            $userId = $this->input->post('userId');


            $userArray = array(
                'id' => $this->input->post('userId'),
                'username' => $this->input->post('userName')
            );

            $config = [
                'upload_path'   => './uploads',
                'allowed_types' => 'csv|xls|xlsx',
                'max_size'      => '51200',
                'file_name'     => str_replace('.','',$userId).'_'.$this->udate()

            ];


            $this->load->library('upload',$config);

            if(!$this->upload->do_upload('excelFile'))
            {

                $upload_error = $this->upload->display_errors();

                $datas['content'] = $this->load->view('message/excelForm',array('userArray'=>$userArray,'upload_error'=>$upload_error),true);
                $this->load->view( 'layouts/main_template',$datas);

            }
            else
            {

                $fileName   = $this->upload->data('raw_name');


                $this->session->set_userdata('lastExcelFileName',$fileName);
                $this->session->set_userdata('excelOwnerName',$_POST['userName']);
                $this->session->set_userdata('excelOnerId',$_POST['userId']);



                $fileExt    = $this->upload->data('file_ext');
                $fileNameWithExt = $fileName.$fileExt;

                $filePathWithFileName = BASEPATH.'../uploads/'.$fileNameWithExt;


                //load the excel library
                $this->load->library('MyExcel');

                //read file from path
                $objPHPExcel = PHPExcel_IOFactory::load($filePathWithFileName);

                //get only the Cell Collection
                $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

                //extract to a PHP readable array format
				$SMSArray = array();

                foreach ($cell_collection as $cell) {

                    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn('A,C,D,F,L');

                    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();

                    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                    //header will/should be in row 1 only. of course this can be modified to suit your need.

                    if ($row == 1) {
                        $header[$row][$column] = $data_value;
                    } else {
                        $arr_data[$row][$column] = $data_value;
                    }

                }


                //send the data in an array format
                $data['header'] = $header;



                $defaultMaskArray = $this->MaskModel->getDefaultMask($userArray['id']); //GETTING DEFAULT MASK FROM DB
			
				$SMSArray = array();

                if(isset($arr_data))
                {
                    $data['values'] = $arr_data;

                    $i=0;
                    foreach($data['values']  as $smsData){

                        
						if(!isset($smsData['C']) || !isset($smsData['D']) || empty($smsData['C'] || $smsData['D']) )
                        {
                            continue;
                        }
                        else
                        {
							$SMSArray[$i]['cd_user_id']     = $userArray['id'];
                            $SMSArray[$i]['sent_by_parent'] = $this->session->userdata('user_id');
                            $SMSArray[$i]['sms_batch_id']	= $fileName;
                            if(!isset($smsData['F']))
                            {$SMSArray[$i]['schedule_time'] = date('Y-m-d H:i:s');}
                            else
                            {$SMSArray[$i]['schedule_time'] = $smsData['F'];}
							usleep(1);// for unique trx_id
                            $SMSArray[$i]['trx_id']         = $this->session->userdata('user_id').'_'.uniqid();
                            $SMSArray[$i]['msg_status']		= -10;


                            if(isset($smsData['L']))
                            {

                                $SMSArray[$i]['smsMask']	= $smsData['L'];
                            }
                            else
                            {
                                $SMSArray[$i]['smsMask']	= @$defaultMaskArray['mask_text'];
                            }

                            $SMSArray[$i]['contact_text']   = @$smsData['C'];
                            $SMSArray[$i]['message']        = @$smsData['D'];

                            $i++;
                        }

                    }


                                 
					
					if(is_array($SMSArray) && !empty($SMSArray)){
                        $batchInsertID = $this->SendSMSModel->smsStoreFromExcel($SMSArray);
                        redirect('SendSMS/finalizedExcelSmsArray');
                    }
                    else{
                        $this->session->set_flashdata('error_msg','Invalid File!');

                        redirect(base_url('SendSMS/sendSMSByExcel/').$userId);
                    }
                }
                else
                {

                    $this->session->set_flashdata('error_msg','Excel file is empty');

                    redirect('SendSMS/sendSMSByExcel');
                }


            }



    }

public function finalizedExcelSmsArray(){



        $this->load->library('pagination');

        $segment = $this->uri->segment(3);
        $config['base_url']         = base_url('SendSMS/finalizedExcelSmsArray');
        $config['total_rows']       = $this->MsgOutboxModel->getAllNotFinalizedExcelSmsNumRows($this->session->userdata());
        $config['per_page']         = 10;
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


        $numRows = $this->MsgOutboxModel->getAllNotFinalizedExcelSmsNumRows($this->session->userdata());

        $notFinalizedExcelSmsArray = $this->MsgOutboxModel->getAllNotFinalizedExcelSms($this->session->userdata(),$segment);



        $lastExcelFileName = $this->session->userdata('lastExcelFileName');

        if(isset($lastExcelFileName)){
            $datas['content'] = $this->load->view('message/lastExcelFileDataTable', array('SMSArray' => $notFinalizedExcelSmsArray,'links'=>$this->pagination->create_links(),'numRows'=>$numRows,'segment'=>$segment), true);
            $this->load->view( 'layouts/main_template',$datas);
        }
        else
        {
            //last file ta query korbo
            $datas['content'] = $this->load->view('message/lastExcelFileDataTable', array('SMSArray' => $notFinalizedExcelSmsArray,'links'=>$this->pagination->create_links(),'numRows'=>$numRows,'segment'=>$segment), true);
            $this->load->view( 'layouts/main_template',$datas);
        }

    }

    public function smsExcelStoreConfirm(){


        $affectedRows = $this->MsgOutboxModel->confirmExcelSms($this->session->userdata());

        if($affectedRows)
        {
            $this->session->set_flashdata('success_msg','All SMS successfully confirmed!');
            redirect('user/userList');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to confirmed');
            redirect('SendSMS/finalizedExcelSmsArray');

        }

    }

    public function ajax_delete()
    {

        $id = $this->input->post('id');
        $this->db->where_in('id', $id);
        $this->db->delete('msg_outbox');

    }
	
	
	public function sendSMSFromText($id)
    {

        $this->load->model('user_model');
        $userArray = $this->user_model->getUserInfo($id);

        $maskArray = $this->MaskModel->maskList($id);


        $datas['content'] = $this->load->view('message/excelForm',array('userArray'=>$userArray,'maskArray'=>$maskArray),true);

        $this->load->view( 'layouts/main_template',$datas);
    }
    

    public function smsFromTextStore()
	{

        $this->load->helper('file');

        $userName = $this->input->post('userName');
        $userId = $this->input->post('userId');


        $userArray = array(
            'id' => $this->input->post('userId'),
            'username' => $this->input->post('userName')
        );

        $config = [
            'upload_path'   => './uploads',
            'allowed_types' => 'txt',
            'max_size'      => '51200',
            'file_name'     => str_replace('.','',$userId).'_'.$this->udate()

        ];




        $this->load->library('upload',$config);

        if(!$this->upload->do_upload('textFile'))
        {

            $upload_error = $this->upload->display_errors();

            $datas['content'] = $this->load->view('message/excelForm',array('userArray'=>$userArray,'upload_error'=>$upload_error),true);
            $this->load->view( 'layouts/main_template',$datas);

        }
        else
        {


            $fileName   = $this->upload->data('raw_name');


            $this->session->set_userdata('lastTextFileName',$fileName);
            $this->session->set_userdata('textOwnerName',$_POST['userName']);
            $this->session->set_userdata('textOnerId',$_POST['userId']);



            $fileExt    = $this->upload->data('file_ext');
            $fileNameWithExt = $fileName.$fileExt;

            $filePathWithFileName = BASEPATH.'../uploads/'.$fileNameWithExt;


//            $MyFile = file_get_contents(base_url()."application/controllers/readme.txt");
            $textFileData = file_get_contents($filePathWithFileName);

            //load the validvalidatedmsisdn library
            $this->load->library('validatemsisdn');


            //calling msisdnCleaner method
            $cleanMSISDN = $this->validatemsisdn->msisdnCleaner($textFileData);



            if(isset($_POST['scheduleDate']) && isset($_POST['scheduleTime'])) {
                $date = $this->input->post('scheduleDate');
                $time = $this->input->post('scheduleTime');
                $scheduleDateAndTime = strtotime($date.$time);
                $scheduleDateAndTime = date("Y-m-d H:i:s",$scheduleDateAndTime);
            }
            else
            {
                $scheduleDateAndTime = date("Y-m-d H:i:s");
            }

            $i=0;
            foreach($cleanMSISDN  as $smsData){


                $SMSArray[$i]['cd_user_id']     = $userArray['id'];
                usleep(1);// for unique trx_id
                $SMSArray[$i]['sms_batch_id']	= $fileName;
                $SMSArray[$i]['sent_by_parent'] = $this->session->userdata('user_id');
                $SMSArray[$i]['trx_id']         = $this->session->userdata('user_id').'_'.uniqid();
                $SMSArray[$i]['contact_text']   = $smsData;
                $SMSArray[$i]['smsMask']        = $this->input->post('mask');
                $SMSArray[$i]['message']        = $this->input->post('message');
                if(strlen($SMSArray[$i]['contact_text']) < 13)
                {
                    $SMSArray[$i]['msg_status']     = '-2';
                }
                else
                {
                    $SMSArray[$i]['msg_status']     = '-10';
                }


                $SMSArray[$i]['schedule_time']  = $scheduleDateAndTime;

                $i++;


            }

            $batchInsertID = $this->SendSMSModel->smsStoreFromExcel($SMSArray);

            if($batchInsertID)
            {
                $this->session->set_flashdata('success_msg','Submitted sms successfully!');

                redirect('SendSMS/finalizedTextSmsArray');

            }
            else
            {
                $this->session->set_flashdata('error_msg','Failed to send SMS');
                redirect('SendSMS/sendSMSFromText');

            }
        }



    }

    public function finalizedTextSmsArray()
	{


        $this->load->library('pagination');

        $segment = $this->uri->segment(3);
        $config['base_url']         = base_url('SendSMS/finalizedTextSmsArray');
        $config['total_rows']       = $this->MsgOutboxModel->getAllNotFinalizedTextSmsNumRows($this->session->userdata());
        $config['per_page']         = 10;
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


        $numRows = $this->MsgOutboxModel->getAllNotFinalizedTextSmsNumRows($this->session->userdata());

        $notFinalizedTextSmsArray = $this->MsgOutboxModel->getAllNotFinalizedTextSms($this->session->userdata(),$segment);



        $lastTextFileName = $this->session->userdata('lastTextFileName');

        if(isset($lastTextFileName)){
            $datas['content'] = $this->load->view('message/lastTextFileDataTable', array('SMSArray' => $notFinalizedTextSmsArray,'links'=>$this->pagination->create_links(),'numRows'=>$numRows,'segment'=>$segment), true);
            $this->load->view( 'layouts/main_template',$datas);
        }
        else
        {
            //last file ta query korbo
            $datas['content'] = $this->load->view('message/lastTextFileDataTable', array('SMSArray' => $notFinalizedTextSmsArray,'links'=>$this->pagination->create_links(),'numRows'=>$numRows,'segment'=>$segment), true);
            $this->load->view( 'layouts/main_template',$datas);
        }

    }


    public function smsTextStoreConfirm()
	{


        $affectedRows = $this->MsgOutboxModel->confirmTextSms($this->session->userdata());

        if($affectedRows)
        {
            $this->session->set_flashdata('success_msg','All SMS successfully confirmed!');
            redirect('user/userList');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to confirmed');
            redirect('SendSMS/finalizedTextSmsArray');

        }

    }




}