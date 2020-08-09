<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i><?php echo($userinfo['username'])."'".'s Credit History';?> </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body">
                <form id="table-form">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                        <thead>
                        <tr>

                            <th class="table-checkbox">
                                <input type="checkbox" class="group-checkable"  value="" data-set="#sample_3 .checkboxes" />
                            </th>

                            <th class="hidden-xs">
                                <i ></i> Given Date
                            </th>
                            <th class="hidden-xs">
                                <i ></i> Valide Up To
                            </th>
                            <th>
                                Credit Added
                            </th>
                            <th>
                                Credit Used
                            </th>
                            <th>
                                Remaining Credit
                            </th>
                            <th>
                                Credit Status
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        foreach($credits as $credit)
                        {
                            ?>

                            <tr>

                                <th class="table-checkbox">
                                    <input type="checkbox" class="group-checkable" name="checkboxes[]" value="" data-set="#sample_3 .checkboxes" />
                                </th>

                                <td class="hidden-xs">
                                    <?php echo $credit['start_date'];?>
                                </td>
                                <td class="hidden-xs">
                                    <?php echo $credit['end_date'];?>
                                </td>

                                <td>
                                    <?php echo $credit['sms_credit'].' &nbsp TK';?>
                                </td>
                                <td>
                                    <?php echo $credit['sms_usage'].' &nbsp TK';?>
                                </td>
                                <td>
                                    <?php
                                    if($credit['accStatus'])
                                    {
                                        echo $credit['remaining_credit'].' &nbsp TK';
                                        ?>

                                        <?php
                                    }
                                    else
                                    {
                                        echo $credit['remaining_credit'].' &nbsp TK';
                                        ?>

                                        <?php

                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if($credit['accStatus'])
                                    {

                                        ?>
                                        <span class="label label-success label-sm"> Active Balance </span>
                                        <?php
                                    }
                                    else
                                    {

                                        ?>
                                        <span class="label label-warning label-sm"> Used Balance </span>
                                        <?php

                                    }
                                    ?>
                                </td>

                            </tr>

                            <?php
                        }
                        ?>
                    </table>
                </form>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->

    </div>
</div>


