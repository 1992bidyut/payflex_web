<?php

class OperatorModel extends CI_Model{


    public  function operatorStore($posts){

        $this->db->insert('operator',$posts);

        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }

    }

    public function operatorShow(){

        $resource = $this->db->get('operator');


        if($resource){
            return $resource->result_array();
        }else{
            return false;
        }

    }

    public function operatorShowById($id){

        $this->db->select('*');
        $this->db->where('id',$id);
        $resource = $this->db->get('operator');

        if($resource->num_rows() == 1){
            return $resource->row_array();
        }
        else
        {
            return false;
        }


    }

    public function operatorUpdate($posts){

        $this->db->where('id',$posts['id'])
            ->update('operator',$posts);

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }

    }

    public function operatorDestroy($id){

        if($id)
        {
            $this->db->where('id',$id);
            $this->db->delete('operator');
            return true;
        }else
        {
            return false;
        }


    }

    public function getAllOperator(){
        $resource = $this->db->get('operator');
        return $resource->result_array();

    }



}