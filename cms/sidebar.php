        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion green-font" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon  green-font">
                   Welcome !
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo $arr_sidenav['dashboard']['active']; ?>">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt  green-font"></i>
                    <span>Dashboard</span></a>
            </li>
			<!-- Divider -->
            <hr class="sidebar-divider">
			<!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo $arr_sidenav['updates']['active']; ?>">
                <a class="nav-link collapsed" href="updates.php" data-toggle="collapse" data-target="#collapseFive"
                    aria-expanded="<?php echo $arr_sidenav['updates']['expanded'];?>" aria-controls="collapseFive">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Updates</span>
                </a>
                <div id="collapseFive" class="collapse <?php echo $arr_sidenav['updates']['collapse'];?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6>-->
                        <a class="collapse-item  <?php echo $arr_sidenav['updates']['show_all']['active']; ?>" href="updates.php">View All Updates</a>
                        <a class="collapse-item <?php echo $arr_sidenav['updates']['add']['active']; ?>" href="add_update.php">Add Update</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->
			<!-- Nav Item - Pages Collapse Menu -->
            <!--
			<li class="nav-item <?php echo $arr_sidenav['updates']['active']; ?>">
                <a class="nav-link collapsed" href="carousel.php" data-toggle="collapse" data-target="#collapseSix"
                    aria-expanded="<?php echo $arr_sidenav['updates']['expanded'];?>" aria-controls="collapseSix">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Carousel Images</span>
                </a>
                <div id="collapseSix" class="collapse <?php echo $arr_sidenav['updates']['collapse'];?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item  <?php echo $arr_sidenav['updates']['show_all']['active']; ?>" href="carousel.php">View All Carousel</a>
                        <a class="collapse-item <?php echo $arr_sidenav['updates']['add']['active']; ?>" href="add_carousel.php">Add Carousel</a>
                    </div>
                </div>
            </li>
            -->
			<hr class="sidebar-divider">
			<!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo $arr_sidenav['lifecycle']['active']; ?>">
                <a class="nav-link collapsed" href="lifecycles.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="<?php echo $arr_sidenav['lifecycle']['expanded'];?>" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>L1: Lifecycles</span>
                </a>
                <div id="collapseTwo" class="collapse <?php echo $arr_sidenav['lifecycle']['collapse'];?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6>-->
                        <a class="collapse-item  <?php echo $arr_sidenav['lifecycle']['show_all']['active']; ?>" href="lifecycles.php">View All Lifecycles</a>
                        <a class="collapse-item <?php echo $arr_sidenav['lifecycle']['add']['active']; ?>" href="add_lifecycle.php">Add Lifecycle</a>
                    </div>
                </div>
            </li>
			<!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo $arr_sidenav['category']['active']; ?>">
                <a class="nav-link collapsed" href="lifecycles.php" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="<?php echo $arr_sidenav['category']['expanded'];?>" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>L2: Categories</span>
                </a>
                <div id="collapseThree" class="collapse <?php echo $arr_sidenav['category']['collapse'];?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6>-->
                        <a class="collapse-item  <?php echo $arr_sidenav['category']['show_all']['active']; ?>" href="categories.php">View All Categories</a>
                        <a class="collapse-item <?php echo $arr_sidenav['category']['add']['active']; ?>" href="add_category.php">Add Category</a>
                    </div>
                </div>
            </li>


			<!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php echo $arr_sidenav['indicators']['active']; ?>">
                <a class="nav-link collapsed" href="lifecycles.php" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="<?php echo $arr_sidenav['indicators']['expanded'];?>" aria-controls="collapseFour">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>L3: Indicators</span>
                </a>
                <div id="collapseFour" class="collapse <?php echo $arr_sidenav['indicators']['collapse'];?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6>-->
                        <a class="collapse-item  <?php echo $arr_sidenav['indicators']['show_all']['active']; ?>" href="indicators.php">View All Indicators</a>
                        <a class="collapse-item <?php echo $arr_sidenav['indicators']['add']['active']; ?>" href="add_indicator.php">Add Indicator</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->