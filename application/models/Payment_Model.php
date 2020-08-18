<?php

class Payment_Model extends CI_Model
{
    public function getpaymentdetail($order_code){
        $this->db->select('*')
            ->from('tbl_payment')
            ->join('tbl_payment_image_relation','tbl_payment_image_relation.payment_id = tbl_payment.id','left')
            ->join('tbl_image','tbl_image.id = tbl_payment_image_relation.image_id')
            ->where('tbl_payment.order_code',$order_code);
        $result = $this->db->get();
        return $result->result_array();
    }

}