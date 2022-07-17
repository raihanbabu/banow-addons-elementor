const observerElements = Array.from(document.querySelectorAll(".hiw-step, .hiw-divider"));

let observer = new IntersectionObserver(
    (entries, observer) => {
        let intersectionFound = false;

        observerElements.forEach((element) => {
            if (element.getBoundingClientRect().top > window.innerHeight) {
                element.classList.remove("hiw-step--reveal");
            } else {
                element.classList.add("hiw-step--reveal");
            }
        });
    },
    {
        threshold: 0.4,
    }
);

observerElements.forEach((step) => observer.observe(step));
