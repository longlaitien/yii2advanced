/**
 * Created by nguyenduyhieu on 10/15/15.
 */
var Print = function () {
    var modalId = "";
    var frameId = "";
};

Print.prototype.init = function () {
    var self = this;
    self.modalId = "print-modal-preview";
    self.frameId = "print_iframe";
};

Print.prototype.openPreview = function (el) {
    var self = this;
    $("#" + self.frameId).attr("src", $(el).data("url"));
    $("#" + self.modalId).modal("show");
};

Print.prototype.closePreview = function () {
    var self = this;
    $("#" + self.modalId).modal("hide");
};

Print.prototype.toPrint = function () {
    var self = this;
    frames[self.frameId].focus();
    frames[self.frameId].print();
};