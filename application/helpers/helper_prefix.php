<?php

function checkPermission($module_id){
    $CI=& get_instance();
    $CI->load->model('user_model');
    $sessionData=$this->session->userdata();
    $permission=$this->user_model->getPermission($sessionData['user_id'],$module_id);
    return $permission;
}
