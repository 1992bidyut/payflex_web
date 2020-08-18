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
        $multipleWhere = ['order_details.order_type' => $order_type, 'tbl_customer_order.order_code' => $order_code];
        $this->db->select(
            'tbl_customer_order.id as customer_order_id,
            tbl_customer_order.order_code,
            tbl_customer_order.taking_date,
            tbl_customer_order.delivery_date,
            order_details.txid as detail_trxid,
            order_details.client_id,
            order_details.product_id,
            product_details.p_name,
            product_details.product_code,
            order_details.quantityes,
            order_details.order_type,
            order_details.plant as plant_id,
            plant_detail.plant,
            tbl_product_price.p_wholesalePrice,
            order_details.ordered_amount
            ')
            ->from('tbl_customer_order')
            ->join('order_details','tbl_customer_order.id = order_details.customer_order_id')
            ->join('product_details','order_details.product_id = product_details.id')
            ->join('tbl_product_price','product_details.id = tbl_product_price.product_id')
            ->join('plant_detail','plant_detail.id = order_details.plant')
            ->where('order_details.order_type',$order_type)
            ->where('tbl_customer_order.order_code',$order_code)
            ->where('tbl_product_price.is_active',1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function updatePaymentAccept($id){
        $this->db->where('tbl_payment.id', $id);
        $data['action_flag']=1;
        if ($this->db->update('tbl_payment', $data)) {
            return true;
        }
        else {
            return false;
        }
    }

    public function updateIndent($id){
        $this->db->where('tbl_payment.id', $id);
        $data['action_flag']=2;
        if ($this->db->update('tbl_payment', $data)) {
            return true;
        }
        else {
            return false;
        }
    }

}