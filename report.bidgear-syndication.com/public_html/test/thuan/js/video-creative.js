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
var CssClassName;
(function (CssClassName) {
    CssClassName["DIV_CONTAINER"] = "container";
    CssClassName["DIV_PLAYER"] = "player";
    CssClassName["DIV_CONTENT"] = "content";
    CssClassName["DIV_MASK"] = "mask";
    CssClassName["BLUR"] = "blur";
    CssClassName["ICON"] = "icon";
    CssClassName["ICON_VOLUMN"] = "icon_volume";
    CssClassName["DIV_PROGRESS"] = "progress";
    CssClassName["DIV_PROGRESS_BAR"] = "progress_bar";
    CssClassName["TITLE"] = "title";
    CssClassName["TITLE_FLEX"] = "title_flex";
    CssClassName["BUTTON_PRIMARY"] = "button_primary";
})(CssClassName || (CssClassName = {}));
var IconSvg;
(function (IconSvg) {
    IconSvg["MUTE"] = "<svg viewBox=\"0 0 24 24\" preserveAspectRatio=\"xMidYMid meet\" focusable=\"false\"><g><path d=\"M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z\"></path></g></svg>";
    IconSvg["UNMUTE"] = "<svg viewBox=\"0 0 24 24\" preserveAspectRatio=\"xMidYMid meet\" focusable=\"false\"><g><path d=\"M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z\"></path></g></svg>";
})(IconSvg || (IconSvg = {}));
var ErrorMessage;
(function (ErrorMessage) {
    ErrorMessage["ELEMENT_TARGET_NOT_FOUND"] = "Target ID not found.";
    ErrorMessage["CREATIVE_NOT_FOUND"] = "Creative not found.";
    ErrorMessage["VIDEO_SOURCE_NOT_FOUND"] = "Can not load video source";
    ErrorMessage["VIDEO_TEXT_NOT_FOUND"] = "Text of video not found";
})(ErrorMessage || (ErrorMessage = {}));
var VideoCreative = function (doc, data) {
    var defaultData = {
        creative: {
            m3u8_source: "",
            thumbnail: "",
            title: "",
            link: "",
        },
        theme: "dark",
        target_id: "",
        css_class_prefix: "bg_",
        autoplay: true,
        repeat: true,
        add_button: true,
        button_text: "Go!"
    };
    var settings = __assign(__assign({}, defaultData), data);
    var cssName = function (name, addDotPrefix) {
        if (addDotPrefix === void 0) { addDotPrefix = false; }
        return (addDotPrefix ? "." : "") + settings.css_class_prefix + name;
    };
    var createElement = function (tagName, options) {
        var ele = doc.createElement(tagName);
        if (options) {
            for (var key in options) {
                ele.setAttribute(key, options[key]);
            }
        }
        return ele;
    };
    var createVideo = function () {
        var videoEle = createElement("video", {
            src: settings.creative.m3u8_source,
        });
        videoEle.autoplay = settings.autoplay;
        videoEle.muted = settings.autoplay;
        videoEle.loop = settings.repeat;
        videoEle.controls = false;
        videoEle.setAttribute('playsinline', 'true');
        videoEle.setAttribute('disablePictureInPicture', 'false');
        return videoEle;
    };
    var createPlayer = function () {
        var playerEle = createElement("div", {
            "class": cssName(CssClassName.DIV_PLAYER),
        });
        var maskEle = createElement("div", {
            class: cssName(CssClassName.DIV_MASK),
        });
        if (settings.creative.thumbnail) {
            maskEle.style.backgroundImage = "url('" + settings.creative.thumbnail + "')";
        }
        playerEle.appendChild(maskEle);
        var videoEle = createVideo();
        if (Hls.isSupported()) {
            var hls = new Hls();
            hls.loadSource(settings.creative.m3u8_source);
            hls.attachMedia(videoEle);
        }
        else if (videoEle.canPlayType('application/vnd.apple.mpegurl')) {
            videoEle.src = settings.creative.m3u8_source;
        }
        playerEle.appendChild(videoEle);
        var muteIconHtml = createElement("button", {
            class: cssName(CssClassName.ICON) + " " + cssName(CssClassName.ICON_VOLUMN),
        });
        muteIconHtml.innerHTML = IconSvg.MUTE;
        muteIconHtml.addEventListener("click", function () {
            if (videoEle.muted) {
                muteIconHtml.innerHTML = IconSvg.UNMUTE;
                videoEle.muted = false;
                videoEle.volume = 1;
            }
            else {
                muteIconHtml.innerHTML = IconSvg.MUTE;
                videoEle.muted = true;
                videoEle.volume = 0;
            }
            videoEle.focus();
        });
        playerEle.appendChild(muteIconHtml);
        var progressEle = createElement("div", {
            class: cssName(CssClassName.DIV_PROGRESS),
        });
        var progressBarEle = createElement("div", {
            class: cssName(CssClassName.DIV_PROGRESS_BAR),
        });
        progressEle.appendChild(progressBarEle);
        playerEle.appendChild(progressEle);
        videoEle.addEventListener('timeupdate', function () {
            var currentTime = Math.floor(videoEle.currentTime);
            var duration = Math.ceil(videoEle.duration);
            var percent = (100 / duration) * currentTime;
            if (percent < 100) {
                progressBarEle.style.width = percent.toFixed(2) + '%';
            }
        });
        videoEle.addEventListener('play', function () {
            maskEle.classList.add(cssName(CssClassName.BLUR));
        });
        videoEle.addEventListener('click', function () {
            window.open(settings.creative.link);
        });
        return playerEle;
    };
    var createContent = function () {
        var contentEle = createElement("div", {
            class: cssName(CssClassName.DIV_CONTENT),
        });
        var textEle = createElement("a", {
            href: settings.creative.link,
            target: "_blank",
            class: cssName(CssClassName.TITLE),
        });
        textEle.innerText = settings.creative.title;
        if (settings.add_button) {
            textEle.classList.add(cssName(CssClassName.TITLE_FLEX));
        }
        contentEle.appendChild(textEle);
        if (settings.add_button) {
            var buttonPrimaryEle = createElement("a", {
                href: settings.creative.link,
                target: "_blank",
                class: cssName(CssClassName.BUTTON_PRIMARY),
            });
            buttonPrimaryEle.innerText = settings.button_text;
            contentEle.appendChild(buttonPrimaryEle);
        }
        return contentEle;
    };
    var initial = function () {
        var targetEle = doc.getElementById(settings.target_id);
        if (!targetEle) {
            throw new Error(ErrorMessage.ELEMENT_TARGET_NOT_FOUND);
        }
        if (!settings.creative) {
            throw new Error(ErrorMessage.ELEMENT_TARGET_NOT_FOUND);
        }
        if (!settings.creative.m3u8_source || settings.creative.m3u8_source.trim().length === 0) {
            throw new Error(ErrorMessage.VIDEO_SOURCE_NOT_FOUND);
        }
        if (!settings.creative.title || settings.creative.title.trim().length === 0) {
            throw new Error(ErrorMessage.VIDEO_TEXT_NOT_FOUND);
        }
        var containerEle = createElement("div", {
            "class": cssName(CssClassName.DIV_CONTAINER) + " " + cssName(settings.theme) + "_theme",
        });
        targetEle.appendChild(containerEle);
        var playerEle = createPlayer();
        containerEle.appendChild(playerEle);
        var contentEle = createContent();
        containerEle.appendChild(contentEle);
    };
    initial();
};
