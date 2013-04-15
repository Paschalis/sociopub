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
                        <?php  include("loginForm.php"); ?>
                    </div>
                    <div class="tab-pane" id="registerFormTab">
                        <?php include("registerForm.php");?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Checks for Login and Register form


    $(document).ready(function () {


        // TODO  PAMPOS vale ola ta IPOLOIPOA STOIXEIA FORMAS sto query (me komma meta to surnameForm )
        // When form fields has changed TODO ele3e an en swsto ta ids: usernameForm, passwordForm etc!
        // TODO TRICKY: password + password confirm! prepei na en ta idia gia na en swsta! diaforetika kokkina kai ta 2!  #passwordForm,
        $("#usernameForm, #nameForm, #surnameForm, #emailForm, #genderForm, #countryForm").keyup(function () {

            checkInputField(this); // TODO ilopoiise tin methodo sto mainJavascript . Arkepsa tin egw!
        });

        $("#passwordForm, #confPasswordForm").keyup(function(){
            checkPassword($("#passwordForm"),$("#confPasswordForm"));
        });
        $("#countryForm, #genderForm").mouseleave(function(){
            checkInputField(this);
        });
/**
 * Touta nomizw prepei na ta kamoume j gia mouse alla en ime siouros
        $("#usernameForm, #nameForm, #surnameForm, #emailForm, #genderForm, #countryForm").mouseKATI

*/
    });

</script>




