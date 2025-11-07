// =========================
// Alert override
// =========================
(function () {
    var tmpAalert = window.alert;
    var Type = {
        native: 'native',
        custom: 'custom'
    };

    // 전역에 저장
    window.tmpAalert = tmpAalert;
    window.Type = Type;
})();

(function (proxy) {
    proxy.alert = function (message, type) {
        message = (_.isUndefined(message)) ? 'null' : message;
        type = (_.isUndefined(type)) ? '' : type;

        if (type && type === 'native') {
            tmpAalert(message);
        } else {
            dialog_alert(message);
        }
    };
})(this);

// =========================
// Custom Alert
// =========================
function dialog_alert(message, title, options) {
    if (_.isUndefined(title)) {
        title = '경고';
    }

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

// =========================
// Custom Confirm
// =========================
function dialog_confirm(message, callback, title, btnText) {
    if (_.isUndefined(title)) {
        title = '확인';
    }

    let cancelLabel = "취소", confirmLabel = "확인";
    if (!_.isUndefined(btnText)) {
        cancelLabel = btnText.cancelLabel || cancelLabel;
        confirmLabel = btnText.confirmLabel || confirmLabel;
    }

    BootstrapDialog.show({
        title: title,
        message: message,
        closable: false,
        buttons: [
            {
                label: cancelLabel,
                hotkey: 32,
                size: BootstrapDialog.SIZE_LARGE,
                action: function (dialog) {
                    if (typeof callback === 'function') callback(false);
                    dialog.close();
                }
            },
            {
                label: confirmLabel,
                cssClass: 'btn-white',
                size: BootstrapDialog.SIZE_LARGE,
                action: function (dialog) {
                    if (typeof callback === 'function') callback(true);
                    dialog.close();
                }
            }
        ]
    });
}