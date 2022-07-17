
// For example
// api_call("/users/login.json", { }, function(statusCode,statusMessage,data){ console.log(data); } )
// cachePolicy 0,1
'use strict';
const NO_CACHED = 0;
const GET_CACHED = 1;
const GET_CACHED_TOBEFIXED = 1;
const GET_CACHED_ONLY = 2;

function api_call(url, requestData, callback, cachePolicy, progressCallback){
    if(cachePolicy === undefined){
        cachePolicy = NO_CACHED;
    }
    if(cachePolicy == GET_CACHED || cachePolicy == GET_CACHED_ONLY){
        let jsonString = localStorage.getItem(url + "?" + btoa(JSON.stringify(requestData)));
        if(jsonString != null){
            processResponseJSON(JSON.parse(jsonString), callback);
            callback = function(a,b,c){};
            if(cachePolicy == GET_CACHED_ONLY){
                return;
            }
        }
    }

    if(waitForFingerPrint){
        document.addEventListener('webserviceready', ()=> {
            api_call(url, requestData, callback, cachePolicy, progressCallback);
        }, false);
        return;
    }

    let callback2 = function(statusCode, statusMessage, data){
        if(data === undefined){
            data = {};
        }
        if(statusCode != 0){
            console.error(statusCode, statusMessage);
        }
        callback(statusCode, statusMessage, data);
    }
    if(requestData === undefined){
        requestData = {};
    }
    if(uniqueBrowserDeviceID == ""){
        callback2(7, "Not able to identify you. Please wait and try again in sometime.");
        return;
    }
    requestData["devicetype"] = "web";
    requestData["deviceid"] = uniqueBrowserDeviceID;
    requestData["appversion"] = "1.0";
    requestData["apiversion"] = "1.0";
    requestData["timezone"] = (new Date).getTimezoneOffset();
    if(url != "/users/hirer/profile/add.post.json"){
        let udid = getUserDeviceID();
        if(udid != ""){
            requestData["userdeviceid"] = udid;
        }
    }
    let guid = getGroupUserID();
    if(guid > 0){
        requestData["groupuserid"] = guid;
        requestData["groupagentid"] = 0;
        if(window.hasOwnProperty("App")){
            if(App.selectedProfile){
                if(App.selectedProfile.permission == "Agent"){
                    requestData["agentuser"] = "Y";
                    requestData["groupagentid"] = guid;
                }
            }
        }
    }
    let gid = getGroupID();
    if(gid > 0){
        requestData["groupid"] = gid;
    }
    var xhr = new XMLHttpRequest();   // new HttpRequest instance 
    let editedURL = API_HOST + url;
    if(editedURL.indexOf("?") >= 0){
        editedURL = editedURL.substr(0, editedURL.indexOf("?"));
    }
    xhr.open("POST", editedURL);
    xhr.setRequestHeader("Access-Control-Allow-Headers", "Origin,Content-Type,Accept");
    xhr.setRequestHeader('Cache-Control', 'no-cache');
    // xhr.setRequestHeader("date", header_date());
    // xhr.setRequestHeader("secretum", header_secretum());
    let body;
    if(url.indexOf(".post") > 0){
        var formData  = new FormData();
        for(var name in requestData) {
            if(requestData[name] instanceof Blob){
                formData.append(name, requestData[name], requestData[name].name);
            } else {
                if(Array.isArray(requestData[name])){
                    var objectCounter = 0;
                    for(const i in requestData[name]){
                        const requestDataNameValues = requestData[name][i];
                        if(typeof requestDataNameValues != typeof "abv" && Object.keys(requestDataNameValues).length > 0){
                            for(const objectKey in requestDataNameValues){
                                formData.append(name + "[" + objectCounter + "][" + objectKey + "]", requestDataNameValues[objectKey]);
                            }
                        } else {
                            formData.append(name + "[]", requestDataNameValues);
                        }
                        objectCounter++;
                    }
                } else {
                    formData.append(name, requestData[name]);
                }
            }
        }
        body = formData;
    } else {
        body = JSON.stringify(requestData);
    }

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if(xhr.status == 0){
                return;
            }
            try {
                let responseJSON = JSON.parse(xhr.response);
                if (responseJSON.log) responseJSON.log.forEach(msg => console.log(msg));
                processResponseJSON(responseJSON, callback2);
                if(cachePolicy == GET_CACHED){
                    localStorage.setItem(url + "?" + btoa(requestData), JSON.stringify(responseJSON));
                }
            } catch(error) {
                console.error(error);
                if(xhr.status != 0){
                    callback2(5, "Could not connect to internet", error);
                }
            }
        }
    }
    xhr.onabort = function() {
       
    }
    if(progressCallback !== undefined){
        xhr.upload.addEventListener("progress", function(evt){
            if (evt.lengthComputable) {  
                progressCallback(Math.round(evt.loaded / evt.total * 100));
            }
        }, false); 
    }
    xhr.send(body);
    return xhr;
}
function api_abort(ref){
    if(ref !== undefined){
        if(ref != null){
            ref.abort();
        }
    }
}

function processResponseJSON(responseJSON, callback){
    var c = 6;
    var m = "Could not connect to internet";
    var d = {};
    if(responseJSON["statuscode"] !== undefined){
        c = parseInt(responseJSON["statuscode"]);
    }
    if(responseJSON["statusmessage"] !== undefined){
        m = responseJSON["statusmessage"];
    }
    if(responseJSON["data"] !== undefined){
        d = responseJSON["data"];
    }
    callback(c,m,d);
}
function header_date(){
    return (new Date()).toUTCString();
}
function header_secretum(){
    let str = header_date() + "|web|web";
    var hash = CryptoJS.HmacSHA256(str, "smartapi");
    var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
    return hashInBase64;
}
function getUserDeviceID(){
    if(localStorage.getItem("loggedinuser")){
        let udid = JSON.parse(localStorage.getItem("loggedinuser")).userdeviceid;
        if(isNaN(udid)){
            clearUserDeviceID();
            return "";
        }
        return udid;
    }
    return "";
}
function getGroupUserID(){
    if(localStorage.getItem("loggedinuser")){
        const j = JSON.parse(localStorage.getItem("loggedinuser"));
        if(j.groupuserid !== undefined){
           let udid = j.groupuserid;
            if(isNaN(udid)){
                
                return 0;
            }
            return parseInt(udid);
        }
    }
    return 0;
}
function getGroupID(){
    if(localStorage.getItem("loggedinuser")){
        const j = JSON.parse(localStorage.getItem("loggedinuser"));
        if(j.groupid !== undefined){
           let udid = j.groupid;
            if(isNaN(udid)){
                
                return 0;
            }
            return parseInt(udid);
        }
    }
    return 0;
}
function storeUserDeviceID(userdeviceid){
    localStorage.setItem("userdeviceid", userdeviceid);
}
function clearUserDeviceID(){
    localStorage.removeItem("loggedinuser");
}

function getFingerprintID(){
    if(localStorage.getItem("FingerprintID")){
        let udid = localStorage.getItem("FingerprintID");
        if(udid == ""){
            clearFingerprintID();
            return "";
        }
        return udid;
    }
    return "";
}
function storeFingerprintID(fingerprintID){
    localStorage.setItem("FingerprintID", fingerprintID);
}
function clearFingerprintID(){
    localStorage.removeItem("FingerprintID");
}

function checkIfUserIsAlreadyLoggedIn(){
    let udid = getUserDeviceID();
    if(udid != ""){
        return true;
    }
    return false;
}
/* To generate unique browser id */
var webserviceready = new Event('webserviceready');
var waitForFingerPrint = true;
document.addEventListener('webserviceready', function(){ }, false);
let uniqueBrowserDeviceID = "";
var hasConsole = typeof console !== "undefined";

var fingerprintReport = function () {

    const f = getFingerprintID();
    if(f != ""){
        uniqueBrowserDeviceID = f;
        waitForFingerPrint = false;
        document.dispatchEvent(webserviceready);
    } else {
        var d1 = new Date()
        Fingerprint2.get(function(components) {
            var murmur = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 31)
            var d2 = new Date()
            var time = d2 - d1
            uniqueBrowserDeviceID = murmur;
            storeFingerprintID(uniqueBrowserDeviceID);
            waitForFingerPrint = false;
            document.dispatchEvent(webserviceready);
        });
    }
}
if (window.requestIdleCallback) {
    setTimeout(() => {
        requestIdleCallback(fingerprintReport)
    }, 1);
} else {
    setTimeout(fingerprintReport, 500)
}
/* END - To generate unique browser id */
//Poly Fill for Edge 42 EdgeHTML 17
NodeList.prototype[Symbol.iterator] = Array.prototype[Symbol.iterator];
HTMLCollection.prototype[Symbol.iterator] = Array.prototype[Symbol.iterator];