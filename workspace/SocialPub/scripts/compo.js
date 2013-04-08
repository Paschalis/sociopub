/**
 * Created with JetBrains PhpStorm.
 * User: sonyvaio
 * Date: 9/4/2013
 * Time: 12:53 πμ
 * To change this template use File | Settings | File Templates.
 */

/**
 * Gets an XMLHttpRequest. For Internet Explorer 6, attempts to use MSXML 6.0,
 * then falls back to MXSML 3.0.
 * Returns null if the object could not be created.
 * @return {XMLHttpRequest or equivalent ActiveXObject}
 */


/* EINAI MALAKIA PROS TO PARON MIN DWDSETE SIMASIA*/


function getXHR() {
    if (window.XMLHttpRequest) {
        // Chrome, Firefox, IE7+, Opera, Safari
        return new XMLHttpRequest();
    }
    // IE6
    try {
        // The latest stable version. It has the best security, performance,
        // reliability, and W3C conformance. Ships with Vista, and available
        // with other OS's via downloads and updates.
        return new ActiveXObject('MSXML2.XMLHTTP.6.0');
    } catch (e) {
        try {
            // The fallback.
            return new ActiveXObject('MSXML2.XMLHTTP.3.0');
        } catch (e) {
            alert('This browser is not AJAX enabled.');
            return null;
        }
    }
}