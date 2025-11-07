    // Alert override
    (function () {
        tmpAalert = window.alert;
        Type = {
            native: 'native',
            custom: 'custom'
        };
    })();

(function (proxy) {
    proxy.alert = function () {
        var message = (!arguments[0]) ? 'null' : arguments[0];
        var type = (!arguments[1]) ? '' : arguments[1];
        if (type && type == 'native') {
            tmpAalert(message);
        } else {
            dialog_alert(message);
        }
    };
})(this);

/**
 * 다이얼로그 형 경고창
 *
 * @param message
 * @param title
 * @param options
 */
function dialog_alert(message, title, options) {
    console.log("message 내용 확인:", JSON.stringify(message));
    if (_.isUndefined(title)) {
        title = '경고';
    }
    message = message.replace(/\n/g, "");

    BootstrapDialog.show({
        title: title,
        message: message,
        buttons: [{
            label: '확인',
            cssClass: 'btn-black',
            hotkey: 13,
            size: BootstrapDialog.SIZE_LARGE,
            action: function (dialog) {
                dialog.close();
                if (!_.isUndefined(options)) {
                    if (options.isReload) {
                        window.location.reload();
                    } else if (options.location) {
                        window.location.href = options.location;
                    } else if ($.isFunction(options.callback)) {
                        options.callback();
                    }

                }
            }
        }]
    });
}


/**
 * 다이얼로그 형 확인창 (comfirm)
 *
 * @param message
 * @param title
 * @param callback
 * @returns {boolean}
 */
function dialog_confirm(message, callback, title, btnText) {
    if (_.isUndefined(title)) {
        title = '확인';
    }

    if (_.isUndefined(btnText)) {
        cancelLabel = "취소";
        confirmLabel = "확인";
    } else {
        cancelLabel = btnText.cancelLabel;
        confirmLabel = btnText.confirmLabel;
    }

    BootstrapDialog.show({
        title: title,
        message: message,
        closable: false,
        buttons: [{
            label: cancelLabel,
            hotkey: 32,
            size: BootstrapDialog.SIZE_LARGE,
            action: function (dialog) {
                if (typeof callback == 'function') {
                    callback(false);
                }
                dialog.close();
            }
        }, {
            label: confirmLabel,
            cssClass: 'btn-white',
            size: BootstrapDialog.SIZE_LARGE,
            action: function (dialog) {
                if (typeof callback == 'function') {
                    callback(true);
                }
                dialog.close();
            }
        }
        ]
    });
}


