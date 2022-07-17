// FIXME - This should be fetched and stored somewhere else.
const bodyContainer = document.querySelector('.container');

const modalQueue = [];

function initModal(modalName, wrapperDiv, payload) {
    const modalElement = wrapperDiv.querySelector('.modal');
    const veilShowClass = 'modal__veil--show';
    const panelShowClass = 'modal__panel--show';
    let modalObject;

    modalElement.classList.remove('modal');
    modalElement.classList.add('modal__veil');
    const loader = getLoader(payload.loaderCaption, 'white');
    const closeTrigger = elm('div', 'modal__close-trigger');
    const modalPanels = Array.from(modalElement.children);
    
    modalElement.insertBefore(closeTrigger, modalElement.firstChild);
    
    Router.domChangedImplementation();
    
    modalElement.appendChild(loader);
    modalElement.classList.add(veilShowClass);
    bodyContainer.classList.add('blur');

    // NOTE - At this point we have both the DOM element and the class
    // object. We should hang the functions off the object so we can
    // use them more easily in our class functions.

    modalPanels.forEach(modalPanel => {
        modalPanel.className = 'modal__panel';

        modalPanel.show = () => {
            // NOTE - This works here but not for modals in general because
            // other modals might be added after the first running on init.
            modalPanels.forEach(otherPanel => otherPanel.hide());
            modalPanel.classList.add(panelShowClass);
            const showFunction = modalPanel.getAttribute('onshow');
            if (showFunction && modalObject[showFunction]) {
                modalObject[showFunction]();
            }

            EventBus.emit(`modal-panel-show`, {
                modal : modalObject,
                panel : modalPanel
            });
        }

        modalPanel.hide = () => {
            modalPanel.classList.remove(panelShowClass);
        }

        modalPanel.validate = () => {
            const validationFunctionName = modalPanel.dataset.validate;
            if (validationFunctionName) {
                try {
                    return modalObject[validationFunctionName](modalPanel);
                } catch (e) {
                    showToast('Something went wrong during validation.');
                    return false;
                }
                
            }
            return true;
        }
    });

    // Set up data-nav links
    Array.from(modalElement.querySelectorAll('[data-nav]')).forEach(link => {
        link.addEventListener('click', e => {
            let allowNavigation = true;
            if (link.hasAttribute('validate')) {
                allowNavigation = modalElement.getCurrentPanel().validate();
            }
            if (allowNavigation) modalElement.showPanel(link.dataset.nav);
        });
    });

    Array.from(modalElement.querySelectorAll('[validate]')).forEach(element => {
        if (element.hasAttribute('data-nav')) return;
        element.addEventListener('click', e => {
            modalElement.getCurrentPanel().validate();
        });
    })

    // NOTE - isResumption is true when the modal is not being opened for the
    // first time but rather is being popped off the modal queue.
    modalElement.show = () => {
        // NOTE - Putting this inside an Immediate means that the modal's
        // constructor can finish running even if we attempt to call "show"
        // from inside the contructor.
        setImmediate(() => {
            const otherModals = Array.from(document.querySelectorAll('.modal-wrapper .modal__veil'));
            otherModals.forEach(otherModal => otherModal.hide());
            modalElement.classList.add(veilShowClass);
            bodyContainer.classList.add('blur');
            modalElement.isShowing = true;
            loader.remove();
            modalPanels[0].show();
            EventBus.emit(`modal-show`, {
                modal : modalObject
            });
        })
    }

    // NOTE - Hide only hides the modal and doesn't deploy the before-close
    // hook. It's used to clear other modals and stuff like that.
    modalElement.hide = (isClose) => {
        // NOTE - This is a little confusing. Basically if we're hiding a modal
        // without closing it, we add it to a queue and it'll pop back up again
        // when there are no other modals being shown. This makes it safe to pop
        // up a confirmation dialog over the top of another modal or something
        // like that.

        // if (!isClose && modalElement.classList.contains(veilShowClass)) {
        if (!isClose && modalElement.isShowing) {
            modalQueue.push(modalElement);
        }
        modalElement.classList.remove(veilShowClass);
        modalElement.isShowing = false;
        bodyContainer.classList.remove('blur');
    }

    // NOTE - Close, unlike hide, actually closes the modal.
    modalElement.close = () => {
        
        let doClose = true;

        // NOTE - This is just to make the function name case insensitive.
        if (modalObject.beforeClose) {
            doClose = modalObject.beforeClose();
        } else if (modalObject.beforeclose) {
            doClose = modalObject.beforeclose();
        }

        if (doClose) {
            modalObject.hide(true);
            const queueIndex = modalQueue.indexOf(modalElement);
            if (queueIndex !== -1) {
                modalQueue.splice(queueIndex, 1);
            }
            // Destroy it.
            wrapperDiv.remove();
            
            if (modalQueue.length) {
                modalQueue.pop().show(null, true);
            }
        }
    }
    closeTrigger.addEventListener('click', e => {
        // NOTE - This test for "isShowing" is what ensures
        // that clicking on the veil during the loading
        // phase doesn't run the close function.
        if(modalElement.isShowing) modalElement.close()
    });

    modalElement.showPanel = id => {
        const panel = modalElement.querySelector(`#${id}`);
        if (panel) panel.show();
    }

    modalElement.getValues = () => {
        const values = {};

        Array.from(modalElement.querySelectorAll('input')).forEach(input => {
            values[input.getAttribute('name')] = input.value;
        });

        return values;
    }

    modalElement.getCurrentPanel = () => modalElement.querySelector('.' + panelShowClass);

    if (typeof window[modalName] !== 'undefined') {
        modalObject = new window[modalName](modalElement, payload);
        modalElement.modalObject = modalObject;
    } else {
        modalObject = {}
    };

    // Attach these functions to the modal object for ease of access.
    modalObject.show        = function () { this.show(...arguments); }.bind(modalElement);
    modalObject.hide        = function () { this.hide(...arguments); }.bind(modalElement);
    modalObject.close       = function () { this.close(...arguments); }.bind(modalElement);
    modalObject.showPanel   = function () { this.showPanel(...arguments); }.bind(modalElement);
    modalObject.getValues   = function () { this.getValues(...arguments); }.bind(modalElement);
    modalObject.getCurrentPanel   = () => { return modalElement.getCurrentPanel() };
}

const loadedModals = {};
function showModal(modalName, payload) {
    if (!payload) payload = {};
    if (!loadedModals[modalName]) {
        // NOTE - This has to be declared out here so that it's accessible
        // in the scope of several of the following arrow functions.
        Util.loadCSS(`/webapp/modals/${modalName}/${modalName}.css`, cssResponse => {
            Util.loadHTML(`/webapp/modals/${modalName}/${modalName}.html`, htmlResponse => {
                Util.loadJS (`/webapp/modals/${modalName}/${modalName}.js`, jsResponse => {
                    loadedModals[modalName] = htmlResponse;
                    // NOTE - Yes, we need to do this here because it's asyncronous
                    unpackModal(modalName, loadedModals[modalName], payload);
                });
            });
        });
    } else {
        unpackModal(modalName, loadedModals[modalName], payload);
    }
}

function unpackModal (modalName, modalHtml, payload) {
    const wrapperDiv = elm('div', 'modal-wrapper');
    const tempDiv = elm('div', null, null, modalHtml);
    Array.from(tempDiv.children).forEach(tag => {
        if (tag.tagName === 'SCRIPT') {
            // // I know this looks crazy but this is what you
            // // have to do to make the browser actually parse
            // // the script tags after load in HTML 5.
            const scriptTag = elm('script');
            scriptTag.appendChild(txt(tag.innerText));

            tag.getAttributeNames().forEach(attrName => {
                scriptTag.setAttribute(attrName, tag.getAttribute(attrName));
            });
            tag = scriptTag;
        }
        wrapperDiv.appendChild(tag);
    });
    document.body.appendChild(wrapperDiv);
    initModal(modalName, wrapperDiv, payload);
}

// FIXME - This whole thing is a bit awful. Use this
// example to inform the redesign.
function showConfirmation(title, message, yesCaption, noCaption, yesCallback, noCallback) {
    showModal('ConfirmationDialog', {
        title : title,
        message : message,
        yesCaption : yesCaption,
        noCaption : noCaption,
        yesCallback : yesCallback,
        noCallback : noCallback
    });
}

function showAlert(title, message, buttonCaption) {
    showModal('AlertDialog', {
        title : title,
        message : message,
        buttonCaption : buttonCaption,
    });
}