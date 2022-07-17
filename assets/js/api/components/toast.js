function showToast (message, duration) {
    duration = duration ? duration : 2;
    let toastElm = elm('div', 'toast', null, elm('div', 'toast__content', null, message));

    document.body.appendChild(toastElm);

    setTimeout(() => {
        toastElm.classList.add('toast--show');
        setTimeout(() => {
            toastElm.classList.remove('toast--show');
            setTimeout(() => {
                toastElm.remove();
            }, 1000);
        }, duration * 1000);
    }, 100);
}