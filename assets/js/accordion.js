function initAccordions() {
    let accordions = Array.from(document.querySelectorAll(".js-accordion"));

    for (var i in accordions) {
        initAccordion(accordions[i]);
    }
}

initAccordions();

function initAccordion(accordion) {
    accordionItems = Array.from(accordion.querySelectorAll(".js-accordion-item"));

    for (var i in accordionItems) {
        let accordionItem = accordionItems[i];

        let accordionHeader = accordionItem.querySelector(".js-accordion-header");

        accordionHeader.addEventListener("click", (e) => {
            if (accordionItem.classList.contains("accordion__item--open")) {
                hideAccordionItem(accordionItem);

                showAccordionItem(accordionItems[0]);
            } else {
                let openItem = accordion.querySelector(".accordion__item--open");

                if (openItem) {
                    hideAccordionItem(openItem);
                }

                showAccordionItem(accordionItem);
            }
        });
    }

    showAccordionItem(accordionItems[0]);
}

function showAccordionItem(accordionItem) {
    accordionItem.classList.add("accordion__item--open");

    if (accordionItem.dataset.auxId) {
        const itemAux = document.getElementById(accordionItem.dataset.auxId);

        if (itemAux) {
            itemAux.classList.add("show");
        }
    }
}

function hideAccordionItem(accordionItem) {
    accordionItem.classList.remove("accordion__item--open");

    if (accordionItem.dataset.auxId) {
        const itemAux = document.getElementById(accordionItem.dataset.auxId);

        if (itemAux) {
            itemAux.classList.remove("show");
        }
    }
}
