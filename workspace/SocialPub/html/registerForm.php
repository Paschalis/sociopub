<!DOCTYPE html>
<html lang=en>

<body>
<form id="registerForm">
    <div class="control-group">
        <label for="usernameRegister">Username</label>
        <input type="text" value="" class="input-xlarge" id="usernameRegister">
    </div>

    <div class="control-group">
        <label>First Name</label>
        <input type="text" value="" class="input-xlarge" id="nameRegister">
    </div>
    <div class="control-group">
        <label>Last Name</label>
        <input type="text" value="" class="input-xlarge" id="surnameRegister">
    </div>
    <div class="control-group">
        <label>Email</label>
        <input value="" class="input-xlarge" id="emailRegister" type="email"">
    </div>
        <div class="control-group">

        <label>Password</label>
        <input type="password" value="" class="input-xlarge" id="passwordRegister">
    </div>
        <div class="control-group">

        <label>Password Confirmation</label>
        <input type="password" value="" class="input-xlarge" id="confPasswordRegister">
    </div>
        <div class="control-group">

        <label>Gender</label>
        <select id="genderRegister">
            <option value="">Select Gender</option>
            }
            <option value="m">Male</option>
            <option value="f">Female</option>
        </select>
    </div>
    <div class="control-group">
        <label>Country</label>
        <select id="countryRegister">
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
