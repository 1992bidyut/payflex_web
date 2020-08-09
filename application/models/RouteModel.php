<?php

/**
 * Created by PhpStorm.
 * User: Sanker Saha
 * Date: 04-03-2017
 * Time: 10:38 PM
 */
class RouteModel extends CI_Model
{

    public function routeStore($posts){

        $this->db->insert('route',$posts);

        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }

    }

    public function routeShow(){

        $resource = $this->db->get('route');


        if($resource){
            return $resource->result_array();
        }else{
            return false;
        }

    }
    public function routeShowById($id){

        $this->db->select('*');
        $this->db->where('id',$id);
        $resource = $this->db->get('route');

        if($resource->num_rows() == 1){
            return $resource->row_array();
        }
        else
        {
            return false;
        }


    }

    public function routeUpdate($posts){

         $this->db->where('id',$posts['id'])
            ->update('route',$posts);

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }

    }

    public function routeDestroy($id){

        if($id)
        {
            $this->db->where('id',$id);
            $this->db->delete('route');
            return true;
        }else
        {
            return false;
        }


    }

    public function getAllRoute(){
        $resource = $this->db->get('route');
        return $resource->result_array();

    }

}