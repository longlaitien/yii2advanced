
var CalendarWidget = function () {
};
CalendarWidget.prototype.init = function () {
    var self = this;
    if (!jQuery().fullCalendar) {
        return;
    }

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    var h = {};

    if ($('#calendar').width() <= 400) {
        $('#calendar').addClass("mobile");
        h = {
            left: 'title, prev, next',
            center: '',
            right: 'today,month,agendaWeek,agendaDay'
        };
    } else {
        $('#calendar').removeClass("mobile");
        if (Metronic.isRTL()) {
            h = {
                right: 'title',
                center: '',
                left: 'prev,next,today,month,agendaWeek,agendaDay'
            };
        } else {
            h = {
                left: 'title',
                center: '',
                right: 'prev,next,today,month,agendaWeek,agendaDay'
            };
        }
    }


    $('#calendar').fullCalendar('destroy'); // destroy the calendar
    $('#calendar').fullCalendar({ //re-initialize the calendar
        disableDragging: false,
        header: h,
        slotMinutes: 30,
        editable: true,
        //eventSources: window.homeUrl + '/social/feed/event-source',
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: window.homeUrl + '/task/calendar/event-source',
                data: {
                    start: self.parseTime(start),
                    end: self.parseTime(end)
                },
                success: function (data) {
                    var events = data;
                    callback(events);
                }
            });
        },
        eventRender: function (event, element, view) {
            element.html(event.title);
            if(event.style.length >0){
                element.css(JSON.parse(event.style));
            }
        },
        eventClick: function (calEvent, jsEvent, view) {
            self.viewEvent(calEvent.event_id);
        },
        dayClick: function(date, jsEvent, view) {
            CallAJAX.call({
                url: '/task/calendar/ajax-view?date=' + self.parseTime(date),
                method: 'GET',
                dataType: 'json',
                callbackSuccess: function (data) {
                    if (data.success) {
                        $('#show-event-date').html(data.message);
                        $('#modal-event-date').modal('show');
                    } else {
                        toastr.success(data.message);
                    }
                },
                callbackFail: function (res, status) {
                }
            });
        }
    });
};

CalendarWidget.prototype.viewEvent = function (event_id) {
    CallAJAX.call({
        url: '/social/feed/view-event?event_id=' + event_id,
        type: 'GET',
        callbackSuccess: function (res) {
            if (res.success) {
                window.location.href = res.url;
            }
        }
    });
}

CalendarWidget.prototype.parseTime = function (d) {
    var date = d.date();
    var month = d.month() + 1;
    var year = d.year();
    return year + '-' + month + '-' + date;
}