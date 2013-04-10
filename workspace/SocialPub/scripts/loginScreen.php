<div class="" id="loginModal" >
    <div class="modal-header">
        <h3>Have an Account?</h3>
    </div>
    <div class="">
        <div class="well">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="loginTabs">
                    <li class="active"><a href="#loginForm" data-toggle="tab">Login</a></li>
                    <li ><a href="#registerForm" data-toggle="tab">Create Account</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="loginForm">
                        <?php  include("loginForm.php"); ?>
                    </div>
                    <div class="tab-pane" id="registerForm">
                        <?php include("registerForm.php");?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




