$(document).ready(function () {
    Core.preparePlaceholders();

    if (Core.msieversion() < 11 && Core.msieversion()) {
        Core.showToast("NRT is not compatible with Internet Explorer. Please use Google Chrome or Firefox.", 999999);
    }
});

var Core = {
    toast: "#main-toast-wrapper",
    toastTimeout: "",
    ajaxKeepGrayOut: false,
    showToast: function (message, duration) {
        duration = typeof duration !== 'undefined' ? duration : 3000;
        var toast = $(this.toast);
        toast.html(message);
        toast.fadeIn().css("display", "inline-block");

        clearTimeout(this.toastTimeout);

        this.toastTimeout = setTimeout(function () {
            toast.fadeOut();
        }, duration);
    },
    hideToast: function () {
        $(this.toast).hide();
    },
    ajax: function (parameters, successCallback, doneCallback) {
        var that = this;
        var grayOutDiv = $("#gray-out-div");

        console.log("Core.ajax. Method: " + parameters.method + ", Data: ", parameters.data);

        grayOutDiv.css("z-index", "9999");
        grayOutDiv.show();
        ProgressBar.show();

        this.resetErrorDiv(parameters.errorDiv);
        $.ajax({
            url: "http://localhost:8888/" + parameters.url,
            type: parameters.method,
            data: parameters.data,
            cache: false,
            dataType: "json",
            success: function (json_response, textStatus, xhr) {
                try {
                    successCallback(json_response, textStatus, xhr);
                } catch (e) {
                }
            },
            fail: function (json_response, textStatus, xhr) {
                parameters.errorDiv.html("Something went wrong, please try again later.");
            },
            statusCode: {
                500: function () { // Internal Server Error
                    parameters.errorDiv.html("Something went wrong, please try again later.");
                },
                408: function () { // Request Timeout
                    parameters.errorDiv.html("Something went wrong, please try again later.");
                }
            }
        }).done(function () {
            if (!that.ajaxKeepGrayOut) {
                grayOutDiv.css("z-index", "999");
                grayOutDiv.hide();
            }
            ProgressBar.hide();
            try {
                doneCallback();
            } catch (e) {
            }
        });
    },
    resetErrorDiv: function (div) {
        div.html('');
    },
    preparePlaceholders: function () {
        $('[placeholder]').focus(function () {
            var input = $(this);
            if (input.val() === input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
                input.css('color', '#1C4D6F');
                input.css('font-family', "'AlegreyaSans', sans-serif");
            }
        }).blur(function () {
            var input = $(this);
            if (input.val() === '' || input.val() === input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
                input.css('color', '#aaaaaa');
                input.css('font-family', "'AlegreyaSans', sans-serif");
            } else {
                input.css('color', '#1C4D6F');
                input.css('font-family', "'AlegreyaSans', sans-serif");
            }
        }).blur();
    },
    isValidEmailAddress: function (emailAddress) {
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailAddress);
    },
    logoutAction: function () {
        var params = {
            url: "ajax/logout.php",
            method: "POST",
            data: {},
            errorDiv: $("#main-error-div")
        };

        this.ajax(
                params,
                function (json) {
                    if (json.status === 'success') {
                        window.location = "";
                    } else {
                        $(params.errorDiv).html('Something went wrong. Please try again.');
                    }
                });
    },
    resetSelect: function (select) {
        select.find("option").removeAttr("selected");
        select.find("option:first-child").removeAttr("disabled");
        select.find("option:first-child").attr("selected", "true");
        select.find("option:first-child").attr("disabled", "true");
        select.css("color", "#999999");
    },
    msieversion: function () {
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0) {      // If Internet Explorer, return version number
            return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
        } else {
            return false;
        }
    }
};

var Constants = {
    DOMAIN_EMAIL_EXT: "@example.com",
    DOMAIN_BODY: 'example',
    SERVER_FAIL_RESPONSE: 'Something went wrong with the server, please try again later or contact webmaster.',
    RED_COLOR: "#CC0000",
    MAIN_TEXT_COLOR: "#1C4D6F",
    SITE_LINK: "http://localhost:8888"
};

var ProgressBar = {
    bar: "#progress-bar",
    show: function () {
        $(this.bar).show();
        $(this.bar).css('opacity', 1.0);
        $(this.bar).css('z-index', '99999');
    },
    hide: function () {
        var that = this;
        $(this.bar).css('opacity', 0.0);
        setTimeout(function () {
            $(that.bar).hide();
        }, 500);
        $(this.bar).css('z-index', '9');
    }
};

jQuery.fn.center = function () {
    this.css("position", "absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
            $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
            $(window).scrollLeft()) + "px");
    return this;
};