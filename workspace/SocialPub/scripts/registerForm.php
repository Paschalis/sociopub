
<form id="registerForm" >
   <div> <label for="usernameForm">Username</label>
    <input type="text" value="" class="input-xlarge" id="usernameForm" onchange="username_Changed(this)"/>
   <span></span>
   </div>

    <label>First Name</label>
    <input type="text" value="" class="input-xlarge" id="nameForm" required>
    <label>Last Name</label>
    <input type="text" value="" class="input-xlarge" id="surnameForm">
    <label>Email</label>
    <input value="" class="input-xlarge" id="emailForm" type="email">
    <label>Password</label>
    <input type="password" value="" class="input-xlarge" id="passwordForm">
    <label>Password Confirmation</label>
    <input type="password" value="" class="input-xlarge" id="confPasswordForm">
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

<!--drop down menus->