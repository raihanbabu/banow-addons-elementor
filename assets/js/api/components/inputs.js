function initInputs () {
    const inputs = Array.from(document.querySelectorAll([
        'input.input:not([init])',
        'textarea.input:not([init])',
        'select.input:not([init])',
        '.pin-form-host:not([init])'
    ].join(',')));

    const raisedPlaceholderTypes = [
        'date',
        'time'
    ];

    const nontransferrableClassnames = [
        'input',
        'pin-form-host',
        'pin-form-field',
    ]

    inputs.forEach(input => {

        const isPinPaymentField = input.classList.contains('pin-form-host');
        const placeholderText = input.getAttribute('placeholder') || input.getAttribute('label');
        

        if (input.hasAttribute('readonly')) {
            input.setAttribute('tabindex', -1);
            input.onfocus = () => input.blur();
        }

        const container = elm('div', 'input__container');
        const label = elm('div', 'input__label', null, placeholderText);
        if (input.hasAttribute('required')) label.appendChild(elm('i', 'fas fa-asterisk input__required'));
        const error = elm('div', 'input__error-message');

        const type = input.getAttribute('type');
        if (!type) input.setAttribute('type', 'text');

        let placeholder = '\xa0';
        switch(type) {
            case 'date': placeholder = 'mm/dd/yyyy'; break;
            case 'time': placeholder = 'hh:mm pm'; break;
        }

        input.setAttribute('placeholder', placeholder);

        // Move all classes from the input to the container (to allow the use of helpers)
        Array.from(input.classList).forEach(classname => {
            if (nontransferrableClassnames.indexOf(classname) === -1) container.classList.add(classname);
        })

        if (isPinPaymentField || raisedPlaceholderTypes.indexOf(type) !== -1) label.classList.add('input__label--raised');

        input.parentElement.insertBefore(container, input);
        container.appendChild(input);
        container.appendChild(label);
        container.appendChild(error);

        input.addEventListener('change', e => {
            input.setAttribute('has-value', input.value.length ? 'true' : 'false');
            container.setAttribute('has-value', input.value.length ? 'true' : 'false');
            container.classList.remove('input__error');

            if (input.classList.contains('input--currency')) {
                input.value = parseFloat(input.value).toFixed(2);
            }

            //= Safari compatibility ===========================================
            if ((input.getAttribute('type') === 'date') && !datePickerSupported()) {
                momentVal = moment(input.value);
                if (momentVal.isValid()) {
                    input.value = momentVal.format('YYYY-MM-DD');
                } else if (input.value) {
                    input.value = '';
                    input.showError('Please enter date using the format mm/dd/yyyy.');
                }

                if (input.hasAttribute('min')) {
                    const minDate = moment(input.getAttribute('min'));
                    if (momentVal.isBefore(minDate) && momentVal.isAfter(moment('1/1/999'))) {
                        input.showError('Please enter a date after ' + input.getAttribute('min') + '.');
                        input.value = '';
                    }
                }

                if (input.hasAttribute('max')) {
                    const maxDate = moment(input.getAttribute('max'));
                    if (momentVal.isAfter(maxDate) && momentVal.isBefore(moment('1/1/9999'))) {
                        input.showError('Please enter a date before ' + input.getAttribute('max') + '.');
                        input.value = '';
                    }
                }
            }

            if (input.getAttribute('type') === 'time') {
                momentVal = moment('1/1/0 ' + input.value);
                if (momentVal.isValid()) {
                    input.value = momentVal.format('HH:mm');
                } else if (input.value) {
                    input.value = '';
                    input.showError('Please enter time using the format hh:mm am/pm.');
                }
            }
        });
        
        input.showError = errorMessage => {
            container.classList.add('input__error');
            error.innerHTML = errorMessage;
        }

        input.removeError = () => {
            error.innerHTML = '';
            container.classList.remove('input__error');
        }
        
        if (input.tagName === 'SELECT' && input.hasAttribute('label')) {
            const blankOption = new Option('', '', true);
            blankOption.setAttribute('disabled', 'true');
            input.add(blankOption, input.firstChild);
            input.value = '';

            input.addEventListener('change', e => {
                blankOption.remove();
            });
        }

        input.setAttribute('init', '');
        
        if (input.value) triggerChange(input);
    });
}
initInputs();
if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initInputs', initInputs);


function initErrorDisplays () {
    const errDisplays = Array.from(document.querySelectorAll('.error-display'));

    errDisplays.forEach(errDis => {
        if (errDis.init) return;

        const errorMessage = errDis.innerHTML;
        emptyElm(errDis);
        const error = elm('div', 'input__error-message', null, errorMessage);
        errDis.appendChild(error);

        errDis.showError = err => {
            if (err) error.innerHTML = err;
            errDis.classList.add('input__error');
        };

        errDis.hide = () => {
            errDis.classList.remove('input__error');
        }

        errDis.init = true;
    });
}
initErrorDisplays();
if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initErrorDisplays', initErrorDisplays);