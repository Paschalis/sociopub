/**
 * Created with JetBrains PhpStorm.
 * User: dimitros
 * Date: 18/4/2013
 * Time: 6:00 μμ
 * To change this template use File | Settings | File Templates.
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


function ajaxJsonRequest(url, formData, successCallback, failCallback) {


    var jqxhr = $.post(url, formData)
        .done(function (data) {
            successCallback(data);

        })
        .fail(failCallback);
    // .always(); -- Not used


}

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