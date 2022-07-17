function initMultis () {
    const multiRadioButtons = Array.from(document.querySelectorAll('input[type="radio"].multi:not([init])'));

    multiRadioButtons.forEach(radioButton => {
        if (radioButton.hasAttribute('init')) return;
        
        const name = radioButton.getAttribute('name');
        const siblings = [];
        let sibling = radioButton;
        sibling.checked = true;

        // Get the siblings
        do {
            if (sibling.tagName
                && sibling.tagName.toLowerCase() === 'input'
                && sibling.getAttribute('type') === 'radio'
                && sibling.getAttribute('name') === name
            ){
                siblings.push(sibling)
            }
            sibling = sibling.nextSibling;
        } while(sibling)

        // Build the pieces
        const multiTrack = elm('div', 'multi__track');
        const multiSlider = elm('div', 'multi__slider');
        const multiOptionsContainer = elm('div', 'multi__options-container');
        const sectionWidth = 100 / siblings.length;

        multiTrack.appendChild(multiSlider);
        multiTrack.appendChild(multiOptionsContainer);

        multiSlider.style.width = sectionWidth + '%';
        
        radioButton.parentNode.insertBefore(multiTrack, radioButton);

        // Assemble the options
        siblings.forEach(radBtn => {
            let id = radBtn.id;
            if (!id) {
                id = getGuid();
                radBtn.id = id;
            }

            const labelContent = [];
            if (radBtn.hasAttribute('label')) {
                labelContent.push(radBtn.getAttribute('label'));
            }
            if (radBtn.hasAttribute('icon')) {
                labelContent.push(elm('i', radBtn.getAttribute('icon')));
            }
            const optionLabel = elm('label', 'multi__option', null, labelContent);
            if (radBtn.checked) optionLabel.classList.add('multi__option--active');
            radBtn.optionLabel = optionLabel;
            optionLabel.setAttribute('for', id);
            multiOptionsContainer.appendChild(radBtn);
            multiOptionsContainer.appendChild(optionLabel);

            // Event listener
            radBtn.addEventListener('change', e => {
                if (!radBtn.checked) return;
                
                multiSlider.style.left = (siblings.indexOf(radBtn) * sectionWidth) + '%';

                // Do tab stuff
                siblings.forEach(rBtn => { // Running out of names here :(
                    const tabId = rBtn.getAttribute('tab');
                    if (!tabId) return;
                    const tabBody = document.getElementById(tabId);
                    if (!tabBody) return;                    
                    if (rBtn === radBtn) {
                        tabBody.classList.remove('hide');
                    } else {
                        tabBody.classList.add('hide');
                    }

                    if (e.target !== rBtn) rBtn.dispatchEvent(new Event('change', { bubbles: true }));
                });
            });

            radBtn.setAttribute('init', '');
        });



        radioButton.dispatchEvent(new Event('change', {bubbles : true}));
        radioButton.setAttribute('init', '');
    });
}

initMultis();

if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initMultis', initMultis);