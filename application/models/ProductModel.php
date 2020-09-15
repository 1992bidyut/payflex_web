<?php


class ProductModel extends CI_Model
{
    public function getProductList(){
        $this->db->select(
            'product_details.id as product_id,
            product_details.p_name,
            product_details.p_type,
            product_details.product_code,')
            ->from('product_details')
            ->where('is_active',1);
        $result = $this->db->get();
        return $result->result_array();
    }
}