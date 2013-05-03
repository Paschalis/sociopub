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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Sports</a></li>
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
    <!-- /navbar-inner -->
    <!--Filter for categories TODO ENABLE-->
<!--    <li>-->
<!--        <div id="options" class="clearfix" class="option-combo">-->
<!---->
<!--            <ul id="filter" class="option-set clearfix" data-option-key="filter">-->
<!--                <li><a href="#" data-option-value="*" class="selected">Everything</a></li>-->
<!--                <li><a href="#" data-option-value=".cinema">Cinema</a></li>-->
<!--                <li><a href="#" data-option-value=".economy">Economy</a></li>-->
<!--                <li><a href="#" data-option-value=".entertainment">Entertainment</a></li>-->
<!--                <li><a href="#" data-option-value=".health">Health</a></li>-->
<!--                <li><a href="#" data-option-value=".history">History</a></li>-->
<!--                <li><a href="#" data-option-value=".lifestyle">Lifestyle</a></li>-->
<!--                <li><a href="#" data-option-value=".music">Music</a></li>-->
<!--                <li><a href="#" data-option-value=".news">News</a></li>-->
<!--                <li><a href="#" data-option-value=".science">Science</a></li>-->
<!--                <li><a href="#" data-option-value=".sports">Sports</a></li>-->
<!--                <li><a href="#" data-option-value=".technology">Technology</a></li>-->
<!--                <li><a href="#" data-option-value=".travel">Travel</a></li>-->
<!--                <li><a href="#" data-option-value=".other">Other</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </li>-->
