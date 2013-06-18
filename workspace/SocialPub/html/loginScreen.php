<!--

Copyright 2013, Internet Technologies course (code epl425) Team, at Computer Science Dept., University of Cyprus,

Members:
Dr. Marios Dikaiakos,
Dimitris Christofi, Paschalis Mpeis, Pampos Charalambous.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

-->
<div class="span6" id="loginModal">
    <div class="modal-header">
        <h3>Have an Account?</h3>
    </div>
    <div >
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

            });

    });

</script>




