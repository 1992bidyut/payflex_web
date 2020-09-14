<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mask extends CI_Controller {

    function __construct()
    {

        parent::__construct();

        if(!$this->session->userdata('user_id')){
            return redirect('login');
        }
        $this->load->model('MaskModel');

    }



    public function createMask($cd_user_id){

        $maskArray = $this->MaskModel->maskList($cd_user_id);



        $datas['content'] = $this->load->view('mask/createMask',array('cd_user_id'=>$cd_user_id,'masks'=>$maskArray),true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function maskStore(){

        $cd_user_id = $this->input->post('cd_user_id');

//        print_r($cd_user_id);
//        die();

        $this->load->library('form_validation');

        if($this->form_validation->run('maskStoreRules') == FALSE)
        {
//            $this->session->set_flashdata('error_msg','Failed to create Mask!');
//            redirect(base_url('Mask/createMask/').$cd_user_id);

            $maskArray = $this->MaskModel->maskList($cd_user_id);


            $datas['content'] = $this->load->view('mask/createMask',array('cd_user_id'=>$cd_user_id,'masks'=>$maskArray),true);
            $this->load->view( 'layouts/main_template',$datas);
        }
        else
        {
            $posts = array(
                'mask_text'     => $this->input->post('mask'),
                'cd_user_id'    => $this->input->post('cd_user_id'),
                'is_acive'      =>1

            );

            $maskTblId = $this->MaskModel->addMask($posts);
            if($maskTblId)
            {

                $this->session->set_flashdata('success_msg','Mask created successfully!');
                redirect(base_url('Mask/createMask/').$cd_user_id);

            }
            else
            {

                $this->session->set_flashdata('error_msg','Failed to create Mask!');
                redirect(base_url('Mask/createMask/').$cd_user_id);

            }

        }



    }

    public function maskDestroy($id,$cd_user_id){

        $result = $this->MaskModel->deleteMask($id);

        if($result){

            $this->session->set_flashdata('success_msg','Mask deleted successfully');
            redirect('mask/createMask/'.$cd_user_id);

//            $datas['content'] = $this->load->view('mask/createMask',array(),true);
//            $this->load->view( 'layouts/main_template',$datas);

        }else{
            $this->session->set_flashdata('error_msg','Mask not deleted successfully');
            $datas['content'] = $this->load->view('mask/createMask',array(),true);
            $this->load->view( 'layouts/main_template',$datas);
        }

    }

    public function maskUpdate($id,$cd_user_id){


        $result = $this->MaskModel->setDefaultMask($id,$cd_user_id);

        if($result)
        {
            $this->session->set_flashdata('success_msg','Default mask successfully set!');
            redirect('mask/createMask/'.$cd_user_id);
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to set default mask!');
            redirect('mask/createMask/'.$cd_user_id);
        }

    }



    public function userMaskInfoShow()
    {
        $maskArray = $this->MaskModel->userMaskInfo();
        $datas['content'] = $this->load->view('mask/userMaskInfoList', array('userMaskInfo'=>$maskArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }



    public function maskInfoDestroy($id)
    {
        $deleteTrue = $this->MaskModel->maskInfoDestroy($id);
        if($deleteTrue)
        {
            $this->session->set_flashdata('success_msg','Mask deleted successfully!');
            redirect('dashboard/redirectMaskRequestView');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to delete mask information');
            redirect('Mask/userMaskInfoShow');
        }

    }



    public function userMaskEdit($id)
    {
        $this->db->set('status', 1);
        $this->db->where('id', $id);
        $this->db->update('user_mask_info');

        $maskUrl = $this->MaskModel->getMaskUrl($id);
        foreach ($maskUrl  as $urlinfo){
            $url = $urlinfo['mask_file_url'];
        }
        redirect($url);
    }




}
