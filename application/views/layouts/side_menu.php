<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">


        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
         <ul class="page-sidebar-menu   " data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
			<li class="nav-item ">
                <a href="<?php echo base_url('dashboard/index');?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <!-- <span class="arrow"></span> -->
                </a>
            </li>


            <li class="nav-item ">
                <a href="<?php echo base_url('LeaderBoard');?>" class="nav-link nav-toggle">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span class="title">Leaderboard</span>
                    <!-- <span class="arrow"></span> -->
                </a>
            </li>


            <li class="nav-item ">
                 <a href="<?php echo base_url('OrderLists');?>" class="nav-link nav-toggle">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="title">Orders List</span>
                    <!-- <span class="arrow"></span> -->
                </a>
            </li>


           
			
            <?php if($this->uri->segment(1) == 'user')
            {
            ?>
                <li class="nav-item start active open">
            <?php
            }
            else
            {
            ?>
                <li class="nav-item">
            <?php
            }
            ?>
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-group"></i>
                    <span class="title">User Management</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <!-- <li class="nav-item  ">
                        <a href="<?php echo site_url('user/createUser');?>" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Create User</span>
                        </a>
                    </li> -->

                    <li class="nav-item  ">
                        <a href="<?php echo site_url('user/userList');?>" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">System User List</span>
                        </a>
                    </li>

                    <li class="nav-item  ">
                        <a href="<?php echo site_url('employee/employeeList');?>" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Employee List</span>
                        </a>
                    </li>


                    

                </ul>
            </li>

            <?php if($this->uri->segment(1) == 'clients')
            {
            ?>
            <li class="nav-item start active open">
                <?php
                }
                else
                {
                ?>
            <li class="nav-item">
                <?php
                }
                ?>
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-mobile"></i>
                    <span class="title">Clients</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('client/clientList');?>" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Client List </span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('client/createClient2');?>" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Add New Client</span>
                        </a>
                    </li>
                </ul>
            </li>

            <?php if($this->uri->segment(1) == 'route')
            {
            ?>
            <li class="nav-item start active open">
                <?php
                }
                else
                {
                ?>
            <li class="nav-item">
                <?php
                }
                ?>
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-map-signs"></i>
                    <span class="title">Products</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Products List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Add New Product</span>
                        </a>
                    </li>
                </ul>
            </li>


            <?php if($this->uri->segment(1) == 'operatorRoute')
            {
            ?>
            <li class="nav-item start active open">
                <?php
                }
                else
                {
                ?>
            <li class="nav-item">
                <?php
                }
                ?>
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span class="title">Systems Settings</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Financial Institution Management</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            <span class="title">Plant Management</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->