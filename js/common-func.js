
function ajaxLoad(href, selector, precallback_str, callback_str, e, history_state) {
    if (!href) {
        return;
    }
    var location = window.history.location || window.location; // включаем HTML5-History-API
    if (!selector) {
        selector = '.content';
    }
    // проверим data-precallback и вызовем, если указан
    if (precallback_str) {
        var precallback_fn = window[precallback_str];
        if (typeof precallback_fn === 'function') {
            precallback_fn(e);
        }
    }
    // собственно аякс
    $(selector).load(href, function (resp, status, xhr) {
        console.log(xhr);
        console.log(xhr.getAllResponseHeaders());
        console.log(status);
        console.log(xhr.status);
        if (history_state == undefined) {
            history.replaceState({
                href: href,
                selector: selector,
                precallback_str: precallback_str,
                callback_str: callback_str
            }, '', href);
        }
        if ('error' === status) {
            $(selector).html(resp);
        } else if (callback_str) {
            // если указан data-callback и функция существует - вызовем
            var callback_fn = window[callback_str];
            if (typeof callback_fn === 'function') {
                callback_fn(e, resp, status, xhr);
            }
        }
    });
}

/**
 * вызывается из аяксового обработчика отправки формы
 * @param {string} resp
 * @param {string} selector
 * @param {string} callback_str
 * @param {Event} event
 */
function formAjaxSuccess(resp, selector, callback_str, event) {
    if (selector) {
        setTimeout(function () { // чтобы было заметно обновление формы
            $(selector).html(resp);
        }, 400);
    } else {
        console.log(resp);
    }
    if (callback_str) {
        // если указан data-callback и функция существует - вызовем
        var callback_fn = window[callback_str];
        if (typeof callback_fn === 'function') {
            callback_fn(event, resp);
        }
    }
}

/**
 * вызывается из аяксового обработчика отправки формы
 * @param {type} xhr
 * @param {type} $form
 * @returns {undefined}
 */
function formAjaxErrorCallback(xhr, $form) {
    console.log('error. ' + xhr.responseText);
    try {
        // попробуем распарсить json
        var obj = $.parseJSON(xhr.responseText);
        if (obj.errors) {
            // если есть список ошибок - подсветим соответствующие поля
            var $err_field;
            for (var field in obj.errors) {
                $err_field = $form.find('[name="' + field + '"]');
                $err_field.parents('.form-group').addClass('has-error')
                        .find('.help-block').html(obj.errors[field]);
                $err_field.one('change', function (e) {
                    $(e.target).parents('.form-group').removeClass('has-error')
                            .find('.help-block').html('');
                });
            }
        }
        if (obj.msg) {
            // если есть сообщение - покажем
            alert(obj.msg);
        }
    } catch (e) {
        // если не json - просто выведем ошибку
        if (xhr.responseText && xhr.responseText.length < 500) {
            alert(xhr.responseText);
        }
    }
}
