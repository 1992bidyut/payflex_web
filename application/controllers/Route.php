<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Route extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            return redirect('login');
        }

        $this->load->model('RouteModel');

    }


    public function routeCreate()
    {


        $datas['content'] = $this->load->view('route/createRoute', array(), true);
        $this->load->view( 'layouts/main_template',$datas);
    }


    public function routeStore()
    {

        $this->load->library('form_validation');

        if($this->form_validation->run('routeStore') == FALSE)
        {
            $datas['content'] = $this->load->view('route/createRoute', array(), true);
            $this->load->view( 'layouts/main_template',$datas);
        }
        else
        {
            $posts = array(
                'name'          => $this->input->post('routeName'),
                'description'   => $this->input->post('routeDescription'),
                'identity'      => $this->input->post('routeIdentity')
            );

            $routeInsertedId = $this->RouteModel->routeStore($posts);
            if($routeInsertedId)
            {
                $this->session->set_flashdata('success_msg','Route created successfully!');
                redirect('route/routeCreate');
            }
            else
            {
                $this->session->set_flashdata('error_msg','Failed to store route');
                redirect('route/routeCreate');

            }


        }


    }

    public function routeShow()
    {

        $routsArray = $this->RouteModel->routeShow();


        $datas['content'] = $this->load->view('route/routeList', array('routs'=>$routsArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function routeEdit($id)
    {
        $routsArray = $this->RouteModel->routeShowById($id);

        $datas['content'] = $this->load->view('route/updateRoute', array('routs'=>$routsArray), true);
        $this->load->view( 'layouts/main_template',$datas);
    }

    public function routeUpdate()
    {

        $this->load->library('form_validation');

        if($this->form_validation->run('routeStore') == FALSE)
        {

            $this->session->set_flashdata('error_msg','Please fill out all');
            redirect(base_url('route/routeEdit/').$this->input->post('id'));

        }
        else
        {
            $posts = array(
                'id'            => $this->input->post('id'),
                'name'          => $this->input->post('routeName'),
                'description'   => $this->input->post('routeDescription'),
                'identity'      => $this->input->post('routeIdentity')
            );

            $affected_rows = $this->RouteModel->routeUpdate($posts);
            if($affected_rows)
            {
                $this->session->set_flashdata('success_msg','Route created successfully!');
                redirect('route/routeShow');
            }
            else
            {
                $this->session->set_flashdata('success_msg','Nothing updated!');
                redirect('route/routeShow');

            }


        }

    }

    public function routeDestroy($id)
    {
        $deleteTrue = $this->RouteModel->routeDestroy($id);
        if($deleteTrue)
        {
            $this->session->set_flashdata('success_msg','Route successfully deleted!');
            redirect('route/routeShow');
        }
        else
        {
            $this->session->set_flashdata('error_msg','Failed to delete route');
            redirect('route/routeShow');

        }

    }



}