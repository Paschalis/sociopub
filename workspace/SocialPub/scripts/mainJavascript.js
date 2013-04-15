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

    var username = $("#usernameForm"); //TODO PAMPOS ALLA3A TO GIA NA PIASW TO ELEMENT! de an ine swsto! aN INE ALLA3E KAI TA KATW ELEMENTSS (fie to .val() kai kame ta methodous)
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

    // Check username TODO KAME TES IPOLOIPES METHODOUS OPWS TOUTIN!
    // PWS? kame nea methodo, kai copy paste ta IF pukatw gia ka8e input + vale tous extra elegxous
    // (analoga me ta sizes tis vasis)
    msg += checkUsername(username);
    msg += checkPassword(password,confPassword);


//TODO KAME KAI TA IPOLOIPA ETSI!
    // alla3e to panw na pianei to element(an ine swsto)
    // kai kalese tes methodous! pou 8a valeis copy paste ta pramata tous mesa!
  /*  if (password == "") {
        //TODO MAKE password RED
        msg += "Please fill the Passwors field \n";
        $('#passwordForm').css('boxShadow', '2px 2px 2px  red');
        dataCorrect = false;
    }
    else {
        $('#passwordForm').css('boxShadow', '2px 2px 2px  lightgreen');
    }
    if (confPassword == "") {
        //TODO MAKE confpassword RED
        msg += "Please confirm your password\n";
        $('#confPasswordForm').css('boxShadow', '2px 2px 2px  red');
        dataCorrect = false;
    }

    if (confPassword != password) {
        //TODO Passwords dont match
        msg += "Wrong confirmation of password!\n";
        $('#confPasswordForm').css('boxShadow', '2px 2px 2px  red');
        dataCorrect = false;
    }
    else if (confPassword == password && password != "" && confPassword != "") {
        $('#confPasswordForm').css('boxShadow', '3px 3px 3px lightgreen');
    }
*/

    if (name == "") {
        //TODO make name red
        msg += "You must fill in the name field. \n";
        $('#nameForm').css('boxShadow', '3px 3px 3px red');
        dataCorrect = false;
    }
    else {
        $('#nameForm').css('boxShadow', '3px 3px 3px lightgreen');
    }

    if (surname == "") {
        //TODO make surname red
        msg += "You must fill in the surname field. \n";
        $('#surnameForm').css('boxShadow', '2px 2px 2px  red');
        dataCorrect = false;
    }
    else {
        $('#surnameForm').css('boxShadow', '2px 2px 2px  lightgreen');
    }

    if (gender != "m" && gender != "f") {
        //TODO make gender red
        msg += "gender \n";

        dataCorrect = false;
    }

    if (email == "" || !isEmailCorrect(email)) {
        //TODO make email red
        msg += "Invalid email address\n";
        $('#emailForm').css('boxShadow', '2px 2px 2px  red');
        dataCorrect = false;
    }
    else {
        $('#emailForm').css('boxShadow', '2px 2px 2px  lightgreen');
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
            checkPassword(element);
            break;
        //TODO OTHERS

    }


}

/*
 * Checks if the username is correct
 * */
function checkUsername(username) {

    var value = $(username).val();
    var msg = "";


// Username is correct
    if (value != "" && value.length <= 15) {

            $(username).parent().removeClass('error').addClass("success");

    }
    // Username is wrong
    else {

            $(username).parent().removeClass('success').addClass("error");

            if (value.length > 15) {
                msg = "Username cant be more than 15 characters<br>";
            }
            else {
                msg = "Username cant be empty<br>";
            }

    }

    return msg;
}

function checkPassword(password, confPassword)
{
    var value= $(password).val();
    var valueConf=$(confPassword).val();
    var msg="";
    if(value==valueConf && value!="" && valueConf!=""){
        $(password).parent().removeClass('error').addClass("success");
        $(confPassword).parent().removeClass('error').addClass("success");
    }
    // password and confirmPassword are not equal or their fields ar empty
    else{
        $(password).parent().removeClass('success').addClass("error");
        $(confPassword).parent().removeClass('success').addClass("error");
    }


}
/*
if (password == "") {
    //TODO MAKE password RED
    msg += "Please fill the Passwors field \n";
    $('#passwordForm').css('boxShadow', '2px 2px 2px  red');
    dataCorrect = false;
}
else {
    $('#passwordForm').css('boxShadow', '2px 2px 2px  lightgreen');
}
if (confPassword == "") {
    //TODO MAKE confpassword RED
    msg += "Please confirm your password\n";
    $('#confPasswordForm').css('boxShadow', '2px 2px 2px  red');
    dataCorrect = false;
}

if (confPassword != password) {
    //TODO Passwords dont match
    msg += "Wrong confirmation of password!\n";
    $('#confPasswordForm').css('boxShadow', '2px 2px 2px  red');
    dataCorrect = false;
}
else if (confPassword == password && password != "" && confPassword != "") {
    $('#confPasswordForm').css('boxShadow', '3px 3px 3px lightgreen');
}
*/