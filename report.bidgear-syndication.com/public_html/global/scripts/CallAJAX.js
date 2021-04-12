var CallAJAX = function () {
    var request;

    function checkIsURL(url) {
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
            '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        return pattern.test(url);
    }

    return {
        init: function () {
            request = null;
        },
        call: function (config) {
            config = config || {
                    url: 'http://md5.jsontest.com/?text=abc',
                    method: 'POST',
                    data: {},
                    callbackSuccess: function (res) {
                    },
                    callbackFail: function (status, message) {
                    }
                };

            config.method = config.method || 'POST';
            config.data = config.data || {};
            config.callbackSuccess = config.callbackSuccess || function (res) {
                };
            config.callbackFail = config.callbackFail || function (res) {
                };
            config.dataType = config.dataType || 'json';

            if (!checkIsURL(config.url)) {
                config.url = window.homeUrl + config.url;
            }
            var ajaxConfig = {
                url: config.url,
                type: config.method,
                data: config.data,
                processData: config.processData,
                contentType: config.contentType,
                dataType: config.dataType
            };
            request = $.ajax(ajaxConfig);
            request.done(function (res) {
                config.callbackSuccess(res);
            });
            request.fail(function (res, status) {
                config.callbackFail(res, status);
            });
        },
        abort: function () {
            if (request != null) {
                request.abort();
            }
        }
    };
}();