function initChiplists () {
    const chiplists = Array.from(document.querySelectorAll('.chiplist'));
    chiplists.forEach(initChiplist);
}

function initChiplist (chiplist) {
    if (chiplist.init) return;

    const labelText = chiplist.getAttribute('label');

    const container = elm('div', 'chiplist__container');
    const bench = elm('div', 'chiplist__bench');
    const list = elm('div', 'chiplist__list');
    const label = elm('div', 'input__label', null, labelText);
    const error = elm('div', 'input__error-message');

    let refinementString = 'asdf';

    if (chiplist.hasAttribute('required')) label.appendChild(elm('i', 'fas fa-asterisk input__required'));
    chiplist.setAttribute('type', 'chiplist');

    chiplist.appendChild(label);
    chiplist.setAttribute('tabindex', 0);
    chiplist.appendChild(bench);
    chiplist.appendChild(elm('hr'));
    chiplist.appendChild(list);

    if (chiplist.parentElement) chiplist.parentElement.insertBefore(container, chiplist);
    container.appendChild(chiplist);
    container.appendChild(error);

    // NOTE - Potential values are added and stored whether or not they
    // have a corresponding chip. This means you can set the values and
    // then set the chips after (e.g., if the chip data comes back on
    // an AJAX call).
    let potentialValues = [];
    let checkboxes;
    
    function buildChips() {
        // Build up the chips
        checkboxes = Array.from(chiplist.querySelectorAll('input[type="checkbox"]'))
        checkboxes.forEach(checkbox => {
            let id = checkbox.id;
    
            if (!id) {
                id = getGuid();
                checkbox.id = id;
            }
    
            const chipLabel = elm('label', 'chiplist__chip', null, checkbox.getAttribute('label'));
            chipLabel.setAttribute('for', id);
    
            list.appendChild(checkbox);
            list.appendChild(chipLabel);
    
            // Repopulate the bench on change
            checkbox.addEventListener('change', e => {
                emptyElm(bench);
    
                if (checkbox.checked) {
                    potentialValues.push(checkbox.value);
                } else if (potentialValues.indexOf(checkbox.value) !== -1) {
                    arrayRemove(potentialValues, checkbox.value);
                }
    
                // Add bench chips from ticked checkboxes
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const chip = elm('div',
                            'chiplist__chip chiplist__chip--checked',
                            null,
                            checkbox.getAttribute('label')
                        )
                        const removeButton = elm('i', 'chiplist__chip-remove fa fa-times-circle');
                        chip.appendChild(removeButton);
    
                        // Close event on the benched chip X button
                        removeButton.addEventListener('click', e => {
                            checkbox.checked = false;
                            checkbox.dispatchEvent(new Event('change', { bubbles : true }));
                        });
    
                        bench.appendChild(chip);
                    }
                });
    
                // NOTE - This is unfortunate but it prevents css duplication. There's probably a better way.
                container.classList.remove('chiplist__error');
                container.classList.remove('input__error');
    
                const values = chiplist.getValues();
    
                if (values.length) {
                    label.classList.add('input__label--raised');
                } else {
                    label.classList.remove('input__label--raised');
                }
            });

            if (potentialValues.indexOf(checkbox.value) !== -1) {
                checkbox.checked = true;
                triggerChange(checkbox);
            }
        });
    }

    buildChips();

    let maxValues = Infinity;

    chiplist.setMaxValues = (n) => {
        if (maxValues === n) return; // This might seem pointless but it can prevent certain recursion problems.
        maxValues = n;
        triggerChange(chiplist);
    };

    if (chiplist.hasAttribute('max-values')) {
        chiplist.setMaxValues(parseInt(chiplist.getAttribute('max-values')));
    }

    chiplist.addEventListener('change', e => {
        const values = chiplist.getValues();
        checkboxes.forEach(checkbox => {
            if (values.length >= maxValues) {
                checkbox.disabled = !checkbox.checked;
            } else {
                checkbox.disabled = false;
            }
        });
    })

    chiplist.addEventListener('focus', e => {
        refinementString = '';
        chiplist.refine(refinementString);
        if (chiplist.dataset.maxHeight) {
            list.style.maxHeight = chiplist.dataset.maxHeight;
        }
    });

    chiplist.addEventListener('keydown', e => {
        if (e.key.length === 1) {
            refinementString = refinementString + e.key;
        } else {
            switch (e.key) {
                case 'Backspace':
                    if (refinementString.length) {
                        refinementString = refinementString.slice(0, -1);
                    }
                    break;
                case 'Escape':
                    refinementString = '';
                    break;
            }
        }
        chiplist.refine(refinementString);
    })

    chiplist.addEventListener('blur', e => {
        list.style.maxHeight = '';
    });

    // Function to get array of checked values
    chiplist.getValues = () => {
        const values = [];
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) values.push(checkbox.value);
        })
        return values;
    };
    
    chiplist.setValues = (values) => {
        if (!Array.isArray(values)) values = [values];
        potentialValues = values;
        checkboxes.forEach(checkbox => {
            checkbox.checked = (values.indexOf(checkbox.value) !== -1);
            checkbox.dispatchEvent(new Event('change', { bubbles : true }));
        })
    };

    chiplist.refine = (searchString) => {
        Array.from(chiplist.querySelectorAll('label')).forEach(chipLabel => {
            const label = chipLabel.innerText;
            if (label.toLowerCase().indexOf(searchString.toLowerCase()) === -1) {
                hide(chipLabel);
            } else {
                unhide(chipLabel);
            }
        })
    }

    chiplist.setChips = (data) => {
        if (!Array.isArray(data)) {
            const newData = [];
            for (var val in data) {
                newData.push({
                    value : val,
                    label : data[val]
                })
            }
            data = newData;
        }

        emptyElm(list);
        data.forEach(datum => {
            const chip = elm('input');
            chip.setAttribute('type', 'checkbox');
            chip.setAttribute('value', datum.value);
            chip.setAttribute('label', datum.label);
    
            list.appendChild(chip);
        });
        buildChips();
    }

    chiplist.showError = errorMessage => {
        // NOTE - This is a bit ugly since we're borrowing elements from input.
        container.classList.add('chiplist__error');
        container.classList.add('input__error');
        error.innerHTML = errorMessage;
    }

    chiplist.init = true;

    return container;
}

/**
 * 
 */
function buildChiplist (id, label, data, attrs) {
    const chiplist = elm('div', 'chiplist', id);
    chiplist.setAttribute('label', label);

    for (var i in attrs) {
        chiplist.setAttribute(i, attrs[i]);
    }

    const chiplistContainer = initChiplist(chiplist);
    chiplist.setChips(data);
    return chiplistContainer;
}

initChiplists();

if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initChiplists', initChiplists);