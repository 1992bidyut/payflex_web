<?php
/**
 * Created by PhpStorm.
 * User: Sanker Saha
 * Date: 16-03-2017
 * Time: 12:56 PM
 */

class CountryCodeModel extends CI_Model{

    //FOR GETTING ALL COUNTRY INFO
    public function getAllCountry(){
        $resource = $this->db->get('countries');
        return $resource->result_array();
    }

    public function getCountryCodeByID($id){

        $this->db->where('id',$id)
                 ->select('code');
        $resource = $this->db->get('countries');

        if($resource->num_rows() > 0)
        {
            return $resource->row_array();
        }
        else
        {
            return false;
        }

    }

}