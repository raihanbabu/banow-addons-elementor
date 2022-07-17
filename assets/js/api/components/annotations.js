function initAnnotations () {
    const annotations = Array.from(document.querySelectorAll('.ano:not([init])'));

    annotations.forEach(ano => {
        let iconClass = "ano__icon fas fa-sticky-note";

        if (ano.hasAttribute('label')) {
            ano.insertBefore(
                elm('div', 'ano__title', null, ano.getAttribute('label')),
                ano.firstChild
            )
        }

        if (ano.classList.contains('ano--info'))         iconClass = 'ano__icon fas fa-info-circle';
        else if (ano.classList.contains('ano--warning')) iconClass = 'ano__icon fas fa-exclamation-triangle';
        else if (ano.classList.contains('ano--success')) iconClass = 'ano__icon fas fa-check';
        else if (ano.classList.contains('ano--error'))   iconClass = 'ano__icon fas fa-times-circle';
        else if (ano.classList.contains('ano--tip'))     iconClass = 'ano__icon fas fa-lightbulb';

        ano.insertBefore(elm('i', iconClass), ano.firstChild);

        const closeButton = elm('i', 'ano__close fas fa-times');
        closeButton.title = "Dismiss";
        closeButton.addEventListener('click', e => {
            shrinkRemove(ano);
        })
        ano.insertBefore(closeButton, ano.firstChild);

        ano.setAttribute('init', '');
    })
}

if (typeof Router !== 'undefined') Router.registerDomChangeCallback('initAnnotations', initAnnotations);
initAnnotations();