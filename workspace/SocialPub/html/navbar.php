
<div class="navbar navbar-inverse"> <!-- TODO removed navbar-fixed-top-->
    <div class="navbar-inner">
        <div class="container">
            <!-- Menu button when navbar is collapsed-->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" <?php echo 'href="'._URL.'"'; ?>><?php echo _NAME; ?></a>

            <div class="nav-collapse collapse navbar-responsive-collapse">
                <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Categories</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown1 <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Right navigation-->
                <ul class="nav pull-right">
                    <form class="navbar-search pull-left" action="">
                        <input type="text" class="search-query span2" placeholder="Search">
                    </form>
                    <li><a href="#">Link 3</a></li>
                    <li class="divider-vertical"></li>
                    <li <?php
                        //If user is logged in, make visible account tab
                        if($_SESSION['loggedin']==1){
                            echo 'class=" dropdown fade in"';
                        }
                    else{
                        echo 'class="dropdown fade out"';
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
    <!-- /navbar-inner -->
</div>