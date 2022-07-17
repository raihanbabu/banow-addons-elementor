'use strict';
const tempDIV = document.createElement('div');
tempDIV.innerHTML = '<div class="popupalerts"><div class="popupcontent"><div class="close"><a href="" class="cross-btn"></a></div><div class="content"></div><div class="button"><a href="" class="negative btn">Cancel</a><a href="" class="positive btn">Okay</a></div></div></div>';
document.body.appendChild(tempDIV.firstChild);
let popupCallBack = function(result){};
let popupAllowEscape = false;
const POPUP_RESULT_GOOD = 1;
const POPUP_RESULT_BAD = 0;
function showPopup(message, positiveText, negativeText, callback, showCloseButton){
    if(message != ""){
        document.querySelector('.popupcontent .content').innerHTML = message;
        popupAllowEscape = false;
        if(showCloseButton === undefined){
            showCloseButton = true;
        }
        if(positiveText === undefined){
            positiveText = "Okay";
        }
        if(negativeText === undefined){
            negativeText = "";
        }
        if(callback === undefined){
            popupCallBack = function(result){  };
        } else {
            popupCallBack = callback;
        }
        
        if(showCloseButton){
            document.querySelector('.popupcontent .close').classList.remove('hidden');
            popupAllowEscape = true;
        } else {
            document.querySelector('.popupcontent .close').classList.add('hidden');
        }
        if(positiveText != ""){
            document.querySelector('.popupcontent .button .positive').classList.remove('hidden');
            document.querySelector('.popupcontent .button .positive').innerHTML = positiveText;
        } else {
            document.querySelector('.popupcontent .button .positive').classList.add('hidden');
        }
        if(negativeText != ""){
            document.querySelector('.popupcontent .button .negative').classList.remove('hidden');
            document.querySelector('.popupcontent .button .negative').innerHTML = negativeText;
        } else {
            document.querySelector('.popupcontent .button .negative').classList.add('hidden');
        }
        document.querySelector('.popupalerts').classList.add('show');
    }
}
function closePopup(){
    document.querySelector('.popupalerts').classList.remove('show');
}
document.querySelector('.popupcontent .button .positive').addEventListener('click', function(e){
    e.preventDefault();
    closePopup();
    popupCallBack(POPUP_RESULT_GOOD, false);
});
document.querySelector('.popupcontent .button .negative').addEventListener('click', function(e){
    e.preventDefault();
    closePopup();
    popupCallBack(POPUP_RESULT_BAD, false);
});
document.querySelector('.popupcontent .close a').addEventListener('click', function(e){
    e.preventDefault();
    closePopup();
    popupCallBack(POPUP_RESULT_BAD, true);
});
document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        if(document.querySelector('.popupalerts').classList.contains('show') && popupAllowEscape){
            popupCallBack(0);
            closePopup();
        }
    }
};