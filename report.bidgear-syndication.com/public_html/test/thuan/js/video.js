"use strict";
var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
var ErrorMessage;
(function (ErrorMessage) {
    ErrorMessage["VIDEO_SOURCE_MISSING"] = "video source is missing";
    ErrorMessage["VIDEO_ELEMENT_NOT_FOUNT"] = "video element html not found";
})(ErrorMessage || (ErrorMessage = {}));
var CssClass;
(function (CssClass) {
    CssClass["VIDEO_HLS"] = "video_hsl";
    CssClass["TIME_LINE"] = "current_time";
    CssClass["MASK"] = "mask";
    CssClass["VOLUMNE"] = "volume";
    CssClass["VOLUME_ON"] = "volume_on";
    CssClass["VOLUME_OFF"] = "volume_off";
    CssClass["TEXT_SUGGEST"] = "suggest";
    CssClass["HIDDEN"] = "hidden";
})(CssClass || (CssClass = {}));
var BgVideoCreative = function (doc, options) {
    var optionsDefault = {
        video_box_id: '',
        video_source: '',
        video_thumb: '',
        link_redirect: '',
        css_prefix: '',
        autoplay: true,
        show_suggest: true,
        replay: false,
        loop_event: false,
    };
    var settings = __assign(__assign({}, optionsDefault), options);
    var renderClassWithPrefix = function (cls, addDot) {
        if (addDot === void 0) { addDot = true; }
        return (addDot ? '.' : '') + settings.css_prefix + cls;
    };
    var boxHtmlElement = doc.getElementById(settings.video_box_id);
    var videoHtmlElement = boxHtmlElement.querySelector(renderClassWithPrefix(CssClass.VIDEO_HLS));
    var timelineHtmlElement = boxHtmlElement.querySelector(renderClassWithPrefix(CssClass.TIME_LINE));
    var maskHtmlElement = boxHtmlElement.querySelector(renderClassWithPrefix(CssClass.MASK));
    var suggestHtmlElement = boxHtmlElement.querySelector(renderClassWithPrefix(CssClass.TEXT_SUGGEST));
    var volumeHtmlElement = boxHtmlElement.querySelector(renderClassWithPrefix(CssClass.VOLUMNE));
    var volumeOnHtmlElement = boxHtmlElement.querySelector(renderClassWithPrefix(CssClass.VOLUME_ON));
    var volumeOffHtmlElement = boxHtmlElement.querySelector(renderClassWithPrefix(CssClass.VOLUME_OFF));
    var eventsDispatch = [];
    var validateOptionsInput = function () {
        if (options.video_source.trim().length === 0) {
            throw new Error(ErrorMessage.VIDEO_SOURCE_MISSING);
        }
        if (!boxHtmlElement) {
            throw new Error(ErrorMessage.VIDEO_ELEMENT_NOT_FOUNT);
        }
        if (!videoHtmlElement) {
            throw new Error(ErrorMessage.VIDEO_ELEMENT_NOT_FOUNT);
        }
    };
    var dispatchEventTime = function (second) {
        if (!~eventsDispatch.indexOf(second)) {
            var method = 'e' + second;
            eventsDispatch.push(second);
            if (settings.hasOwnProperty(method) && typeof settings[method] === 'function') {
                settings[method].call(undefined);
            }
        }
    };
    var updateTimeline = function (duration, currentTime) {
        var percent = (100 / duration) * currentTime;
        if (percent < 100) {
            timelineHtmlElement.style.width = percent.toFixed(2) + '%';
        }
    };
    var showTextSuggest = function () {
        suggestHtmlElement.classList.remove(renderClassWithPrefix(CssClass.HIDDEN, false));
    };
    var hideTextSuggest = function () {
        suggestHtmlElement.classList.add(renderClassWithPrefix(CssClass.HIDDEN, false));
    };
    var initial = function () {
        validateOptionsInput();
        if (settings.video_thumb.length) {
            videoHtmlElement.poster = settings.video_thumb;
        }
        videoHtmlElement.autoplay = settings.autoplay;
        videoHtmlElement.muted = videoHtmlElement.autoplay;
        videoHtmlElement.loop = settings.replay;
        videoHtmlElement.controls = false;
        videoHtmlElement.setAttribute('playsinline', 'true');
        videoHtmlElement.setAttribute('disablePictureInPicture', 'false');
        if (Hls.isSupported()) {
            var hls = new Hls();
            hls.loadSource(settings.video_source);
            hls.attachMedia(videoHtmlElement);
        }
        else if (videoHtmlElement.canPlayType('application/vnd.apple.mpegurl')) {
            videoHtmlElement.src = settings.video_source;
        }
        videoHtmlElement.addEventListener('timeupdate', function () {
            var currentTime = Math.floor(videoHtmlElement.currentTime);
            var duration = Math.ceil(videoHtmlElement.duration);
            if (currentTime === 0 && eventsDispatch.length > 0 && settings.loop_event) {
                eventsDispatch = [];
            }
            updateTimeline(duration, currentTime);
            dispatchEventTime(currentTime);
        });
        if (maskHtmlElement) {
            maskHtmlElement.addEventListener('click', function () {
                window.open(settings.link_redirect);
            });
        }
        if (settings.autoplay) {
            volumeOnHtmlElement.classList.add(renderClassWithPrefix(CssClass.HIDDEN, false));
            volumeOffHtmlElement.classList.remove(renderClassWithPrefix(CssClass.HIDDEN, false));
        }
        else {
            volumeOnHtmlElement.classList.remove(renderClassWithPrefix(CssClass.HIDDEN, false));
            volumeOffHtmlElement.classList.add(renderClassWithPrefix(CssClass.HIDDEN, false));
        }
        if (settings.show_suggest) {
            suggestHtmlElement.classList.remove(renderClassWithPrefix(CssClass.HIDDEN, false));
        }
        else {
            suggestHtmlElement.classList.add(renderClassWithPrefix(CssClass.HIDDEN, false));
        }
        if (volumeHtmlElement) {
            volumeHtmlElement.addEventListener('click', function () {
                if (videoHtmlElement.muted) {
                    videoHtmlElement.muted = false;
                    videoHtmlElement.volume = 1;
                    volumeOffHtmlElement.classList.add(renderClassWithPrefix(CssClass.HIDDEN, false));
                    volumeOnHtmlElement.classList.remove(renderClassWithPrefix(CssClass.HIDDEN, false));
                }
                else {
                    videoHtmlElement.muted = true;
                    videoHtmlElement.volume = 0;
                    volumeOffHtmlElement.classList.remove(renderClassWithPrefix(CssClass.HIDDEN, false));
                    volumeOnHtmlElement.classList.add(renderClassWithPrefix(CssClass.HIDDEN, false));
                }
            });
        }
        if (suggestHtmlElement) {
            if (!settings.show_suggest) {
                hideTextSuggest();
            }
        }
    };
    initial();
    return { showTextSuggest: showTextSuggest, hideTextSuggest: hideTextSuggest };
};
