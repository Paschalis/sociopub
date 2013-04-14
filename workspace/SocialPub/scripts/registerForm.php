<!DOCTYPE html>
<html lang=en>

<body>
<form id="registerForm" >
   <div> <label for="usernameForm">Username</label>
    <input type="text" value="" class="input-xlarge" id="usernameForm" onchange="username_Changed(this)" required="">
   <span></span>
   </div>

    <label>First Name</label>
    <input type="text" value="" class="input-xlarge" id="nameForm" required>
    <label>Last Name</label>
    <input type="text" value="" class="input-xlarge" id="surnameForm" required>
    <label>Email</label>
    <input value="" class="input-xlarge" id="emailForm" type="email" required="">
    <label>Password</label>
    <input type="password" value="" class="input-xlarge" id="passwordForm" required="">
    <label>Password Confirmation</label>
    <input type="password" value="" class="input-xlarge" id="confPasswordForm" required="">
    <label>Gender</label>
    <!--<input type="text" value="" class="input-xlarge" id="genderForm">-->
    <select id="genderForm">
        <option value="Select Gender">Select Gender</option>}
        <option value="m">Male</option>
        <option value="f">Female</option>
    </select>
    <label>Country</label>
    <!-- <input type="text" value="" class="input-xlarge" id="countryForm">-->
<select id="countryForm">
    <option value="">Select Country</option>}
    <option value="Cyprus">Cyprus</option>
    <option value="Other">Other</option>
</select>
    <div>
        <button class="btn btn-primary" id="registerButton">Create Account</button>
    </div>
</form>


updateFormFieldStatusEmail($("#emailForm"));

<!--updateFormFieldStatusTelephone($("#register-form-telephone"));-->


updateFormFieldStatusConfirmPassword($("#confPasswordForm"));

updateFormFieldStatusPassword($("#passwordForm"));
<!--drop down menus-->

</body>
</html>
