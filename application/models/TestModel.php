<?php
class TestModel extends CI_Model
{
    public function test($data1){
        $this->db->insert('tbl_user', $data1);
        $Info = $this->db->insert_id();
        return $Info;
    }
}
?>
