function initAccordions () {
    const accordions = Array.from(document.querySelectorAll('.accordion'));
    const showClass = 'accordion--show';

    accordions.forEach(accordion => {
        if (accordion.init) return;

        const header    = elm('div', 'accordion__header');
        const body      = elm('div', 'accordion__body');
        const chevron   = elm('div', 'accordion__chevron', null, '<i class="fa fa-chevron-down"></i>');

        header.appendChild(txt(accordion.getAttribute('label')));
        header.appendChild(chevron);
        Array.from(accordion.childNodes).forEach(child => body.appendChild(child));

        accordion.appendChild(header);
        accordion.appendChild(body);

        header.addEventListener('click', e => {
            const openAccordion = document.querySelector('.' + showClass);
            if (openAccordion && openAccordion !== accordion) openAccordion.close();
            
            if (accordion.classList.contains(showClass)) {
                accordion.close();
            } else {
                accordion.open();
            }
        });

        accordion.open  = () => {
            accordion.classList.add(showClass);
            if (accordion.dataset.maxHeight) {
                body.style.maxHeight = accordion.dataset.maxHeight;
            }
        };

        accordion.close = () => {
            accordion.classList.remove(showClass);
            body.style.maxHeight = '';
        }

        if (accordion.hasAttribute('open')) accordion.open();

        accordion.init = true;
    });
}

if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initAccordions', initAccordions);

initAccordions();