
$.ajaxSetup({
    beforeSend: function () {
        $('body').css({cursor: 'wait'});
    },
    complete: function () {
        $('body').css({cursor: 'auto'});
    }
});

// обработка аяксовых ссылок (с классом ajax),
// должен быть указан атрибут data-box (jqery-селектор, куда загружать контент по ссылке),
// опционально может быть указан атрибут data-precallback, и, если указанная функция существует, она будет вызвана с параметром (Event) перед отправкой аякс-запроса
// опционально может быть указан атрибут data-callback, и, если указанная функция существует, она будет вызвана с параметрами (Event, response, status, jqXHR) при успешном завершении аякс-запроса
$('body').on('click', 'a.ajax', function (e) {
    e.preventDefault();
    var href = $(e.currentTarget).attr('href');
    var selector = $(e.currentTarget).attr('data-box');
    var precallback_str = $(e.currentTarget).attr('data-precallback');
    var callback_str = $(e.currentTarget).attr('data-callback');
    ajaxLoad(href, selector, precallback_str, callback_str, e);
    hideTooltip($(e.currentTarget));
});

// обработка форм, отправляемых аяксом,
// у формы кроме класса ajax должны быть указаны атрибуты action и method,
// а также атрибут data-box, если необходимо обновить указанный в нём jqery-селектор содержимым ответа
$('body').on('submit', 'form.ajax', function (e) {
    var $form = $(e.target);
    var url = $form.attr('action');
    if (!url) {
        return;
    } // если action не указан, отправим форму обычным способом
    e.preventDefault();
    var form_data = $form.serializeArray();
    var method = $form.attr('method') || 'GET';
    var selector = $(e.currentTarget).attr('data-box') || '.content';
    var callback_str = $(e.currentTarget).attr('data-callback');
    var ajax_params = {
        url: url,
        method: method,
        data: form_data,
        async: false,
        cache: false,
        success: function (resp) {
            console.log('ok.');
            formAjaxSuccess(resp, selector, callback_str, e);
        },
        error: function (xhr) {
            console.log('error');
            formAjaxErrorCallback(xhr, $form);
        }
    };
    if ($form.has('input[type="file"]')) {
        var formData = new FormData(e.target);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                var resp = xhr.responseText;
                if (xhr.status == 200) {
                    console.log('ok with files.');
                    formAjaxSuccess(resp, selector, callback_str, e);
                } else {
                    console.log('error with files');
                    formAjaxErrorCallback(xhr, $form);
                }
            }
        };
        xhr.send(formData);
    } else {
        $.ajax(ajax_params);
    }
});
