<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PostpaidCdr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cdr_model');
		
	}
	
    public function postpaidCdrCreate()
    {
        $userArray  = $this->cdr_model->getAllUser();

        $datas['content'] = $this->load->view('postpaidCdr/postpaidCdrCreate', array('users'=>$userArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }
	
    public function postpaidCdrStore() {
		

        $sel_user = $this->input->post('user');
				
		$dirs = array_filter(glob('http://api.infobuzzer.net:8083/v3.1/logFiles/'.$sel_user.'/*'), 'is_dir');
		
		foreach($dirs as $dir) {
		$files = glob($dir."/*.txt");

			foreach($files as $file) {
				$open = fopen($file, "r") or die ("Unable to open file!");
				
				{
					fgets($open);
					fgets($open);
					$getTextLine = fgets($open);			
					$strReplace = (str_replace('SMSArray = [','',$getTextLine));			
					$strReplace = (str_replace(']','',$strReplace));			
					
					$explodeLine = json_decode($strReplace, true);
					
					$data = array(
						 'cd_user_id' => $explodeLine['cd_user_id'],
						 'sms_batch_id' => $explodeLine['sms_batch_id'],
						 'entryDate' => $explodeLine['entryDate'],
						 'id' => $explodeLine['id'],
						 'trx_id' => $explodeLine['trx_id'],
						 'msg_status' => $explodeLine['msg_status'],
						 'smsMask' => $explodeLine['smsMask'],
						 'contact_text' => $explodeLine['contact_text'],
						 'message' => $explodeLine['message'],
						 'schedule_time' => $explodeLine['schedule_time'],
						 'route_id' => $explodeLine['route_id'],
						 'send_time' => date("Y-m-d H:i:s.", filectime($file))
					);
					
					$postpaidCdrInsertedId = $this->cdr_model->insert_cdr($data);
				}
				fclose($open);
				unlink($file);
			}
			rmdir($dir);
		}
		
		if($postpaidCdrInsertedId)
		{
			$this->session->set_flashdata('success_msg','Postpaid CDR created successfully!');
			redirect('postpaidCdr/postpaidCdrShow');
		}
		else
		{
			$this->session->set_flashdata('error_msg','No Postpaid CDR exists for this user.');
			redirect('postpaidCdr/postpaidCdrCreate');
		}
		
    }
	
	public function postpaidCdrShow()
    {

        $postpaidCdrArray = $this->cdr_model->postpaidCdrShow();

        $datas['content'] = $this->load->view('postpaidCdr/postpaidCdrList', array('postpaidCdrs'=>$postpaidCdrArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }
}
	
?>
