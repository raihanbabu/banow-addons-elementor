let isExploded = false;

function openExplosion() {
    isExploded = true;

    let portraits = Array.from(document.querySelectorAll(".js-explosion-portrait"));

    for (var i in portraits) {
        let portrait = portraits[i];

        portrait.style.top = portrait.dataset.yOpen + "%";

        portrait.style.left = portrait.dataset.xOpen + "%";
    }
}

function closeExplosion() {
    isExploded = false;

    let portraits = Array.from(document.querySelectorAll(".js-explosion-portrait"));

    for (var i in portraits) {
        let portrait = portraits[i];

        portrait.style.top = portrait.dataset.yClosed + "%";

        portrait.style.left = portrait.dataset.xClosed + "%";
    }
}

let exploderSection = document.querySelector(".js-explode");

if (exploderSection) {
    const callback = (e) => {
        let exploderViewport = exploderSection.getBoundingClientRect();

        if (exploderViewport.top < window.innerHeight / 3 && exploderViewport.top > 0 - exploderViewport.height / 2) {
            if (!isExploded) openExplosion();
        } else if (isExploded) closeExplosion();
    };

    document.addEventListener("scroll", callback);

    document.body.addEventListener("scroll", callback);
}
