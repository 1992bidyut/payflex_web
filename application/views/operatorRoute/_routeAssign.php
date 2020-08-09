
<div class="row">
    <div class="col-md-12">



        <?php
        if($this->session->flashdata('success_msg')){
            ?>
            <div class="alert alert-success alert-dismissable" id="successMessage">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg');?>
            </div>

            <?php
        }
        ?>
        <?php
        if($this->session->flashdata('error_msg')){
            ?>
            <div class="alert alert-danger alert-dismissable" id="failedMessage">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error_msg');?>
            </div>

            <?php
        }
        ?>

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Existing Route List </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i> Add </a>
                    <a href="javascript:;" class="btn btn-default btn-sm">
                        <i class="fa fa-print"></i> Print </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" />
                        </th>
                        <th> Operator </th>
                        <th> Route </th>
                        <th> Standard Price </th>
                        <th> Given Price </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($userRoutesArray as $userRoute)
                        {
                        ?>
                            <tr class="odd gradeX">
                                <form action="<?php echo base_url('OperatorRoute/updateUserRoute');?>" method="post" class="form-horizontal" role="form">

                                <input type="hidden" value="<?php echo $cd_user_id ;?>" name="cd_user_id">
                                <input type="hidden" value="<?php echo $userRoute['operatorID'];?>" name="operatorID">
                                <input type="hidden" value="<?php echo $userRoute['operatorUserTblId'];?>" name="operator_userID">

                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td> <?php echo $userRoute['operatorNamemy'];?> </td>
                                <td>
                                    <div class="">
                                        <select class="form-control" name="routeID">
                                            <?php

                                            foreach($routeArray as $route){
                                                if($route['id'] == $userRoute['routeID'])
                                                {$routeID = 'selected';}
                                                else
                                                {$routeID = '';}
                                                ?>
                                                <option <?php echo $routeID;?> value="<?php echo $route['id'];?>"><?php echo $route['name']. '&nbsp('.$route['id'].')';?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td> <?php echo $userRoute['standard_price'];?> </td>
                                <td>
                                    <div class="form-group">
                                        <div class="">
                                            <input type="text" value="<?php echo $userRoute['terrif'];?>" name="newPrice" class="form-control">
                                        </div>
                                    </div>
                                </td>

                                <td >
                                    <div class="clearfix">

                                        <button type="submit" class="btn btn-sm green"> Update
                                            <i class="fa fa-map-signs"></i>
                                        </button>
                                        <a href="<?php echo base_url('OperatorRoute/deleteUserAssignedRoute/').$userRoute['operatorUserTblId'].'/'.$cd_user_id;?>" onclick="return confirm('Are you sure you want to delete');" class="btn btn-sm red"> Delete
                                            <i class="fa fa-tags"></i>
                                        </a>
                                    </div>
                                </td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Create Route </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i> Add </a>
                    <a href="javascript:;" class="btn btn-default btn-sm">
                        <i class="fa fa-print"></i> Print </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                    <thead>
                    <tr>
                        <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" />
                        </th>
                        <th> Operator </th>
                        <th> Route </th>
                        <th> Standard Price </th>
                        <th> Given Price </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
//                    echo'<per />';
//                    print_r($operatorsRoutesArray);
//                    die();
                    foreach($operatorsRoutesArray as $operatorRoute){
                        ?>
                        <tr class="odd gradeX">
                            <form action="<?php echo base_url('OperatorRoute/assignRouteToUser');?>" method="post" class="form-horizontal" role="form">
                                <input type="hidden" value="<?php echo $operatorRoute['operator_route_id'] ;?>" name="operatorRouteID">
                                <input type="hidden" value="<?php echo $operatorRoute['operatorID'] ;?>" name="operator_id">
                                <input type="hidden" value="<?php echo $cd_user_id ;?>" name="cd_user_id">
                                <td><input type="checkbox" class="checkboxes" value="1" /></td>
                                <td><?php echo $operatorRoute['operatorName'];?></td>
                                <td><?php echo $operatorRoute['routeName']. '&nbsp('.$operatorRoute['routeID'].')';?></td>
                                <td><?php echo $operatorRoute['standard_price'];?></td>
                                <td>
                                    <div class="form-group">
                                        <div class="">
                                            <input type="text" value="" name="newPrice" class="form-control" required>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="clearfix">
                                        <button type="submit" class="btn btn-sm green"> Add
                                            <i class="fa fa-map-signs"></i>
                                        </button>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

