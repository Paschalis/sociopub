<!DOCTYPE html>
<html lang=en>

<body>
<form id="registerForm">
    <div class="control-group">
        <label for="usernameForm">Username</label>
        <input type="text" value="" class="input-xlarge" id="usernameForm">
    </div>

    <div class="control-group">
        <label>First Name</label>
        <input type="text" value="" class="input-xlarge" id="nameForm">
    </div>
    <div class="control-group">
        <label>Last Name</label>
        <input type="text" value="" class="input-xlarge" id="surnameForm">
    </div>
    <div class="control-group">
        <label>Email</label>
        <input value="" class="input-xlarge" id="emailForm" type="email"">
    </div>
        <div class="control-group">

        <label>Password</label>
        <input type="password" value="" class="input-xlarge" id="passwordForm">
    </div>
        <div class="control-group">

        <label>Password Confirmation</label>
        <input type="password" value="" class="input-xlarge" id="confPasswordForm">
    </div>
        <div class="control-group">

        <label>Gender</label>
        <select id="genderForm">
            <option value="">Select Gender</option>
            }
            <option value="m">Male</option>
            <option value="f">Female</option>
        </select>
    </div>
    <div class="control-group">
        <label>Country</label>
        <!-- <input type="text" value="" class="input-xlarge" id="countryForm">-->
        <select id="countryForm">
            <option value="">Select Country</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div>
        <button class="btn btn-primary" id="registerButton">Create Account</button>
    </div>
</form>
</body>
</html>
