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

//AKiri
/**function username_Changed(usernameForm)
{
    $("#usernameForm").style.borderColor=($("#usernameForm").val().length>15) ? "#FF0000" : $("#usernameForm").style.borderColor="#e52213";
}

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
   //p.x. username.ontextChange
    //

    //When login button is clicked TODO


    //When notification closebutton is clicked
    $("#notificationClose").click(function () {
        //Hide notification
        // TODO MAKE THIS WITH FADE EFFECT!
        $("#notification").hide(500);
        $("#notification").css({class:"hidden"});

    });
});


/**Checks register form for possible errors
 * and returns forms data in JSon object
 * */
function checkRegisterForm() {

    var username = $("#usernameForm").val();
    var password = $("#passwordForm").val();
    var confPassword = $("#confPasswordForm").val();
    var name = $("#nameForm").val();
    var surname = $("#surnameForm").val();
    var gender = $("#genderForm").val();
    var email = $("#emailForm").val();
    var country = $("#countryForm").val();

    //assume data will be correct
    var dataCorrect = true;

    // TODO PAMPOS IMPLEMENT THIS!
    // NA KAMES OLA TA LA8OS INPUT DATA KOKKINA!
    // GIREPSE EDW PROS TO TELOS TOU FORMS: http://twitter.github.io/bootstrap/base-css.html?#forms

    // Google search and implement:
    // update bootstrap form with wrong fields (eg turn red the outline of input boxes)

    var msg = "";
    var result = "";

    //Check username
    if (username == "" ) {//or lenghth >15=>problem
        //TODO MAKE USERNAME RED
        msg += "You must fill the username field\n";
        dataCorrect = false;
       // $("#usernameForm").css({class:"alert alert-error fade in"});
        //$("#usernameForm").css({class:"alert-error"});
        //kame to kouti kokkino

    }
    if(username.length>15){
        msg += "Invalid Username. You must choose a smaller than 15 characters.\n";
       // $("#usernameForm").css("border-bottom-color", "#fff");
       // $('#usernameForm').css('border-bottom', 'solid 10px red');
        $('#usernameForm').css('borderColor', 'green');
        $('#usernameForm').css('boxShadow', '1px 3px 6px red');

        // usernmame.keyup()
        //document.getElementById($("#usernameForm")).style.border = "4px solid red";
        //$("#usernameForm").css({box-shadow: 0 0 4px green;});
        //$("#usernameForm").css({class:"controls-inputError"});
        //$("#usernameForm").color({border:"red"});
        dataCorrect = false;
    }

    if (password == "") {
        //TODO MAKE password RED
        msg += "Please fill the Passwors field \n";

        dataCorrect = false;
    }
    if (confPassword == "") {
        //TODO MAKE confpassword RED
        msg += "Please confirm your password\n";

        dataCorrect = false;
    }

    if(confPassword!=password){
        //TODO Passwords dont match
        msg+="Wrong confirmation of password!\n";
        $('#paswordForm').css('boxShadow', '2px 2px 2px  green');
        dataCorrect = false;
    }



    if (name == "") {
        //TODO make name red
        msg += "You must fill in the name field. \n";
        dataCorrect = false;
    }

    if (surname == "") {
        //TODO make surname red
        msg += "You must fill in the surname field. \n";
        dataCorrect = false;
    }

    if (gender != "m" && gender != "f") {
        //TODO make gender red
        msg += "gender \n";
        dataCorrect = false;
    }

    if (email == "" || !isEmailCorrect(email)) {
        //TODO make email red
        msg += "Invalid email address\n";
        dataCorrect = false;
    }

    if (country == "") {
        //TODO make email red
        msg += "Country \n";
        dataCorrect = false;
    }


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
 * Checks if an email address is correct
 */
function isEmailCorrect(email) {
    //TODO PAMPOS COPY EMAIL FUNCTION FROM MY SMARTLIB GITHUB PROJECT HERE!
//COPY-paste pou kwdika github
   // return true;
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    return (reg.test(email));
    //this copied from paschalis code OK
}


function liveFormCheck() {
    //TODO CHECK FORM LIVE AS USER TYPES
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
//TODO REMOVE ALERT MAKE NICE BOOTSTRAP NOTIFICATION

}
/**
 * Called when successfully contact register PHP script.
 * That doesnt mean registration was successfull
 *
 */

function ajaxRegisterSuccess(result) {
    //TODO REMOVE ALERT MAKE NICE BOOTSTRAP NOTIFICATION
    //Show notification alert
    $("#notification").show(200);
    $("#notification").css({class:"alert-success"});
    //-success,-info,-waning, alla3e xrwma
    //TODO parse this json object and show results
    $("#notificationMessage").text('server: ' + result);

    //TODO if result <=0, then class = alert-error
    //else alert-success
}


/*
 * Send AJAX request with json data, using
 * */
function ajaxJsonRequest(url, formData, successCallback, failCallback) {


    var jqxhr = $.post(url, formData)
        .done(function (data) {
            ajaxRegisterSuccess(data);

        })
        .fail(failCallback);
    // .always(); -- Not used


}


function updateFormFieldStatusEmail(that) {
    //If is empty
    if ($(that).val() == "") {
        $(that).addClass('empty').removeClass('filled').removeClass('error');
    }
    else {
        //Check if its a valid email address
        if (isEmailCorrect($(that).val())) {
            $(that).addClass('filled').removeClass('empty').removeClass('error');
        }
        else {
            $(that).addClass('error').removeClass('empty').removeClass('filled');
        }

    }

}



function updateFormFieldStatusPassword(that) {

    var pass = $(that).val();
    var conf = $("#confPasswordForm").val();

    //If is empty
    if (pass == "") {
        //Mark empty
        $(that).addClass('empty').removeClass('filled').removeClass('error');

        //Confirmation is wrong
        if (conf != "")
            $("#register-form-confPassword").addClass('error').removeClass('empty').removeClass('filled');

        return;
    }


    //Passwords match: mark filled
    if (conf == pass) {
        $(that).addClass('filled').removeClass('empty').removeClass('error');
        $("#register-form-confPassword").addClass('filled').removeClass('empty').removeClass('error');
        return;
    }

    //Conf isnt wrong yet
    if (conf == "") return;

    // Confirmation password is wrong
    $("#confPasswordForm").addClass('error').removeClass('empty').removeClass('filled');

}


//Updates the status according of forms Confirm Password field
function updateFormFieldStatusConfirmPassword(that) {

    var confPass = $(that).val();
    //If is empty
    if (confPass == "") {
        $(that).addClass('empty').removeClass('filled').removeClass('error');
        return;
    }

    var pass = $("#passwordForm").val();

    //Password is filled
    if (pass != "") {

        if (confPass == pass) {
            $(that).addClass('filled').removeClass('empty').removeClass('error');
            return;
        }


    }
    // Confirmation password is wrong
    $(that).addClass('error').removeClass('empty').removeClass('filled');

}


function updateFormFieldStatusSimple(that) {
    //Something is filled
    if ($(that).val() != "") {
        $(that).addClass('filled').removeClass('empty');
    }
    else {
        $(that).addClass('empty').removeClass('filled');
    }

}