/**
 * Created by nguyenduyhieu on 10/28/15.
 */
var SmartSearch = function () {
    this.formName = "";
    this.gridId = "";
    this.filterUrl = "";
    this.filterParams = {};

    this.labels = {};
};
SmartSearch.prototype.init = function (labels) {
    var self = this;
    self.labels = labels;
    self.initUI();
    //$("a[data-pjax='pjax']").on("click", function (event) {
    //    var attribute = $(this).data("attribute"),
    //        value = $(this).data("value");
    //    self.addFilter(attribute, value);
    //    event.preventDefault();
    //});
    //TODO register filter pjax success
    $("#smart-search-" + self.gridId).on('ready pjax:success', function () {
        self.initUI();
    });
    //TODO init selected filter
    $("#filter-selected-items .filter-selected-item").each(function (index, el) {
        var attribute = $(el).data("attribute"),
            value = $(el).data("value");
        self.filterParams[attribute] = value;
    });
    $("input[name='" + self.formName + "[keyword]']").focus();
};

SmartSearch.prototype.initUI = function () {
    var self = this;
    var ranges = {};
    ranges[self.labels['All']] = ["", ""];
    ranges[self.labels['Today']] = [moment(), moment()];
    ranges[self.labels['Yesterday']] = [moment().subtract(1, 'days'), moment().subtract(1, 'days')];
    ranges[self.labels['Last 7 days']] = [moment().subtract(6, 'days'), moment()];
    ranges[self.labels['Last 30 days']] = [moment().subtract(29, 'days'), moment()];
    ranges[self.labels['This month']] = [moment().startOf('month'), moment().endOf('month')];
    ranges[self.labels['Last month']] = [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')];
    //TODO init date range picker
    $('.daterange-picker').each(function (index, el) {
        var attribute = $(el).data("attribute"),
            value = $(el).data("value"),
            dateFormat = "YYYY-MM-D";
        var dateRange = value.split(",");
        $(el).daterangepicker({
                opens: (Metronic.isRTL() ? 'left' : 'right'),
                format: dateFormat,
                locale: {
                    applyLabel: 'OK',
                    cancelLabel: 'Huỷ',
                    fromLabel: 'Từ',
                    toLabel: 'Tới',
                    weekLabel: 'W',
                    customRangeLabel: 'Tuỳ chỉnh',
                    daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5",
                        "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                    firstDay: moment.localeData()._week.dow,
                },
                separator: ' to ',
                ranges: ranges,
                startDate: moment(dateRange[0], dateFormat),
                endDate: moment(dateRange[1], dateFormat),
                minDate: '2000/01/01',
                maxDate: '2020/12/31',
            },
            function (start, end) {
                if (start._isValid && end._isValid) {
                    var startAt = start.format(dateFormat),
                        endAt = end.format(dateFormat);
                    self.addFilter(attribute, startAt + "," + endAt);
                } else {
                    self.removeFilter(attribute);
                }
            }
        )
    });
    //TODO focus to search field
    $("input[name='" + self.formName + "[keyword]']").focus();
};

SmartSearch.prototype.toSearch = function () {
    var self = this;
    var data = {
        '_pjax': "#" + self.gridId
    };
    data[self.formName] = self.filterParams;
    //TODO search
    $.pjax({
        url: self.filterUrl,
        data: data,
        container: '#' + self.gridId,
        async: false
    });
    //TODO reload smart search
    $.pjax.reload({
        container: "#smart-search-" + self.gridId,
        async: false
    });
};

SmartSearch.prototype.addFilter = function (attribute, value) {
    var self = this;
    if (self.filterParams[self.formName] == undefined) {
        self.filterParams[self.formName] = {};
    }
    self.filterParams[attribute] = value;
    self.toSearch();
};

SmartSearch.prototype.removeFilter = function (attribute) {
    var self = this;
    self.filterParams[attribute] = "";
    self.toSearch();
};


SmartSearch.prototype.deleteFilter = function (event, el) {
    var self = this;
    var keyword = $(el).val();
    if (event.which == 8) {
        if (keyword.length == 0) {
            var lastFilter = $("#filter-selected-items .filter-selected-item").last();
            var attribute = $(lastFilter).data("attribute");
            if (attribute != undefined) {
                self.removeFilter(attribute);
            }
            event.preventDefault();
        }
    }
};
