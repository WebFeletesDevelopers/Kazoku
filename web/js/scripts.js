window.onload = function(){
    innerCounter('messagesCenter','a','popupMessages');
    innerCounter('alertsCenter','a','popupAlerts');
};

/**
 * Function that is used for notification center's pop ups that have a counter.
 * @param divId the div that contains the lists
 * @param tagName the kind of tag that contains each row
 * @param popUpId the id of the popup
 */
function innerCounter(divId,tagName,popUpId) {
    var num = $("#"+divId).find(tagName).length;
    if (num > 1) {
        document.getElementById(popUpId).innerHTML = num-1;
    }
}
