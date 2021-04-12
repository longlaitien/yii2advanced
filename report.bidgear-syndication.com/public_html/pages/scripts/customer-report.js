/**
 * Created by Quynh on 10/9/15.
 */

var CustomerReport = function () {
    var messages = {

    };
};


//TODO init for customer statistic
CustomerReport.prototype.initCustomer = function () {
    var self = this;
    $('.date-picker').datepicker({
        rtl: Metronic.isRTL(),
        orientation: 'auto top',
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: 'linked',
        language: window.language,
    });

    if ($("#socialactivitycustomerform-customer_id").length > 0) {
        $("#socialactivitycustomerform-customer_id").select2({
            allowClear: true,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: window.homeUrl + '/account/info/public-search?',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        keyword: term, // search term
                        page: page
                    };
                },
                results: function (res, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    var data = [];
                    for (var i = 0; i < res.data.objects.length; i++) {
                        data.push({
                            id: res.data.objects[i].account_id,
                            text: res.data.objects[i].name
                        });
                    }
                    return {
                        results: data,
                        more: res.data.more
                    };
                }
            }
        });
    }
}


//TODO init for contact statistic
CustomerReport.prototype.initContact = function () {
    var self = this;
    $('.date-picker').datepicker({
        rtl: Metronic.isRTL(),
        orientation: 'auto top',
        autoclose: true,
        format: "yyyy-mm-dd",
        todayBtn: 'linked',
        language: window.language,
    });

    if ($("#socialactivitycontactform-object_id").length > 0) {
        $("#socialactivitycontactform-object_id").select2({
            allowClear: true,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: window.homeUrl + '/contact/info/public-search',
                dataType: 'json',
                data: function (term, page) {
                    return {
                        keyword: term, // search term
                        page: page
                    };
                },
                results: function (res, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    var data = [];
                    for (var i = 0; i < res.data.objects.length; i++) {
                        data.push({
                            id: res.data.objects[i].contact_id,
                            text: res.data.objects[i].full_name
                        });
                    }
                    return {
                        results: data,
                        more: res.data.more
                    };
                }
            }
        });
    }
}


//TODO set data for select2
CustomerReport.prototype.setData = function (el, id, name) {
    $('#' +el).select2("data", {
        id: id,
        text: name
    });
};
