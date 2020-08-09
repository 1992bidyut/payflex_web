<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Operator extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            return redirect('login');
        }

        $this->load->model('OperatorModel');

    }

    public function operatorCreate()
    {


        $datas['content'] = $this->load->view('operator/operatorCreate', array(), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function operatorStore()
    {

        $this->load->library('form_validation');

        if($this->form_validation->run('operatorStore') == FALSE)
        {
            $datas['content'] = $this->load->view('operator/operatorCreate', array(), true);
            $this->load->view( 'layouts/main_template',$datas);
        }
        else
        {
            $posts = array(
                'name'          => $this->input->post('operatorName'),
                'description'   => $this->input->post('operatorDescription'),
                'identity'      => $this->input->post('operatorIdentity')
            );


            $operatorInsertedId = $this->OperatorModel->operatorStore($posts);

            if($operatorInsertedId)
            {
                $this->session->set_flashdata('success_msg','Operator created successfully!');
                redirect('operator/operatorCreate');
            }
            else
            {
                $this->session->set_flashdata('error_msg','Failed to store operator');
                redirect('operator/operatorCreate');

            }


        }


    }


    public function operatorShow()
    {

        $operatorsArray = $this->OperatorModel->operatorShow();

        $datas['content'] = $this->load->view('operator/operatorList', array('operators'=>$operatorsArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function operatorEdit($id)
    {
        $operatorsArray = $this->OperatorModel->operatorShowById($id);

        $datas['content'] = $this->load->view('operator/operatorUpdate', array('operators'=>$operatorsArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function operatorUpdate()
    {

        $this->load->library('form_validation');

        if($this->form_validation->run('operatorStore') == FALSE)
        {

            $this->session->set_flashdata('error_msg','Please fill out all');
            redirect(base_url('operator/operatorEdit/').$this->input->post('id'));

        }
        else
        {
            $posts = array(
                'id'            => $this->input->post('id'),
                'name'          => $this->input->post('operatorName'),
                'description'   => $this->input->post('operatorDescription'),
                'identity'      => $this->input->post('operatorIdentity')
            );

            $affected_rows = $this->OperatorModel->operatorUpdate($posts);

            if($affected_rows)
            {
                $this->session->set_flashdata('success_msg','Operator updated successfully!');
                redirect('operator/operatorShow');
            }
            else
            {
                $this->session->set_flashdata('success_msg','Nothing updated!');
                redirect('operator/operatorShow');

            }


        }

    }


    public function operatorDestroy($id)
    {
        $deleteTrue = $this->OperatorModel->operatorDestroy($id);

        if($deleteTrue)
        {
            $this->session->set_flashdata('success_msg','Operator deleted successfully!');
            redirect('operator/operatorShow');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to delete operator');
            redirect('operator/operatorShow');

        }

    }





}