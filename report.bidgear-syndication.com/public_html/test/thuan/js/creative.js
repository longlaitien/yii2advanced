"use strict";
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
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
var IconSvg;
(function (IconSvg) {
    IconSvg["MUTE"] = "<svg viewBox=\"0 0 24 24\" width=\"100%\" height=\"100%\"><g><path d=\"M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z\"></path></g></svg>";
    IconSvg["UNMUTE"] = "<svg viewBox=\"0 0 24 24\" width=\"100%\" height=\"100%\"><g><path d=\"M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z\"></path></g></svg>";
})(IconSvg || (IconSvg = {}));
var CssClass;
(function (CssClass) {
    CssClass["CONTAINER"] = "container";
    CssClass["CONTENT"] = "content";
    CssClass["BACKDROP"] = "backdrop";
    CssClass["PROGRESS"] = "progress";
    CssClass["PROGRESS_BAR"] = "progress-bar";
    CssClass["ICON_VOLUME"] = "icon-volume";
    CssClass["HIDDEN"] = "hidden";
    CssClass["ACTIVE"] = "active";
    CssClass["TEXT_CONTENT"] = "text-content";
    CssClass["TEXT_LINK"] = "text-link";
    CssClass["TEXT_LINK_FULL"] = "text-link-full";
    CssClass["BTN_REDIRECT"] = "btn-redirect";
})(CssClass || (CssClass = {}));
var CreativeEvents;
(function (CreativeEvents) {
    CreativeEvents["VIDEO_START_FIRST_TIME"] = "VIDEO_START_FIRST_TIME";
    CreativeEvents["VIDEO_START_NOT_FIRST_TIME"] = "VIDEO_START_NOT_FIRST_TIME";
    CreativeEvents["VIDEO_ENDED_FIRST_TIME"] = "VIDEO_ENDED_FIRST_TIME";
    CreativeEvents["VIDEO_ENDED_NOT_FIRST_TIME"] = "VIDEO_ENDED_NOT_FIRST_TIME";
    CreativeEvents["DESTROY"] = "DESTROY";
})(CreativeEvents || (CreativeEvents = {}));
var ExceptionMessage;
(function (ExceptionMessage) {
    ExceptionMessage["HLS_LIBRARY_NOT_FOUND"] = "Hls library not found";
    ExceptionMessage["TARGET_ELEMENT_NOT_FOUND"] = "Target element not found";
    ExceptionMessage["BROWSER_NOT_SUPPORT_VIDEO_M3U8"] = "Browser is not support video m3u8";
    ExceptionMessage["VIDEO_SOURCE_NOT_FOUND"] = "Video source not found";
})(ExceptionMessage || (ExceptionMessage = {}));
var EventEmitter = (function () {
    function EventEmitter() {
        this.events = {};
    }
    EventEmitter.prototype.on = function (eventName, callback) {
        if (this.events[eventName]) {
            this.events[eventName].push(callback);
        }
        else {
            this.events[eventName] = [callback];
        }
    };
    EventEmitter.prototype.trigger = function (eventName, data) {
        if (this.events[eventName]) {
            this.events[eventName].forEach(function (callback) {
                callback.call(null, data);
            });
        }
    };
    EventEmitter.prototype.clearAllEvents = function () {
        this.events = {};
    };
    return EventEmitter;
}());
var Creative = (function (_super) {
    __extends(Creative, _super);
    function Creative(configs) {
        var _this = _super.call(this) || this;
        _this.debug = false;
        _this.prefix = "dsp-";
        _this.countPlay = 0;
        _this.hasRun = false;
        _this.configs = {
            video: {
                source: "",
                thumbnail: "",
                text: "",
                link: "",
            },
            targetId: "",
            displayVideoText: true,
            redirectButtonText: "Go!",
            redirectButton: false,
            openNewTab: true,
            limitNumberRepeat: -1,
            delayRepeat: 3e3,
            useOriginSource: false,
        };
        _this.targetEle = document.getElementById(configs.targetId);
        _this.containerEle = document.createElement("div");
        _this.videoEle = document.createElement("video");
        _this.progressBarEle = document.createElement("div");
        _this.iconMuteEle = document.createElement("div");
        _this.iconUnmuteEle = document.createElement("div");
        _this.loadConfig(configs);
        _this.hlsInstance = new Hls();
        return _this;
    }
    Object.defineProperty(Creative, "Events", {
        get: function () {
            return CreativeEvents;
        },
        enumerable: false,
        configurable: true
    });
    Creative.prototype.loadConfig = function (configs) {
        this.configs = __assign(__assign({}, this.configs), configs);
        this.log("load config");
        var _a = this.configs, video = _a.video, targetId = _a.targetId;
        if (!video.source || video.source.length === 0) {
            throw new Error(ExceptionMessage.VIDEO_SOURCE_NOT_FOUND);
        }
        if (typeof Hls !== "function") {
            throw new Error(ExceptionMessage.HLS_LIBRARY_NOT_FOUND);
        }
        this.targetEle = document.getElementById(targetId);
        if (!this.targetEle) {
            throw new Error(ExceptionMessage.TARGET_ELEMENT_NOT_FOUND);
        }
    };
    Creative.prototype.display = function () {
        if (this.hasRun) {
            this.destroy();
        }
        this.log("build creative and display");
        this.containerEle = document.createElement("div");
        this.containerEle.setAttribute("class", this.buildCssClass(CssClass.CONTAINER));
        this.targetEle.appendChild(this.containerEle);
        this.createMediaElementsGroup();
        this.createContentElementsGroup();
        this.attachMediaAndRegisterEvents();
        this.hasRun = true;
    };
    Creative.prototype.destroy = function () {
        var _a, _b, _c;
        this.log("destroy creative");
        this.countPlay = 0;
        this.hasRun = false;
        if (this.hlsInstance) {
            this.hlsInstance.destroy();
        }
        if (this.videoEle) {
            (_a = this.videoEle.parentNode) === null || _a === void 0 ? void 0 : _a.removeChild(this.videoEle);
            this.videoEle = document.createElement("video");
        }
        if (this.iconMuteEle) {
            (_b = this.iconMuteEle.parentNode) === null || _b === void 0 ? void 0 : _b.removeChild(this.iconMuteEle);
            this.iconMuteEle = document.createElement("div");
        }
        if (this.iconUnmuteEle) {
            (_c = this.iconUnmuteEle.parentNode) === null || _c === void 0 ? void 0 : _c.removeChild(this.iconUnmuteEle);
            this.iconUnmuteEle = document.createElement("div");
        }
        while (this.containerEle.firstChild) {
            this.containerEle.removeChild(this.containerEle.firstChild);
        }
        while (this.targetEle.firstChild) {
            this.targetEle.removeChild(this.targetEle.firstChild);
        }
        this.trigger(CreativeEvents.DESTROY, {
            event: CreativeEvents.DESTROY,
            payload: this.getPayload(),
        });
    };
    Creative.prototype.log = function () {
        var rest = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            rest[_i] = arguments[_i];
        }
        if (this.debug) {
            console.log.apply(console, rest);
        }
    };
    Creative.prototype.getPayload = function (extra) {
        return __assign(__assign({}, extra), { countPlay: this.countPlay, limit: this.configs.limitNumberRepeat });
    };
    Creative.prototype.buildCssClass = function () {
        var _this = this;
        var className = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            className[_i] = arguments[_i];
        }
        var arr = className.map(function (item) { return "" + _this.prefix + item; });
        return arr.join(" ");
    };
    Creative.prototype.createMediaElementsGroup = function () {
        this.log("create media elements group");
        var _a = this.configs, displayVideoText = _a.displayVideoText, video = _a.video;
        var contentEle = document.createElement("div");
        contentEle.setAttribute("class", this.buildCssClass(CssClass.CONTENT));
        contentEle.style.height = (displayVideoText ? 210 : 250) + "px";
        var backdropEle = document.createElement("div");
        backdropEle.setAttribute("class", this.buildCssClass(CssClass.BACKDROP));
        contentEle.appendChild(backdropEle);
        if (video.thumbnail && video.thumbnail.length > 0) {
            backdropEle.style.backgroundImage = "url('" + video.thumbnail + "')";
        }
        this.videoEle = document.createElement("video");
        this.videoEle.src = video.source;
        this.videoEle.width = 300;
        this.videoEle.height = displayVideoText ? 210 : 250;
        this.videoEle.autoplay = false;
        this.videoEle.muted = true;
        this.videoEle.controls = false;
        this.videoEle.loop = false;
        this.videoEle.setAttribute("playsinline", "true");
        this.videoEle.setAttribute("disablePictureInPicture", "false");
        contentEle.appendChild(this.videoEle);
        var progressEle = document.createElement("div");
        progressEle.setAttribute("class", this.buildCssClass(CssClass.PROGRESS));
        contentEle.appendChild(progressEle);
        this.progressBarEle = document.createElement("div");
        this.progressBarEle.setAttribute("class", this.buildCssClass(CssClass.PROGRESS_BAR));
        progressEle.appendChild(this.progressBarEle);
        this.iconMuteEle = document.createElement("div");
        this.iconMuteEle.setAttribute("class", this.buildCssClass(CssClass.ICON_VOLUME, CssClass.HIDDEN));
        this.iconMuteEle.innerHTML = IconSvg.MUTE;
        contentEle.appendChild(this.iconMuteEle);
        this.iconUnmuteEle = document.createElement("div");
        this.iconUnmuteEle.setAttribute("class", this.buildCssClass(CssClass.ICON_VOLUME, CssClass.HIDDEN));
        this.iconUnmuteEle.innerHTML = IconSvg.UNMUTE;
        contentEle.appendChild(this.iconUnmuteEle);
        this.containerEle.appendChild(contentEle);
    };
    Creative.prototype.createContentElementsGroup = function () {
        var _a = this.configs, openNewTab = _a.openNewTab, video = _a.video, redirectButton = _a.redirectButton, redirectButtonText = _a.redirectButtonText, displayVideoText = _a.displayVideoText;
        if (!displayVideoText) {
            return;
        }
        this.log("create content elements group");
        var textContentEle = document.createElement("div");
        textContentEle.setAttribute("class", this.buildCssClass(CssClass.TEXT_CONTENT));
        this.containerEle.appendChild(textContentEle);
        var textLinkEle = document.createElement("a");
        textLinkEle.href = video.link;
        textLinkEle.target = openNewTab ? "_blank" : "_self";
        textLinkEle.innerText = video.text;
        textLinkEle.setAttribute("class", this.buildCssClass(CssClass.TEXT_LINK));
        textContentEle.appendChild(textLinkEle);
        if (!redirectButton) {
            textLinkEle.classList.add(this.buildCssClass(CssClass.TEXT_LINK_FULL));
        }
        if (redirectButton) {
            var buttonRedirectEle = document.createElement("a");
            buttonRedirectEle.href = video.link;
            buttonRedirectEle.target = openNewTab ? "_blank" : "_self";
            buttonRedirectEle.innerText = redirectButtonText;
            buttonRedirectEle.setAttribute("class", this.buildCssClass(CssClass.BTN_REDIRECT));
            textContentEle.appendChild(buttonRedirectEle);
        }
    };
    Creative.prototype.attachMediaAndRegisterEvents = function () {
        var _this = this;
        var _a = this.configs, useOriginSource = _a.useOriginSource, video = _a.video, openNewTab = _a.openNewTab, delayRepeat = _a.delayRepeat, limitNumberRepeat = _a.limitNumberRepeat;
        var delayMs = delayRepeat > 0 ? delayRepeat : 1e3;
        if (useOriginSource) {
            this.videoEle.src = video.source;
            this.videoEle.play();
        }
        else {
            if (Hls.isSupported()) {
                this.hlsInstance = new Hls();
                this.hlsInstance.loadSource(video.source);
                this.hlsInstance.attachMedia(this.videoEle);
                this.videoEle.play();
            }
            else if (this.videoEle.canPlayType("application/vnd.apple.mpegurl")) {
                this.videoEle.src = video.source;
                this.videoEle.play();
            }
            else {
                throw new Error(ExceptionMessage.BROWSER_NOT_SUPPORT_VIDEO_M3U8);
            }
        }
        this.log("load media source and add events");
        this.videoEle.addEventListener("play", function () {
            _this.log("start play video");
            _this.countPlay++;
            if (_this.videoEle.muted) {
                _this.showIconMute();
                _this.hiddenIconUnMute();
            }
            else {
                _this.showIconUnMute();
                _this.hiddenIconMute();
            }
            if (_this.countPlay === 1) {
                _this.trigger(CreativeEvents.VIDEO_START_FIRST_TIME, {
                    event: CreativeEvents.VIDEO_START_FIRST_TIME,
                    payload: _this.getPayload(),
                });
            }
            if (_this.countPlay > 1) {
                _this.trigger(CreativeEvents.VIDEO_START_NOT_FIRST_TIME, {
                    event: CreativeEvents.VIDEO_START_NOT_FIRST_TIME,
                    payload: _this.getPayload(),
                });
            }
        });
        this.videoEle.addEventListener("click", function () {
            if (openNewTab) {
                window.open(video.link);
            }
            else {
                window.location.href = video.link;
            }
            _this.log("click to video player");
        });
        this.videoEle.addEventListener("ended", function () {
            if (_this.countPlay === 1) {
                _this.trigger(CreativeEvents.VIDEO_ENDED_FIRST_TIME, {
                    event: CreativeEvents.VIDEO_ENDED_FIRST_TIME,
                    payload: _this.getPayload(),
                });
            }
            else {
                _this.trigger(CreativeEvents.VIDEO_ENDED_NOT_FIRST_TIME, {
                    event: CreativeEvents.VIDEO_ENDED_NOT_FIRST_TIME,
                    payload: _this.getPayload(),
                });
            }
            if (limitNumberRepeat === -1) {
                setTimeout(function () { _this.videoEle.play(); }, delayMs);
            }
            if (limitNumberRepeat > 0 && limitNumberRepeat >= _this.countPlay) {
                setTimeout(function () { _this.videoEle.play(); }, delayMs);
            }
            _this.hiddenIconMute();
            _this.hiddenIconUnMute();
            _this.log("video ended");
        });
        this.videoEle.addEventListener("timeupdate", function () {
            var percent = (Math.ceil(_this.videoEle.currentTime) / Math.ceil(_this.videoEle.duration)) * 100;
            if (percent <= 100) {
                _this.progressBarEle.style.width = percent.toFixed(2) + '%';
            }
        });
        this.iconMuteEle.addEventListener("click", function () {
            _this.showIconUnMute();
            _this.hiddenIconMute();
            _this.videoEle.muted = false;
            _this.videoEle.volume = 1;
            _this.log("video switch to unmute");
        });
        this.iconUnmuteEle.addEventListener("click", function () {
            _this.showIconMute();
            _this.hiddenIconUnMute();
            _this.videoEle.muted = true;
            _this.videoEle.volume = 0;
            _this.log("video switch to mute");
        });
    };
    Creative.prototype.hiddenIconMute = function () {
        this.iconMuteEle.classList.add(this.buildCssClass(CssClass.HIDDEN));
        this.iconMuteEle.classList.remove(this.buildCssClass(CssClass.ACTIVE));
    };
    Creative.prototype.showIconMute = function () {
        this.iconMuteEle.classList.remove(this.buildCssClass(CssClass.HIDDEN));
        this.iconMuteEle.classList.add(this.buildCssClass(CssClass.ACTIVE));
    };
    Creative.prototype.hiddenIconUnMute = function () {
        this.iconUnmuteEle.classList.add(this.buildCssClass(CssClass.HIDDEN));
        this.iconUnmuteEle.classList.remove(this.buildCssClass(CssClass.ACTIVE));
    };
    Creative.prototype.showIconUnMute = function () {
        this.iconUnmuteEle.classList.remove(this.buildCssClass(CssClass.HIDDEN));
        this.iconUnmuteEle.classList.add(this.buildCssClass(CssClass.ACTIVE));
    };
    return Creative;
}(EventEmitter));
