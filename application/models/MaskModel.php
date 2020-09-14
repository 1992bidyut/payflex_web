<?php
class MaskModel extends CI_Model{

    function maskList($cd_user_id){
        $this->db->where('cd_user_id',$cd_user_id);
        $resource = $this->db->get('mask');
        if($resource)
        {
            return $resource->result_array();
        }
        else
        {
            return false;
        }
    }

    function addMask($posts){

        $this->db->insert('mask',$posts);

        if($this->db->insert_id())
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }


    }

    function deleteMask($id){

        $this->db->where('id',$id);
        $this->db->delete('mask');

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    function setDefaultMask($id,$cd_user_id)
    {
         $this->db->where('cd_user_id',$cd_user_id)
                  ->where('is_default',1)
                  ->select('id');
        $hasDefault = $this->db->get('mask')->result_array();


        if($hasDefault)
        {
            $this->db->where('cd_user_id',$cd_user_id)
                ->update('mask',array('is_default'=>'0'));

            if($this->db->affected_rows() > 0){
                $this->db->where('id',$id)
                    ->update('mask',array('is_default'=>'1'));
                return $this->db->affected_rows();
            }else{
                return false;
            }

        }
        else
        {
            $this->db->where('id',$id)
                ->update('mask',array('is_default'=>'1'));
            return $this->db->affected_rows();

        }



    }

    function getDefaultMask($cd_user_id){
        $this->db->where('cd_user_id',$cd_user_id);
        $this->db->where('is_default',1);
        $resource = $this->db->get('mask');

        if($resource)
        {
            return $resource->row_array();
        }
        else
        {
            return false;
        }
    }



    public function getTotalMaskRequestCount(){
        $this->db->select('*')
            ->from('user_mask_info')
            ->where('status',0);
        return $resource = $this->db->count_all_results();
    }

    public function userMaskInfo(){
        $this->db->order_by("id", "DESC");
        $resource = $this->db->get('user_mask_info');

        if($resource){
            return $resource->result_array();
        }else{
            return false;
        }
    }


    public function maskInfoDestroy($id){
        if($id)
        {
            $this->db->where('id',$id);
            $this->db->delete('user_mask_info');
            return true;
        }else
        {
            return false;
        }
    }


    public function getMaskUrl($id){
        $this->db->select('mask_file_url'); 
        $this->db->from('user_mask_info');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
    }






}