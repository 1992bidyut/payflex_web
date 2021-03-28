<?php


class OfferForClient extends CI_Controller
{
    function __construct() {
        parent::__construct();
            }

    function index(){
        $this->load->view( 'offer/offer');
    }

    function offerRegistration(){
        $this->load->view( 'offer/registration');
    }
}