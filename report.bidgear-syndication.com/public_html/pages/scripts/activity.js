/**
 * Created by Quynh on 10/9/15.
 */
var Activity = function () {

};

Activity.prototype.init = function(){
    //TODO friend time with element has class = datetime-fromnow
    $(".timeline .datetime-fromnow").each(function (index, el) {
        var language = $(el).data("language");
        var datetime = $(el).data("datetime");
        var format = $(el).data("datetime-format");
        format = format.replace("dd", "DD").replace("yyyy", "YYYY");
        format = format.replace("H", "h").replace("i", "mm").replace("s", "ss");
        $(el).html(moment(datetime, format).locale(language).fromNow());
    });
    //TODO init tooltip
    $('[data-toggle="tooltip"]').tooltip();

    if (jQuery().datepicker) {
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            orientation: "left",
            autoclose: true,
            format: "yyyy-mm-dd",
            todayBtn: 'linked',
            language: window.language,
        });
    }

    if (jQuery().timepicker) {
        $('.timepicker-24').timepicker({
            autoclose: true,
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false
        });
    }

    $('.bs-select').selectpicker({
        iconBase: 'fa',
        tickIcon: 'fa-check'
    });

    Metronic.initAjax();
}

