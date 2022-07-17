// This is the better one. I'll convert the other one when I get time.

function initSliders() {
    let sliders = Array.from(document.querySelectorAll(".js-slider"));

    const activePipClass = "slider__pip--active";

    for (var i in sliders) {
        let sliderIndex = 0;

        let slider = sliders[i];

        let sliderTrack = slider.querySelector(".js-slider-track");

        let pips = Array.from(slider.querySelectorAll(".js-slider-pip"));

        let nextBtn = slider.querySelector(".js-slider-next");

        let prevBtn = slider.querySelector(".js-slider-prev");

        let menuItems = Array.from(slider.querySelectorAll(".js-slider-menu-item"));

        let sliderIndexMax = sliderTrack.children.length - 1;

        if (nextBtn) nextBtn.addEventListener("click", (e) => slider.sliderNext());

        if (prevBtn) prevBtn.addEventListener("click", (e) => slider.sliderPrev());

        let touchStartX;

        let touchDeltaX;

        sliderTrack.addEventListener("touchstart", (e) => {
            touchStartX = e.touches[0].screenX;
        });

        sliderTrack.addEventListener("touchmove", (e) => {
            touchDeltaX = e.touches[0].screenX - touchStartX;
        });

        sliderTrack.addEventListener("touchend", (e) => {
            if (Math.abs(touchDeltaX) > 30) {
                touchDeltaX < 0 ? slider.sliderNext() : slider.sliderPrev();
            }
        });

        // I don't particularly like these js-set styles so I'm

        // totally open to a better way of doing this.

        sliderTrack.style.width = sliderTrack.children.length * 100 + "%";

        for (var i = 0; i < sliderTrack.children.length; i++) {
            let sliderItem = sliderTrack.children[i];

            sliderItem.style.width = sliderTrack.children.length * 100 + "%";
        }

        slider.sliderSlide = () => {
            sliderTrack.style.left = "-" + sliderIndex * 100 + "%";

            slider.updatePips();
        };

        slider.sliderSet = (index) => {
            sliderIndex = index % (sliderIndexMax + 1);

            slider.sliderSlide();
        };

        slider.sliderNext = () => {
            sliderIndex++;

            if (sliderIndex > sliderIndexMax) sliderIndex = 0;

            slider.sliderSlide();
        };

        slider.sliderPrev = () => {
            sliderIndex--;

            if (sliderIndex < 0) sliderIndex = sliderIndexMax;

            slider.sliderSlide();
        };

        slider.updatePips = () => {
            if (!pips.length) return;

            for (var i = 0; i < pips.length; i++) pips[i].classList.remove(activePipClass);

            pips[sliderIndex].classList.add(activePipClass);
        };

        for (let i = 0; i < pips.length; i++) {
            pips[i].addEventListener("click", (e) => {
                slider.sliderSet(i);
            });
        }

        if (pips[0]) pips[0].classList.add(activePipClass);
    }
}

initSliders();
