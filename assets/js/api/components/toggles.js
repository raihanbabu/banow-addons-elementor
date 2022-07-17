function initToggles() {
    const toggleCheckBoxes = Array.from(document.querySelectorAll('input[type="checkbox"].toggle, input[type="radio"].toggle'));

    toggleCheckBoxes.forEach(checkBox => {
        if (checkBox.init) return;

        let id = checkBox.id;
        if (!id) {
            id = getGuid();
            checkBox.id = id;
        }
        const label = elm('label', 'toggle__label')
        label.setAttribute('for', id);
        label.innerHTML = checkBox.getAttribute('label') || '';
        checkBox.parentElement.insertBefore(label, checkBox.nextSibling);

        const toggleTrack = elm('div', 'toggle__track');
        const toggleSwitch = elm('div', 'toggle__switch');

        label.appendChild(toggleTrack);
        toggleTrack.appendChild(toggleSwitch);
        checkBox.init = true;

        checkBox.addEventListener('change', e => {
            let tabOnIds = checkBox.getAttribute('tab') || checkBox.getAttribute('tab-on');
            if (tabOnIds) {
                tabOnIds = tabOnIds.split(' ');
                const tabOnElements = Array.from(document.querySelectorAll('#' + tabOnIds.join(', #')));
                if (checkBox.checked) {
                    tabOnElements.forEach(elmt => unhide(elmt));
                } else {
                    tabOnElements.forEach(elmt => hide(elmt));
                }
            }
    
            let tabOffIds = checkBox.getAttribute('tab-off');
            if (tabOffIds) {
                tabOffIds = tabOffIds.split(' ');
                const tabOffElements = document.querySelectorAll('#' + tabOffIds.join(', #'));
                if (checkBox.checked) {
                    tabOffElements.forEach(elmt => hide(elmt));
                } else {
                    tabOffElements.forEach(elmt => unhide(elmt));
                }
            }
        });

        checkBox.dispatchEvent(new Event('change', { bubbles : true }));
    });
}

initToggles();

if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initToggles', initToggles);