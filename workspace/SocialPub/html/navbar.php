<div class="navbar navbar-inverse"> <!-- TODO removed navbar-fixed-top-->
    <div class="navbar-inner">
        <div class="container">
            <!-- Menu button when navbar is collapsed-->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" <?php echo 'href="' . _URL . '"'; ?>><?php echo _NAME; ?></a>

            <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Link 2</a></li>
                </ul>
                <!--                    DropDown Comment out-->
                <!--                    <li class="dropdown">-->
                <!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>-->
                <!--                        <ul class="dropdown-menu">-->
                <!--                            <li><a href="#">Sports</a></li>-->
                <!--                            <li class="divider"></li>-->
                <!--                            <li class="nav-header">Nav header</li>-->
                <!--                        </ul>-->
                <!--                    </li>-->

                <!-- Right navigation-->
                <ul class="nav pull-center">
                    <form class="navbar-search pull-left" action="">
                        <input type="text" class="search-query span2" placeholder="Search">
                    </form>
                </ul>

                <!-- Right in navbar-->
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown"  <?php
                    //If user is logged in, make visible account tab
                    if ($_SESSION['loggedin'] == 1) {
                        echo 'style="display: inline"';
                    } else {
                        echo 'style="display: none"';
                    }
                    ?> >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:logout()">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>