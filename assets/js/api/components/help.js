function showHelp(title, body) {
    const container = elm('div', 'help__container');
    const modal = elm('div', 'help__modal');

    container.appendChild(modal);

    modal.appendChild(elm('h2', 'h2', null, title));

    if (!Array.isArray(body)) body = [body];

    body.forEach(bodyParagraph => {
        modal.appendChild(elm('p', null, null, bodyParagraph));
    });

    modal.appendChild(elm('div', 'help__dismiss', null, 'Click to dismiss'));

    container.addEventListener('click', e => {
        container.classList.remove('help__container--show');
        setTimeout(() => container.remove(), 300);
    })

    document.body.appendChild(container);
    setTimeout(() => container.classList.add('help__container--show'), 0);
}