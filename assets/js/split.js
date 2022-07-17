function initSplit() {
    let options = Array.from(document.querySelectorAll(".js-split-option"));

    for (var i = 0; i < options.length; i++) {
        const option = options[i];

        option.hoverTimeout;

        option.addEventListener("mouseover", (e) => {
            option.classList.add("hover");

            clearTimeout(option.hoverTimeout);
        });

        option.addEventListener("mouseout", (e) => {
            option.hoverTimeout = setTimeout(() => option.classList.remove("hover"), 200);
        });
    }
}

initSplit();
