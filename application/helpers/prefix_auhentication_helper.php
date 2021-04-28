<?php
//$SUPER_EDITING=1;
//$ORDER_EDITING=2;
//$PAYMENT_EDITING=3;
//$ONLY_VIEWER=4;
//$EDITING=5;
//$API_COMMUNICATOR=6;

function checkPermission(){
    $CI=& get_instance();
    $CI->load->model('user_model');
    $sessionData=$CI->session->userdata();
    $permission=$CI->user_model->getPermission($sessionData['user_id']);

//    if ($permission!=false){
//        if ($permission->permission==1){
//            return true;
//        }else{
//            return false;
//        }
//    }else{
//        return false;
//    }
    return $permission->moduleid;
}
