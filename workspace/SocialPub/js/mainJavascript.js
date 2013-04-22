/**
 * Created with JetBrains PhpStorm.
 * User: paschalis
 * Date: 4/11/13
 * Time: 2:05 AM
 * To change this template use File | Settings | File Templates.
 */


// Global variables
var DELAY_MEDIUM = 4000;
var DELAY_LOGIN_FORM_ERROR = 4000;
var DELAY_AJAX_ERROR = 4000;
var DELAY_REGISTER_FORM_ERROR = 6000;

/**
 * When the document is ready (fully loaded)
 */
$(document).ready(function () {

    //When register button is clicked
    $("#registerButton").click(function () {


        var formData = checkRegisterForm();

        // Form data are wrong
        if (formData['code'] == 0) {
            showNotification(formData, DELAY_REGISTER_FORM_ERROR);
        }
        else {
            // Try to register user and return the success of failure value
            // success here mean that form data where correct and an attemp to
            // save them was made
            registerUser(formData);

        }


        return false;

    });

    //When register button is clicked
    $("#loginButton").click(function () {

        var loginData = checkLoginForm();


        //Something went wrong
        if (loginData['code'] != 1) {
            showNotification(loginData, DELAY_LOGIN_FORM_ERROR);
        }
        else {
            //Login user
            var formData = new Object();
            formData['username'] = loginData['username'];
            formData['password'] = loginData['password'];

            ajaxJsonRequest("scripts/login.php",
                formData,
                ajaxSuccessLogin,
                ajaxFailed);
        }
        return false;
    });


    //When notification is clicked
    $("#notification").click(function () {

        $(this).removeClass('in').addClass("out");

    });
});


/*
 *
 * Logouts a user from webpage
 *
 * */
function logout() {
    ajaxJsonRequest("scripts/logout.php",
        "",
        ajaxSuccessLogout,
        ajaxFailed);
}


/**Checks register form for possible errors
 * and returns forms data in JSon object
 * */
function checkLoginForm() {
    var username = $("#usernameLogin");

    var password = $("#passwordLogin");

    var msg = "";

    var result = new Object();

    // Check user and pass
    msg += checkUsername(username);
    msg += checkPassword(password);

    if (msg != "") {

        result['code'] = 0;
        result['message'] = msg;

    }
    else {
        result['code'] = 1;
        result['username'] = username.val();
        result['password'] = password.val();
    }

    return result;
}


/**Checks register form for possible errors
 * and returns forms data in JSon object
 * */
function checkRegisterForm() {

    var username = $("#usernameRegister");
    var password = $("#passwordRegister");
    var confPassword = $("#confPasswordRegister");
    var name = $("#nameRegister");
    var surname = $("#surnameRegister");
    var gender = $("#genderRegister");
    var email = $("#emailRegister");
    var country = $("#countryRegister");

    var msg = "";
    var result = "";


    msg += checkUsername(username);
    msg += checkPasswords(password, confPassword);
    msg += checkName(name);
    msg += checkSurname(surname);
    msg += checkGender(gender);
    msg += checkCountry(country);
    msg += checkEmail(email);


    // Check result
    var result = new Object();

    if (msg != "") {
        result['code'] = 0;
        result['message'] = msg;
    }
    else {
        result['code'] = 1;
        result['username'] = username.val();
        result['password'] = password.val();
        result['confPassword'] = confPassword.val();
        result['name'] = name.val();
        result['surname'] = surname.val();
        result['gender'] = gender.val();
        result['email'] = email.val();
        result['country'] = country.val();

    }


    return result;
}


/**
 * Register user to database with asynchronous request
 *
 */
function registerUser(formData) {

    // Send data to server
    ajaxJsonRequest("scripts/register.php",
        formData,
        ajaxSuccessRegister,
        ajaxFailed);

}


/**
 * Called when failed to contact register PHP script
 *
 */
function ajaxFailed() {

    var data = new Object();

    data['code'] = 0;
    data['message'] = "Something went wrong!";

    showNotification(data, DELAY_AJAX_ERROR);

}


/**
 * Called when successfully contact register PHP script.
 * That doesnt mean registration was successfull
 *
 */
function ajaxSuccessLogin(result) {

    var jsonObj = eval('(' + result + ')');

    // Login was successfull
    if (jsonObj['code'] == 1) {
        window.location.reload();
    }
    //Something is wrong: user/pass or user banned/not activated yet
    else {
        //Show notification alert
        showNotification(jsonObj, DELAY_MEDIUM);
    }


}


/**
 * Called when successfully contact register PHP script.
 * That doesnt mean registration was successfull
 *
 */
function ajaxSuccessLogout(result) {

    var jsonObj = eval('(' + result + ')');


    //Successfully logged out -- Reload webpage
    if (jsonObj['code'] == 1) {
        window.location.reload();
    }
    else {
        // something went wrong
        var msg = new Object();
        msg['code'] == 0;

        msg['message'] = "Failed to log out. Something went wrong";

        //Show notification alert
        showNotification(msg, DELAY_MEDIUM);
    }


}


/**
 * Called when successfully contact register PHP script.
 * That doesnt mean registration was successfull
 *
 */
function ajaxSuccessRegister(result) {

    var jsonObj = eval('(' + result + ')');

    //Show message according to registration status
    showNotification(jsonObj, DELAY_MEDIUM);

}


/*
 * Checks input fields and updates the UI
 *
 * */
function checkInputField(element) {

// Get elements id
    switch ($(element).attr("id")) {

        //TODO MAKE ALL THOSE WITH RETUNR !
        //Handle usernames
        case "usernameLogin":
            return checkUsername(element);
            break;
        case "usernameRegister":
            checkUsername(element);
            break;
        case "passwordLogin":
            return checkPassword(element);
        case "passwordRegister":
            //DONE
            checkPasswords($("#passwordRegister"),$("#confPasswordRegister"));
            break;
        case "confPasswordRegister":
            checkPasswords($("#passwordRegister"),$("#confPasswordRegister"));
            break;
        case "nameRegister":
            checkName(element);
            break;
        case "surnameRegister":
            checkSurname(element);
            break;
        case "genderRegister":
            checkGender(element);
            break;
        case "countryRegister":
            checkCountry(element);
            break;
        case "emailRegister":
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
    if (value != "" && value.length <= 30) {

        $(username).parent().removeClass('error');

    }
    // Username is wrong
    else {

        $(username).parent().removeClass('success').addClass("error");

        if (value.length > 30) {
            msg = "Username cant be more than 30 characters.<br/>";
        }
        else {
            msg = "Username cant be empty.<br/>";
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
            msg = "<div>Password cant be more than 40 characters.</div>";
        }
        else {
            msg = "<div>Password cant be empty.</div>";
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
        msg = "Please fill the Password and Password Confirmation fields<br>";
    }
    else if (pass == conf) {
        $(password).parent().removeClass('error').addClass("success");
        $(confPassword).parent().removeClass('error').addClass("success");
    }
    // password and confirmPassword are not equal or their fields ar empty
    else {
        $(password).parent().removeClass('success').addClass("error");
        $(confPassword).parent().removeClass('success').addClass("error");


        msg = "Wrong password confirmation<br>";

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
            msg = "First name field cant be empty<br>";
        }
        else if (value.length > 40) {
            msg = "First name must be smaller than 40 characters<br>";
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
            msg = "Last name field cant be empty<br>";
        }
        else if (value.length > 40) {
            msg = "Last name must be smaller than 40 characters<br>";
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
        $(gender).parent().removeClass('error').addClass("success");

    }
    else {
        $(gender).parent().removeClass('success').addClass("error");
        msg = "Specify your gender.<br>";
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
        $(country).parent().removeClass('error').addClass("success");
    }
    else {

        if (value.length > 40) {
            msg = "Country length cant be more than 60 characters.<br>";
        }
        else {
            msg = "Please choose your country.<br>";
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
            msg = "Please write your email address in the Email field<br>";
        }
        else if (!isEmailCorrect(value)) {
            msg = "The email address is not valid<br>";
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

    var notification = $("#notification");

    //Show error message
    if (data['code'] == 0) {
        notification.removeClass('alert-success alert-info').addClass('alert-error');

    }
    //Show success message
    else if (data['code'] == 1) {
        notification.removeClass('alert-error alert-info').addClass('alert-success');
    }
    //Show info
    else if (data['code'] == 2) {
        notification.removeClass('alert-success alert-error').addClass('alert-info');
    }

    // Show success message
    notification.html(data['message']);

    //Show notification
    notification.removeClass('out').addClass("in");

    // Set notification timeout delay
    window.setTimeout(function () {
        notification.removeClass('in').addClass("out");
    }, duration);

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

/**
 * Downloads an article
 * */
function saveArticle() {

    //Get the url for the article
    var articleUrl = $("#newArticleInput").val();
    var formData = new Object();

    formData['url']=articleUrl;

    ajaxJsonRequest("scripts/getArticle.php",
        formData,
        getArticleSuccess,
        ajaxFailed);


    $("#buttonsToolbar").removeClass('fade out').addClass("fade in");


}


/**
 * TODO DIMITRI INFO
 *
 * */
function getArticleSuccess(data) {

    // TODO HANDLE CASE WHEN ARTICLE DOESNT EXISTS IN HERE !

    var jsonObj;

    try {
        jsonObj = eval('(' + data + ')');

    }
    // Failed to fetch article
    catch (e) {
        if (e instanceof SyntaxError) {

            makeShowNotification(0, "Failed to fetch article!", DELAY_MEDIUM);

            return;
        }
    }




    var code = jsonObj['code'];



    //Failed to fetch data
    if(code==0){
        makeShowNotification(0, jsonObj['message'], DELAY_MEDIUM);
        return;
    }



    var title = jsonObj['title'];
    var description = jsonObj['description'];
    var image = jsonObj['image'];
    var siteName = jsonObj['siteName'];


    // Set the image
    $("#newArticle .thumbnail .articleimg").attr({src: image});

    $("#newArticle .thumbnail .articletitle").html(title + " - " + siteName);

    $("#newArticle .thumbnail .articledesc").html(description);

    $("#newArticle .thumbnail").removeClass('out').addClass('in');
    $("#newArticle #postNewArticle").removeClass('out').addClass('in');



    // When user posts new article
    $("#postNewArticle").click(function(){

    });



}


/**
 * TODO CHANGE
 *
 * */
function makeShowNotification(code, msg, delay) {

    var obj = new Object();

    obj['code'] = 0;
    obj['message'] = msg;

    showNotification(obj, delay);

}
