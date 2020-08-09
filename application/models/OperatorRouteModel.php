<?php
/**
 * Created by PhpStorm.
 * User: Sanker Saha
 * Date: 05-03-2017
 * Time: 2:46 PM
 */
class OperatorRouteModel extends CI_Model{

    public function operatorRouteStore($posts){

        $this->db->insert('operator_route',$posts);

        if($this->db->insert_id()){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    public function operatorRouteShow(){

        $this->db->select('operator_route.id as operator_route_id,
                           operator_route.standard_price,
                           operator.id as operatorID,
                           operator.name as operatorName,
                           operator.identity as operatorIdentity,
                           route.id as routeID,
                           route.name as routeName,
                           route.identity as routeIdentity')
                 ->from('operator_route')
                 ->join('operator','operator_route.operator_id = operator.id')
                 ->join('route','operator_route.route_id = route.id')
                 ->order_by('operator_route_id', 'asc');

        $resource = $this->db->get();


        if($resource){
            return $resource->result_array();
        }else{
            return false;
        }

    }

    public function operatorRouteShowById($id){

        $this->db->select('operator_route.id as operator_route_id,
                           operator_route.standard_price,
                           operator.id as operatorID,
                           operator.name as operatorName,
                           operator.identity as operatorIdentity,
                           route.id as routeID,
                           route.name as routeName,
                           route.identity as routeIdentity')
                 ->from('operator_route')
                 ->join('operator','operator_route.operator_id = operator.id')
                 ->join('route','operator_route.route_id = route.id')
                 ->where('operator_route.id',$id);

        $resource = $this->db->get();


        if($resource){
            return $resource->result_array();
        }else{
            return false;
        }

    }

    public function operatorRouteUpdate($posts){

        $this->db->where('id',$posts['id'])
            ->update('operator_route',$posts);

        if($this->db->affected_rows()){
            return $this->db->affected_rows();
        }else{
            return false;
        }

    }



    public function operatorRouteDestroy($id){

        if($id)
        {
            $this->db->where('id',$id);
            $this->db->delete('operator_route');
            return true;
        }
        else
        {
            return false;
        }


    }

    public function userRoutesList($id){
        $this->db->select('operator_user.id as operatorUserTblId,
                           operator_user.operator_route_id,
                           operator_user.user_id,
                           operator_user.terrif,
                           operator_user.terrif,

                           operator_route.id as operatorRouteTblID,
                           operator_route.operator_id,
                           operator_route.route_id,
                           operator_route.standard_price,

                           operator.id as operatorID,
                           operator.name as operatorNamemy,

                           route.id as routeID,
                           route.name as routeName')

            ->from('operator_user')
            ->join('operator_route','operator_route.id = operator_user.operator_route_id')
            ->join('operator','operator_route.operator_id = operator.id')
            ->join('route','operator_route.route_id = route.id')
            ->where('operator_user.user_id',$id);
        $resource = $this->db->get();
//        echo $this->db->last_query();
        if($resource)
        {
           return $resource->result_array();
        }
        else
        {
            return false;
        }
    }

    public function userRouteStore($posts){

        $this->db->where('operator_id',$posts['operator_id'])
                 ->where('user_id',$posts['user_id'])
                ->select('id');
            $resource = $this->db->get('operator_user');



        if($resource->num_rows() > 0)
        {
            return false;
        }
        else
        {
            $this->db->insert('operator_user',$posts);

            if($this->db->insert_id()){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }

    }

    //FOR UPDATING user_route TABLE
    public function operatorRouteTblIdGet($operatorID,$routeID){

        $this->db->where('operator_id',$operatorID)
                 ->where('route_id',$routeID)
                 ->select('id as operatorRouteID');
        $resource = $this->db->get('operator_route');


        if($resource)
        {
            return $resource->row_array();
        }
        else
        {
           return false;
        }

    }

    public function userRouteUpdate($posts){

        $this->db->where('id',$posts['id'])
            ->update('operator_user',$posts);

        if($this->db->affected_rows() > 0){
            return $this->db->affected_rows();
        }else{
            return false;
        }

    }

    public function deleteUserAssignedRoute($userRouteID){

        if($userRouteID)
        {
            $this->db->where('id',$userRouteID);
            $this->db->delete('operator_user');
            return true;
        }
        else
        {
            return false;
        }
    }



}

