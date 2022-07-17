function initTestimonials() {
    // let bodies = Array.from(document.querySelectorAll('.js-testimonial-body'));

    const bodies = [...document.querySelectorAll(".js-testimonial-body")];

    let bylines = Array.from(document.querySelectorAll(".js-testimonial-byline"));

    let calloutTick = document.querySelector(".js-callout-tick");

    let calloutOffset = 15;

    let showClass = "lp-they-say__testimonial--show";

    let currentIndex = 0;

    let prevButton = document.querySelector(".js-testimonial-left");

    let nextButton = document.querySelector(".js-testimonial-right");

    bodies[0].classList.add(showClass);

    for (var i in bylines) {
        let byline = bylines[i];

        let index = byline.dataset.index;

        byline.giveFocus = (e) => showTestimonialByIndex(index);

        byline.addEventListener("click", byline.giveFocus);
    }

    // FIXME - Doing this duplication hurts me as much as it hurts you.

    prevButton.addEventListener("click", (e) => {
        currentIndex = (currentIndex - 1) % bodies.length;

        if (currentIndex < 0) currentIndex += bodies.length;

        showTestimonialByIndex(currentIndex);
    });

    nextButton.addEventListener("click", (e) => {
        currentIndex = (currentIndex + 1) % bodies.length;

        if (currentIndex < 0) currentIndex += bodies.length;

        showTestimonialByIndex(currentIndex);
    });

    const showTestimonialByIndex = (index) => {
        calloutTick.style.left = parseInt(index) * (100 / bylines.length) + calloutOffset + "%";

        for (var j in bodies) {
            let body = bodies[j];

            body.classList.remove(showClass);

            if (body.dataset.index === "" + index) {
                body.classList.add(showClass);
            }
        }

        currentIndex = parseInt(index);
    };
}

initTestimonials();
