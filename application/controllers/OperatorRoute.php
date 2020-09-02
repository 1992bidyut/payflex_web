<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OperatorRoute extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_id'))
        {
            return redirect('login');
        }

        $this->load->model('OperatorModel');
        $this->load->model('RouteModel');
        $this->load->model('OperatorRouteModel');
    }

    public function operatorRouteCreate()
    {
        $operatorArray  = $this->OperatorModel->getAllOperator();

        $routeArray     = $this->RouteModel->getAllRoute();

        $datas['content'] = $this->load->view('operatorRoute/operatorRouteCreate', array('operators'=>$operatorArray,'routes'=>$routeArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function operatorRouteStore()
    {
        $operatorArray  = $this->OperatorModel->getAllOperator();

        $routeArray     = $this->RouteModel->getAllRoute();

        $this->load->library('form_validation');

        if($this->form_validation->run('operatorRouteStore') == FALSE)
        {


            $datas['content'] = $this->load->view('operatorRoute/operatorRouteCreate', array('operators'=>$operatorArray,'routes'=>$routeArray), true);
            $this->load->view( 'layouts/main_template',$datas);
        }
        else
        {

            $posts = array(
                'operator_id'       => $this->input->post('operatorID'),
                'route_id'          => $this->input->post('routeID'),
                'standard_price'    => $this->input->post('standardPrice')
            );

            $operatorRouteInsertedId = $this->OperatorRouteModel->operatorRouteStore($posts);

            if($operatorRouteInsertedId)
            {
                $this->session->set_flashdata('success_msg','Route created successfully!');
                redirect('operatorRoute/operatorRouteShow');
            }
            else
            {
                $this->session->set_flashdata('error_msg','Failed to store route');
                redirect('operatorRoute/operatorRouteCreate');
            }


        }


    }

    public function operatorRouteShow()
    {

        $operatorsRoutesArray = $this->OperatorRouteModel->operatorRouteShow();

        $datas['content'] = $this->load->view('operatorRoute/operatorRouteList', array('operatorsRoutes'=>$operatorsRoutesArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function operatorRouteEdit($id)
    {

        $operatorArray          = $this->OperatorModel->operatorShow();
        $routeArray             = $this->RouteModel->routeShow();

        $operatorsRoutesArray   = $this->OperatorRouteModel->operatorRouteShowById($id);

        $datas['content'] = $this->load->view('operatorRoute/operatorRouteUpdate', array('operatorRoutes'=>$operatorsRoutesArray,'operators'=>$operatorArray,'routes'=>$routeArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function operatorRouteUpdate()
    {

        $this->load->library('form_validation');

        if($this->form_validation->run('operatorRouteStore') == FALSE)
        {

            $this->session->set_flashdata('error_msg','Failed to update');
            redirect(base_url('operatorRoute/operatorRouteEdit/').$this->input->post('operatorRouteID'));

        }
        else
        {
            $posts = array(
                'operator_id'       => $this->input->post('operatorID'),
                'route_id'          => $this->input->post('routeID'),
                'standard_price'    => $this->input->post('standardPrice')
            );

            $affected_rows = $this->OperatorRouteModel->operatorRouteUpdate($posts);

            if($affected_rows)
            {
                $this->session->set_flashdata('success_msg','Operator updated successfully!');
                redirect('operatorRoute/operatorRouteShow');
            }
            else
            {
                $this->session->set_flashdata('success_msg','Nothing updated!');
                redirect('operatorRoute/operatorRouteShow');

            }


        }

    }

    public function operatorRouteDestroy($id)
    {
        $deleteTrue = $this->OperatorRouteModel->operatorRouteDestroy($id);

        if($deleteTrue)
        {
            $this->session->set_flashdata('success_msg','Operator-Route deleted successfully!');
            redirect('operatorRoute/operatorRouteShow');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to delete Operator-Route');
            redirect('operatorRoute/operatorRouteShow');

        }

    }

    public function routeAssign($id){



        $cd_user_id = $this->uri->segment(3);

        $this->load->model('user_model');
        $userIdName = $this->user_model->getUserInfo($id);


        $operatorsRoutesArray   = $this->OperatorRouteModel->operatorRouteShow();

        $userRoutesArray        = $this->OperatorRouteModel->userRoutesList($id);
//        echo'<pre />';
//        print_r($operatorsRoutesArray);
//        die();
        $operatorArray          = $this->OperatorModel->operatorShow();
        $routeArray             = $this->RouteModel->routeShow();


        $datas['content'] = $this->load->view('operatorRoute/routeAssign',array('cd_user_id'=>$cd_user_id,
                                                                                'operatorsRoutesArray'=>$operatorsRoutesArray,
                                                                                'userRoutesArray'=>$userRoutesArray,
                                                                                'operatorArray'=>$operatorArray,
                                                                                'routeArray'=>$routeArray,
                                                                                'userIdName'=>$userIdName,
                                                                                ),true);
        $this->load->view('layouts/main_template',$datas);
    }

    public function assignRouteToUser(){

        $cd_user_id = $this->input->post('cd_user_id');

        $this->load->library('form_validation');



        if($this->form_validation->run('routeAssignToUser') == FALSE)
        {
            $this->session->set_flashdata('error_msg','Failed to store operator');
            redirect(base_url('OperatorRoute/routeAssign/').$cd_user_id);
        }
        else
        {
            $posts = array(
                'operator_route_id' => $this->input->post('operatorRouteID'),
                'operator_id'       => $this->input->post('operator_id'),
                'user_id'           => $this->input->post('cd_user_id'),
                'terrif'            => $this->input->post('newPrice')
            );


            $userRouteInsertedId = $this->OperatorRouteModel->userRouteStore($posts);

            if($userRouteInsertedId)
            {

                $this->session->set_flashdata('success_msg','Operator created successfully!');
                redirect(base_url('OperatorRoute/routeAssign/').$cd_user_id);

            }
            else
            {
                $this->session->set_flashdata('error_msg','Operator Route already exist!');
                redirect(base_url('OperatorRoute/routeAssign/').$cd_user_id);


            }


        }

    }


    public function updateUserRoute(){

        $cd_user_id = $this->input->post('cd_user_id');
        $operatorID = $this->input->post('operatorID');
        $routeID    = $this->input->post('routeID');

        $operatorRouteID = $this->OperatorRouteModel->operatorRouteTblIdGet($operatorID,$routeID);

        if($operatorRouteID)
        {
            $posts = array(
                        'id'                => $this->input->post('operator_userID'),
                        'operator_route_id' => $operatorRouteID['operatorRouteID'],
                        'terrif'            => $this->input->post('newPrice')
                        );
            $userRouteUpdatedRowID = $this->OperatorRouteModel->userRouteUpdate($posts);


            $this->session->set_flashdata('success_msg','Route updated successfully!');
            redirect(base_url('OperatorRoute/routeAssign/').$cd_user_id);

        }
        else
        {
            $this->session->set_flashdata('error_msg','Please create route first!');
            redirect(base_url('OperatorRoute/routeAssign/').$cd_user_id);

        }

    }

    public function deleteUserAssignedRoute($userRouteID,$cd_user_id){

        $userRouteDeleteSuccess =  $this->OperatorRouteModel->deleteUserAssignedRoute($userRouteID);

        if($userRouteDeleteSuccess){

            $this->session->set_flashdata('success_msg','Route deleted successfully!');
            redirect(base_url('OperatorRoute/routeAssign/').$cd_user_id);
        }
        else
        {
            $this->session->set_flashdata('error_msg','Route not deleted!');
            redirect(base_url('OperatorRoute/routeAssign/').$cd_user_id);
        }

    }


}