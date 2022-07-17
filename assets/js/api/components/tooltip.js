
function removeTip(){
    for(var el of document.querySelectorAll(".tooltip")){
        el.remove();
    }
}
function createTip(ev){  
    for(var el of document.querySelectorAll(".tooltip")){
        el.remove();
    }
    var title = this.getAttribute('tooltip-title');
    this.title = '';
    this.setAttribute("tooltip", title);  

    var tooltipWrap = document.createElement("div"); //creates div
    tooltipWrap.className = 'tooltip'; //adds class
    tooltipWrap.appendChild(document.createTextNode(title)); //add the text node to the newly created div.

    var firstChild = document.body.firstChild;//gets the first elem after body
    firstChild.parentNode.insertBefore(tooltipWrap, firstChild); //adds tt before elem
 
    var targetElProps = this.getBoundingClientRect();
    var tooltipProps = tooltipWrap.getBoundingClientRect();
    var topPos = targetElProps.top;
    var leftPos = targetElProps.left;
    var padding = 10;
    var bgcolor = '#7447f9';
    tooltipWrap.setAttribute('style','top:'+topPos+'px;'+'left:'+leftPos+'px;');
    if(this.hasAttribute('tooltip-position') === true)
    {  
        if(this.hasAttribute('tooltip-color') === true)
        {   
            var bgcolor =  this.getAttribute('tooltip-color');
        }
        switch (this.getAttribute('tooltip-position').toUpperCase()) {
            case 'L': 
                leftPos = leftPos - (tooltipProps.width + padding);
                topPos = topPos  + Math.abs(targetElProps.height / 2) - Math.abs(tooltipProps.height / 2);
                break;
            
            case 'T':
                topPos = topPos - (tooltipProps.height + padding);
                leftPos = leftPos  + Math.abs(targetElProps.width / 2) - Math.abs(tooltipProps.width / 2);
                break;
            case 'TL':
                topPos = topPos - (tooltipProps.height + padding);
                leftPos = leftPos - (tooltipProps.width) + Math.abs(targetElProps.width);
                break;
            case 'TR':
                topPos = topPos - (tooltipProps.height + padding);
                leftPos = leftPos + (targetElProps.width) - Math.abs(targetElProps.width);
                break;

            case 'B':
                topPos = topPos + (targetElProps.height + padding);
                leftPos = leftPos  + Math.abs(targetElProps.width / 2) - Math.abs(tooltipProps.width / 2);
                break;

            case 'BR':
                topPos = topPos + (targetElProps.height + padding);
                leftPos = leftPos + (targetElProps.width) - Math.abs(targetElProps.width);
                break;
            
            case 'BL':
                topPos = topPos + (targetElProps.height + padding);
                leftPos = leftPos - (tooltipProps.width) + Math.abs(targetElProps.width);
                break;
        
            case 'R':
                leftPos = leftPos + (targetElProps.width + padding);
                topPos = topPos  + Math.abs(targetElProps.height / 2) - Math.abs(tooltipProps.height / 2);
                break; 
            default:
                topPos = topPos - (tooltipProps.height + padding);
                leftPos = leftPos  + Math.abs(targetElProps.width / 2) - Math.abs(tooltipProps.width / 2);
                break;
        }  
    }
    else{
        topPos = topPos - (tooltipProps.height + padding); 
    } 
    tooltipWrap.setAttribute('style','top:'+topPos+'px;'+'left:'+leftPos+'px;'); 
    //tooltipWrap.style.background = bgcolor;  

}
function cancelTip(ev){ 
    this.removeAttribute("tooltip"); 
    for(var el of document.querySelectorAll(".tooltip")){
        el.remove();
    }
} 

function buildToolTip(el,options){
    if(el !== undefined && el !== null){ 
        if(options !== undefined && options !== null)
        { 
            for (var i in options) { 
                if(i=="text")
                {
                    el.setAttribute('tooltip-title',options[i]);
                }
                if(i=="position")
                {
                    el.setAttribute('tooltip-position',options[i]);
                }
                if(i=="color")
                {
                    el.setAttribute('tooltip-color',options[i]);
                }
            } 
        el.addEventListener('mouseover',createTip);
        el.addEventListener('mouseout',removeTip);
        } 
    } 
} 