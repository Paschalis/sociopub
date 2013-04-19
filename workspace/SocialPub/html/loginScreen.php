<div class="" id="loginModal">
    <div class="modal-header">
        <h3>Have an Account?</h3>
    </div>
    <div class="">
        <div class="well">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="loginTabs">
                    <li class="active"><a href="#loginFormTab" data-toggle="tab">Login</a></li>
                    <li><a href="#registerFormTab" data-toggle="tab">Create Account</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="loginFormTab">
                        <?php include("loginForm.php"); ?>
                    </div>
                    <div class="tab-pane" id="registerFormTab">
                        <?php include("registerForm.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // Live feedback on forms
    $(document).ready(function () {

        $("#usernameRegister, #passwordRegister, #confPasswordRegister, #nameRegister, " +
            "#surnameRegister, #emailRegister, #genderRegister, #countryRegister, " +
            "#usernameLogin, #passwordLogin").keyup(function () {

                var result = checkInputField(this);

//                // Something went wrong
//                if (result != "") {
//
//                    $(this).tooltip('show',{
//                        'title': result,
//                        'placement': 'bottom'
//                    });
//
//
//                }
//                else {
//                    $(this).tooltip('hide');
//                }

            });


    });

</script>




