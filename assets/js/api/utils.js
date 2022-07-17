////////////////////////////////////////////////////////////////////////////////
// NOTE - This utils file should be kept
// ultra-generic. As a general rule of
// thumb, if it wouldn't be useful outside
// of Muso, it doesn't go here.
////////////////////////////////////////////////////////////////////////////////

// NOTE - I know these wrappers don't do much but if we
// ever change our core way of hiding things, you'll be
// glad they're here.
function hide(element) {
    element.classList.add('hide');
}

function unhide(element) {
    element.classList.remove('hide');
}

function suffixNumber(number) {
    number = number.toString();
    let suffix = '';
    const secondLast = number.length > 1 ? number.substr(-2, 1) : '';

    if (secondLast === '1') {
        suffix = 'th';
    } else {
        switch (number.substr(-1, 1)) {
            case '1':
                suffix = 'st';
                break;
            case '2':
                suffix = 'nd';
                break;
            case '3':
                suffix = 'rd';
                break;
        }
    }

    return number + suffix;
}

function onEnter(element, callback) {
    element.addEventListener('keypress', e => {
        if (e.key === 'Enter') {
            callback(e);
        }
    })
}

function displayNumber(number) {
    let suffix = '';

    if (number > 1000000) {
        number = number / 1000000;
        suffix = 'm'
    } else if (number > 10000) {
        number = number / 1000;
        suffix = 'k';
    }

    if ((number % 1) > 0.1) number = number.toFixed(1);
    else (number = Math.round(number));
    return number.toLocaleString() + suffix;
}

function getGuid() {
    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_'.split('');
    let guid = '';
    for (var i = 0; i < 10; i++) {
        const index = Math.floor(Math.random() * chars.length);
        guid = guid + chars[index];
    }
    return guid;
}

function getRadioValue(name) {
    const radioButtons = Array.from(document.querySelectorAll(`[name="${name}"]`));
    let result = false;
    if (radioButtons) {
        radioButtons.forEach(rb => {
            if (rb.checked) result = rb.value;
        });
    }
    return result;
}

function setRadioValue(name, value) {
    let radioButton = document.querySelector(`[name="${name}"][value="${value}"]`);
    if (!radioButton) {
        radioButton = document.querySelector(`[name="${name}"]`);
    }
    if (radioButton) {
        radioButton.checked = true;
        triggerChange(radioButton);
    }
}

function arrayRemove(array, value) {
    const valIndex = array.indexOf(value);
    if (valIndex === -1) return false;
    array.splice(valIndex, 1);
}

function triggerChange(element) { element.dispatchEvent(new Event('change', { bubbles: true })) }
function triggerEvent(element, type) { element.dispatchEvent(new Event(type, { bubbles: true })) }

// NOTE - I know this looks stupid but Node has it and
// it's actually really useful for thread management.
function setImmediate(callback) { setTimeout(callback, 1); }

function isNormalClick(e) {
    if (e.ctrlKey || e.button !== 0) return false;

    return true;
}

function cancelJsEvent(e) {
    if (e.preventDefault) e.preventDefault();
    if (e.stopImmediatePropagation) e.stopImmediatePropagation();
    if (e.stopPropagation) e.stopPropagation();
    return true;
}

function txt(text) {
    return document.createTextNode(text);
}

function emptyElm(element) {
    while (element.firstChild) {
        element.removeChild(element.firstChild);
    }
}


function elm(tagName, classname, id, content) {
    let element = document.createElement(tagName || 'div');
    if (classname) element.className = classname;
    if (id) element.id = id;

    if (content) {
        if (!content.pop) content = [content];

        for (var contentElement of content) {
            if (typeof contentElement === 'string') {
                let tempDiv = document.createElement('div');
                tempDiv.innerHTML = contentElement;
                while (tempDiv.firstChild) {
                    element.appendChild(tempDiv.firstChild);
                }
            } else if (contentElement instanceof HTMLElement) {
                element.appendChild(contentElement);
            }
        }
    }

    return element;
}

// NOTE - Taken from https://www.gregoryvarghese.com/how-to-get-browser-name-and-version-via-javascript/
function getBrowserInfo() {
    var ua = navigator.userAgent, tem, M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return { name: 'IE ', version: (tem[1] || '') };
    }
    if (M[1] === 'Chrome') {
        tem = ua.match(/\bOPR\/(\d+)/)
        if (tem != null) { return { name: 'Opera', version: tem[1] }; }
    }
    M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
    if ((tem = ua.match(/version\/(\d+)/i)) != null) { M.splice(1, 1, tem[1]); }
    return {
        name: M[0],
        version: M[1]
    };
}

function datePickerSupported () {
	var input = document.createElement('input');
	var value = 'a';
	input.setAttribute('type', 'date');
	input.setAttribute('value', value);
	return (input.value !== value);
}

function smoothScrollTo(q) {
    window.scroll({ top: document.querySelector(q).offsetTop - document.querySelector('header').offsetHeight, left: 0, behavior: 'smooth' });
}

function isEmptyString(x) {
    if (safeTrim(x) == "") {
        return true;
    } else {
        return false;
    }
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateMobile(mobile) {
    // NOTE - This has been modified to validate
    // all phone numbers, mobile or not.
    mobile = mobile.replace(/[^\d\w]/g, "");
    return /^\d{10,11}$/.test(mobile);
}

function validateAbn (abn) {
    abn = abn.replace(/[^\d\w]/g, "");
    return /^\d{9,11}$/.test(abn);
}

function trimEmail  (email)     { return email.trim(); }
function trimMobile (mobile)    { return mobile.replace(/[^\d\w]/g, ""); }
function trimAbn    (abn)       { return abn.replace(/[^\d\w]/g, ""); }

function getAllLocationPaths() {
    return location.pathname.substr(1).split("/");
}

function getMobileOS() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;
    // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) return OS_WINDOWS_PHONE;
    if (/android/i.test(userAgent)) return OS_ANDROID;
    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) return OS_IOS;

    return false;
}

function safeTrim(x) {
    return x.replace(/^\s+|\s+$/gm, '');
}

/**
 * Debounce - A debounce function is a rate limiter. It allows you to call a 
 * function as many times as you want knowing that it will only fire once 
 * after a given delay. You use them when you’re waiting for some event that 
 * may happen repeatedly, but you only care about the final state.
 * @param {*} delay In Milliseconds
 * @param {*} fn The debounced function
 */
function debounce(delay, fn) {
    let later = null;
    return function (...args) {
        clearTimeout(later);
        later = setTimeout(() => fn(...args), delay);
    }
}

/**
 * Date Utilities.
 * Masking library - https://github.com/uNmAnNeR/imaskjs
 */
function parseDate(dateStr) {
    if (isEmptyString(dateStr)) {
        return false;
    }
    const dayMonthYear = dateStr.split('-');
    const parsedDate = new Date(dayMonthYear[2], dayMonthYear[1] - 1, dayMonthYear[0]);
    return !isNaN(parsedDate) &&
        // Also Check whether the parsed date has the same day, month, year as the input
        // or not. This check will fail for any invalid dates (including leap years).
        parsedDate.getDate() == dayMonthYear[0] &&
        parsedDate.getMonth() == dayMonthYear[1] - 1 &&
        parsedDate.getFullYear() == dayMonthYear[2] && parsedDate;
}

function parseTime(timeStr) {
    if (isEmptyString(timeStr)) {
        return false;
    }
    if (timeStr.length != 5) {
        return false;
    }
    const hourMin = timeStr.split(":");
    if (hourMin.length != 2) {
        return false;
    }
    if (isNaN(hourMin[0]) || isNaN(hourMin[1])) {
        return false;
    }
    if (!(parseInt(hourMin[0]) >= 0 && parseInt(hourMin[0]) <= 23)) {
        return false;
    }
    if (!(parseInt(hourMin[1]) >= 0 && parseInt(hourMin[1]) <= 59)) {
        return false;
    }
    return true;
}

function getValidTimeFromString(timeStr) {
    if (!parseTime(timeStr)) {
        return "";
    } else {
        return timeStr;
    }
}

function getDateFromString(dateStr, timeStr) {
    if (timeStr === undefined) {
        timeStr = "00:00";
    }
    const dayMonthYear = dateStr.split('-');
    const hourMin = timeStr.split(':');
    return new Date(dayMonthYear[2], dayMonthYear[1] - 1, dayMonthYear[0], hourMin[0], hourMin[1]);
}

function getFormattedDateYMD(dateObj) {
    // Month is 0 padded.
    var day = dateObj.getDate();
    var month = dateObj.getMonth() + 1;
    var year = dateObj.getFullYear();

    if (day < 10) day = "0" + day;
    if (month < 10) month = "0" + month;

    return [year, month, day].join('-');
}

function getFormattedDate(dateObj) {
    // Month is 0 padded.
    var day = dateObj.getDate();
    var month = dateObj.getMonth() + 1;
    var year = dateObj.getFullYear();

    if (day < 10) day = "0" + day;
    if (month < 10) month = "0" + month;

    return [day, month, year].join('-');
}

// Refer this link for documentation - https://unmanner.github.io/imaskjs/guide.html#date
// Checking if IMask exists to ensure that the library is loaded properly.
function setAndGetTimeMask(element, maxHour) {

    var momentFormat = 'hh:mm';
    var momentMask = new IMask(element, {
        mask: Date,
        pattern: momentFormat,
        lazy: false,
        format: function (date) {
            return moment(date).format(momentFormat);
        },
        parse: function (str) {
            return moment(str, momentFormat);
        },

        blocks: {
            hh: {
                mask: IMask.MaskedRange,
                from: 0,
                to: maxHour,
                placeholderChar: 'h'
            },
            mm: {
                mask: IMask.MaskedRange,
                from: 0,
                to: 59,
                placeholderChar: 'm'
            }
        }
    });
    return momentMask;
};
// Refer this link for documentation - https://unmanner.github.io/imaskjs/guide.html#date
// Checking if IMask exists to ensure that the library is loaded properly.
function setAndGetDobDateMask(element) {
    return (typeof IMask !== "undefined") && new IMask(element, {
        mask: Date,  // enable date mask

        // other options are optional
        pattern: 'd-`m-`Y',  // Pattern mask with defined blocks, default is 'd{.}`m{.}`Y'
        // you can provide your own blocks definitions, default blocks for date mask are:
        blocks: {
            d: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 31,
                maxLength: 2,
                placeholderChar: 'd',
            },
            m: {
                mask: IMask.MaskedRange,
                from: 1,
                to: 12,
                maxLength: 2,
                placeholderChar: 'm',
            },
            Y: {
                mask: IMask.MaskedRange,
                from: 1900,
                to: 9999,
                placeholderChar: 'y',
            }
        },
        // define date -> str convertion
        format: getFormattedDate,
        // define str -> date convertion
        parse: function (str) {
            var yearMonthDay = str.split('-');
            return new Date(yearMonthDay[2], yearMonthDay[1] - 1, yearMonthDay[0]);
        },

        // also Pattern options can be set
        lazy: false
    });
};

function setAndGetNumberMask(element) {

    return (typeof IMask !== "undefined") && new IMask(element, {
        mask: Number,  // enable number mask

        // other options are optional with defaults below
        scale: 0,  // digits after point, 0 for integers
        signed: false,  // disallow negative
        thousandsSeparator: '',  // any single char
        padFractionalZeros: false,  // if true, then pads zeros at end to the length of scale
        normalizeZeros: true,  // appends or removes zeros at ends
        //radix: ',',  // fractional delimiter
        //mapToRadix: ['.'],  // symbols to process as radix

        // additional number interval options (e.g.)
        min: 0,
        max: 1000000000
    });
};

function shrinkRemove(element) {
    element.classList.add('shrink-remove');
    element.style.height = element.offsetHeight + 'px';
    setImmediate(() => {
        element.style.height = '0';
        element.style.paddingTop = '0';
        element.style.paddingBottom = '0';
        element.style.marginTop = '0';
        element.style.marginBottom = '0';

        setTimeout(() => {
            element.remove();
        }, 300);
    })
}

function loadHTML(url, callback){
    var formData  = new FormData();
    formData.append("loader", 1);
    var opts = {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        redirect: "follow",
        referrer: "no-referrer",
        body: formData
    };
    fetch(url, opts)
    .then((response) => {
        if(response.status !== 200){
            throw new Error(response.status +" " + url);
        }
        return response.text()
    }).then(responseText => {
        callback(responseText);
    }).catch(error => {
        console.error(error);
    });
}

function loadJS(url, callback){
    // url = this.appendUniqueParam(url);
    if(document.head.querySelector('[src="' + url + '"]')){
        callback();
        return;
    }
    var scriptTag = document.createElement('script');
    scriptTag.src = url;
    scriptTag.onload = callback;
    scriptTag.onreadystatechange = callback;
    document.head.appendChild(scriptTag);   
}

function loadCSS(url, callback){
    // url = this.appendUniqueParam(url);
    if(document.head.querySelector('[href="' + url + '"]')){
        callback();
        return;
    }
    var scriptTag = document.createElement('link');
    scriptTag.rel  = 'stylesheet';
    scriptTag.type = 'text/css';
    scriptTag.href = url;
    scriptTag.media = 'all';
    scriptTag.onload = callback;
    document.head.appendChild(scriptTag);
}

function copyToClipboard(str) {
    const ta = elm('textarea');
    ta.value = str;
    document.body.appendChild(ta);
    ta.focus();
    ta.select();
    document.execCommand('copy');
    ta.remove();
}