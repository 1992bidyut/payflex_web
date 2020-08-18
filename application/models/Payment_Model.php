<?php

class Payment_Model extends CI_Model
{
    public function getpaymentdetail($order_code){
        $this->db->select('tbl_payment.id as payment_id, 
        tbl_payment.trxid,
        tbl_payment.payment_mode_id,
        tbl_payment.financial_institution_id,
        tbl_payment.payment_date_time,
        tbl_payment.reference_no,
        tbl_payment.order_code,
        tbl_payment.amount,
        tbl_payment.order_id,
        tbl_payment.action_flag,
        tbl_payment.submitted_date,
        tbl_payment_image_relation.id as payment_image_relation_id,
        tbl_payment_image_relation.image_id,
        tbl_payment_image_relation.user_id,
        tbl_payment_image_relation.payment_id,
        tbl_image.id,
        tbl_image.trxid,
        tbl_image.image_name,
        tbl_image.user_id,
        tbl_image.request_time,
        tbl_image.upload_time,
        tbl_image.image_discription,
        tbl_image.image_type_id,
        tbl_image.purpose,
        ')
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