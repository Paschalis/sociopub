/**

 Copyright 2013, Internet Technologies course Team, at Computer Science Dept., University of Cyprus,

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

    window.previewing = 0;


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

        clearNotification();
    });

    //When categories are clicked
    $("body").on("click", "#buttonsToolbar button", function () {

        // Disable category
        if ($(this).hasClass("label-info")) {
            $(this).removeClass("label-info");
        }
        // Enable category
        else {
            $(this).addClass("label-info");
        }
    });


    //When user presses like button
    $("body").on("click", ".box button.likes", function () {

        //Toggle like, and hope user will make it!
        toggleLike(this);


        //Disable the button
        $(this).attr("disabled", true);

        //Get the article ID
        var articleID = $($($(this).parent()).siblings(".articleID")[0]).html();

        var formData = new Object();

        formData['articleID'] = articleID;



        ajaxJsonRequest("scripts/likeArticle.php",
            formData,
            getLikeSuccess,
            ajaxLikeFailed, this);

    });


    //When user presses read button
    $("body").on("click", ".box button.read", function () {

        //Toggle read, and hope user will make it!
        toggleRead(this);

        //Disable the button
        $(this).attr("disabled", true);

        //Get the article ID
        var articleID = $($($(this).parent()).siblings(".articleID")[0]).html();

        var formData = new Object();

        formData['articleID'] = articleID;

        ajaxJsonRequest("scripts/readLaterArticle.php",
            formData,
            getReadlaterSuccess,
            ajaxReadFailed, this);
    });


    //When user reads an article
    $(document).on(
        {
            mouseenter: function () {


                $($(this).children('.box-img')[0]).addClass('hover');
                $(this).addClass('hover');

                if ($(this).hasClass('newpost'))
                    return;

                window.boxHoverSeconds = new Date().getTime() / 1000;

            },
            mouseleave: function () {

                $($(this).children('.box-img')[0]).removeClass('hover');
                $(this).removeClass('hover');

                if ($(this).hasClass('newpost'))
                    return;

                //Calculate total seconds on box article
                var curTime = new Date().getTime() / 1000;
                var diff = curTime - window.boxHoverSeconds;

                if (diff < 4) return; //user has to stay at least 4 seconds

                var articleID = $($($(this).children('.box-body')[0]).children('.articleID')[0]).html();

                var formData = new Object();

                formData['articleID'] = articleID;

                ajaxJsonRequest("scripts/viewedArticle.php",
                    formData,
                    getViewSuccess,
                    ajaxFailed, this);


            }
        }
        , '.box.article');


    //When user performs search
    var timeoutHnd;
    window.doingQuery = 0;


    $("#boxsearch").keypress(function (e) {

        //On Enter
        if (event.keyCode == 13) {

            if (window.doingQuery) return;
            window.doingQuery = 1;
            var q = $("#boxsearch").val();

            doQuery(q);

        }
        else {
            if (timeoutHnd)
                clearTimeout(timeoutHnd);
            timeoutHnd = setTimeout(function () {


                if (window.doingQuery) return;
                window.doingQuery = 1;

                var q = $("#boxsearch").val();

                doQuery(q);


            }, 500);

        }

    });


    // Add clear functionality to all inputs
    $("#boxsearchClear").click(function () {

        $('#boxsearch').val("");

        doQuery();
    });


    //When search loose focus and its empty
    $('#boxsearch').blur(function () {


        var q = $("#boxsearch").val();

        if (q == "") {
            if (window.doingQuery) return;
            window.doingQuery = 1;
            doQuery();
        }
    });


});

function submitForm() {

    var q = $("#boxsearch").val();

    if (window.doingQuery) return;
    window.doingQuery = 1;

    doQuery(q);


    return false;

}

/*
 * Performs a query, and re inits isotope
 * */
function doQuery(q) {


    // no query & already all articles? dont fetch 'em again
    if ((q == null || q == "") && window.allArticles == 1) {
        window.doingQuery = 0;
        return;
    }


    // Remove all existing elements
    $(".box.article").each(function () {

        if ($(this).hasClass("newpost")) return;
        //remove from isotope
        window.container.isotope('remove', $(this));

        $(this).remove();
    });

    // Load new articles based on query
    loadArticles(q);


}
/*
* Toggle like button for faster response!
* */
function toggleLike(element){

    //Do unlike
    if($(element).hasClass('liked')){
        $(element).removeClass('liked');
        $($($($(element).parent()).parent()).parent()).removeClass('liked');
    }
    // do like
    else{
        $(element).addClass('liked');
        $($($($(element).parent()).parent()).parent()).addClass('liked');
    }


}

/*
 * Toggle read button for faster response!
 * */
function toggleRead(element){

    //Do unlike
    if($(element).hasClass('readLater')){
        $(element).removeClass('readLater');
        $($($($(element).parent()).parent()).parent()).removeClass('readLater');
    }
    // do like
    else{
        $(element).addClass('readLater');
        $($($($(element).parent()).parent()).parent()).addClass('readLater');
    }


}


/*
 * Ajax like failed. so restore the element as it was
 * */
function ajaxReadFailed(element){
    toggleRead(element);

    ajaxFailed(element);

}


/*
* Ajax like failed. so restore the element as it was
* */
function ajaxLikeFailed(element){
    toggleLike(element);

    ajaxFailed(element);

}


/*
 * Article was liked
 * */
function getLikeSuccess(data, element) {


    var jsonObj = eval('(' + data + ')');


    // Login was successfull
    if (jsonObj['code'] == -1) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. User dont exists";

    }
    else if (jsonObj['code'] == -2) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. Article dont exists";
    }
    else if (jsonObj['code'] == -3) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. User's article dont exists";
    }

    // Successfully liked or unliked
    if (jsonObj['code'] != -1) {
        //Successfully unliked
        if (jsonObj['code'] == 0) {
            $(element).removeClass('liked');
            $($($($(element).parent()).parent()).parent()).removeClass('liked');

        }
        //Successfully liked
        else {
            $(element).addClass('liked');
            $($($($(element).parent()).parent()).parent()).addClass('liked');
        }

        $(element).html('+' + jsonObj['likes']);


        //Re-filter items
        //Re-filter items
        if (window.currentFilter != null && window.currentFilter != "") {
            window.currentFilter.click();
        }

    }
    //Show notification
    else {
        jsonObj['code'] = 0;
        showNotification(jsonObj, DELAY_MEDIUM);
    }

    //Re enable button
    $(element).attr("disabled", false);


}


/*
 * Article was readLater-changed
 * */
function getReadlaterSuccess(data, element) {


    var jsonObj = eval('(' + data + ')');


    // Login was successfull
    if (jsonObj['code'] == -1) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. User dont exists";

    }
    else if (jsonObj['code'] == -2) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. Article dont exists";
    }
    else if (jsonObj['code'] == -3) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. User's article dont exists";
    }

    // Successfully liked or unliked
    if (jsonObj['code'] != -1) {

        //Successfully removed read later
        if (jsonObj['code'] == 0) {
            $(element).removeClass('readLater');
            $($($($(element).parent()).parent()).parent()).removeClass('readLater');

        }
        //Successfully added read later
        else {
            $(element).addClass('readLater');
            $($($($(element).parent()).parent()).parent()).addClass('readLater');
        }


        //Re-filter items
        if (window.currentFilter != null && window.currentFilter != "") {
            window.currentFilter.click();
        }

    }
    //Show notification
    else {
        jsonObj['code'] = 0;
        showNotification(jsonObj, DELAY_MEDIUM);
    }


    //Re enable button
    $(element).attr("disabled", false);

}


/*
 * Article was viewed
 * */
function getViewSuccess(data, element) {

    var jsonObj = eval('(' + data + ')');

    // Login was successfull
    if (jsonObj['code'] == -1) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. User dont exists";

    }
    else if (jsonObj['code'] == -2) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. Article dont exists";
    }
    else if (jsonObj['code'] == -3) {
        jsonObj['code'] = -1;
        jsonObj['message'] = "Something went wrong. User's article dont exists";
    }

    // Successfully liked or unliked
    if (jsonObj['code'] != -1) {

        $($($(element).children('.box-body')[0]).find('.badge.views')[0]).html('Views: ' + jsonObj['views']);
        $(element).addClass("viewed");
    }
    //Show notification
    else {
        jsonObj['code'] = 0;
        showNotification(jsonObj, DELAY_MEDIUM);
    }


}


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


function ajaxPreviewArticleFailed(params) {


    window.previewing = 0;
    $("#previewNewArticleButton").attr("disabled", false);

    //Re enable button
    $(params[0]).attr("disabled", false);
    //call ajax failed
    ajaxFailed();
}

/**
 * Called when failed to contact register PHP script
 *
 */
function ajaxFailed(elem) {

    var data = new Object();

    data['code'] = 0;
    data['message'] = "Something went wrong! Ajax failed";

    showNotification(data, DELAY_AJAX_ERROR);

    if (elem != null)
    //Re enable button
        $(elem).attr("disabled", false);

}


/**
 * Post Ajax request was made
 *
 */
function ajaxSuccessPost(result) {


    var jsonObj = eval('(' + result + ')');


    // Login was successfull
    if (jsonObj['code'] == 1) {
        jsonObj['message'] = "Article shared";

    }
    else if (jsonObj['code'] == 2) {
        jsonObj['code'] = 1;
        jsonObj['message'] = "Article reshared";
    }
    else if (jsonObj['code'] != 0) {
        jsonObj['code'] = 0;
        jsonObj['message'] = "Something went wrong. Post failed";
    }


    // Add article to isotope
    if (jsonObj['code'] == 1) {
        addArticleToIsotope(jsonObj);
    }

    showNotification(jsonObj, DELAY_MEDIUM);

    // Re-Enable button
    $("#postNewArticleButton").attr("disabled", false);

}


/*
 * Adds an article to the isotope
 * */
function addArticleToIsotope(article) {


    var items = [],
        item;


    var filterClasses = "", filterTags = "";


    //Create classes for the filtering
    for (var j = 0; j < article.tags.length; j++) {
        filterClasses += article.tags[j] + " ";
        filterTags += '<button class="category ' + article.tags[j] + '">#' + article.tags[j] + '</button>';
    }

    filterClasses += article.site.replace(/[ .//]/ig, '').toLowerCase() + " ";


    var likedClass = "";
    var readLaterClass = "";


    if (article.like == 1) {
        likedClass = " liked";
        filterClasses += " liked ";
    }
    if (article.readLater == 1) {
        readLaterClass = " readLater";
        filterClasses += " readLater ";
    }

    if (article.view == 1) {
        filterClasses += " viewed ";
    }

    var imgCode = "";
    if (article.image != "") {
        imgCode = '<img  class="articleimg" src="' + article.image.replace('/l.', '/m.') + '" />';
    }

    item = '<div class="box article  ' + filterClasses + ' ">'
        + '<div class="box-img">'
        + imgCode
        + '</div>'
        + '<div class="box-body">'
        + '<h4 class="articletitle">' + article.title + '</h4>'
        + '<button class="btn closebox" onclick="deleteArticle(($(event.target).parent()).parent())">x</button>'
        + '<p class="date" datetime="' + article.added + '" >' + jQuery.timeago(new Date(article.added * 1000)) + '</p>'
        + '<p class="articledesc" >' + article.description + '</p>'
        + '<div class="readMore"><a href="' + article.url + '" target="_blank">@' + article.site + '</a></div>'
        + '<div class="likesReads">'
        + '<button class="badge likes' + likedClass + '">+' + article.likes + '</button>'
        + '<button class="badge read ' + readLaterClass + '" >Read later</button>'
        + '</div>'
        + '<div class="sharesViews">'
        + '<button class="badge shares" disabled>Shares: ' + article.shares + '</button>'
        + '<button class="badge views" disabled>Views: ' + article.views + '</button>'
        + '</div>'
        + '<span class="articleID" style="display: none">' + article.uid + '</span>'
        + '</div>'
        + '<div class="categories" >' + filterTags + '</div>'
        + '</div>';


    var $items = $(item);


    //When image is loaded, add the article
    $items.imagesLoaded(function () {

        //Clear  new post box
        clearUsersNewPostAndAddNewPost(1, this, $items);

    });


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
            checkPasswords($("#passwordRegister"), $("#confPasswordRegister"));
            break;
        case "confPasswordRegister":
            checkPasswords($("#passwordRegister"), $("#confPasswordRegister"));
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

//    //Clear notification first
//    if(window.isNotificationShowing){
//        clearNotification();
//    }

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
        clearNotification();
    }, duration);

//    window.isNotificationShowing=1;


}

/*
 * Clears the notification
 * */
function clearNotification() {
    var notification = $("#notification");

    notification.removeClass('in').addClass("out");
    notification.html('');
//    window.isNotificationShowing=0;
}


/*
 * Send AJAX request with json data, using
 * */
function ajaxJsonRequest(url, formData, successCallback, failCallback, successParams) {

    var jqxhr = $.post(url, formData)
        .done(function (data) {

            if (successParams != "") {
                successCallback(data, successParams);
            }
            else {
                successCallback(data);

            }
        }
    )
        .
        fail(function () {
            if (successParams != "") {
                failCallback(successParams);
            }
            else {
                failCallback();

            }
        });
// .always(); -- Not used


}

/**
 * Previews an article
 * */
function previewArticle(element, pArticleUrl) {

    if (window.previewing == 1)
        return;

    window.previewing = 1;


    //Disable button
    $(element).attr("disabled", true);
    $("#previewNewArticleButton").attr("disabled", true);


    var articleUrl;
    if (pArticleUrl == null || pArticleUrl == "") {
        articleUrl = $("#newArticleInput").val();
    }
    else {
        articleUrl = pArticleUrl;
    }

    //Get the url for the article

    var formData = new Object();
    formData['url'] = articleUrl;

    var params = [];

    //Push header of site filters
    params.push(element);
    params.push(articleUrl);


    ajaxJsonRequest("scripts/previewArticle.php",
        formData,
        getArticleSuccess,
        ajaxPreviewArticleFailed, params);

}


/**
 * Clears an article's (from session and isotope)
 * */
function clearUsersNewPostAndAddNewPost(param, that, items) {


    ajaxJsonRequest("scripts/clearArticlePreview.php",
        "",
        function (data) {
            //Clear article success
            var jsonObj;

            jsonObj = eval('(' + data + ')');

            var $newPost = $('.box.newpost.article');
            $newPost.html(getNewPostHtml());

            // Run clear when inserting new post
            if (param == 1) {

                //TODO ADD NEW CODE!

                // add the box to the isotope
                window.container.append($(items));

                $(items).each(function () {
                    var $this = $(that);

                    //Save box width
                    $this.width(window.boxWidth);
                    //Save box's image width
                    $this.find('img').width(window.boxWidth);
                });


                window.container.isotope('insert', $(items));

                //Relayout isotope
//                window.container.isotope('reLayout'); //Force reLayout
            }
            //Run simple cleared
            else {
                //Relayout isotope
                window.container.isotope('reLayout'); //Force reLayout
            }


        },
        ajaxFailed, param);


}

/**
 * Deletes users article from database
 * */
function deleteUsersArticle(element) {

    var articleID = element.find('.articleID').html();
    //Create new object w/ article ID
    var formData = new Object();
    formData['articleID'] = articleID;


    ajaxJsonRequest("scripts/deleteUserArticle.php",
        formData,
        deletedArticleSuccess,
        ajaxFailed, element);

}


/**
 * Successfully deleted an article of a user
 * */
function deletedArticleSuccess(data, element) {

    var jsonObj;


    jsonObj = eval('(' + data + ')');


    //if deletion was okay, remove element from isotope too
    if (jsonObj['code'] == 1) {

        //remove from isotope
        window.container.isotope('remove', $(element));

        element.remove();

    }

    //Relayout isotope
    window.container.isotope('reLayout'); //Force reLayout

    makeShowNotification(jsonObj['code'], jsonObj['message'], DELAY_MEDIUM);

}


/**
 * TODO DIMITRI INFO
 *
 * */
function getArticleSuccess(data, params) {

    var jsonObj;

    try {
        jsonObj = eval('(' + data + ')');

    }
        // Failed to fetch article
    catch (e) {
        if (e instanceof SyntaxError) {

            makeShowNotification(0, "Failed to fetch article!", DELAY_MEDIUM);

            //re Enable button
            $("#previewNewArticleButton").attr("disabled", false);

            window.previewing = 0;

            return;
        }
    }


    var code = jsonObj['code'];


    //Failed to fetch data
    if (code == 0) {
        makeShowNotification(0, jsonObj['message'], DELAY_MEDIUM);
        //re Enable button
        $(params[0]).attr("disabled", false);
        $("#previewNewArticleButton").attr("disabled", false);
        window.previewing = 0;
        return;
    }


    var title = jsonObj['title'];
    var description = jsonObj['description'];
    var image = jsonObj['image'];
    var siteName = jsonObj['siteName'];


    // Set the image
    $(".box.newpost.article .articleimg").attr({src: image});

    $(".box.newpost.article #buttonsToolbar .articletitle").html(title);

    $(".box.newpost.article #buttonsToolbar .articledesc").html(description);



    $(".box.newpost.article #buttonsToolbar .readMore a").attr("href", params[1]);
    $(".box.newpost.article #buttonsToolbar .readMore a").html("@" + siteName + "");

    $(".box.newpost.article .input .buttons button").addClass('fade in half');
    $(".box.newpost.article .input .buttons button").css("display", "inline");

    $(".box.newpost.article #buttonsToolbar").addClass("fade in");
    $(".box.newpost.article #buttonsToolbar").css("display", "inline");


    //When image is loaded, relayout the isotope
    $(".box.newpost.article .articleimg").imagesLoaded(function () {


        //Relayout isotope
        window.container.isotope('reLayout'); //Force reLayout

        //re Enable button
        $("#previewNewArticleButton").attr("disabled", false);
        $(params[0]).attr("disabled", false);
        //TODO

        window.previewing = 0;

    });


}


/**
 * Post an article to DB
 *
 * */
function postArticle() {
    var categories = "";


    //When categories are clicked
    $("#buttonsToolbar button ").each(function () {
        // Get categories
        if ($(this).hasClass("label-info")) {
            $(this).each(function () {
                categories += $(this).attr('id').substring(1) + ":";
            });

        }
    });

    if (categories == "") {
        makeShowNotification(0, "Please select at least one category", DELAY_MEDIUM);
        return;
    }

    // Disable button
    $("#postNewArticleButton").attr("disabled", true);

    categories = categories.substring(0, categories.length - 1);


    var formData = new Object();

    formData['categories'] = categories;

    //Post article
    ajaxJsonRequest("scripts/postArticle.php",
        formData,
        ajaxSuccessPost,
        ajaxFailed, $("#postNewArticleButton"));
}


/**
 * Delets an article from DB
 *
 * */
function deleteArticle(element) {


    // its the new post. Just clear it, dont remove it
    if ($(element).hasClass('newpost')) {
        clearUsersNewPostAndAddNewPost();
    }
    else {
        //Delete users article
        deleteUsersArticle(element)
    }


}


/**
 * Returns the HTML code for a new post
 * */
function getNewPostHtml() {

    return '<div class="box-img">'
        + '<img  class="articleimg" style="width: ' + window.boxWidth + '"  />'
        + '</div>'
        + '<div class="box-body">'
        + '<div class="input">'
        + '<label for="newArticleInput">Post an article:</label>'
        + '<input id="newArticleInput" type="text">'
        + '<div class="buttons">'
        + '<button id="previewNewArticleButton"  class="btn" type="button" onclick="previewArticle(this)">Preview</button>'
        + '<button id="postNewArticleButton" class="btn half" style="display: none" type="button" onclick="postArticle()">Post</button>'
        + '</div>'
        + '</div>'
        + '<div style="display: none" id="buttonsToolbar">'
        + '<h4 class="articletitle"></h4>'
        + '<button class="btn closebox newpost" onclick="deleteArticle(this)">x</button>'
        + '<p class="date fade out" datetime="' + Math.round((new Date()).getTime() / 100) + '" ></p>'
        + '<p class="articledesc" ></p>'
        + '<div class="readMore"><a href="" target="_blank"></a></div>'
        + '<button class="badge likes"></button>'
        + '<span class="badge shares" ></span>'
        + '<span class="badge views" ></span>'
        + '<span class="articleID" style="display: none"></span>'
        + '<div class="categories" >'
        + '<button class="label" id="acinema">Cinema</button>'
        + '<button class="label" id="aeconomy">Economy</button>'
        + '<button class="label" id="aentertainment">Entertainment</button>'
        + '<button class="label" id="ahealth">Health</button>'
        + '<button class="label" id="ahistory">History</button>'
        + '<button class="label" id="alifestyle">Lifestyle</button>'
        + '<button class="label" id="amusic">Music</button>'
        + '<button class="label" id="anews">News</button>'
        + '<button class="label" id="ascience">Science</button>'
        + '<button class="label" id="asports">Sports</button>'
        + '<button class="label" id="atechnology">Technology</button>'
        + '<button class="label" id="atravel">Travel</button>'
        + '<button class="label" id="aother">Other</button>'
        + '</div>'
        + '</div>'
        + '</div>';

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


/*
 * Calculates the width of a box
 * */
function calculateBoxWidth() {

    var $container = $('#container');
    //Init width
    var curwidth = $container.width();

    //Set width according to sizes
    // SMARTPHONE STATS:
    // NEXUS4: P 344, L 558


    //Smartphone size: full size!
    if (curwidth < 400) {
        //window.boxWidth =  $('.box.newpost').width() + "px";
        window.boxWidth = "95%";

    }
    //Phablet size, or portait big smartphones
    else if (curwidth >= 400 && curwidth < 650) {
        window.boxWidth = Math.floor((curwidth / 2)) - (2 * 7) + "px";

    }
    //Tablet size
    else if (curwidth >= 650 && curwidth < 900) {
        window.boxWidth = Math.floor((curwidth / 3)) - 3 * 7 + "px";

    }
    //Laptop size TODO ???????????
    else if (curwidth >= 900 && curwidth < 1300) {
        window.boxWidth = Math.floor((curwidth / 4)) - 4 * 5 + "px";

    }
    //Desktop size
    else if (curwidth >= 1300 && curwidth < 1600) {
        window.boxWidth = Math.floor((curwidth / 5)) - 5 * 4 + "px";

    }
    //Large size
    else if (curwidth >= 1600 && curwidth < 2000) {
        window.boxWidth = Math.floor((curwidth / 6)) - 5 * 4 + "px";

    }
    // Extra large screen size
    else {
        window.boxWidth = Math.round((curwidth / 8)) - 5 * 4 + "px";
    }


}


/*
 * Load articles from Server
 * */
function loadArticles(query) {

    var curwidth = window.container.width();

    window.container.isotope({
        animationEngine: 'best-available',
        sortBy: 'date',
        sortAscending: false,
        getSortData: {
            date: function ($elem) {
                return new Date($elem.find('.date').attr('datetime') * 1000);

            },
            alphabetical: function ($elem) {
                var name = $elem.find('.name'),
                    itemText = name.length ? name : $elem;
                return itemText.text();
            }
        }
    });


    var fetchArticlesError = function () {
        makeShowNotification(0, "Couldnt fetch articles! :(", DELAY_MEDIUM);
    };

    var queryURL = '../scripts/getUserArticles.php';

    var formData = new Object();

    //If we have query data
    if (query != null && query != "") {
        formData['q'] = query;
        window.allArticles = 0;
    }
    else {
        window.allArticles = 1;
    }


    // Fetch articles
    ajaxJsonRequest('../scripts/getUserArticles.php',
        formData,
        function (dataRaw) {

            var data = eval('(' + dataRaw + ')');

            var code = data[0]['code'];

            // proceed only if we have data
            if (!data || !data.length || code == 0) {
                fetchArticlesError();
                window.allArticles = 0; // no articles
                window.doingQuery = 0; //query finished!

                return;
            }


            var items = [], siteFiltersDivs = [], siteFilters = [],
                item, article;
            //Push header of site filters
            siteFiltersDivs.push('<li><h4>Sites</h4></li>');


            for (var i = 1, len = data.length; i < len; i++) {
                article = data[i];

                var filterClasses = "", filterTags = "";


                //Create classes for the filtering
                for (var j = 0; j < article.tags.length; j++) {
                    filterClasses += article.tags[j] + " ";
                    filterTags += '<button class="category ' + article.tags[j] + '">#' + article.tags[j] + '</button>';
                }

                var newSiteFilter = article.site.replace(/[ .//]/ig, '').toLowerCase();

                filterClasses += newSiteFilter;


                var likedClass = "";
                var readLaterClass = "";


                if (article.like == 1) {
                    likedClass = " liked";
                    filterClasses += " liked ";
                }
                if (article.readLater == 1) {
                    readLaterClass = " readLater";
                    filterClasses += " readLater ";
                }

                if (article.view == 1) {
                    filterClasses += " viewed ";
                }


                var imgCode = "";
                if (article.image != "") {
                    imgCode = '<img  class="articleimg" src="' + article.image.replace('/l.', '/m.') + '" />';
                }

                item = '<div class="box article  ' + filterClasses + ' ">'
                    + '<div class="box-img">'
                    + imgCode
                    + '</div>'
                    + '<div class="box-body">'
                    + '<h4 class="articletitle">' + article.title + '</h4>'
                    + '<button class="btn closebox" onclick="deleteArticle(($(event.target).parent()).parent())">x</button>'
                    + '<p class="date" datetime="' + article.added + '" >' + jQuery.timeago(new Date(article.added * 1000)) + '</p>'
                    + '<p class="articledesc" >' + article.description + '</p>'
                    + '<div class="readMore" ><a href="' + article.url + '" target="_blank">@' + article.site + '</a></div>'
                    + '<div class="likesReads">'
                    + '<button class="badge likes' + likedClass + '">+' + article.likes + '</button>'
                    + '<button class="badge read ' + readLaterClass + '" >Read later</button>'
                    + '</div>'
                    + '<div class="sharesViews">'
                    + '<button class="badge shares" disabled>Shares: ' + article.shares + '</button>'
                    + '<button class="badge views" disabled>Views: ' + article.views + '</button>'
                    + '</div>'
                    + '<span class="articleID" style="display: none">' + article.uid + '</span>'
                    + '</div>'
                    + '<div class="categories" >' + filterTags + '</div>'
                    + '</div>';


                items.push(item);


                // Find out if sitename is unique
                var isUnique = 1;


                for (var sf = 0; sf < siteFilters.length; sf++) {

                    if (siteFilters[sf] == newSiteFilter) {
                        isUnique = 0;
                        break;
                    }
                }
                http://www.nytimes.com/2013/05/05/opinion/sunday/wheres-my-ghost-money.html?smid=go-share&_r=0
                    //if sitename is unique, add it
                    if (isUnique == 1) {
                        siteFilters.push(newSiteFilter);
                        siteFiltersDivs.push('<li><a href="#" data-option-value=".' + newSiteFilter + '">' + article.site.substring(0, 10) + '</a></li>');
                    }

            }

            var $items = $(items.join(''));

            var boxesShown = false;


            // If there is an img that still loads after 2 secs, show the current boxes
            setTimeout(function () {

                if (!boxesShown) {
                    showBoxesAndFilters($items, siteFiltersDivs);
                }
                boxesShown = true;
            }, 2000);


            //When images are loaded, relayout webpage
            $items.imagesLoaded(function () {

                if (!boxesShown) {
                    showBoxesAndFilters($items, siteFiltersDivs);
                    boxesShown = true;
                }

                window.doingQuery = 0;


                window.container.isotope('reLayout'); //Force reLayout

            });

        },
        fetchArticlesError);


}


function showBoxesAndFilters($items, siteFiltersDivs) {

    //Show items on webpage
    window.container.append($items);

    $items.each(function () {
        var $this = $(this);

        //Save box width
        $this.width(window.boxWidth);
        //Save box's image width
        $this.find('img').width(window.boxWidth);
    });

    window.container.isotope('insert', $items);


    $('#filter ul #sitefilters').html("");


    //Show site filters on right content bar
    for (var i = 0; i < siteFiltersDivs.length; i++) {
        $('#filter ul #sitefilters').append(siteFiltersDivs[i]);

    }

    setFilterFunctionality();
}


function setFilterFunctionality() {
    var $optionSets = $('#filters .option-set'),
        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function () {

        var $this = $(this);

        window.currentFilter = $this;


        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
            // changes in layout modes need extra logic
            changeLayoutMode($this, options)
        } else {
            // otherwise, apply new options
            window.container.isotope(options);
        }

        return false;
    });

}
