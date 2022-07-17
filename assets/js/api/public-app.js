if(document.querySelector('.menu-handle')){
    document.querySelector('.menu-handle').addEventListener('click', (e) => {
    e.preventDefault();
    if(document.querySelector('header').classList.contains('active')){
        document.querySelector('header').classList.remove('active');
    } else {
        document.querySelector('header').classList.add('active');
    }
    });
}

function smoothScrollTo(q, o){
    if(o === undefined){
        o = 0;
    }
    window.scroll({top: document.querySelector(q).offsetTop - document.querySelector('header').offsetHeight - o, left: 0,  behavior: 'smooth' });
}

for(const a of document.querySelectorAll('.scrollto')){
    a.addEventListener('click', (e)=>{
        if(document.querySelector(a.getAttribute('data-scrollto'))){
            e.preventDefault();
            if(a.getAttribute('data-offset')){
                smoothScrollTo(a.getAttribute('data-scrollto'), parseInt(a.getAttribute('data-offset')));
            } else {
                smoothScrollTo(a.getAttribute('data-scrollto'));
            }
            document.querySelector('header').classList.remove('active');
            document.body.classList.remove('show-new-hirer-menu');
        }
    });
}
if(location.hash != ""){
    const h = location.hash.substr(1);
    if(document.querySelector(h)){
        smoothScrollTo(h);
    }
}
function storeStateSelected(state){
    setLocalStorage("selectedState", state);
}
function getStateSelected(){
    return getLocalStorage("selectedState");
}

function storeArtistAccount(artistAccount) {
    setLocalStorage("artistAccount", artistAccount);
}

function getArtistAccount(){
    return getLocalStorage("artistAccount");
}

function storeHirerAccount(hirerAccount) {
    setLocalStorage("hirerAccount", hirerAccount);
}

function getHirerAccount(){
    return getLocalStorage("hirerAccount");
}

function setLocalStorage(key, data) {
    localStorage.setItem(key, JSON.stringify(data));
}

function getLocalStorage(key) {
    let s = localStorage.getItem(key);
    if(s == null){
        return s;
    } else {
        return JSON.parse(s);
    }
}


for(let el of document.querySelectorAll('input, textarea')){
    el.addEventListener('keyup',function(e){
        if (el.value != "") {
            el.parentNode.classList.add('add-detail');
            el.parentNode.classList.remove('show-error');
        }
        else{
            el.parentNode.classList.remove('add-detail');
        }
    });
}
function isEmptyString(x){
    if(safeTrim(x) == ""){
        return true;
    } else {
        return false;
    }
}
function safeTrim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

// FIXME - This is a duplicate
// of a function in utils.js.
function validateMobile(mobile){
    // NOTE - This has been modified to validate
    // all phone numbers, mobile or not.    
    mobile = mobile.replace(/[^\d\w]/g, "");
    return /^\d{10,11}$/.test(mobile);
}


function getAllLocationPaths(){
    return location.pathname.substr(1).split("/");
}

function openInNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
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
function getFormattedDateYMD(dateObj){
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
function dataURItoBlob(dataURI) {
    // convert base64 to raw binary data held in a string
    // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
    var byteString = atob(dataURI.split(',')[1]);
  
    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]
  
    // write the bytes of the string to an ArrayBuffer
    var ab = new ArrayBuffer(byteString.length);
  
    // create a view into the buffer
    var ia = new Uint8Array(ab);
  
    // set the bytes of the buffer to the correct values
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
  
    // write the ArrayBuffer to a blob, and you're done
    var blob = new Blob([ab], {type: mimeString});
    return blob;
  
  }

function maxLengthWithoutSpaces(el,m) {    
    var max = m;
    el.setAttribute("maxlength", max);
    el.onkeypress = function () {
        if (this.value.length >= max) return false;
    };
    el.onpaste = function () {
        var oldValue = this.value;
        var element = this;
        setTimeout(() => {
            if (element.value.replace(/ /g,'').length >= max) {
                element.value = get400CharactersWithoutSpaces(element.value);
             }
        }, 4);
    };
}
function get400CharactersWithoutSpaces(str){

    var m = 0;
    var newstr = "";
    for (var i = 0; i < str.length && m < 400; i++) {
        const c = str.charAt(i);
        if(c != " "){ m++; }
        newstr += c;
    }
    return newstr;
}
var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
});
var utilInstance;
class WebUtil {
    constructor(){
        this.cacheAppendedUrls = {};
        if(utilInstance){
            return utilInstance;
        }
        utilInstance = this;
    }
    loadHTML(url, callback){
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
    loadJS(url, callback){
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
    loadCSS(url, callback){
        url = this.appendUniqueParam(url);
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
    appendUniqueParam(url){
        if(this.cacheAppendedUrls[url] !== undefined){
            return this.cacheAppendedUrls[url];
        }
        const oldUrl = url;
        const uniqueParam = (new Date()).getTime();
        if(url.indexOf("?") >= 0){
            url += "&" + uniqueParam;
        } else {
            url += "?" + uniqueParam;
        }
        this.cacheAppendedUrls[oldUrl] = url;
        return url;
    }
}
var Util = new WebUtil();

function emailAlert(msg) {
    emailInput = document.querySelector('.js-email-input');
    if (msg) document.getElementById('email-alert').innerHTML = msg;
    document.getElementById('email-alert').classList.add('email-alert--show');
    document.querySelector('.js-email-input').focus();
    emailInput.focus();
}

function emailChill() {
    document.getElementById('email-alert').classList.remove('email-alert--show');
    document.getElementById('email-input').classList.remove('email-input--alert');
}

function newHirerSignup(){
    let emailInputs = Array.from(document.querySelectorAll('.js-email-input'));
    let email;
    for (var i = 0; i < emailInputs.length; i++) {
        email = emailInputs[i].value.trim();
        if(email) break;
    }

    if (validateEmail(email)) {
        api_call("/users/emailcheck.json", {
            email: email
        }, function(statusCode, statusMessage, data){
            if(statusCode == 0){
                beginSignupFlow(email);
            } else {
                emailAlert(statusMessage);
            }
        });
    } else {
        emailAlert('Please enter your email address.');
    }
}

function beginSignupFlow (email) {
    analytics.track('Hirer Email', { email: email });
    new AppPopup(()=>{
        Util.loadHTML("/hirer-signup", (response) => {
            document.querySelector('.util-content').innerHTML = response;
            Util.loadJS("/assets/js/public/hirer-signup.js", (response) => {
                let hirerSignup = new HirerSignUp();
                hirerSignup.emailInput.value = email;
            });
        });
    });
}