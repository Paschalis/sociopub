/**
 * Created with JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/11/13
 * Time: 2:05 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * When the document is ready (fully loaded)
 */
$(document).ready(function () {

    //When register button is clicked
    $("#registerButton").click(function () {

        var registerData = checkRegisterForm();

        if (registerData == "") {
            //TODO Data are wrong. SHow notificaiton

            return false; //form didnt submitted
        }
        else {

            //Try to register user and return the success of failure value
            //success here mean that form data where correct and an attemp to
            // save them was made
            return registerUser(registerData);

        }


    });

    //When register button is clicked
    $("#loginButton").click(function () {

//        var loginData = checkLoginForm();

//        showNotification(loginData, 3000);

        return false;
    });


    //When notification closebutton is clicked
    $("#notificationClose").live().click(function () {
        //Hide notification
        // TODO MAKE THIS WITH FADE EFFECT!
        $("#notification").hide(500);
        $("#notification").css({class: "hidden"});
//
    });
});


/**Checks register form for possible errors
 * and returns forms data in JSon object
 * */
function checkLoginForm() {
    var username = $("#usernameLogin");

    var password = $("#passwordLogin");

    var msg = "";

    var result = new Object();

    // Check user and pass
    var m1 = checkUsername(username);
    var m2 = checkPassword(password);

    alert(m1 + m2);

    if (m1 != "" || m2 != "")
        msg = "Username or password cant be empty";

    if (msg != "") {

        result['code'] = 0;
        result['message'] = msg;

    }
    else {
        result['code'] = 1;
        result['username'] = username;
        result['password'] = password;
        result['message'] = "Welcome!";
    }

    return result;
}


/**Checks register form for possible errors
 * and returns forms data in JSon object
 * */
function checkRegisterForm() {

    var username = $("#usernameForm");
    var password = $("#passwordForm");
    var confPassword = $("#confPasswordForm");
    var name = $("#nameForm");
    var surname = $("#surnameForm");
    var gender = $("#genderForm");
    var email = $("#emailForm");
    var country = $("#countryForm");

    // TODO PAMPOS IMPLEMENT THIS!
    // NA KAMES OLA TA LA8OS INPUT DATA KOKKINA!
    // GIREPSE EDW PROS TO TELOS TOU FORMS: http://twitter.github.io/bootstrap/base-css.html?#forms

    // Google search and implement:
    // update bootstrap form with wrong fields (eg turn red the outline of input boxes)

    var msg = "";
    var result = "";

    msg += checkUsername(username);
    msg += checkPasswords(password, confPassword);
    msg += checkName(name);
    msg += checkSurname(surname);
    msg += checkGender(gender);
    msg += checkCountry(country);
    msg += checkEmail(email);


//TODO KAME KAI TA IPOLOIPA ETSI!
    // alla3e to panw na pianei to element(an ine swsto)
    // kai kalese tes methodous! pou 8a valeis copy paste ta pramata tous mesa!

    if (!dataCorrect) {
        //TODO MAKE THIS notification
        alert("Input is wrong!\n" + msg);

        return "";
    }
    else {
        var result = new Object();

        result['username'] = username;
        result['password'] = password;
        result['confPassword'] = confPassword;
        result['name'] = name;
        result['surname'] = surname;
        result['gender'] = gender;
        result['email'] = email;
        result['country'] = country;

        return result;

    }


}


/**
 * Register user to database with asynchronous request
 *
 */
function registerUser(formData) {

    //TODO CHECK FORM DATA!


//    ajaxJsonRequest("register.php",)

    // Send data to server
    ajaxJsonRequest("scripts/register.php",
        formData,
        ajaxRegisterSuccess(),
        ajaxRegisterFailed());

    return true; // form submitted

}


/**
 * Called when failed to contact register PHP script
 *
 */
function ajaxRegisterFailed() {

    var data = new Object();

    data['code'] = 0;
    data['message'] = "Registration failed.";


    showNotification(data);

}


/**
 * Called when successfully contact register PHP script.
 * That doesnt mean registration was successfull
 *
 */
function ajaxRegisterSuccess(result) {

    //TODO USE SHOW  NOTIFICATION FUNCTION


    //Show notification alert
    $("#notification").show(200);
    $("#notification").css({class: "alert-success"});
    //-success,-info,-waning, alla3e xrwma
    //TODO parse this json object and show results
    $("#notificationMessage").text('server: ' + result);

    //TODO if result <=0, then class = alert-error
}


/*
 * Checks input fields and updates the UI
 *
 * */
function checkInputField(element) {


// Get elements id
    switch ($(element).attr("id")) {
        case "usernameForm":
            checkUsername(element);
            break;
        case "passwordForm":
            //TODO
            //checkPassword(element);
            //problem here
            break;
        case "nameForm":
            checkName(element);
            break;
        case "surnameForm":
            checkSurname(element);
            break;
        case "genderForm":
            checkGender(element);
            break;
        case "countryForm":
            checkCountry(element);
            break;
        case "emailForm":
            checkEmail(element);
            break;
        //TODO OTHERS

    }


}


/*
 *
 * Checks if the username is correct
 * */
function checkUsername(username) {

    var value = $(username).val();
    var msg = "";


// Username is correct
    if (value != "" && value.length <= 15) {

        $(username).parent().removeClass('error');

    }
    // Username is wrong
    else {

        $(username).parent().removeClass('success').addClass("error");

        if (value.length > 15) {
            msg = "Username cant be more than 15 characters\n";
        }
        else {
            msg = "Username cant be empty\n";
        }
    }

    return msg;
}


/*
 * Checks if password or confirmation password is correct
 * */
function checkPassword(password) {

    var value = $(password).val();
    var msg = "";


// Username is correct
    if (value != "" && value.length <= 40) {

        $(password).parent().removeClass('error');

    }
    // Username is wrong
    else {

        $(password).parent().removeClass('success').addClass("error");

        if (value.length > 40) {
            msg = "Password cant be more than 40 characters\n";
        }
        else {
            msg = "Passswordcant be empty\n";
        }
    }

    return msg;
}


//TODO FIX THIS!

/**
 *
 *
 * */
function checkPasswords(password, confPassword) {


    var pass = $(password).val();
    var conf = $(confPassword).val();


    var msg = "";

    if (pass == "" || conf == "") {
        msg = "Please fill the Password and Password Confirmation fields\n";
    }
    else if (pass == conf) {
        $(password).parent().removeClass('error');
        $(confPassword).parent().removeClass('error').addClass("success");
    }
    // password and confirmPassword are not equal or their fields ar empty
    else {
        $(password).parent().removeClass('success').addClass("error");
        $(confPassword).parent().removeClass('success').addClass("error");


        msg = "Wrong password confirmation\n";

    }


    return msg;

}


/**
 *
 *
 * */
function checkName(name) {
    var value = $(name).val();
    var msg = "";

    if (value != "" && value.length <= 40) {
        $(name).parent().removeClass('error');
    }
    else {
        $(name).parent().removeClass('success').addClass("error");

        if (value == "") {
            msg = "First name field cant be empty\n";
        }
        else if (value.length > 40) {
            msg = "First name must be smaller than 40 characters\n";
        }
    }
    return msg;
}


/**
 *
 *
 * */
function checkSurname(surname) {
    var value = $(surname).val();
    var msg = "";

    if (value != "" && value.length <= 40) {
        $(surname).parent().removeClass('error');
    }
    else {
        $(surname).parent().removeClass('success').addClass("error");

        if (value == "") {
            msg = "Last name field cant be empty\n";
        }
        else if (value.length > 40) {
            msg = "Last name must be smaller than 40 characters\n";
        }
    }
    return msg;
}


/**
 *
 *
 * */
function checkGender(gender) {
    var value = $(gender).val();
    var msg = "";

    if (value == "m" || value == "f") {
        //TODO make gender red
        $(gender).parent().removeClass('error');

    }
    else {
        $(gender).parent().removeClass('success').addClass("error");
        msg = "Specify your gender \n";
    }

    return msg;

}


/**
 *
 *
 * */
function checkCountry(country) {
    var value = $(country).val();
    var msg = "";

    if (value != "" && value.length <= 40) {
        $(country).parent().removeClass('error');
    }
    else {

        if (value.length > 40) {
            msg = "Country length cant be more than 60 characters.\n";
        }
        else {
            msg = "Please choose your country.\n";
        }

        $(country).parent().removeClass('success').addClass("error");

    }
    return msg;
}


/**
 *
 *
 * */
function checkEmail(email) {
    var value = $(email).val();
    var msg = "";
    if (value != "" && isEmailCorrect(value)) {
        $(email).parent().removeClass('error');
    }
    else {
        $(email).parent().removeClass('success').addClass("error");
        if (value == "") {
            msg = "Please write your email address in the Email field\n";
        }
        else if (!isEmailCorrect(value)) {
            msg = "The email address is not valid\n";
        }
    }
    return msg;
}


/**
 *
 * Checks if an email address is correct
 */
function isEmailCorrect(email) {
    // Regexp
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    return (reg.test(email));
    //this copied from paschalis code OK
}


/*
 *   Show a notification alert according the object received
 *
 * */
function showNotification(data, duration) {

    //Show error message
    if (data['code'] == 0) {
        $("#notification").css({class: "alert-success"});
    }
    //Show success message
    else if (data['code'] == 1) {
        $("#notification").css({class: "alert-error"});
    }
    //Show info
    else if (data['code'] == 2) {
        $("#notification").css({class: "alert-info"});
    }


    $("#notification").show(200);

    // Show success message
    $("#notificationMessage").text(data['message']);

    $("#notification").delay(duration).fadeOut(500);

    //TODO AUTOHIDE NOTIFICATION
}


/*
 * Send AJAX request with json data, using
 * */
function ajaxJsonRequest(url, formData, successCallback, failCallback) {


    var jqxhr = $.post(url, formData)
        .done(function (data) {
            successCallback(data);

        })
        .fail(failCallback);
    // .always(); -- Not used


}
