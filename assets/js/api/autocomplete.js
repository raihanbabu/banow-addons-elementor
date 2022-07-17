class JBAutoComplete {
    constructor(inputElement, apiURL, requestObject, requestObjectKey, responseKey, updateSuggestions, setSelection, updateSelection){
        this.inputElement = inputElement;
        this.apiURL = apiURL;
        this.requestObject = requestObject;
        this.updateSuggestions = updateSuggestions;
        this.setSelection = setSelection;
        this.updateSelection = updateSelection;
        this.suggestions = [];
        this.selectedIndex = 0;
        this.currentSearchKeyword = "";
        this.resultCache = {};
        this.apiCaller;
        this.requestObjectKey = requestObjectKey;
        this.responseKey = responseKey;
        this.removeAllSuggestions();
        this.attachInputEvents();
    }
    removeAllSuggestions() {
        this.suggestions = [];
        this.updateSuggestions(this.suggestions, this.attachSuggestionEvent.bind(this));
    }
    setValue(){
        this.setSelection(this.selectedIndex, this.suggestions[this.selectedIndex]);
    }
    attachInputEvents(){
        this.inputElement.addEventListener('focus', this.onFocus.bind(this));
        this.inputElement.addEventListener('blur', this.onBlur.bind(this));
        this.inputElement.addEventListener('keydown', this.onKeydown.bind(this));
        this.inputElement.addEventListener('keyup', this.onKeyup.bind(this));
    }
    attachSuggestionEvent(allSuggestionElements){
        var suggestionIndex = 0;
        for(let sugElement of allSuggestionElements){
            sugElement.setAttribute("data-index", suggestionIndex);
            sugElement.addEventListener('mouseover', this.suggestionMouseover.bind(this));
            sugElement.addEventListener('mousedown', this.suggestionMousedown.bind(this));
            suggestionIndex++;
        }
    }
    suggestionMousedown(e){
        e.preventDefault();
        this.selectedIndex = parseInt(e.target.getAttribute("data-index"));
        this.setValue();
    }
    suggestionMouseover(e){
        this.selectedIndex = parseInt(e.target.getAttribute("data-index"));
        this.updateSelection(this.selectedIndex);
    }
    onFocus(e){
        this.removeAllSuggestions();
    }
    onBlur(e){
        if(this.suggestions.length > 0){
            if (!this.ignoreBlur) this.setValue();
            this.removeAllSuggestions();
        }
    }
    onKeydown(e){
        var key = window.event ? e.keyCode : e.which;
        if(key == 13) { //enter
            e.preventDefault();
            this.setValue();
            this.removeAllSuggestions();
        }
        else if(key == 9) { //tab
            this.setValue();
            this.removeAllSuggestions();
        }
        else if(key == 38) { //up arrow
            this.selectedIndex -= 1;
            if(this.selectedIndex < 0){
                this.selectedIndex = 0;
            }
            this.updateSelection(this.selectedIndex);
        }
        else if(key == 40) { //down arrow
            this.selectedIndex += 1;
            if(this.selectedIndex >= this.suggestions.length){
                this.selectedIndex = this.suggestions.length - 1;
            }
            this.updateSelection(this.selectedIndex);
        }
        else if(key == 27) { //escape
            this.removeAllSuggestions();
        }
    }
    onKeyup(e){
        if(this.currentSearchKeyword != this.cleanString(this.inputElement.value)){
            this.currentSearchKeyword = this.cleanString(this.inputElement.value);
            this.fetchResults();
        }
    }
    fetchResults(){
        this.removeAllSuggestions();
        if(this.currentSearchKeyword == ""){ this.removeAllSuggestions(); return; }
        if(this.resultCache[this.currentSearchKeyword] !== undefined){
            this.renderResult(this.resultCache[this.currentSearchKeyword]);
        } else {
            if(this.apiCaller){
                api_abort(this.apiCaller);
            }
            this.requestObject[this.requestObjectKey] = this.inputElement.value.trim().toLowerCase();
            this.apiCaller = api_call(this.apiURL, this.requestObject, this.parseResult.bind(this))
        }
    }
    parseResult(statusCode, statusMessage, data) {
        if(statusCode == 0){ 
            this.resultCache[this.currentSearchKeyword] = data;
            this.renderResult(data);
        }
    }
    renderResult(data){
        if(data[this.responseKey]){
            this.suggestions = data[this.responseKey];
            this.selectedIndex = 0;
            this.updateSuggestions(this.suggestions, this.attachSuggestionEvent.bind(this));
            this.updateSelection(this.selectedIndex);
        }
    }
    cleanString(s){
        if(s.indexOf(",") >= 0){
            s = s.substring(0, s.indexOf(","));
        }
        return s.trim().toLowerCase().replace(/[^0-9a-z ]/gi, '');
    }
}
