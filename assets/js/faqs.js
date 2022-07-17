const SHOW_CLASS = "faqs-body--show";

const faqsSwitch = document.getElementById("faqs-switch");

const faqsContainer = document.getElementById("faqs-body-container");

let currentBody;

function setFaqsMode(mode) {
    faqsSwitch.dataset.selected = mode;

    Array.from(document.querySelectorAll(".faqs-body")).forEach((element) => {
        element.classList.remove(SHOW_CLASS);
    });

    currentBody = document.getElementById("faqs-" + mode);

    if (currentBody) {
        currentBody.classList.add(SHOW_CLASS);

        resetHeight();
    }
}

function resetHeight() {
    const shownBody = document.querySelector(`.${SHOW_CLASS}`);

    if (shownBody) {
        faqsContainer.style.height = shownBody.offsetHeight + "px";
    }
}

setFaqsMode("artists");

window.addEventListener("resize", (e) => {
    if (currentBody) {
        faqsContainer.style.height = currentBody.offsetHeight + "px";
    }
});

Array.from(document.querySelectorAll(".faqs-q")).forEach((qDiv) => {
    qDiv.addEventListener("click", (e) => {
        qDiv.classList.toggle("faqs-q--open");

        resetHeight();
    });
});
