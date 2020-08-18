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
    public function getOrderDetail($order_code){
        $order_type =2;
        $multipleWhere = ['order_type' => $order_type, 'order_code' => $order_code];
        $this->db->select('*')
            ->from('tbl_customer_order')
            ->join('tbl_customer_order','tbl_customer_order.id = order_details.customer_order_id')
            ->where($multipleWhere);
    }

}