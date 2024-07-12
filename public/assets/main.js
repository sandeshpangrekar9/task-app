$(document).ready(function () {
    
    // Override Noty defaults
    Noty.overrideDefaults({
        theme: 'limitless',
        layout: 'bottomLeft',
        type: 'alert',
        timeout: 2500,
        //closeWith: ['button'],
        modal: false
    });

    /* Start of solution - Below solution fix the issue of - dropdown menu was 
    being shown inside table and was adding vertical scroll in table row */
    $('.table-responsive').on('show.bs.dropdown', function (e) {
        //get button position
        offset = $(e.relatedTarget).offset();

        //get button height
        heigth = $(e.relatedTarget).outerHeight();

        //append dropdown to body and perpare position.
        $(e.relatedTarget).next('.dropdown-menu').addClass('dropdown-menu-in-table').appendTo("body").css({display:'block',top:offset.top+heigth, left: offset.left});
    });

    //move back dropdown menu to button and remove positon
    $('body').on('hide.bs.dropdown', function (e) {                                    
            $(this).find('.dropdown-menu-in-table').removeClass('dropdown-menu-in-table').css({display:'',top:'', left: ''}).appendTo($(e.relatedTarget).parent());
    });
    /* End of solution - Below solution fix the issue of - dropdown menu was 
    being shown inside table and was adding vertical scroll in table row */

});

/* Email validation  */
function is_valid_email(email = null) {

    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)) {
        return true;
    } else {
        return false;
    }

}

/* Print error validation message */
function pError(message = null) {

    return '<span class="text-danger"><i class="ph ph-warning-circle me-1"></i>' + message + '</span>';

}

/* Print warning validation message */
function pWarning(message = null) {

    return '<span class="text-warning"><i class="ph ph-warning-circle me-1"></i>' + message + '</span>';

}

/* Print success validation message */
function pSuccess(message = null) {

    return '<span class="text-success"><i class="ph ph-check-circle me-1"></i>' + message + '</span>';

}

/* Print info validation message */
function pInfo(message = null) {

    return '<span class="text-info"><i class="ph ph-info me-1"></i>' + message + '</span>';

}

/* Show notification message using Noty */
// type can be error/success/warning/info/alert
function notify(text = null, type = 'alert') {

    return new Noty(
        {   
            text: text,
            type: type,
            theme: 'limitless',
            layout: 'bottomLeft',
            timeout: 2500,
            //closeWith: ['button']
        }).show();

}

function getErrorResponseTextMessage(jqXHR) {

    var message = 'Something went wrong!';

    if(jqXHR.responseText) {

        var response = JSON.parse(jqXHR.responseText);

        if(response.message) {

            message = response.message; 

        }

    }

    return message;

}

function showLimitedString(text, count, insertDots) {
    return text.slice(0, count) + (((text.length > count) && insertDots) ? "<a href='javascript:void(0);' data-text='" + text + "' class='more-classs'> <span class='text-decoration-underline'>more..</span></a>" : "");
}

$(document).on("click",".more-classs",function() {
    $("#more-modal-body").empty().html($(this).data('text'));
    var moreModal = new bootstrap.Modal(document.getElementById('moreModal'))
    moreModal.show();
});