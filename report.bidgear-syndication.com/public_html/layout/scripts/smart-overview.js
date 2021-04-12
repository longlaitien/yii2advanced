var SmartOverview = function () {
    this.element = $("#smart-preview-widget");
    this.top = 0;
    this.bottom = 0;
    this.left = 0;
    this.right = 0;
};

SmartOverview.prototype.init = function () {
    var self = this;
    self.element.hover(function () {
    }, function () {
        self.element.animate({
            //opacity: 0.5,
        }, 200, function () {
            self.element.css({
                "top": "0px",
                "left": "0px",
                "display": "none",
                "opacity": 0,
                "z-index": 999999
            });
            self.element.find("div.content").html('<img src="/global/img/paragraph.png" class="img img-responsive img-thumbnail loading"/>');
        });
    });
    //TODO init smart overview
    $("[data-smart-preview='preview']").hover(function () {
        var currentElement = this;
        setTimeout(function () {
            var position = $(currentElement).offset();
            self.element.animate({
                //opacity: 0.5,
            }, 200, function () {
                if ($(currentElement).is(":hover")) {
                    var width = 650;
                    var height = 160;
                    var p = 150;

                    //TODO set css
                    self.top = position.top - height;
                    self.left = (position.left - width) + p;
                    self.bottom = self.top + height;
                    self.right = self.left + width;

                    //console.log('top: ' + self.top + "; bottom: " + self.bottom + " left: " + self.left + " right: " + self.right);
                    self.element.css({
                        "top": (self.top - 2) + "px",
                        "left": (self.left) + "px",
                        "display": "block",
                        "opacity": 1,
                        "-webkit-transition": "width 2s, height 2s, background-color 2s, -webkit-transform 2s",
                        "transition": "width 2s, height 2s, background-color 2s, transform 2s",
                        "border": "1px solid black",
                        "overflow-y": "scroll"
                    });
                    //TODO get overview
                    self.element.find("div.content").css({
                        height: height,
                        width: width
                    }).html("Loading");

                    //TODO get data
                    var data = {
                        date: $(currentElement).data('date'),
                        type: $(currentElement).data('type'),
                        campaign: $(currentElement).data('campaign'),
                    };
                    //console.log(data);
                    $.ajax({
                        url: window.homeUrl + '/user/report/quick-info',
                        method: 'GET',
                        data: $.param(data),
                        success: function (res) {
                            if (res.success) {
                                self.element.find("div.content").html(res.content);
                            }
                        }
                    });
                }
            });
        }, 500);
    }, function () {
        $(document).mouseover(function (e) {
            var x = e.pageX, y = e.pageY;
            // console.log("x: " + x);
            // console.log("y: " + y);
            if (!(x <= (self.right+10) && x >= self.left && y >= (self.top) && y <= (self.bottom + 5))) {
                self.element.css({
                    "top": "0px",
                    "left": "0px",
                    "display": "none",
                })
            }
        });
    });

    $("[data-smart-preview='preview']").click(function () {
        self.element.css({
            "top": "0px",
            "left": "0px",
            "display": "none",
            "opacity": 1,
        });
    });
};